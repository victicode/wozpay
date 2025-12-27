<template>
  <div>
    <q-dialog v-model="dialog"  persistent class="withdrawal__modal">
      <q-card style=" overflow: visible; border-radius: 10px;" class="position-relative card__withdrawal" >
        <q-card-section class="flex q-py-sm w-100 items-center justify-between">
          <div class="flex items-center">
            <div class="text-black text-bold">
              Formulario de retiro
            </div>
          </div>
          <q-btn @click="hideModal" size="0.2rem" flat style="padding:0.3rem 0px;">
            <q-icon name="eva-close-outline" size="sm" color="grey-6" />
          </q-btn>
        </q-card-section>
        <q-linear-progress :value="1" color="grey-5" size="0.125rem"/>
        <q-card-section>
          <div>
            <div class="flex justify-between items-center q-mt-xs containerSaldo">
              <div class="text-balanceSaldo">Saldo total</div>
              <div class="text-balanceSaldo">Gs. {{ numberFormat(withdrawal.balanceTotal) }}</div>
            </div>
            <div class="q-mt-lg">
              <div style="font-size: .95rem;" class="text-bold q-mb-md q-mt-md">
                Retira tus ganancias
              </div>
              <div class="q-pt-sm">
                <q-input
                  class="withdrawalAmount"
                  outlined
                  clearable
                  :clear-icon="'eva-close-outline'"
                  color="positive"
                  v-model="withdrawal.amount"
                  label="¿Cuanto quieres retirar?"
                  mask="###.###.###"
                  reverse-fill-mask
                  :rules="amountRules"
                  autocomplete="off"
                  @keyup="deducAmount()"
                />
              </div>
              <div class="" style="border: 1px solid lightgray; border-radius:0.87rem; padding: 0.5rem 1rem;">
                <div class="flex items-center justify-between q-pb-sm">
                  <div >
                    <div class="title-withdarwal">Comisión a pagar</div>
                    <div class="subtitle-withdarwal text-grey-7">{{ numberFormat(withdrawal.sliderCheck.value)}}% sobre monto a retirar</div>
                  </div>
                  <div class="title-withdarwal">Gs. {{numberFormat(withdrawal.deductAmount)}}</div>
                </div>
                <div class="flex items-center justify-between q-pt-sm" style="border-top: 1px solid lightgray;">
                  <div>
                    <div class="title-withdarwal">Comisión fija</div>
                    <div class="subtitle-withdarwal text-grey-7">1,5 USD fijo</div>
                  </div>
                  <div class="title-withdarwal" >Gs. {{numberFormat(7500)}}</div>
                </div>
              </div>
              <div class="q-mt-md">
                <div class="flex justify-between items-center q-mt-xs containerSaldoGreen">
                  <div class="text-balanceSaldo text-positive">Total a retirar</div>
                  <div class="text-balanceSaldo text-positive">Gs. {{ numberFormat(withdrawal.totalWithdrawalAmount) }}</div>
                </div>
              </div>
              <div class="q-pt-sm q-px-xs  q-mt-lg" >
                <q-btn 
                  unelevated
                  no-caps 
                  color="positive" 
                  class="redirect_button" 
                  style="width: 100%;"
                >
                  <div class="q-py-sm">
                    Solicitar
                  </div>
                </q-btn>
                <div style="font-size: 0.8rem;" class="text-primary q-px-md-xs q-mt-xs">
                  Tu dinero estará disponible en 24hs a 72h habiles
                </div>
              </div>
            </div>
          </div>
        </q-card-section>
      </q-card>
    </q-dialog>
  </div>
</template>
<script>
  import { inject, onMounted, ref, watch } from 'vue';
  import utils from '@/util/numberUtil';
 
  export default {
    props: {
      dialog: Boolean,
      withdrawalData: Object
    },
    emits: ['hideModal'],
    
    setup (props, { emit }) {
      const dialog = ref(props.dialog);
      const withdrawal = ref(props.withdrawalData)
      const numberFormat = utils.numberFormat
      const amountRules = [
        val => (val !== null && val !== '') || 'Monto es requerido.',
        val => (val.length >= 6 ) || 'Formato no valido',
        val => (/[,%"'();&|<>]/.test(val) == false ) || 'No debe contener "[](),%|&;\'" ',
      ]
      const hideModal = (data) => {
        emit('hideModal', data )
      }
      const deducAmount = () => {

        let amount = typeof withdrawal.value.amount == 'number' ? withdrawal.value.amount : parseInt(withdrawal.value.amount.replace(/\./g, ''))
        console.log(typeof withdrawal.value.amount )
        console.log(amount )

        withdrawal.value.deductAmount = ( amount * withdrawal.value.sliderCheck.value)/100;
        withdrawal.value.totalWithdrawalAmount = amount - withdrawal.value.deductAmount - 7500;
      }
      watch(() => props.dialog, (newValue) => {
        dialog.value = newValue
        deducAmount()
      });
      

      return {
        dialog,
        withdrawal,
        hideModal,
        numberFormat,
        amountRules,
        deducAmount,
      }
    }
  };
</script>
<style>
.containerSaldoGreen{
  border: 1px solid #20ce1c;
  border-radius: 0.5rem;
  padding: 0.7rem 0.8rem;
}
.subtitle-withdarwal{
  font-size: 0.69rem;
}
.title-withdarwal{
  font-size: 0.95rem;
  font-weight: 400;
}
.card__withdrawal{
  width: 850px;
}
@media screen and (max-width: 780px){
  .card__withdrawal{
    width: 350px;
  }
}
.withdrawalAmount {

  & .q-field__control{
    border-radius: 10px!important;
    height: 50px!important;
    min-height: 50px!important;
  }
  & .q-field__label{
  transform: translateY(0%)
  }
  &.q-field--focused .q-field__label, &.q-field--float .q-field__label{
    z-index: 100;
    background: white;
    font-weight: 600;
    max-width: 133%;
    transform: translateY(-125%) translateX(4%) scale(0.75)!important;
  }

  & .q-field__native{
    padding-top: 5px!important;
    font-weight: 500;
  }
  & .q-field__append{
    transform: translateY(-2%)
  }
  & .q-field__messages {
    transform: translateY(-25%) translateX(-1%)
  }

}
.withdrawalAmount .q-field__native{
  padding-top: 15px!important;
}
.withdrawal__modal{
  width: 100%;
  & .q-dialog__inner{
    padding: 0;
  }
}
</style>
<style lang="scss" scoped>

.containerSaldo{
  border: 1px solid rgb(148, 148, 148);
  border-radius: 0.4rem;
  padding: 0.7rem 0.8rem;
}
.w-100 {
  width: 100%;
}
.negative-back {
  background-color: #ff00001a;border-radius: 20px;
}

.button-file {
  width: 60px; 
  height: 60px; 
  border-radius: 10px; 
  box-shadow: 0px 2px 8px 0px rgba(168, 167, 167, 0.829);
}
.cls-button{
  position: absolute; 
  right: -10px; 
  top:-10px; 
  z-index: 15;
}
</style>
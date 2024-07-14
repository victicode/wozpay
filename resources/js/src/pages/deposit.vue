<template>
  <div style="height: 91vh; overflow: scroll;">
    <div class="q-pa-md-md q-pa-sm q-px-md q-mb-xl" >
      <Transition name="inFade">
        <div v-if="ready">
          <div>
            <div class="text-body2 text-weight-bold q-mb-sm q-pt-sm ">¿Por qué pedimos que cargues tu billetera?
            </div>
            <div class="benefict-options__container q-pa-md">
              <div class="text-weight-medium q-mb-xs">• Debito de los préstamos</div>
              <div class="text-weight-medium q-mb-xs">• Pago de servicios</div>
              <div class="text-weight-medium ">• Mayor posibilidad de préstamos</div>
            </div>
          </div>
          <div class="q-mt-md">
            <div>
              <div class="text-body1 text-weight-bold q-mb-xs q-pt-sm ">
                Escoge cuánto cargar
              </div>
              <div class="text-caption text-weight-medium q-mb-sm " style="font-size: 0.73rem!important;">
                Podrás usar este saldo para pagos de servicios y cuotas.
              </div>
            </div>
            <div class="q-mt-md">
              <div v-for="n in amountList" :key="n" class=" q-mb-md amount__container q-pl-md">
                <div class="text-weight-medium">Gs {{ numberFormat(n) }}</div>
                <div></div>
              </div>
            </div>
          </div>
          <div class="q-mt-md">
            <div>
              <div class="text-body2 text-weight-bold q-mb-xs q-pt-sm ">
                ¿Quieres cargar un monto personalizado?
              </div>
              <div class="text-caption text-weight-medium q-mb-sm " style="font-size: 0.73rem!important;">
                Indica cuánto quieres cargar en tu billetera
              </div>
            </div>
            <div class="q-mt-lg">
              <div>
                <q-input v-model="mount" placeholder="GS. 0" class="amount_diff"  />
              </div>
            </div>
            <div>
              <q-btn 
                  label="Pagar con Tigo Money" 
                  unelevated
                  no-caps 
                  type="submit" 
                  color="tigo" 
                  class="full-width q-mt-lg rounded_button" 
                  :loading="loading" 
                >
                  <template v-slot:loading>
                    <q-spinner-facebook />
                  </template>
                </q-btn>
                <q-btn 
                  label="Pagar con Personal Pay" 
                  unelevated
                  no-caps 
                  type="submit" 
                  color="personal" 
                  class="full-width q-mt-sm rounded_button" 
                  :loading="loading" 
                >
                  <template v-slot:loading>
                    <q-spinner-facebook />
                  </template>
                </q-btn>
            </div>
          </div>
        </div>
        <div v-else>
          <div class="text-subtitle1 text-weight-bold q-mb-sm  "> <q-skeleton type="text" width="30%" /></div>
          <div v-for="n in 8" :key="n" class=" q-px-sm q-mb-md bank__section_skeleton" >
            <q-skeleton type="QBtn" width="20%" height="15px" />
          </div>
        </div>
      </Transition>      
    </div>
  </div>
</template>
<script>
  import { onMounted, ref } from 'vue'
  import wozIcons from '@/assets/icons/wozIcons'
  import { useBankAccountStore } from '@/services/store/bankAccount.store'
  import { useRouter } from 'vue-router';
  import util from '@/util/numberUtil'
  export default {
    setup () {
      const ready = ref(true)
      const router = useRouter()
      const numberFormat = util.numberFormat
      const loading = ref(false)
      const amountList = [
        30000,
        60000,
        100000,
        150000
      ]
      const mount = ref('')

      const loadingShow = (state) => {
        loading.value = state;
      }
      onMounted(() => {
      })
      return { ready, wozIcons, numberFormat, amountList, mount, loading }
    },
  }
</script>
<style lang="scss" scoped>
.bank__section_skeleton{
  padding-top: 1.2rem;
  padding-bottom: 1.2rem;

}
.benefict-options__container{

  border: 1.5px solid $primary;
  border-radius: 15px;
}
.amount__container{
  border: 1px solid $grey-5;
  border-radius: 10px;
  height: 48px;
  display: flex;
  align-items: center;
  overflow: hidden;
}
</style>
<style>
.bg-tigo {
  background: #fab32a!important;
}
.text-tigo {
  color: #fab32a!important;
}
.bg-personal{
  background: #6128be!important;
}
.text-personal{
  color: #6128be!important;
}
.rounded_button{
  border-radius: 12px!important;
  padding: 0.8rem 0px!important;
}
.amount_diff input::placeholder{
  color: rgb(165, 165, 165);
  text-align: center;
  font-size: 35px;
  transform: translateY(10px);
}
</style>
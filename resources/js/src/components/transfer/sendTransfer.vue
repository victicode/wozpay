<template>
  <div class="section_page q-mt-lg q-pt-lg">
    <div class="">
      <div class="text-subtitle1 text-weight-bold text-center">Escoge una cuenta a debitar</div>
      <div class="q-px-md-xl q-px-md">
        <div class="q-pa-md select_card q-mt-md">
          <div class="flex" >
            <div style="width: 10%;" class="q-mr-sm text-center">
              <q-radio v-model="selectCard" checked-icon="eva-checkmark-circle-outline"  val="1" />
            </div>
            <div class="flex justify-between card_detail q-pb-sm" >
              <div>
                <div class="text-left text-body1">
                  Tarjeta de crédito
                </div>
                <div class="text-left text-body2 text-grey-6">
                  Hasta 24 meses
                </div>
              </div>
              <div>
                <div class="text-right text-weight-medium text-caption">
                  Préstamos hasta
                </div>
                <div class="text-right text-weight-bold text-body2">
                  {{ numberFormat(25000000) }}
                </div>
              </div>
            </div>

          </div>
          <div class="flex q-mt-md" >
            <div style="width: 10%;" class="q-mr-sm text-center">
              <q-radio v-model="selectCard" checked-icon="eva-checkmark-circle-outline"  val="2" />
            </div>
            <div class="flex justify-between card_detail q-pb-sm" >
              <div>
                <div class="text-left text-body1">
                  Tarjeta de débito
                </div>
                <div class="text-left text-body2 text-grey-6">
                  Hasta 15 días
                </div>
              </div>
              <div>
                <div class="text-right text-weight-medium text-caption">
                  Préstamos hasta
                </div>
                <div class="text-right text-weight-bold text-body2">
                  {{ numberFormat(500000) }}
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
      <div class="text-subtitle1 text-weight-bold q-mt-md q-pt-md text-center">Datos de envío</div>
      <div class="q-px-md-xl q-px-md">
        <div class="">
          <q-form
            id="linked_form"
            class=""
            @submit="linkCard()"
          >
            <div class="q-px-md-xl">
              <div class="q-pb-xs  q-px-md-lg card_form ">
                <div class="q-mb-lg q-mt-md">
                  <q-input
                    class="transferForm q-pb-none"
                    outlined
                    clearable
                    :clear-icon="'eva-close-outline'"
                    color="positive"
                    v-model="formCardData.card"
                    label="N° de tarjeta de débito o crédito"
                    :rules="rulesForm('card')"
                    autocomplete="off"
                    maxlength="24"
                    mask="#### #### #### #### ####"
                  />
                </div>
                <div class="q-my-lg">
                  <q-input
                    class="transferForm q-pb-none"
                    outlined
                    clearable
                    :clear-icon="'eva-close-outline'"
                    color="positive"
                    v-model="formCardData.card"
                    label="N° de tarjeta de débito o crédito"
                    :rules="rulesForm('card')"
                    autocomplete="off"
                    maxlength="24"
                    mask="#### #### #### #### ####"
                  />
                </div>
                <div class="q-my-lg">
                  <q-input class="transferForm q-pb-none"
                    outlined
                    clearable
                    :clear-icon="'eva-close-outline'"
                    color="positive"
                    v-model="formCardData.due_date"
                    label="Fecha de vencimiento"
                    :rules="rulesForm('card_date')"
                    autocomplete="off"
                    hint="Formato EJ.: 01/2024 "
                    mask="##/####"
                  >
                  </q-input>
                </div>
                <div class="q-my-lg">
                  <q-input
                    class="transferForm q-pb-none"
                    outlined
                    clearable
                    :clear-icon="'eva-close-outline'"
                    color="positive"
                    v-model="formCardData.cvc"
                    name="id_user"
                    label="Código de seguridad"
                    :rules="rulesForm('cvc')"
                    autocomplete="off"
                    maxlength="3"
                  />
                </div>
              </div>
            </div>
            <div class="q-px-sm q-mt-sm q-px-md-xl q-mx-md-xl">
              <q-btn 
                color="primary" class="w-100 q-pa-sm q-mb-sm  link_button" 
                no-caps
                :loading="loading"
                @click="goTo()"
              >
                <div class="text-white q-mt-sm text-subtitle1 text-weight-medium"  >
                  Enviar
                </div> 
              </q-btn>
              <div class="q-px-sm q-mt-sm text-primary">
                Transacción segura con Woz Security Services
              </div>
            </div>
          </q-form>
        </div>
      </div>

    </div>
  </div>
</template>
<script>
  import { useAuthStore } from '@/services/store/auth.store'
  import { inject, ref } from 'vue'
  import util from '@/util/numberUtil'
  import { useQuasar } from 'quasar'
  import { useRouter } from 'vue-router'

  export default {
    setup() {
      //vue provider
      const user = useAuthStore().user;
      const numberFormat = util.numberFormat
      const icons = inject('ionIcons')
      const q = useQuasar()
      const router = useRouter()
      const loading = ref(false)
      // Data
      const selectCard = ref(0)

      const formCardData = ref({
        card:'',
        due_date:'',
        cvc:'',
      })

      const rulesForm = (id) => {
        const iRules = {
          card:[
            val => (val !== null && val !== '') || 'El número de tarjeta es requerido.',
            // val => (val.length > 20 ) || 'Debe contener 20 digitos',
            val => (/[a-zA-z,%"'();&|<>]/.test(val) == false ) || "Se permiten solo valores numericos",
          ],
          card_type:[
            val => (val !== null && val !== '') || 'El tipo de tarjeta es requerido.',
          ],
          card_date:[
            val => (val !== null && val !== '') || 'La fecha de vencimiento es requerida.',
            // val => (/[,%"' ();&|<>]/.test(val) == false ) || 'No debe contener espacios, ni "[](),%|&;\'" ',
          ],
          cvc:[
            val => (val !== null && val !== '') || 'El CVC es obligatorio.',
            val => (/[a-zA-z,%"' ();&|<>]/.test(val) == false ) || "Se permiten solo valores numericos",
          ],
        }
        
        return iRules[id]
      }

      const goTo = () => {
        if(!verify()){
          showNotify('negative', 'Debe seleccionar el tipo de tarjeta')
          return
        }
        router.push('/linked_card/'+selectCard.value)
      }
      const verify = () => {
        
        return selectCard.value !== 0
      }
      const showNotify = (type, message) => {
        q.notify({
          message: message,
          color: type,
          actions: [
            { icon: 'eva-close-outline', color: 'white', round: true, handler: () => { /* ... */ } }
          ]
        })
      }
       const linkCard = () => {
          console.log('hola')
       }
      return{
        icons,
        user,
        numberFormat,
        selectCard,
        loading,
        formCardData,
        goTo,
        rulesForm,
        linkCard,
      }
    },
  }

</script>
<style>

</style>
<style lang="scss" scoped>
  .link_button  {
    border-radius: 15px!important;
  }
  .w-100{
    width: 100%;
  }
  .card_detail{
    width: 86%; 
    border-bottom: 1.5px solid #ececec;
  }
  .select_card{
    box-shadow: 0px 4px 8px 0px rgba(134, 134, 134, 0.397);
    border-radius: 20px;
  }
  .section_page {
    background: white;
    height: 100%;
    width: 100%;
    border-top-left-radius: 50px;
    border-top-right-radius: 50px;
  }
</style>
<style lang="scss">
  .transferForm.q-field--auto-height.q-field--labeled{
     & .q-field__control-container{
      padding-top: 0px!important;
     }
  }
  .transferForm {
    
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
      transform: translateY(-110%) translateX(4%) scale(0.75)!important;
    }
    
    & .q-field__native{
      padding-top: 15px!important;
      font-weight: 500;
    }
    & .q-field__append{
      transform: translateY(-2%)
    }
  }
  @media screen and (max-width: 780px){
  .transferForm {
      & .q-field__bottom{
        transform: translateY(15px);
      }
    }
  }

</style>
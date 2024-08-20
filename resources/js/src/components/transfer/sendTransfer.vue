<template>
  <div class="section_page q-mt-md q-pt-lg">
    <div class="section__page" style="max-height: 100%; overflow: scroll;">
      <div class="text-subtitle1 text-weight-bold text-center">Escoge una cuenta a debitar</div>
      <div class="q-px-md-xl q-px-md">
        <div class="q-pa-md select_card q-mt-sm">
          <div class="flex" v-if="Object.values(linkCard).length > 0 ">
            <div style="width: 10%;" class="q-mr-sm text-center">
              <q-radio v-model="selectPayMethod" checked-icon="eva-checkmark-circle-outline"  val="1" />
            </div>
            <div class="flex justify-between card_detail q-pb-sm" >
              <div>
                <div class="text-left text-body1">
                  {{ linkCard.type == 1 ? 'Tarjeta de crédito' : 'Tarjeta de dédito' }}
                </div>
                <div class="text-left text-body2  text-bold">
                  N° **************** {{ linkCard.number.substring(linkCard.number.length - 4) }}
                </div>
              </div>
              <div>
                <q-chip :color="linkCard.status == 1 ? 'positive' : 'warning'" text-color="white" >
                  Vinculada
                </q-chip>
              </div>
            </div>

          </div>
          <div class="flex q-mt-md" >
            <div style="width: 10%;" class="q-mr-sm text-center">
              <q-radio v-model="selectPayMethod" checked-icon="eva-checkmark-circle-outline"  val="2" />
            </div>
            <div class="flex justify-between card_detail q-pb-sm" >
              <div>
                <div class="text-left text-body1">
                  Caja de ahorro
                </div>
                <div class="text-left text-body2  text-bold">
                  N° 9164920791
                </div>
              </div>
              <div>
                <div class="text-right text-weight-medium text-caption">
                  Disponible
                </div>
                <div class="text-right text-weight-bold text-body2">
                  Gs. {{ numberFormat(500000) }}
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
      <div class="text-subtitle1 text-weight-bold q-mt-sm q-pt-md text-center">Datos de envío</div>
      <div class="q-px-md-xl q-px-md">
        <div class="">
          <q-form
            id="linked_form"
            class=""
            @submit="storeTransfer()"
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
                    v-model="formCardData.amount"
                    label="Monto a enviar"
                    :rules="rulesForm('amount')"
                    autocomplete="off"
                    maxlength="24"
                    mask="###.###.###"
                    reverse-fill-mask
                  />
                </div>
                <div class="q-my-lg">
                  <q-input
                    class="transferForm q-pb-none"
                    outlined
                    clearable
                    :clear-icon="'eva-close-outline'"
                    color="positive"
                    v-model="formCardData.recept"
                    label="Número de cuenta Woz Pay"
                    :rules="rulesForm('recept')"
                    autocomplete="off"
                    @change="getWalletToTransfer()"
                  />
                </div>
                <div class="q-my-lg">
                  <q-input
                    class="transferForm q-pb-none"
                    outlined
                    clearable
                    :clear-icon="'eva-close-outline'"
                    color="positive"
                    v-model="formCardData.recept_owner"
                    name="id_user"
                    label="Titular "
                    autocomplete="off"
                    disable
                  />
                </div>
                <div class="q-my-lg">
                  <q-input
                    class="transferForm q-pb-none"
                    outlined
                    clearable
                    :clear-icon="'eva-close-outline'"
                    color="positive"
                    v-model="formCardData.recept_dni"
                    name="id_user"
                    label="Número de cédula"
                    disable
                    autocomplete="off"
                  />
                </div>
                <div class="q-my-lg">
                  <q-input class="transferForm q-pb-none"
                    outlined
                    clearable
                    :clear-icon="'eva-close-outline'"
                    color="positive"
                    v-model="formCardData.text"
                    label="Concepto"
                    :rules="rulesForm('text')"
                    autocomplete="off"
                  >
                  </q-input>
                </div>
              </div>
            </div>
            <div class="q-px-sm q-mt-sm q-px-md-xl q-mx-md-xl">
              <q-btn 
                color="primary" class="w-100 q-pa-sm q-mb-sm  link_button" 
                no-caps
                :loading="loading"
                type="submit"
              >
                <div class="text-white q-mt-sm text-subtitle1 text-weight-medium"  >
                  Enviar
                </div> 
              </q-btn>
              <div class="q-px-sm q-mt-sm text-primary q-pb-xl">
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
  import { useUserStore } from '@/services/store/user.store'
  import { useCardStore } from '@/services/store/card.store'
  import { inject, ref } from 'vue'
  import { useQuasar } from 'quasar'
  import util from '@/util/numberUtil'

  export default {
    setup() {
      //vue provider
      const user = useAuthStore().user;
      const userStore = useUserStore();
      const cardStore = useCardStore()
      const numberFormat = util.numberFormat
      const icons = inject('ionIcons')
      const q = useQuasar()
      // const router = useRouter()
      const loading = ref(false)
      // Data
      const selectPayMethod = ref(0)
      const linkCard = ref({})
      const formCardData = ref({
        amount:'',
        recept:'',
        text:'',
        recept_owner: '',
        recept_dni: '',
      })

      const rulesForm = (id) => {
        const iRules = {
          amount:[
            val => (val !== null && val !== '') || 'El monto es requerido.',
            // val => (val.length > 20 ) || 'Debe contener 20 digitos',
            val => (/[a-zA-z,%"'();&|<>]/.test(val) == false ) || "Se permiten solo valores numericos",
          ],
          recept:[
            val => (val !== null && val !== '') || 'El receptor es requerido.',
            val => (/[a-zA-z,%"'();&|<>]/.test(val) == false ) || "Se permiten solo valores numericos",

          ],
          text:[
            val => (val !== null && val !== '') || 'El concepto es requerido.',
            val => (/[,%$#"' ();&|<>]/.test(val) == false ) || 'No debe contener espacios, ni "[](),%|&;\'" ',
          ],
        }
        
        return iRules[id]
      }
      const validate = () => {
        let isOk  = true
        let msg   = ''
        const dontValidate = ['recept_owner','recept_dni'];

        Object.entries(formCardData.value).forEach( ([key, value]) => {
          if(dontValidate.includes(key)) return
          if(value == '') { 
            isOk = false 
            msg = 'Debes completar el formulario'
          }
        });

        if(selectPayMethod.value == 0) {
          isOk = false 
          msg = 'Debes seleccionar la cuenta a debitar'
        }

        !isOk ? showNotify('negative', msg) : ''
        return isOk

        
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
      const storeTransfer = () => {
        if(!validate()) return
      }
      const getLinkCard = () => {
        cardStore.getCard(user.id).then((data) => {
          if(data.code !== 200) throw data
          linkCard.value = data.data ? Object.assign(data.data) : {}
        }).catch((response) => {
          // showNotify('negative', response)
        })
      }
      const getWalletToTransfer = () => {
        loadingWallet(true)
        userStore.getUserByWallet(formCardData.value.recept)
        .then((data) =>{
          if(!data.code) throw data

          setTimeout(() => {
            formCardData.value.recept_owner = data.data.user.name
            formCardData.value.recept_dni = numberFormat(data.data.user.dni)
          }, 2000)
        }).catch((response) => {
          console.log(response)
          setTimeout(() => {
            loadingWallet(false)
            showNotify('negative', response)
          }, 2000)
        })
      }
      const loadingWallet = (status) => {
        formCardData.value.recept_owner = status ? 'Cargando...' : '';
        formCardData.value.recept_dni = status ? 'Cargando...' : '';
      }
      onMounted(() => {
        getLinkCard()
      })
      return{
        icons,
        user,
        numberFormat,
        selectPayMethod,
        loading,
        formCardData,
        linkCard,
        rulesForm,
        storeTransfer,
        getWalletToTransfer,
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
</style>
<style lang="scss">
  .section_page {
    background: white;
    height: 100%;
    width: 100%;
    border-top-left-radius: 50px;
    border-top-right-radius: 50px;
    
  }
  .section__page::-webkit-scrollbar {
    width: 5px;
    height: 8px;
    border-radius: 15px;
    background-color: #aaa; /* or add it to the track */
  }
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
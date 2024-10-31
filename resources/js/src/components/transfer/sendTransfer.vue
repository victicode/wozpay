<template>
  <div class="section_page q-mt-md q-pt-lg">
    <div class="section__page" style="max-height: 100%; overflow-y: auto;">
      <div class="text-subtitle1 text-weight-bold text-center">Escoge una cuenta a debitar</div>
      <div class="q-px-md-xl q-px-md">
        <div class="q-pa-md select_card q-mt-sm">
          <div class="flex" v-if="Object.values(linkCard).length > 0 ">
            <div style="width: 10%;" class="q-mr-sm text-center">
              <q-radio v-model="selectPayMethod" checked-icon="eva-checkmark-circle-outline"  val="1"  v-if="linkCard.status == 2" />
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
                <q-chip :color="linkCard.status == 2 ? 'positive' : 'warning'" text-color="white" >
                  {{ 
                    linkCard.status == 2 
                    ? 'Vinculada'
                    : 'Pendiente'
                  }}
                </q-chip>
              </div>
            </div>
          </div>
          <div class="flex q-mt-md" >
            <div style="width: 10%;" class="q-mr-sm text-center">
              <q-radio v-model="selectPayMethod" checked-icon="eva-checkmark-circle-outline"  val="2"  />
            </div>
            <div class="flex justify-between card_detail q-pb-sm" >
              <div>
                <div class="text-left text-body1">
                  Caja de ahorro
                </div>
                <div class="text-left text-body2  text-bold">
                  N° {{ user.wallet.number}}
                </div>
              </div>
              <div>
                <div class="text-right text-weight-medium text-caption">
                  Disponible
                </div>
                <div class="text-right text-weight-bold text-body2">
                  Gs. {{ numberFormat(user.wallet.balance) }}
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
            @submit="showConfirm()"
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
                    class="transferForm numberWozPay q-pb-none"
                    outlined
                    clearable
                    :clear-icon="'eva-close-outline'"
                    color="positive"
                    v-model="formCardData.recept"
                    label="Número de cuenta Woz Pay"
                    :rules="rulesForm('recept')"
                    autocomplete="off"
                    @change="getWalletToTransfer()"
                    maxlength="8"
                  >
                  <template v-slot:prepend>
                    <div class="text-body2 text-black text-weight-bold q-pr-sm" style="border-right: 1px solid grey;">
                      916
                    </div>
                  </template>
                </q-input>
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
            <div class="q-px-sm q-mt-none q-px-md-xl q-mx-md-xl">
              <q-btn 
                color="primary" class="w-100 q-pa-md q-mb-sm  link_button" 
                no-caps
                :loading="loading"
                type="submit"
                label="Enviar"
              >
              <template v-slot:loading>
                <q-spinner-facebook />
              </template>
              </q-btn>
              <div class="q-px-sm q-mt-sm text-primary q-pb-xl">
                Transacción segura con Woz Security Services
              </div>
            </div>
          </q-form>
        </div>
      </div>
    </div>
    <div v-if="showDialog == 'ready'">
      <doneModal :dialog="(showDialog == 'ready')" :text="'Transferencia realizada'" />
    </div>

    <confirmDialog :dialog="(showDialog == 'confirm')" :transfer="formCardData" @hideModal="hideModal"/>

  </div>
</template>
<script>
  import { useTransferStore } from '@/services/store/transfer.store'
  import { useAuthStore } from '@/services/store/auth.store'
  import { storeToRefs } from 'pinia'
  import { useUserStore } from '@/services/store/user.store'
  import { useCardStore } from '@/services/store/card.store'
  import { inject, ref } from 'vue'
  import { useQuasar } from 'quasar'
  import { useRouter } from 'vue-router'
  import util from '@/util/numberUtil'
  import doneModal from '@/components/layouts/modals/doneModal.vue';
  import confirmDialog from '@/components/transfer/confirmDialog.vue'
  export default {
    components: {
      doneModal,
      confirmDialog,
    },
    setup() {
      //vue provider
      const emitter = inject('emitter')
      const { user  } = storeToRefs(useAuthStore())
      const userStore = useUserStore();
      const cardStore = useCardStore()
      const transferStore = useTransferStore();
      const numberFormat = util.numberFormat
      const icons = inject('ionIcons')
      const q = useQuasar()
      const showDialog = ref(false);
      const router = useRouter()
      const loading = ref(false)

      // Data

      const selectPayMethod = ref(0)
      const linkCard = ref({})
      const formCardData = ref({
        amount:'',
        recept:'',
        recept_id: '',
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
            val => (/[,%$#"'();&|<>]/.test(val) == false ) || 'No debe contener espacios, ni "[](),%|&;\'" ',
          ],
        }
        
        return iRules[id]
      }
      const validateAmont = () =>{
        return user.value.wallet.balance < parseInt(formCardData.value.amount.replace(/\./g, ''))
      }
      const validate = () => {
        let isOk  = true
        let msg   = ''
        let title   = ''
        const dontValidate = ['recept_owner','recept_dni'];

        Object.entries(formCardData.value).forEach( ([key, value]) => {
          if(value == '' || value=='Cargando...') {
            isOk = false 
            msg = dontValidate.includes(key) ? 'Debes seleccionar un destinatario valido' : 'Debes completar el formulario'
            title = 'Error en formulario'
          }
        });

        if(selectPayMethod.value == 0) {
          isOk = false 
          msg = 'Debes seleccionar la cuenta a debitar'
          title = 'Error en cuenta'
        }
        if(selectPayMethod.value == 2 && validateAmont()) {
          isOk = false 
          msg = 'Saldo insuficiente.'
          title = 'Error en cuenta'
        }

        !isOk ? showNotification({msg, title}): ''
        return isOk
        
      }
      const showNotification = (value) => {
        const data = {
          newColor: 'negative', 
          newTitle: value.title,
          newText: value.msg, 
          newIcon: 'eva-bell-outline',
          newCallback: () => emitter.emit('offModalNotification'),
        }
        emitter.emit('modalNotification', data);
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
        loading.value = true
        const data = {
          from: user.value.wallet.id,
          to: formCardData.value.recept_id,
          amount: parseInt(formCardData.value.amount.replace(/\./g, '')),
          type:1,
          pay_method:selectPayMethod.value,
          concept :formCardData.value.text
        }

        transferStore.createTransfer(data)
        .then((response) => {
          if(response.code !== 200) throw response
          loading.value = false;
          showDialog.value = 'ready';
          console.log(response.data)
          setTimeout(() => {
            router.push('/finish_transfer/'+response.data.id)
          }, 2000);
        })
        .catch((response) => {
          loading.value = false
          showNotification({msg:response, title:'Error al realizar transferencia'})
        })
      }
      const getLinkCard = () => {
        cardStore.getCard(user.value.id).then((data) => {
          if(data.code !== 200) throw data
          linkCard.value = data.data ? Object.assign(data.data) : {}
        }).catch((response) => {
          // showNotify('negative', response)
        })
      }
      const getWalletToTransfer = () => {
        loadingWallet(true)
        userStore.getUserByWallet('916'+formCardData.value.recept)
        .then((data) =>{
          if(!data.code) throw data

          setTimeout(() => {
            formCardData.value.recept_owner = data.data.user.name
            formCardData.value.recept_id = data.data.id
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
      const showConfirm = () => {
        if(!validate()) return
        showDialog.value = 'confirm'
      }
      const hideModal = (isTrue) => {
        
        if(isTrue) storeTransfer()
        
        showDialog.value = ''
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
        showDialog,
        formCardData,
        linkCard,
        rulesForm,
        storeTransfer,
        showConfirm,
        getWalletToTransfer,
        hideModal,
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
  
    &.q-field--focused .q-field__label, &.q-field--float .q-field__label{
      z-index: 100;
      background: white;
      font-weight: 600;
      max-width: 133%;
      transform: translateY(-120%) translateX(4%) scale(0.75)!important;
    }
    &.numberWozPay.q-field--focused .q-field__label, &.numberWozPay.q-field--float .q-field__label{

      transform: translateY(-120%) translateX(-21%) scale(0.75)!important;
    }
    & .q-field__native{
      padding-top: 14px!important;
      font-weight: 500;
    }
    & .q-field__append{
      transform: translateY(-2%)
    }
    &  .q-field__prepend{
      transform: translateY(0%);
      
    }
    &.q-field--disabled .q-field__label{
      background: transparent
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
<template>
  <q-dialog v-model="dialog"  :auto-close="true" backdrop-filter="blur(8px)">
    <q-card style="min-width: 350px">
      <q-card-section class="q-py-sm q-px-md-md q-pt-md-md q-pb-md-sm">
        <div class="q-pa-none q-px-md-md q-pt-md-md q-pb-md-none">
          <div class="text-subtitle1 text-weight-medium">
            Datos de la operación
          </div>
          <div>
            <q-form
              id="addTransferPay"
              class="q-gutter-md"
              @submit="updateAccount()"
            >
            <div class="row ">
              <div class="col-12 q-my-md">
                <q-input
                  class="account_bankForm q-pb-none"
                  outlined
                  clearable
                  :clear-icon="'eva-close-outline'"
                  color="positive"
                  v-model="operationData.operationId"
                  label="Ingresa el numero de operación"
                  autocomplete="off"
                  :rules="rulesForm('number')"
                />
              </div>
              <div class="col-12 q-my-md">
                <q-select 
                  outlined
                  class="account_bankForm q-pb-none" 
                  v-model="operationData.bank" 
                  :options="banks" 
                  option-value="id"
                  option-label="name"
                  label="Banco emisor" 
                  clearable
                  :rules="rulesForm('bank')"
                  :clear-icon="'eva-close-outline'"
                  dropdown-icon="eva-chevron-down-outline"
                  behavior="menu"

                />
              </div>
              <div class="col-12 q-my-md">
                <q-input label="Fecha de pago" outlined v-model="operationData.date" mask="date" class="account_bankForm q-pb-none" :rules="rulesForm('number')">
                  <template v-slot:append>
                    <q-icon name="eva-calendar-outline" class="cursor-pointer">
                      <q-popup-proxy cover transition-show="scale" transition-hide="scale">
                        <q-date v-model="operationData.date">
                          <div class="row items-center justify-end">
                            <q-btn v-close-popup label="Close" color="primary" flat />
                          </div>
                        </q-date>
                      </q-popup-proxy>
                    </q-icon>
                  </template>
                </q-input>
              </div>
              <div class="col-12 q-my-md">
                <div class="">
                  <div class="text-subtitle2 text-weight-medium">
                    Pagaste:
                  </div>
                  <div class="q-px-md ">
                    <div class="text-h5 text-center text-weight-medium amount_container">
                      Gs. {{ numberFormat(operationData.amount) }}
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <q-card-actions align="right" class="text-primary">
              <q-btn flat label="Volver" @click="hideModal(null)"/>
              <q-btn flat label="Confirmar" :loading="loading" type="submit" > 
                <template v-slot:loading>
                  <q-spinner-facebook />
                </template>
              </q-btn>
            </q-card-actions>
            </q-form>
          </div>
        </div>
      </q-card-section>
    </q-card>
  </q-dialog>
</template>
<script>
  import { ref, onMounted } from 'vue';
  import { useAuthStore } from '@/services/store/auth.store'
  import { useQuasar } from 'quasar'
  import { useBankAccountStore } from '@/services/store/bankAccount.store'
  import wozIcons from '@/assets/icons/wozIcons'
  import util from '@/util/numberUtil'

  export default {
    props: {
      dialog: Boolean,
      amountToPay: Number
    },
    emits: ['hideModal'],
    setup (props, { emit }) {
      //vue provider
      const bankStore = useBankAccountStore()
      const user = useAuthStore().user;
      const $q = useQuasar();
      const banks = ref([])
      const numberFormat  = util.numberFormat
      
      // Data
      const step = ref(1);
      const operationData = ref({
        operationId: '',
        amount: props.amountToPay,
        bank: '',
        date:'',
        vaucher:'',
      })
      const loading = ref(false);
      const dialog = props.dialog;
      

      // Methods
      const loadingShow = (state) => {
        loading.value = state;
      }
      const showNotify = (type, message) => {
        $q.notify({
          message: message,
          color: type,
          actions: [
            { icon: 'eva-close-outline', color: 'white', round: true, handler: () => { /* ... */ } }
          ]
        })
      }
      const hideModal = (data) => {
        emit('hideModal', data)
      }
      const getAllBanks = () =>{
        bankStore.getAllBanks().then((data) =>{
          if(data.code !== 200) return
          banks.value = data.data
        })
      }
      const updateAccount = () => {
        if(!validate) return 
        console.log('cebollllaaa')
      }
      
      const rulesForm = (id) => {
        const iRules = {
          number:[
            val => (val !== null && val !== '') || 'En número de operación es requerido.',
            val => (val.length > 20 ) || 'Debe contener 20 digitos',
            val => (/[a-zA-z,%"' ();&|<>]/.test(val) == false ) || "Se permiten solo valores numericos",
          ],
          amount:[
            val => (val !== null && val !== '') || 'Selecciona un banco.',
            val => (val.length >= 8 ) || 'Formato no valido',
            val => (/[,%"'();&|<>]/.test(val) == false ) || 'No debe contener "[](),%|&;\'" ',
          ],
          ownerDni:[
            val => (val !== null && val !== '') || 'El número de cedula es requerido.',
            val => (val.length >= 8 ) || 'Formato no valido',
            val => (/[,%"' ();&|<>]/.test(val) == false ) || 'No debe contener espacios, ni "[](),%|&;\'" ',
          ],
          bank:[
            val => (val !== null && val !== '') || 'Selecciona un banco.',
            val => (/[,%"'();&|<>]/.test(val) == false ) || 'No debe contener espacios, ni "[](),%|&;\'" ',
          ],
        }
        
        return iRules[id]
      }
      const validate = () => {
        let isOk = true
        Object.entries(account).forEach( ([key,value ]) => { if(value == '') isOk = false }); 

        if(!isOk) showNotify('negative', 'Los campos del formulario no pueden estar vacio')

        return isOk
      }

      onMounted(() =>{
        getAllBanks()
      })
      return {
        wozIcons,
        loading,
        dialog,
        operationData,
        banks,
        hideModal,
        rulesForm,
        updateAccount,
        numberFormat,
      }
    }
  };
</script>

<style lang="scss" scoped>
  .amount_container{
    border-bottom: 1px solid $grey-6;
  }
  .w-100{
    width: 100%;
  }
</style>
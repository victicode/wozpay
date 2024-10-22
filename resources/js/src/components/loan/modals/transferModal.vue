<template>
  <q-dialog v-model="dialog"  :auto-close="true" backdrop-filter="blur(8px)">
    <!-- <transition name="horizontal">
      <q-card style="min-width: 350px" v-if="step === 1">
        <q-card-section class="q-py-sm q-px-md-md q-pt-md-md q-pb-md-sm" >
          <div class="q-pt-sm q-px-md-md q-pt-md-md q-pb-md-none">
            <div class="text-subtitle1 text-weight-medium">
              Datos de la operación
            </div>
            <div>
              <q-form
                id="addTransferPay"
                class="q-gutter-md"
                @submit="step = 2"
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
                  <q-input label="Fecha de pago" outlined v-model="operationData.date" mask="date" class="account_bankForm q-pb-none" :rules="rulesForm('date')">
                    <template v-slot:append>
                      <q-icon name="eva-calendar-outline" class="cursor-pointer">
                        <q-popup-proxy cover transition-show="scale" transition-hide="scale">
                          <q-date v-model="operationData.date" :options="optionsFn">
                            <div class="row items-center justify-end">
                              <q-btn v-close-popup label="Aceptar" color="primary" flat />
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
                <q-btn flat no-caps label="Volver" @click="hideModal()"/>
                <q-btn flat no-caps label="Confirmar" type="submit" />
              </q-card-actions>
              </q-form>
            </div>
          </div>
        </q-card-section>
      </q-card>
    </transition> -->
    <transition name="horizontal">
      <q-card style="min-width: 350px" v-if="step === 1">
        <q-card-section class="q-py-sm q-px-md-md q-pt-md-md q-pb-md-sm" >
          <div class="q-pt-sm q-px-md-md q-pt-md-md q-pb-md-none">
            <div class="text-subtitle1 text-weight-medium">
              Sube tu comprobante
            </div>
            <div class="q-mt-sm flex info_pay__content q-py-sm q-px-md">
              <q-icon  name="eva-alert-circle-outline" size="sm" color="primary"/>
              <div class="text-subtitle2 text-weight-medium q-ml-sm">
                Para agilizar el proceso de la verificación de tu pago, adjunta el comprobante de la operación.
              </div> 
            </div>
            <div class="q-mt-lg">
              <q-form
                id="addVoucher"
                class="q-gutter-md"
                @submit="emmitPay()"
              >
              <div class="row ">
                <div class="col-12 q-my-md">
                  <q-file
                    class="account_bankForm q-pb-none" 
                    outlined 
                    clearable
                    :clear-icon="'eva-close-outline'"
                    color="positive"
                    v-model="operationData.vaucher"
                    label="Cargar comprobante 📂"
                    :rules="rulesForm('vaucher')"
                  />
                </div>
              </div>
              <q-card-actions align="right" class="text-primary">
                <q-btn flat no-caps label="Volver" @click="hideModal()"/>
                <q-btn flat no-caps label="Confirmar" type="submit"  /> 
              </q-card-actions>
              </q-form>
            </div>
          </div>
        </q-card-section>
      </q-card>
    </transition>
  </q-dialog>
</template>
<script>
  import { ref, onMounted } from 'vue';
  import { useQuasar } from 'quasar'
  import { useBankAccountStore } from '@/services/store/bankAccount.store'
  import wozIcons from '@/assets/icons/wozIcons'
  import util from '@/util/numberUtil'
  import moment from 'moment';

  export default {
    props: {
      dialog: Boolean,
      loan: Object
    },
    emits: ['hideModal', 'emitDataPay'],
    setup (props, { emit }) {

      //vue provider
      const bankStore = useBankAccountStore()
      const $q = useQuasar();
      const banks = ref([])
      const numberFormat  = util.numberFormat
      const loan = props.loan
      // Data
      const step = ref(1);
      const operationData = ref({
        operationId: '',
        amount: loan.amounToPay,
        bank: '',
        date: '',
        vaucher: null,
      })

      const dialog = props.dialog;

      // Methods

      const hideModal = () => {
        emit('hideModal')
      }
      const emmitPay = () => {
        emit('emitDataPay', operationData.value)
      }

      const getAllBanks = () =>{
        bankStore.getAllBanks().then((data) =>{
          if(data.code !== 200) return
          banks.value = data.data
        })
      }
      
      const rulesForm = (id) => {
        const iRules = {
          number:[
            val => (val !== null && val !== '') || 'En número de operación es requerido.',
            val => (/[a-zA-z,%"' ();&|<>]/.test(val) == false ) || "Se permiten solo valores numericos",
          ],
          amount:[
            val => (val !== null && val !== '') || 'Selecciona un banco.',
            val => (val.length >= 8 ) || 'Formato no valido',
            val => (/[,%"'();&|<>]/.test(val) == false ) || 'No debe contener "[](),%|&;\'" ',
          ],
          date:[
            val => (val !== null && val !== '') || 'La fecha del pago es requerida.',
            val => (/[,%"' ();&|<>]/.test(val) == false ) || 'No debe contener espacios, ni "[](),%|&;\'" ',
          ],
          bank:[
            val => (val !== null && val !== '') || 'Selecciona un banco.',
            val => (/[,%"'();&|<>]/.test(val) == false ) || 'No debe contener espacios, ni "[](),%|&;\'" ',
          ],
          vaucher:[
            val => (val !== null && val !== '') || 'Adjunta el comprobante.',
          ],
        }
        
        return iRules[id]
      }
      const optionsFn = (date) => {
        return  date <= moment().format('YYYY/MM/DD')
      }
      onMounted(() =>{
        getAllBanks()
      })
      
      return {
        wozIcons,
        dialog,
        operationData,
        banks,
        step,
        numberFormat,
        optionsFn,
        hideModal,
        rulesForm,
        emmitPay,
      }
    }
  };
</script>

<style lang="scss" scoped>
  .info_pay__content{
    flex-wrap: inherit!important;
    border: 1px solid $primary;
    border-radius: 5px;
  }
  .amount_container{
    border-bottom: 1px solid $grey-6;
  }
  .w-100{
    width: 100%;
  }
  
</style>
<style lang="scss">
.copy_icon {
    transform: rotate(90deg)!important;
  }
</style>
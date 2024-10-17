<template>
  <div v-if="Object.values(myLoan).length > 0" class="q-pt-none">
    <div class="w-100 q-mx-none" >
      <!-- info -->
       <div class="flex flex-center">
        <div v-html="wozIcons.sudameris2"/>
       </div>
      <q-list  class="q-px-md">
        <div v-for="(data, key) in dataToPay" :key="key">
          <q-item class="q-py- q-px-sm"  >
            <q-item-section>
              <div class="flex items-center justify-between">
                <div class="w-100">
                  <q-item-label class="q-mt-xs text-weight-bold" >
                  <span class="text-subtitle2 text-weight-bold">
                    {{data.title}}
                  </span>
                  </q-item-label>
                  <q-item-label  >
                    <div class="flex justify-between w-100">
                      <div class="flex items-center">
                        <div class="text-body2 text-grey-8">
                          {{data.title == 'Monto' ? 'Gs.' + numberFormat(data.value) : data.title == 'Datos bancarios' ? 'Alias Bancario': data.value }}
                        </div>
                        <div class="q-ml-xs" v-if="data.title == 'Monto'">
                          <q-icon 
                            name="eva-copy-outline" 
                            size="sm" 
                            color="grey-9"
                            class="copy_icon cursor-pointer" 
                            @click="copyData(key, data.title )" 
                          />
                        </div>
                      </div>
                      <div class="flex items-center">
                        <div class="text-body2 text-grey-8 q-mt-xs">
                          {{ data.title == 'Datos bancarios' ? data.value : ''}}
                        </div>
                        <div class="q-ml-xs" v-if=" data.title == 'Datos bancarios'">
                          <q-icon 
                            name="eva-copy-outline" 
                            size="sm" 
                            color="grey-9"
                            class="copy_icon cursor-pointer" 
                            @click="copyData(key, data.title)" 
                          />
                        </div>
                      </div>
                    </div>
                  </q-item-label>
                </div>
              </div>
            </q-item-section>
          </q-item>
          <q-separator />
        </div>
        <q-item class="q-py- q-px-sm" v-if="loadData" >
            <q-item-section>
              <div class=" ">
                <div class="w-100 flex items-center justify-between">
                  <div>
                    <q-item-label class="q-mt-xs text-weight-bold" >
                      <span class="text-subtitle2 text-weight-bold">
                        Comprobante
                      </span>
                    </q-item-label>
                    <q-item-label >
                      <div class="text-body2 text-grey-8">
                        Comprobante de transferencia
                      </div>
                    </q-item-label>
                  </div>
                  <div>
                    <div class="q-ml-xs q-mt-sm" >
                      <q-icon 
                        name="eva-checkmark-circle-2-outline" 
                        size="sm" 
                        color="positive"
                        class="cursor-pointer" 
                      />
                    </div>
                  </div>
                </div>
              </div>
            </q-item-section>
          </q-item>
          <q-separator />
      </q-list>
    </div>
    <div class="q-px-md-xl q-px-md">
      <div class="q-mt-md  q-px-md-xl" >
        <q-btn  
          color="primary" class="w-100 q-pa-sm" 
          :label=" !loadData ? 'Subir comprobante' : 'Enviar comprobante'" 
          @click="!loadData ? showDialog = 'transfer' : createNewPay()"
          :loading="  (loading == 'transfer') "
        >
          <template v-slot:loading>
            <q-spinner-facebook />
          </template>
        </q-btn>
      </div>
    </div>
    <div v-if="showDialog == 'done'">
      <doneModal :dialog="showDialog == 'done'"  />
    </div>
    <div v-if="showDialog == 'transfer'">
      <transferModal :dialog="showDialog == 'transfer'" :loan="myLoan" @hideModal="hideModal" @emitDataPay="setDataPay" />
    </div>
  </div>
</template>

<script>
  import { useAuthStore } from '@/services/store/auth.store'
  import { inject, ref,} from 'vue'
  import { useRouter } from 'vue-router'
  import { useLoanStore } from '@/services/store/loan.store'
  import { usePayStore } from '@/services/store/pay.store'
  import { useQuasar } from 'quasar';
  import doneModal from '@/components/layouts/modals/doneModal.vue';
  import transferModal from '@/components/loan/modals/transferModal.vue';
  import wozIcons from '@/assets/icons/wozIcons';
  import util from '@/util/numberUtil';


  export default {
    components: {
      doneModal,
      transferModal,
    },
    setup() {
      //vue provider
      const emitter = inject('emitter')
      const user = useAuthStore().user;
      const loanStore = useLoanStore();
      const payStore = usePayStore()
      const icons = inject('ionIcons')
      const router = useRouter()
      const q = useQuasar()
      const myLoan = ref({})
      const showDialog = ref(false)
      const loading = ref('')
      const numberFormat = util.numberFormat
      const dataToPay = [
        { title: 'Tipo de cuenta', value: 'Cuenta corriente'},
        { title: 'Datos', value: 'Alias Bancario'},
        { title: 'Datos bancarios', value: '0983994268'},
      ]
      const loadData = ref(false)
      const dataPay = ref({});

      const activeLoan = () => {
        loanStore.getLoan(user.id).then((data) => {
          if(!data.code)  throw data
            myLoan.value = data.data
            quotaAmount()
        }).catch((e) => {
          console.log(e)
          showNotify('negative', 'error al obtener prestamo activo')
        })
      }
      
      const showNotification = ({type, title, msg}) => {
        const data = {
          newColor: type, 
          newTitle: title,
          newText:  msg, 
          newIcon: 'eva-bell-outline',
          newCallback: () => emitter.emit('offModalNotification'),
        }
        emitter.emit('modalNotification', data);
      } 

      const showModal = (modal) => {
        showDialog.value = modal
      }
      const hideModal = () => {
        showDialog.value = ''
      }
      const doneModal = () => {
        showModal('done')
        setTimeout(() => {
          router.go(-2)
        }, 4000);
      }
      const loadingShow = (show) => {
        loading.value = show
      }

      const quotaAmount = () => {
        let currentCuota = [];
        myLoan.value.quotas_desc.forEach(quota => {
          if(quota.status !== 2 && !quota.success_pays){
            currentCuota.push(quota)
          }
        });
        myLoan.value.currentQuota = currentCuota[0];
        myLoan.value.amounToPay = myLoan.value.currentQuota.days_due > 1 ? isPayWithDelay(myLoan.value.currentQuota) : myLoan.value.currentQuota.amount.toFixed(0)

        dataToPay.push({title:'Monto', value: myLoan.value.amounToPay })
      }
      const isPayWithDelay = (quota) => {
        return (((quota.amount * myLoan.value.interest_for_delay)/100) + quota.amount).toFixed(0)
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
      const createConceptPay = () => {
        return `Pago de cuota ${myLoan.value.pays.length + 1 }/ ${myLoan.value.quotas}`
      }
      const copyData = (index, type) => {
        const texto = dataToPay[index].value;
        const textArea = document.createElement('textarea');
        textArea.value = texto;
        textArea.style.opacity = 0;
        document.body.appendChild(textArea);
        textArea.select();

        try {
          const success = document.execCommand('copy');
        } catch (err) {
          console.error(err.name, err.message);
        }

        document.body.removeChild(textArea);

        showNotify('positive',`${type} copiado`)
      }
      const createNewPay = () => {
        loadingShow('transfer')
        const data = new FormData
        data.append('loan_id', myLoan.value.id)
        data.append('quota_id', myLoan.value.currentQuota.id)
        data.append('amount', parseFloat(dataPay.value.amount))
        data.append('operation_id', dataPay.value.operationId)
        data.append('bank', dataPay.value.bank.name)
        data.append('pay_date', dataPay.value.date)
        data.append('vaucher', dataPay.value.vaucher)
        data.append('type', 3)
        data.append('status', 1)
        data.append('concept', createConceptPay())

        payStore.createPay(data)
        .then((response) => {
          if(response.code !== 200) throw response
          doneModal()
          loadingShow('')

        }).catch((response) => {
          console.log(response)
          loadingShow('')
        })
      }
      const setDataPay = (data) => {
        dataPay.value = data;
        loadData.value = data ? true : false;
        console.log(data)
        hideModal()
      }
      onMounted(() => {
        activeLoan();
      })

      // Data
      return{
        icons,
        user,
        router,
        myLoan,
        showDialog,
        loading,
        wozIcons,
        dataToPay,
        numberFormat,
        loadData,
        setDataPay,
        quotaAmount,
        showModal,
        hideModal,
        doneModal,
        copyData,
        createNewPay,
      }
    },
  }
</script>
<style lang="scss" scoped>
.w-100 {
  width: 100%;
}
</style>
<style lang="scss" >
.amount_input {
  border-bottom: 1px solid $grey-6 ;
  display: flex;
  justify-content: center;
  position: relative;
  &.q-field--disabled .q-field__inner{
    background: transparent!important;
  }
  &.q-field--disabled .q-placeholder{
    opacity: 1!important;
  }
  & .q-field__control::before {
    border: 0px!important;
  }
  & .q-field__control-container{
    text-align: center;
  }
  & .q-field__prefix{
    position: absolute;
    font-size: 40px;
    margin-right: 10px;
    transform: translateY(0.5px) translateX(140%);
  }
  & .q-field__native{
    font-size: 40px;
    text-align: center;
  }
}
@media screen and (max-width: 780px){
  .amount_input { 
    & .q-field__prefix{
      transform: translateY(3.5px) translateX(40%)!important;
    }
  }
}

</style>

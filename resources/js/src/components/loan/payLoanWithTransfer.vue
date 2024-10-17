<template>
  <div v-if="Object.values(myLoan).length > 0" class="q-pt-md">
    <div class="w-100 q-mx-none" >
      <!-- info -->
       <div class="flex flex-center">
        <div v-html="wozIcons.sudameris2"/>
       </div>
      <q-list  class="q-px-md">
        <q-item class="q-py- q-px-sm" >
          <q-item-section>
            <div class="flex items-center justify-between">
              <div>

                <q-item-label class="q-mt-xs text-weight-bold" >
                <span class="text-body2 text-weight-bold">
                  Tarjeta vinculada
                </span>
                </q-item-label>
                <q-item-label caption lines="1" class=" text-caption">Paga con tu tarjeta vinculada</q-item-label>
              </div>
              <div>
                <q-btn 
                  unelevated 
                  flat 
                  round 
                  color="grey-6"  
                  icon="eva-chevron-right-outline" 
                  @click="router.push('/loan_pay/tpago')"  
                />
              </div>
            </div>
          </q-item-section>
        </q-item>
        <q-separator />
        <q-item class="q-py- q-px-sm" >
          <q-item-section>
            <div class="flex items-center justify-between">
              <div>
                <q-item-label class="q-mt-xs text-weight-bold" >
                <span class="text-body2 text-weight-bold">
                  Transferencia bancaria
                </span>
                </q-item-label>
                <q-item-label caption lines="1" class=" text-caption">Haz una transferencia</q-item-label>
              </div>
              <div>
                <q-btn 
                  unelevated 
                  flat 
                  round 
                  color="grey-6"  
                  icon="eva-chevron-right-outline" 
                  @click="router.push('/loan_pay/transfer')"  
                />
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
          color="grey-7" class="w-100 q-pa-sm" 
          label="Pagar con transferencia" 
          @click="showDialog = 'transfer'"
          :loading="(loading == 'transfer')"
        >
          <template v-slot:loading>
            <q-spinner-facebook />
          </template>
        </q-btn>
      </div>
    </div>

    <div v-if="showDialog == 'card'">
      <doneModal :dialog="showDialog == 'card' " text="Préstamo pagado" />
    </div>
    <div v-if="showDialog == 'transfer'">
      <transferModal :dialog="showDialog == 'transfer'" :loan="myLoan" @hideModal="hideModal" @donePay="doneModal()" />
    </div>
  </div>
</template>
<script>
  import { useAuthStore } from '@/services/store/auth.store'
  import { inject, ref,} from 'vue'
  import { useRouter } from 'vue-router'
  import { useLoanStore } from '@/services/store/loan.store'
  import doneModal from '@/components/layouts/modals/doneModal.vue';
  import transferModal from '@/components/loan/modals/transferModal.vue';
  import { useQuasar } from 'quasar';
  import wozIcons from '@/assets/icons/wozIcons';


  export default {
    components: {
      doneModal,
      transferModal,
    },
    setup() {
      //vue provider
      const emitter = inject('emitter')
      const user = useAuthStore().user;
      const icons = inject('ionIcons')
      const router = useRouter()
      const loanStore = useLoanStore();
      const myLoan = ref({})
      const showDialog = ref(false)
      const loading = ref(false)
      const q = useQuasar()


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
        showModal('card')
        setTimeout(() => {
          router.go(-1)
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
        quotaAmount,
        showModal,
        hideModal,
        doneModal,
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

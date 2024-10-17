<template>
  <div v-if="Object.values(myLoan).length > 0" class="q-pt-md">
    <div class="q-pa-md">
      <div class="text-h6 text-bold">Paga tu préstamo y pedí un rekutu  </div>
      <div class="text-subtitle2 text-weight-medium">Total a pagar</div>
    </div>
    <div class="q-px-md-xl q-px-lg q-mt-md" >
      <div class="q-px-md-xl">
        <q-input 
          v-model="myLoan.amounToPay" 
          prefix="Gs." 
          disable
          dense  class="amount_input" mask="#.###.###" maxlength="9" reverse-fill-mask
          
        />
      </div>
    </div>
    <div class="q-px-md-xl q-px-md">
      
      <div class="q-mt-lg  q-px-md-xl">
        <q-btn  
          color="primary" class="w-100 q-pa-sm" 
          label="Pagar con Tpago" 
          @click="queryPayUrl()"
          :loading="(loading == 'tpago')"
        >
          <template v-slot:loading>
            <q-spinner-facebook />
          </template>
        </q-btn>
      </div>
      <!-- <div class="q-mt-md  q-px-md-xl" v-if="Object.values(card).length > 0">
        <q-btn  
          color="positive" class="w-100 q-pa-sm" 
          label="Pagar con tarjeta vinculada" 
          @click="payWithCard()"
          :loading="(loading == 'card')"
        >
          <template v-slot:loading>
            <q-spinner-facebook />
          </template>
        </q-btn>
      </div> -->
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
    <!-- <div class="q-px-md q-pt-lg q-px-md-xl q-mx-md-xl flex justify-between" v-if="Object.values(card).length > 0 && !loadingCard">
      <div>
        <div class="text-subtitle1 text-weight-medium">Nombre</div>
        <div class="text-weight-medium text-subtitle2">Tarjeta de Crédito ****{{ card.number.substring(card.number.length - 4) }}</div>
      </div>
      <div>
        <div class="text-subtitle1 text-weight-medium text-right">Vencimiento</div>
        <div class="text-weight-medium text-subtitle2 text-right">{{ card.due_date }}</div>
      </div>
    </div> -->
    <div class="q-px-md q-pt-lg q-px-md-xl q-mx-md-xl flex justify-between" v-if="loadingCard">
      <div>
        <div class="text-subtitle1 text-weight-medium">
          <q-skeleton type="QBadge" />
        </div>
        <div class="text-weight-medium text-subtitle2 q-mt-sm">
          <q-skeleton type="QBadge" />
        </div>
      </div>
      <div>
        <div class="text-subtitle1 text-weight-medium text-right">
          <q-skeleton type="QBadge" />
        </div>
        <div class="text-weight-medium text-subtitle2 text-right q-mt-sm">
          <q-skeleton type="QBadge" />
        </div>
      </div>
    </div>
    <div v-if="showDialog == 'card'">
      <doneModal :dialog="showDialog == 'card' " text="Préstamo pagado" />
    </div>
    <div v-if="showDialog == 'tpago'">
      <waitModal :dialog="showDialog == 'tpago' " text="Préstamo pagado" />
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
  import { useCardStore } from '@/services/store/card.store'
  import { usePayStore } from '@/services/store/pay.store'
  import doneModal from '@/components/layouts/modals/doneModal.vue';
  import waitModal from '@/components/layouts/modals/waitModal.vue';
  import transferModal from '@/components/loan/modals/transferModal.vue';
  import { useQuasar } from 'quasar';
  import axios from 'axios'

  export default {
    components: {
      doneModal,
      waitModal,
      transferModal,
    },
    setup() {
      //vue provider
      const emitter = inject('emitter')
      const user = useAuthStore().user;
      const icons = inject('ionIcons')
      const router = useRouter()
      const loanStore = useLoanStore();
      const cardStore = useCardStore()
      const payStore = usePayStore()
      const myLoan = ref({})
      const card = ref({})
      const showDialog = ref(false)
      const loading = ref(false)
      const payUrl = ref('')
      const q = useQuasar()
      const loadingCard = ref(false)
      const axiosHttp = axios


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
      
      const getLinkCard = () => {
        loadingCard.value = true;
        cardStore.getCard(user.id).then((data) => {
          if(data.code !== 200) throw data
          setTimeout(()=>{
            loadingCard.value = false;

            card.value = data.data ? Object.assign(data.data) : {}
          }, 500)
        }).catch((response) => {
          showNotify('negative', response)
        })
      }

      const payWithCard = () => {
        loadingShow('card')

        const data = new FormData
        data.append('loan_id', myLoan.value.id)
        data.append('quota_id', myLoan.value.currentQuota.id)
        data.append('amount', parseFloat(myLoan.value.amounToPay).toFixed(0))
        data.append('type', 1)
        data.append('status', 1)
        data.append('concept', createConceptPay())

        payStore.createPay(data)
        .then((response) => {
          if(response.code !== 200) throw response
          setTimeout(() => {
            doneModal()
          }, 500);

        }).catch((response) => {
          showNotify('negative', response.data.error)
          loadingShow('')
        })
      } 

      const getPayUrl = () => {
        loadingShow('tpago')
        showModal('tpago')
        const data = {
          amount:  parseFloat(myLoan.value.amounToPay).toFixed(0),
          type: 1,
          debitDay: new Date().getDate()
        }
        payStore.payRequest(data)
        .then((response) => {
          if(response.code !== 200) throw response

          payUrl.value = response.data.payment_link.link_url ?? response.data.subscription_link

          setTimeout(() => {
            loadingShow('')
            hideModal()
            openTpagoWindow()
          }, 500);
        }).catch(() =>{
          loadingShow('')
          hideModal()
          showNotification({type:'negative',msg:'Error para procesar el pago', title:'Error'})
        })

      }
      const queryPayUrl = () => {
        const data = {
          amount:  parseFloat(myLoan.value.amounToPay).toFixed(0),
          debit_day: new Date().getDate(),
          description: "cuotatest",
          periodicity: 1,
          unlimited: true
        }


        loadingShow('tpago')
        showModal('tpago')
        axiosHttp.defaults.headers.common[
          "Authorization"
        ] = 'Basic YXBwcy91Q2dwaFFRMXNRUFk4dlFoRHZwc1V5R09BQU1MTTBiVDp5KW80UHJqLnpjV1VERmUuNHE2MDUrWVNMR3JCc2ozWk1lQXJPbnhl';
        axiosHttp.defaults.headers.common[
          "Accept"
        ] = `application/json`;

        axiosHttp.defaults.headers.common[
          "Content-Type"
        ] = `application/json`;

        axiosHttp.defaults.headers.common[
          "Access-Control-Allow-Credentials"
        ] = `true`;

         axiosHttp.post('https://comercios.bancard.com.py:8888/external-commerce/api/0.1/commerces/321473/branches/1/links/generate-payment-link', data).then((data) => {
          console.log(data)
         })
         .catch(() => {
          showNotification({type:'negative',msg:'Error para procesar el pago', title:'Error'})
          loadingShow('')
          hideModal()
         })
        return 
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
      const openTpagoWindow = () => {
        var ventana = window.open(payUrl.value, 'pago', `height=${q.screen.height},width=${q.screen.width}`);
        setTimeout(() => {
          ventana.document.close();
          ventana.focus();
          return true;
        }, 500);
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
        getLinkCard();
      })

      // Data
      return{
        icons,
        user,
        router,
        myLoan,
        card,
        showDialog,
        loading,
        loadingCard,
        payWithCard,
        quotaAmount,
        getPayUrl,
        showModal,
        hideModal,
        doneModal,
        queryPayUrl,
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

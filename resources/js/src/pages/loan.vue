<template>
  <div v-if="Object.values(myLoan).length > 0" class="q-pt-sm">
    <div>
      <loanProgress :loan="myLoan" />
    </div>
    <div v-if=" myLoan.status != '1' && myLoan.status != '0'">
      <loanDetails />
    </div>
    <div v-if=" myLoan.status != '1' && myLoan.status != '0'">
      <loanHistory :loan="myLoan" />
    </div>
    <div class="q-mt-sm q-pt-xs q-mx-md q-mx-md-xl q-px-md-xl"  v-if=" myLoan.status == '2' || myLoan.status == '4' ">
      <div class="q-mt-md q-pt-md-md">
        <q-btn 
          @click="goTo(loanComplete() ? 1 : 0)" 
          no-caps
          :color="'primary'" 
          class="w-100 q-pa-sm " 
          :label="'Pagar préstamo'" 
        />
      </div>
    </div>
  </div>
</template>
<script>
  import { useAuthStore } from '@/services/store/auth.store'
  import { inject,} from 'vue'
  import { useRouter } from 'vue-router'
  import loanDetails from '@/components/loan/loanDetails.vue'
  import loanProgress from '@/components/loan/loanProgress.vue'
  import loanHistory from '@/components/loan/loanHistory.vue'
  import { useLoanStore } from '@/services/store/loan.store'
  import { useQuasar } from 'quasar';


  export default {
    components: {
      loanDetails,
      loanProgress,
      loanHistory,
    },
    setup() {
      //vue provider
      const user = useAuthStore().user;
      const icons = inject('ionIcons')
      const router = useRouter()
      const loanStore = useLoanStore();
      const myLoan = ref({})
      const $q = useQuasar()
      
      const activeLoan = () => {
        loanStore.getLoan(user.id).then((data) => {
          if(!data.code)  throw data
          myLoan.value = data.data
        }).catch((e) => {
          showNotify('negative', 'error al obtener prestamo activo')
        })
      }
      const goTo = (status) => {
        if(status){
          // router.go(-1)
          showNotify('warning', 'Tu pago estan siendo veificados')

          return
        }
        router.push('/loan_select_pay')
        
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
      const loanComplete = () => {
        let goodPays = 0;

        myLoan.value.pays.forEach((pay) => {
          if(pay.status != 0) {
            goodPays++
          }
        })
        return goodPays == myLoan.value.quotas
      }
      onMounted(() => {
        activeLoan()

        window.Echo
        .channel('userUpdateEvent'+user.id)
        .listen('UserUpdateEvent', async () => {
          console.log('lll')
          activeLoan()
        })
      
      })

      // Data
      return{
        icons,
        user,
        router,
        myLoan,
        goTo,
        loanComplete,
      }
    },
  }

</script>
<style lang="scss" scoped>
.w-100{
  width: 100%;
}
</style>
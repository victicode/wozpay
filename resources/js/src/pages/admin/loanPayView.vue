<template>
  <div v-if="Object.values(myLoan).length > 0" class="q-pt-md">
    <div>
      <loanProgress :loan="myLoan" />
    </div>
    <div v-if=" myLoan.status != '1' && myLoan.status != '0'" >
      <loanHistory :loan="myLoan" @getPay="setPay" />
    </div>
    <paysVerification :paySelected="selectedPay" :dialog="dialog" @hiddeModal="hiddeModal" />
  </div>
</template>
<script>
  import { useAuthStore } from '@/services/store/auth.store'
  import { inject,} from 'vue'
  import { useRoute, useRouter } from 'vue-router'
  import loanDetails from '@/components/loan/loanDetails.vue'
  import loanProgress from '@/components/loan/loanProgress.vue'
  import loanHistory from '@/components/loan/loanHistory.vue'
  import { useLoanStore } from '@/services/store/loan.store'
  import paysVerification from '@/components/admin/pays/paysVerification.vue';

export default {
    components: {
      paysVerification,
      loanDetails,
      loanProgress,
      loanHistory,
    },
    setup() {
      //vue provider
      const user = useAuthStore().user;
      const icons = inject('ionIcons')
      const emitter = inject('emitter')

      const router = useRouter()
      const loanStore = useLoanStore();
      const myLoan = ref({})
      const route = useRoute()
      const selectedPay = ref({})
      const dialog = ref(false)

      const activeLoan = () => {
        loanStore.getLoanById(route.params.id).then((data) => {
          if(!data.code)  throw data
          myLoan.value = data.data
        }).catch((e) => {
          showNotify('negative', 'error al obtener prestamo activo')
        })
      }
      const goTo = (status) => {
        if(status){
          router.go(-1)
          return
        }
        router.push('/loan_pay')
        
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
      
      const setPay = (pay) => {
        selectedPay.value = pay.success_pays
        showDialog()
      }
      const showDialog = () => {
        dialog.value = true
      }
      const hiddeModal = () => {
        dialog.value = false
      }
      onMounted(() => {
        activeLoan()
      })
      emitter.on('payChangeStatus', () => {
        activeLoan()
      })
      // Data
      return{
        icons,
        dialog,
        user,
        router,
        myLoan,
        selectedPay,
        goTo,
        loanComplete,
        setPay,
        hiddeModal,
      }
    },
  }

</script>
<style lang="scss" scoped>
.w-100{
  width: 100%;
}
</style>
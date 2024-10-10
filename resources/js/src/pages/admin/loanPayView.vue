<template>
  <div v-if="Object.values(myLoan).length > 0" class="q-pt-md">
    <div>
      <loanProgress :loan="myLoan" />
    </div>
    <div v-if=" myLoan.status != '1' && myLoan.status != '0'" @click="seeYou()">
      <loanHistory :loan="myLoan" />
    </div>
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
      const route = useRoute()
      
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
      const seeYou = () => {
        alert('seeeyou')
      }
      onMounted(() => {
        activeLoan()
      })

      // Data
      return{
        icons,
        user,
        router,
        myLoan,
        goTo,
        loanComplete,
        seeYou,
      }
    },
  }

</script>
<style lang="scss" scoped>
.w-100{
  width: 100%;
}
</style>
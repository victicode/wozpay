<template>
  <div  class="dashboard_container">
    <div style="height: 100%;" v-if="ready">
      <div style="height: 28.3%;">
        <currentUserPersonalInfo />
      </div>
      <div class="bg-white">
        <actionsDashboard />
      </div>
      <div style="">
        <linkedCard />
      </div>
      <div style="height: 27%;">
        <LastTrasanction />
      </div>
    </div>

  </div>
</template>
<script>
  import currentUserPersonalInfo from '@/components/dashboard/currentUserPersonalInfo.vue';
  import actionsDashboard from '@/components/dashboard/actionsDashboard.vue';
  import linkedCard from '@/components/dashboard/linkedCard.vue';
  import LastTrasanction from '@/components/dashboard/lastTrasanction.vue';
  import { useAuthStore } from '@/services/store/auth.store'
  import { useWalletStore } from '@/services/store/wallet.store'
  import { onMounted, ref } from 'vue'

  export default {
    components: {
      currentUserPersonalInfo,
      actionsDashboard,
      linkedCard,
      LastTrasanction,
    },
    setup() {
      const user = useAuthStore().user;
      const walletStore = useWalletStore()
      const ready = ref(false)
      const capitalBalances = () => {

        walletStore.getBalancesByUser(user.id)
        .then((data) => {
          if(!data.code) throw data
          ready.value = true
        }).catch((response) => {
          console.log(response)
        })
      }
      onMounted(() => {
        capitalBalances()
      })
      return {
        ready
      }
    },
  }
</script>
<style lang="scss" scoped>
.dashboard_container{
  height: 100%; 
  background:#f1f0f0; 
  
}
@media screen and (max-width: 780px){
  .dashboard_container{
    height: 100%;
    max-height: fit-content; 
    background:#f1f0f0; 
    overflow-y: auto;
  }
}
</style>
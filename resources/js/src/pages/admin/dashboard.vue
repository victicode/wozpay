<template>
  <div  class="dashboard_container">
    <div style="" class="dashboard_container--details">
      <div style="height: 28%;">
        <currentUserPersonalInfo />
      </div>
      <div class="dashi"> 
        <div>
          <capital />
        </div>
        <div>
          <balance />
        </div>
        <div>
          <profit />
        </div>
        <div class="q-pb-xl">
          <another_profit />
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import currentUserPersonalInfo from '@/components/dashboard/currentUserPersonalInfo.vue';
  import another_profit from '@/components/admin/dashboard/another_profit.vue';
  import balance from '@/components/admin/dashboard/balance.vue';
  import capital from '@/components/admin/dashboard/capital.vue';
  import profit from '@/components/admin/dashboard/profit.vue';

  import { useAuthStore } from '@/services/store/auth.store'
  import { useWalletStore } from '@/services/store/wallet.store'
  import { onMounted, ref } from 'vue'

  export default {
    components: {
      currentUserPersonalInfo,
      another_profit,
      balance,
      capital,
      profit
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
        // capitalBalances()
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
  overflow: hidden;
}
.dashboard_container--details {
  height: 100%;
  overflow: hidden;

}

.dashi {
  max-height: 77%;
  height: max-content; overflow-y: auto;
  &::-webkit-scrollbar {
    display: none;
  }

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
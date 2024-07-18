<template>
  <div style="height: 100%; background:#f1f0f0">
    <div style="height: 100%;">
      <div style="height: 28.3%;">
        <currentUserPersonalInfo />
      </div>
      <div class="bg-white">
        <actionsDashboard />
      </div>
      <div style="">
        <linkedCard />
      </div>
      <div style="height: 40%;">
        <LastTrasanction />
      </div>
    </div>

  </div>
</template>
<script>
  import { useAuthStore } from '@/services/store/auth.store'
  import util from '@/util/numberUtil'
  import currentUserPersonalInfo from '@/components/dashboard/currentUserPersonalInfo.vue';
  import actionsDashboard from '@/components/dashboard/actionsDashboard.vue';
  import linkedCard from '@/components/dashboard/linkedCard.vue';
  import LastTrasanction from '@/components/dashboard/lastTrasanction.vue';

  export default {
    components: {
      currentUserPersonalInfo,
      actionsDashboard,
      linkedCard,
      LastTrasanction,
    },
    setup() {
      //vue provider
      const user = useAuthStore().user;
      const numberFormat = util.numberFormat
      // Data


      return{
        user,
        numberFormat
      }

      
    },
  }
</script>
<style lang="scss" scoped>

</style>
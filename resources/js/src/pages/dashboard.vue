<template>
  <div style="height: 100%;">
    <div style="height: 100%;">
      <div style="height: 28%;">
        <currentUserPersonalInfo />
      </div>
      <div style="">
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
  import { inject, onMounted } from 'vue'
  import { useAuthStore } from '@/services/store/auth.store'
  import { useQuasar } from 'quasar'
  import { useRouter } from 'vue-router';
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
      const icons = inject('ionIcons')
      const $q = useQuasar()
      const user = useAuthStore().user;
      const router = useRouter();
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
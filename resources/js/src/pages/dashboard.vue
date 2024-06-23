<template>
  <div style="height: 91vh;">
    <div style="height: 100%;">
      <div style="height: 28%;">
        <currentUserPersonalInfo />
      </div>
      <div style="height: 18%;">
        <actionsDashboard />
      </div>
      <div>
        <linkedCard />
      </div>
      <div></div>
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
  
  export default {
    components: {
      currentUserPersonalInfo,
      actionsDashboard,
      linkedCard
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
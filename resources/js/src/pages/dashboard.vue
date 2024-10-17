<template>
  <div  class="dashboard_container">
    <div style="height: 100%;" >
      <div style="height: 27%;">
        <currentUserPersonalInfo />
      </div>
      <div class="bg-white">
        <actionsDashboard />
      </div>
      <div class="bg-white q-py-md">
        <socialLinks />
      </div>
      <div style="">
        <linkedCard />
      </div>
      <div style="height: 18%;">
        <lastTrasanction />
      </div>
    </div>

  </div>
</template>
<script>
  import currentUserPersonalInfo from '@/components/dashboard/currentUserPersonalInfo.vue';
  import actionsDashboard from '@/components/dashboard/actionsDashboard.vue';
  import linkedCard from '@/components/dashboard/linkedCard.vue';
  import lastTrasanction from '@/components/dashboard/lastTrasanction.vue';
  import socialLinks from '@/components/dashboard/socialLinks.vue';

  export default {
    components: {
      currentUserPersonalInfo,
      actionsDashboard,
      linkedCard,
      lastTrasanction,
      socialLinks,
    },
    setup() {
      
    },
  }
</script>
<style lang="scss" scoped>
.dashboard_container{
  height: 100%; 
  background:#f1f0f0; 
  overflow-y: auto;
  
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
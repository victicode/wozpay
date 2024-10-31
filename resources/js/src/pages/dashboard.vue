<template>
  <div  class="dashboard_container">
    <div style="height: 100%;" >
      <div style="height: 27%;">
        <currentUserPersonalInfo />
      </div>
      <div class="bg-white">
        <actionsDashboard />
      </div>
      <div class="bg-white q-pt-sm q-pb-none">
        <socialLinks />
      </div>
      <div style="">
        <rekutu />
      </div>
      <div style="">
        <linkedCard />
      </div>
      <div style="">
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
  import rekutu from '@/components/dashboard/rekutu.vue';

  import socialLinks from '@/components/dashboard/socialLinks.vue';

  export default {
    components: {
      currentUserPersonalInfo,
      actionsDashboard,
      linkedCard,
      lastTrasanction,
      rekutu,
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
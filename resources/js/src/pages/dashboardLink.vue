<template>
  <div  class="dashboardLink_container">
    <div style="height: 100%;" >
      <div style="height: 14rem;">
        <currentUserPersonalInfo />
      </div>
      <div style="">
        <currentUserLink />
      </div>
      <div>
        <historyLinks />
      </div>
      <div class="payNavbar-buttom">
        <navbarVue />
      </div>
    </div>
  </div>
</template>
<script>
  import currentUserPersonalInfo from '@/components/dashboard_link/currentUserPersonalInfo.vue';
  import currentUserLink from '@/components/dashboard_link/currentUserLink.vue';
  import navbarVue from "@/components/layouts/navbar.vue";
  import historyLinks from '@/components/dashboard_link/historyLinks.vue';
  import { useUserStore } from '@/services/store/user.store';
  export default {
    components: {
      currentUserPersonalInfo,
      currentUserLink,
      historyLinks,
      navbarVue,
    },
    setup() {
      const user = useUserStore()
      return{
      }
    },
  }
</script>
<style lang="scss" scoped>
.dashboardLink_container{
  height: 100%; 
  background:#ffffff; 
  overflow-y: auto;
  
}
@media screen and (max-width: 780px){
  .dashboardLink_container{
    height: 92vh;
    max-height: fit-content; 

    overflow-y: auto;
  }
}
</style>
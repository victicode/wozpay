<template>
  <div  class="dashboard_container">
    <div style="height: 100%;" >
      <div style="height: 14rem;">
        <currentUserPersonalInfo />
      </div>
      <div class="bg-white">
        <actionsDashboard />
      </div>
      <!-- <div>
        <q-btn @click="enviar" color="black"> enviar</q-btn>
      </div> -->
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
        <walletUser />
      </div>
      <div>
        <linksDepartament />
      </div>
      <div style="">
        <currentUserLoan />
      </div>
      
    </div>
  </div>
</template>
<script>
  import currentUserPersonalInfo from '@/components/dashboard/currentUserPersonalInfo.vue';
  import actionsDashboard from '@/components/dashboard/actionsDashboard.vue';
  import linkedCard from '@/components/dashboard/linkedCard.vue';
  import currentUserLoan from '@/components/dashboard/currentUserLoan.vue';
  import rekutu from '@/components/dashboard/rekutu.vue';
  import linksDepartament from '@/components/dashboard/linksDepartament.vue';
  import socialLinks from '@/components/dashboard/socialLinks.vue';
  import walletUser from '@/components/dashboard/walletUser.vue';
  import { useUserStore } from '@/services/store/user.store';
  export default {
    components: {
      currentUserPersonalInfo,
      actionsDashboard,
      linkedCard,
      currentUserLoan,
      rekutu,
      socialLinks,
      walletUser,
      linksDepartament,
    },
    setup() {
      const user = useUserStore()
      const enviar = () => {
        user.prueba().then((response) => {
          console.log(response)
          console.log('kkkkkkk')
        })
      }
      return{
        enviar,
      }
    },
  }
</script>
<style lang="scss" scoped>
.dashboard_container{
  height: 100%; 
  background:#ffffff; 
  overflow-y: auto;
  &::-webkit-scrollbar {
    display: none;
  }
  
}
@media screen and (max-width: 780px){
  .dashboard_container{
    height: 100%;
    max-height: fit-content; 

    overflow-y: auto;
  }
}
</style>
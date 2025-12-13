<template>
  <div  class="dashboard_container">
    <div style="height: 100%;" >
      <div style="height: 14rem;">
        <currentUserPersonalInfo />
      </div>
      <div style="background:#fff" class="q-px-md-md">
        <div>
          <linksDepartament />
        </div>
        <bolsaStock />
        <div class="q-mt-xs">
          <actionsDashboard />
        </div>
        <!-- <div>
          <q-btn @click="enviar" color="black"> enviar</q-btn>
        </div> -->
        <!-- <div class=" q-pt-sm q-pb-none">
          <socialLinks />
        </div> -->
        <div class="cardItmes q-pt-xs ">
          <div style="" class="q-mt-sm">
            <walletUser />
          </div>
          <div style="">
            <linkedCard />
          </div>
          <div style="">
            <rekutu />
          </div>
          <div style="">
            <currentUserLoan />
          </div>
        </div>
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
  import bolsaStock from '@/components/dashboard/bolsaStock.vue';
  export default {
    components: {
      currentUserPersonalInfo,
      bolsaStock,
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
.cardItmes{
  margin-top: 0.9rem;
  background: #efefef;
  border-top-right-radius: 3rem;
  border-top-left-radius: 3rem;

}
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
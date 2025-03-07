<template>
  <div  class="dashboardLink_container">
    <div style="height: 100%; " >
      <div style="height: 14rem;">
        <currentUserPersonalInfo />
      </div>
      <div style="background:#f2f2f5;height:calc(100vh - 18rem); overflow: auto;">
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
    <template v-if="user.wallet_link.status!=2">
      <div class="layer" style="">
        <q-card class="notification__card"  >
          <q-card-section class="flex q-pb-sm w-100 items-center justify-between">
            <div class="flex items-center">
              <div class="text-terciary">
                Woz Pay informa
              </div>
              <q-icon
                :name="icons.sharpVerified"
                size="xs"
                color="terciary"
                class="q-mx-xs "
              />
            </div>
            <!-- <div>
              <q-icon :name="icon" size="sm" :color="color == 'negative' ? color : 'black'" />
            </div> -->
          </q-card-section>
          <q-linear-progress :value="1" color="terciary " size="0.125rem"/>
          <q-card-section class="text-center">
            <div  class="text-terciary text-weight-bold text-subtitle1">
              Revision de pago
            </div>
            <div class="text-subtitle2 q-mt-sm q-px-md q-py-sm" > 
              <div class="text-weight-medium">
                La activación de tu cuenta de cobros internacional esta siendo verifcada, pronto podras crear tus links de cobro
              </div>
            </div>
          </q-card-section>
          <q-card-section 
            class="row bg-terciary items-center no-wrap justify-center" 
            @click="router.go(-1)"
          >
            <div class="text-white text-subtitle2 cursor-pointer" >
              Volver
            </div>
          </q-card-section>
        </q-card>
      </div>
    </template>
  </div>
</template>
<script>
  import currentUserPersonalInfo from '@/components/dashboard_link/currentUserPersonalInfo.vue';
  import currentUserLink from '@/components/dashboard_link/currentUserLink.vue';
  import navbarVue from "@/components/layouts/navbar.vue";
  import historyLinks from '@/components/dashboard_link/historyLinks.vue';
  import { useAuthStore } from '@/services/store/auth.store';
  import { useRouter } from 'vue-router';
  import { storeToRefs } from 'pinia';

  export default {
    components: {
      currentUserPersonalInfo,
      currentUserLink,
      historyLinks,
      navbarVue,
    },
    setup() {
      const { user  } = storeToRefs(useAuthStore())
      const router = useRouter()
      const icons = inject('ionIcons')
      return{
        user,
        router,
        icons
      }
    },
  }
</script>
<style lang="scss" scoped>
.notification__card{
  transition: none!important;
  left: calc(50% - 150px);
  top:5rem;

  width: 300px; overflow: visible; border-radius: 20px;
}
.dashboardLink_container{
  height: 100%; 
  background:#ffffff; 
  overflow-y: auto;
  position: relative;
}
  
.layer{
  position: fixed; bottom: 8%; left: 25%; right: 25%; top: 0; background:#3a33337a; 
  border-radius: 0px;
  z-index: 500;
}

@media screen and (max-width: 780px){
  .dashboardLink_container{
    height: 92vh;
    max-height: fit-content; 

    overflow-y: auto;
  }
  .layer{
    left: 0; right: 0;
  }
}
</style>
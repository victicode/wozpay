<template>
  <q-layout view="hHh lpR fFf" style="overflow: hidden;">
    <div>
      <transition name="vertical">
        <q-page-container class="body" v-if="readyState && readyState2">
          <router-view v-slot="{ Component }" >
            <transition name="vertical">
              <component :is="Component" />
            </transition>
          </router-view>
        </q-page-container>
      </transition>
      <transition name="inFade">
        <div  v-if="!readyState">
          <q-inner-loading
            :showing="true"
            label="Cargando"
            class="bg-primary"
            color="white"
            label-class="text-white"
            label-style="font-size: 1.1em"
          />
        </div>
      </transition>
    </div>
    <modalNotification />

  </q-layout>
</template>
<script >

  import { onMounted, ref, watch} from 'vue';
  import { useAuthStore } from '@/services/store/auth.store'
  import { useWalletStore } from '@/services/store/wallet.store'
  import { useQuasar } from 'quasar'
  import { useRoute, useRouter } from 'vue-router';
  import utils from '@/util/httpUtil';
  import modalNotification from '@/components/layouts/modals/modalNotification.vue';

  export default {
    components: {
      modalNotification
    },
    setup () {
      //vue provider
      const $q = useQuasar()
      const store = useAuthStore();
      const walletStore = useWalletStore()
      const router = useRouter();
      const route = useRoute()
      const readyState = ref(false)
      const readyState2 = ref(false)
      const user = ref({})

      // methods
      const getCurrentUser = (inject = null) =>{

        if(exceptionsToShow() && !inject) return
        store.currentUser().then((data)=>{
          if(data.code !== 200 ) throw data
          user.value = data.data
          capitalBalances(data.data.id)
          if(!inject){
            initChanel()
          }
        }).catch((e) => { 
          showNotify('negative', 'Error de servicio')
          utils.errorLogout( () => router.push('/login'))
        })
      }
      const capitalBalances = (id) => {
        walletStore.getBalancesByUser(id)
        .then((data) => {
          if(!data.code) throw data
          readyState.value = true
          readyState2.value = true
        }).catch((response) => {
          console.log(response)
        })
      }
      const exceptionsToShow = () => {
        const user = useAuthStore().user;
        if(route.name == 'Login' && route.name == 'register') {
          readyState2.value = true
          return true
        }
        if(route.name !== 'dashboard' && route.name != 'dashboard_admin' && Object.values(user).length > 0) {
          readyState2.value = true
          return true
        }
        return false
      }
      const showNotify = (type, message) => {
        $q.notify({
          message: message,
          color: type,
          actions: [
            { icon: 'eva-close-outline', color: 'white', round: true, handler: () => { /* ... */ } }
          ]
        })
      }
      const isReady = () => {
        readyState.value =  route.name == 'dashboard' || route.name == 'dashboard_admin' ? false : true
        readyState2.value =  route.name == 'Login' || route.name == 'register' ? true : false
      }
      const initChanel = () => {
        console.log(user.value.id)

        window.Echo
        .channel('userUpdateEvent'+user.value.id)
        .listen('UserUpdateEvent', async () => {
          getCurrentUser(true)
        })
      }
      watch(route, () => {
        isReady()
        getCurrentUser()
      });

      onMounted(() =>{
        isReady()
      })
      
      return {
        readyState2,
        readyState,
      }
    }
  };
</script>
<style scss scoped>
  .body{
      width: 50%;
      margin: auto;
      overflow: hidden;
      position: relative;
  }

  @media screen and (max-width: 780px){
    .body{
      width: 100%;
      margin: auto;
    }
  }
</style>
<style>
.animate__animated {/* referring directly to the animation's @keyframe declaration */
  animation-duration: 0.2s; /* don't forget to set a duration! */
}
</style>
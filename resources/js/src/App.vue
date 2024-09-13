<template>
  <q-layout view="hHh lpR fFf" style="overflow: hidden;">
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
  </q-layout>
</template>
<script >

  import { onMounted, ref, watch} from 'vue';
  import { useAuthStore } from '@/services/store/auth.store'
  import { useQuasar } from 'quasar'
  import { useRoute, useRouter } from 'vue-router';
  import utils from '@/util/httpUtil';

  export default {
    setup () {
      //vue provider
      const $q = useQuasar()
      const store = useAuthStore();
      const router = useRouter();
      const route = useRoute()
      const readyState = ref(false)
      const readyState2 = ref(false)

      // methods
      const getCurrentUser = () =>{
        
        if(exceptionsToShow()) return
        store.currentUser().then((data)=>{
          if(data.code !== 200 ) throw data
          setTimeout(() => {
            readyState.value = true
            readyState2.value = true

          }, 500);
        }).catch((e) => { 
          showNotify('negative', 'Error de servicio')
          utils.errorLogout( () => router.push('/login'))
        })
      }
      const exceptionsToShow = () => {
        const user = useAuthStore().user;
        if(route.name == 'Login' && route.name == 'register') return true
        if(route.name !== 'dashboard' && Object.values(user).length > 0) return true
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
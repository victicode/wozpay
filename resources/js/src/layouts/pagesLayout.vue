<template>
  <div class="layout-dasboard__content"  style="">
    <topbar/>
    <div class="container_page" id="scroll-target-id">
      <router-view v-slot="{ Component }">
        <transition name="horizontal">
          <component :is="Component" />
        </transition>
      </router-view>
    </div>
  </div>
</template>
<script >
  import { inject, onMounted, ref } from 'vue';
  import { useAuthStore } from '@/services/store/auth.store'
  import { useQuasar } from 'quasar'
  import { useRouter } from 'vue-router';
  import utils from '@/util/httpUtil';
  import topbar from '@/components/layouts/topbar.vue';
  export default {
    components:{
      topbar
    },
    setup () {
      //vue provider
      const icons = inject('ionIcons')
      const $q = useQuasar()
      const store = useAuthStore();
      const router = useRouter();

      const readyState = ref(false)
      // methods
      const getCurrentUser = () =>{
        store.currentUser().then((data)=>{
          if(data.code !== 200 ) throw data
          readyState.value = true
        }).catch((e) => { 
          showNotify('negative', 'Error de servicio')
          utils.errorLogout( () => router.push('/login'))
        })
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

      // Mounted
      onMounted(() =>{
        // getCurrentUser()
        $q.addressbarColor.set('#565656')
      })
      
      return {
        icons,
        readyState
      }
    }
  };
</script>

<style lang="scss" scoped>
.container_page{
  height: 91%;
  overflow: hidden;

}

.layout-dasboard__content{
  height: 100vh;
  max-height: 100vh;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}
</style>
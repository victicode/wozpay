<template>
  <div class="layout-dasboard__content"  v-if="readyState"  style="">
    <topbarPay />
    <div class="container_page" >
      <div class="section_page q-mt-md">
        
        <router-view v-slot="{ Component }">
          <transition name="vertical">
            <component :is="Component" />
          </transition>
        </router-view>
      </div>
    </div>
  </div>
</template>
<script >
  import { inject, onMounted, ref } from 'vue';
  import { useAuthStore } from '@/services/store/auth.store'
  import { useQuasar } from 'quasar'
  import { useRouter } from 'vue-router';
  import utils from '@/util/httpUtil';
  import topbarPay from '@/components/layouts/topbarPay.vue';
  
  export default {
    components:{
      topbarPay
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
          if(data.code !== 200 ){
            showNotify('negative', data.error ?? 'Error de servicio')
            utils.errorLogout( () => router.push('/login'))
            return;
          }
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
        getCurrentUser()
        $q.addressbarColor.set('#0449fb')
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
  height: 92%;
  overflow: hidden;
  background: $primary;
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
<style lang="scss" scoped>
.section_page {
  background: white;
  height: 100%;
  width: 100%;
  border-top-left-radius: 50px;
  border-top-right-radius: 50px;
  overflow: hidden;
}
</style>
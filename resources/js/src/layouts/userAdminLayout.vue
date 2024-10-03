<template>
  <div class="layout-dasboard__content"    style="">
    <topbarPay />
    <div class="container_page" >
      <div class="section_page q-mt-md">
        <div class="user_section " >
          <div class="h-100">
            <div class="h-20 q-pt-none q-pt-md-sm  search__container">
              <div>
                <searchUser :filter="filter" @filters="setFilters"/>
              </div>
            </div>
            <router-view v-slot="{ Component }">
              <transition name="inFade">
                <component :is="Component" class="w-100" />
              </transition>
            </router-view>
          </div>
        </div>
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
  import searchUser from '@/components/admin/users/searchUser.vue';
    
  export default {
    components:{
      searchUser,
      topbarPay
    },
    setup () {
      //vue provider
      const icons = inject('ionIcons')
      const $q = useQuasar()
      const store = useAuthStore();
      const router = useRouter();
      const filter = ref(1);
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
      const setFilters = (e) => {
        console.log(e)
      } 
      // Mounted
      onMounted(() =>{
        // getCurrentUser()
        $q.addressbarColor.set('#0449fb')
      })
      
      return {
        icons,
        readyState,
        filter,
        setFilters
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
.w-100 {
  width: 100%;
}
.search__container {
  background: #d9d9d9;
  overflow: hidden;
}
.section_page {
  background: white;
  height: 100%;
  width: 100%;
  border-top-left-radius: 50px;
  border-top-right-radius: 50px;
  overflow: hidden;
}
.w-70 {
  width: 70%;
}
.w-30 {
  width: 30%;
}
.user_section{
  height: 100%;
}
.h-100 {
  height: 100%;
}
.h-20 {
  height: 21%;
}
@media screen and (max-width: 780px){
  .h-20 {
    height: 28%;
  }
}
</style>
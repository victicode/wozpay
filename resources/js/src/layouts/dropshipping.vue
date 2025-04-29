<template>
  <div class="layout-dasboard__content"   style="">
    <headerDrop />
    <div class="container_page" >
      <div class="section_page q-mt-md">  
        <router-view v-slot="{ Component }">
          <transition name="vertical">
            <component :is="Component"  />
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
  import headerDrop from '@/components/dropshipping/layout/header.vue';


  export default {
    components:{
      headerDrop,
    },
    setup () {
      //vue provider
      const icons = inject('ionIcons')
      const $q = useQuasar()
      const user = ref(useAuthStore().user)
      const readyState = ref(false)


      // Mounted
      onMounted(() =>{
        // getCurrentUser()
        $q.addressbarColor.set('#0449fb')
      })
      
      return {
        icons,
        readyState,
        user,
      }
    }
  };
</script>

<style lang="scss" scoped>
.container_page{
  height: 100%;
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

}
</style>
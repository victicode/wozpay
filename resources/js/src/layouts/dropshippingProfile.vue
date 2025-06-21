<template>
  <div class="layout-dasboard__content"   style="">
    <headerDropProfile />
    <div class="container_page"  id="scroll-target-id">
      <div class="section_page q-pb-xl">  
        <router-view v-slot="{ Component }">
          <transition name="fadx">
            <component :is="Component"  />
          </transition>
        </router-view>
      </div>
      <tabMenuDropshipping  style="height: 10%;"/>
    </div>

  </div>
</template>
<script >
  import { inject, onMounted, ref } from 'vue';
  import { useAuthStore } from '@/services/store/auth.store'
  import { useQuasar } from 'quasar'
  import headerDropProfile from '@/components/dropshipping/layout/headerProfile.vue';
  import wozIcons from '@/assets/icons/wozIcons';

  
  import { useRoute } from 'vue-router';
  import tabMenuDropshipping from '@/components/dropshipping/tabMenuDropshipping.vue';
  export default {
    components:{
      tabMenuDropshipping,
      headerDropProfile
    },
    setup () {
      //vue provider
      const icons = inject('ionIcons')
      const $q = useQuasar()
      const user = ref(useAuthStore().user)
      const readyState = ref(false)
      const route = useRoute()


      onMounted(() =>{
        // getCurrentUser()
        $q.addressbarColor.set('#0449fb')
      })
      
      return {
        icons,
        readyState,
        user,
        wozIcons,
      }
    }
  };
</script>

<style lang="scss" scoped>
.container_page{
  max-height: 100%;
  overflow-x: hidden;

  overflow-y: auto;
  background: white;
  &::-webkit-scrollbar {
    width: 5px;
    background: transparent;
    background: rgba(199, 199, 199, 0.719);

  }
  &::-webkit-scrollbar-thumb{
    background: $primary;
    border-radius: 50px;
  }
}

.layout-dasboard__content{
  height: 100%;
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
  height: 90%;
  width: 100%;

}
</style>
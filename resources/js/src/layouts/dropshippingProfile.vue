<template>
  <div class="layout-dasboard__contentProfile"   style="">
    <headerDropProfile />
    <div class="container_pageProfile"  id="scroll-target-id">
      <div class="section_pageProfile">  
        <router-view v-slot="{ Component }">
          <transition name="fadx">
            <component :is="Component"  />
          </transition>
        </router-view>
      </div>
      <!-- <tabMenuDropshipping v-if="route.name "  style="height: 10%;"/> -->
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
        route
      }
    }
  };
</script>

<style lang="scss" scoped>
.container_pageProfile{
  max-height: 75%;
  overflow-x: hidden;
  height: 75%;
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

.layout-dasboard__contentProfile{
  height: 100vh;
  max-height: 100vh;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.section_pageProfile {
  background: white;
  height: 100%;
  width: 100%;
  overflow: auto;
}
</style>
<template>
  <div class="layout-dasboard__content"   style="">
    <headerDrop :styleHead="headerStyle">
      <img :src="imgButton" alt="" style="width: 1.59rem; height: 1.59rem;" >
    </headerDrop>
    <div class="container_page"  id="scroll-target-id">
      <div class="section_page">  
        <router-view v-slot="{ Component }">
          <transition name="fadx">
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
  import wozIcons from '@/assets/icons/wozIcons';
  import img1 from '@/assets/images/vector1.png'
  import img2 from '@/assets/images/vector2.png'
  import { useRoute } from 'vue-router';

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
      const route = useRoute()
      const headerStyle = ref(route.name == 'dropshipping_landing' ? 'principal' : 'others')
      const imgButton = ref(route.name == 'dropshipping_landing' ? img1 : img2)
      watch(route, () => {
        headerStyle.value = route.name == 'dropshipping_landing' ? 'principal' : 'others'
        imgButton.value = route.name == 'dropshipping_landing' ? img1 : img2
      });
      // Mounted
      onMounted(() =>{
        // getCurrentUser()
        $q.addressbarColor.set('#0449fb')
      })
      
      return {
        icons,
        readyState,
        user,
        wozIcons,
        imgButton,
        headerStyle
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
  height: 100%;
  width: 100%;

}
</style>
<template>
  <div id="topbarLayoutlink" class=" q-pt-none" :style="'background:#'+ route.query.color">
    <div class="w-100 flex flex-center h-100 q-pb-sm q-pt-md-sm q-pt-md position-relative">
      <div style="position: absolute; left: 0%;">
        <q-btn flat round color="white" size="xl" icon="eva-chevron-left-outline" @click="redirectToHome()" />
      </div>
      <div class="text-weight-bold text-h6 text-white w-100 text-center" >
        {{ route.query.title }}
      </div>
      <div class="text-weight-bold text-subtitle1 text-white w-100 text-center q-mt-xs" >
        {{ route.query.subtitle }}
      </div>
      <div class="boxNoVisible" style="position: absolute; right: 0%;">
        <transition name="inFade">
          <q-btn v-if="!isShowSideMenu" flat round color="white" size="lg" icon="eva-menu-outline" @click="showSideMenu" />
        </transition>
        <transition name="inFade">
          <q-btn v-if="isShowSideMenu" flat round color="white" size="lg" icon="eva-close-outline" @click="showSideMenu" />
        </transition>
      </div>
    </div>
  </div>
</template>
<script >
  import { inject } from 'vue';
  import { useRoute, useRouter } from 'vue-router';
  export default {
    setup () {
      //vue provider
      const icons = inject('ionIcons')
      const emitter = inject('emitter');
      const route = useRoute();
      const router = useRouter();
      const isShowSideMenu = ref(false)
      
      const showSideMenu = () => {
        isShowSideMenu.value = !isShowSideMenu.value 
        emitter.emit('showSideMenu', true);
      }
      const redirectToHome = () => {
        router.go(-1)
      }

      emitter.on('closeMenu', () => {
        showSideMenu()
      })

      return {
        icons,
        route,
        isShowSideMenu,
        redirectToHome,
        showSideMenu,
      }
    }
  };
</script>
<style lang="scss" scoped>
.w-100 {
  width: 100%;
}
.boxNoVisible {
  width: 72px;
  height: 72px;
  visibility: hidden;
}
.h-100{
  height: 100%;
}
#topbarLayoutlink{
  height: 9%;
  width: 100%;
  // border-bottom: 1px solid lightgray;
}
</style>
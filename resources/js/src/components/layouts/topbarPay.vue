<template>
  <div id="topbarLayout" class="bg-primary q-pt-sm">
    <div class="w-100 flex justify-between items-center h-100 q-pb-sm q-pt-md" style="flex-wrap: nowrap;">
      <div class="">
        <q-btn flat round color="white" size="xl" icon="eva-chevron-left-outline" @click="router.go(-1)" />
      </div>
      <div class="text-weight-bold text-h6 text-white">
        {{ route.meta.title == 'Banco' ? 'Cuenta bancaria' : route.meta.title}}
      </div>
        <div :class=" route.name == 'userById' ? '' :'boxNoVisible'">
        <q-btn flat round color="white" size="lg" icon="eva-menu-outline" @click="showSideMenu" />
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
      
      const showSideMenu = () => {
        emitter.emit('showSideMenu', true);
      }
      return {
        icons,
        router,
        route,
        showSideMenu
      }
    }
  };
</script>
<style lang="scss" scoped>
.boxNoVisible {
  width: 72px;
  height: 72px;
  visibility: hidden;
}
.h-100{
  height: 100%;
}
#topbarLayout{
  height: 8%;
  width: 100%;
  // border-bottom: 1px solid lightgray;
}
</style>
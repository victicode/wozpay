<template>
  <div class="text-center q-mb-xl">
    <div class="titleDownload">Descarga la app y disfruta de los beneficios</div>
    <div class="downloadSubtitle q-mt-sm">Woz Marketplace también disponible en computadoras</div>
    <div class="flex flex-center q-mt-lg">
      <img :src="android" alt="" class="q-mx-md" style="height: 2.8rem;">
      <img :src="iphone" alt="" class="q-mx-md" style="height: 2.8rem;">
    </div>
  </div>
</template>
<script>
import iphone from '@/assets/images/appMac.webp'
import android from '@/assets/images/appAndroid.webp'

export default {
  
  setup() {
    return {
      iphone,
      android
    }  
  },
}
</script>
<style lang="scss">
.titleDownload{
  color: #3f3d56;
  font-size: 2.3rem;
  font-weight: 900;
  font-family: 'Amazon Ember Regular'!important;
}
.downloadSubtitle{
  color: #3f3d56;
  font-size: 1.3rem;
  font-weight: 500;
  font-family: 'Amazon Ember Regular'!important;
}
</style>
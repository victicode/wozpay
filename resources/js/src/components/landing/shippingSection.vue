<template>
  <div class="q-pt-md">
    <div class="titleSection-lading q-pl-lg q-pr-xl">
      Desde Paraguay <br>
      llegamos a todo el <br>
      mundo para vos
    </div>
    <div class="text-subtitle2 subtitleMapSection q-px-lg q-mt-md">
      <div class="text-grey-6 q-pl-sm ">
        Tenemos alianzas comerciales con las
        empresas lideres en el rubro de logística
        y envíos globales 
      </div>
    </div>
    <div class="q-mt-lg q-px-lg">
      <img :src="map" alt="">
    </div>
  </div>
</template>
<script>

import map from '@/assets/images/mapWoz.webp'
import { inject } from 'vue';

export default {
  
  setup() {
    return{
      map
    }
  }
}
</script>
<style lang="scss">
.subtitleMapSection{
  width: 85%;
  position: relative;
  & .text-grey-6{
    line-height: 1.3;
  }
  &::after{
    content: '';
    top: -0.4rem;
    background: #2f2d41;
    border-radius: 1rem;
    height: 4rem;
    width: 2px;
    display: block;
    position: absolute;

  }
}
</style>
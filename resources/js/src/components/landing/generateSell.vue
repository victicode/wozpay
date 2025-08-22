<template>

<div class="q-pt-lg" style="background: #f7f7f7;">
  <div class="titleSection-lading q-px-md " style="line-height: 1;">
    Genera tus primeros 100
    millones de guaraníes en
    ventas en tan solo los
    primeros 181 días

  </div>
  <div class="text-subtitle2 subtitleMapSection q-px-md q-mt-lg">
    <div class="text-grey-6 q-pl-sm ">
      Sigue nuestro plan de 181 días para
      poder generar tus primeros 100
      millones de guaraníes en ventas.
    </div>
  </div>
  <img :src="shopping" alt="" class="q-mx-auto q-mt-md" style="width: 80%;">
</div>
</template>
<script>

import shopping from '@/assets/images/shopping.jpeg'


export default {
  
  setup() {
    return{
      shopping
    }
  }
}
</script>
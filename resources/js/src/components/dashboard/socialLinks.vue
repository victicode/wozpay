<template>
  <div class="flex items-center">
    <q-carousel
      v-model="slide"
      swipeable
      animated
      navigation-position="bottom"
      navigation
      padding
      height="150px"
      class="bg-purple text-white rounded-borders w-100"
    >
      <q-carousel-slide name="style" class="column no-wrap flex-center">
        <q-icon name="style" size="56px" />
        <div class="q-mt-md text-center">
          {{ lorem }}
        </div>
      </q-carousel-slide>
      <q-carousel-slide name="tv" class="column no-wrap flex-center">
        <q-icon name="live_tv" size="56px" />
        <div class="q-mt-md text-center">
          {{ lorem }}
        </div>
      </q-carousel-slide>
      <q-carousel-slide name="layers" class="column no-wrap flex-center">
        <q-icon name="layers" size="56px" />
        <div class="q-mt-md text-center">
          {{ lorem }}
        </div>
      </q-carousel-slide>
      <template v-slot:navigation-icon="{ active, btnProps, onClick }">

        <div style="height: 50px; width: 50px; background: red; border-radius: 50%;"  class="cursor-pointer q-mx-sm":class="{'bg-blue':active}" @click="onClick">

        </div>
      </template>
    </q-carousel>
  </div>
</template>
<script>
  import ln from '@/assets/images/ln.png'
  import ig from '@/assets/images/ig.png'
  import fb from '@/assets/images/fb.png'
  import { inject } from 'vue';
  
export default {
  setup() {
    return {
      icons: inject('ionIcons'),
      ln,
      ig,
      fb,
      slide: ref('style'),
      lorem: 'cia rerum, error dignissimos praesentium libero ab nemo.'
    }
  },
}
</script>
<style lang="scss">
  .socialLink__container{
    height: 52px;
    width: 52px;
    border-radius: 50%;
    border: 3px solid #ffc701;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0.15rem;
    transition: all 0.2s ease;
    &:hover {
      transform: scale(1.15);
    }
  }
  .socialLink__img{
    height: 100%;
    width: 100%;
    border-radius: 50%;
    overflow: hidden;
  }
</style>

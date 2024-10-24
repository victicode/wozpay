<template>
  <div class="flex items-center social__carousel">
    <q-carousel
      v-model="slide"
      swipeable
      animated
      navigation-position="bottom"
      navigation
      padding
      height="150px"
      
      class=" rounded-borders w-100"
    >
      <q-carousel-slide 
        v-for="info in infoData"
        :key="info.value"
        :name="info.value" 
        class=" column no-wrap flex-center w-100 q-px-sm" 
      >
        <a href="https://www.instagram.com/wozparaguay" target="_blank" class="w-100">
          <div class="socialLink__item w-100 flex items-center no-wrap q-py-md q-px-md">
            <div style="" cc>
              <div  class="socialLink__img--container">
                <div class="socialLink__img">
                  <img :src="info.img" height="100%" width="100%" alt="">
                </div>
              </div>
            </div>
            <div style="" class="q-pl-sm">
              <div class="text-subtitle1 text-weight-bold flex items-center">
                <div class="q-mr-xs">
                  {{info.title}}
                </div>
                <q-icon :name="icons.sharpVerified" color="terciary" size="1.4rem" style="margin-left: 0.05rem; margin-top: -0.1rem;"/>

              </div>
              <div class="text-body2 text-weight-medium">{{info.text}}</div>
            </div>

          </div>
        </a>
      </q-carousel-slide>
      <template v-slot:navigation-icon="{ active, btnProps, onClick }">

        <div  class="cursor-pointer q-mx-xs socialLink__controls" :class="{active}" @click="onClick">

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
    const infoData = [
      {
        value:'ln',
        title:'Prensa - Diario LA NACION',
        img:ln,
        text:'Lee nuestra nota sobre Woz Paraguay y descubre más sobre nuestra empresa y servicios',
      },
      {
        value:'ig',
        title:'Instagram',
        img:ig,
        text:'Síguenos para ver más productos y servicios con ofertas exclusivas',
      },
      {
        value:'fb',
        title:'Facebook',
        img:fb,
        text:'Conéctate con nuestra página de Facebook para novedades y promociones asombrosas',
      },
    ]
    return {
      icons: inject('ionIcons'),
      slide: ref('ln'),
      infoData,
    }
  },
}
</script>
<style lang="scss">
  .socialLink__controls{
    height: 0.8rem; 
    width: 0.8rem; 
    background: #fcd486; 
    border-radius: 50%;
    transition: all ease-in 0.5s;
    &.active{
      width: 1.6rem;
      border-radius:30px;
      background: #f9a90d;
    }
  }
  .socialLink__item{
    background: #e1e9fe;
    border-radius: 20px;
  }
  .img__container{
    width:22%;
  }
  .info__container{
    width:78%;
  }
  .socialLink__img--container{
    height: 4rem;
    width: 4rem;
    border-radius: 50%;
    border: 4px solid #ffc701;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0.05rem;
    transition: all 0.2s ease;
  }
  .socialLink__img{
    height: 100%;
    width: 100%;
    border-radius: 50%;
    overflow: hidden;
  }
  
</style>

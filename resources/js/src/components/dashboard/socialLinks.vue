<template>
  <div class="flex items-center social__carousel q-px-md q-px-md-xl">
    <q-carousel
      v-model="slide"
      swipeable
      animated
      navigation-position="bottom"
      navigation
      transition-prev="slide-right"
      transition-next="slide-left"
      padding
      height="165px"
      infinite
      :autoplay="5000"
      class=" rounded-borders w-100"
    >
      <q-carousel-slide 
        v-for="info in infoData"
        :key="info.value"
        :name="info.value" 
        class=" column no-wrap flex-center w-100 q-px-sm" 
      >
        <a href="" target="_blank" class="w-100">
          <div class="socialLink__item w-100 flex items-center no-wrap q-py-md q-px-md">
            <div style="" cc>
              <div  class="socialLink__img--container">
                <div class="socialLink__img">
                  <img :src="info.img" height="100%" width="100%" alt="">
                </div>
              </div>
            </div>
            <div style="" class="q-pl-sm">
              <div class="text-subtitle2 text-weight-bold flex items-center">
                <div class="q-mr-xs">
                  {{info.title}}
                </div>
                <q-icon :name="icons.sharpVerified" color="terciary" size="1.4rem" style="margin-left: 0.05rem; margin-top: -0.1rem;"/>

              </div>
              <div class="text-caption text-weight-medium">{{info.text}}</div>
            </div>

          </div>
        </a>
      </q-carousel-slide>
      <template v-slot:navigation-icon="{ active, onClick }">

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
        link: 'https://cdn-www.lanacionpy.arcpublishing.com/negocios/2021/01/12/emprendedores-ln-renuncio-a-todo-y-en-5-anos-consolido-woz-paraguay-sitio-de-comercio-digital/'
      },
      {
        value:'ig',
        title:'Instagram',
        img:ig,
        text:'Síguenos para ver más productos y servicios con ofertas exclusivas',
        link:'https://www.instagram.com/wozparaguay',
      },
      {
        value:'fb',
        title:'Facebook',
        img:fb,
        text:'Conéctate con nuestra página de Facebook para novedades y promociones asombrosas',
        link:'https://www.facebook.com/WozParaguay?mibextid=ZbWKwL',
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
    height: 3.5rem;
    width: 3.5rem;
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

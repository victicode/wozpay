<template>
  <div class="bg-blueLanding q-pb-lg q-px-sm q-px-md-xl q-pt-md-lg flex flex-md-column" style="box-shadow: #00000033 0px 5px 18px 2px;
    z-index: 9;
    position: relative;">
    <div class="q-px-sm q-px-md-lg q-pt-md text__section">
      <div class="q-pt-lg text-yellowLanding text-hero1 text-bold show-xs">
        Woz Pay
      </div>
      <div class="flex no-wrap relative position-relative" >
        <div class="text-white text-hero2 text-bold"> El mundo a un solo</div>
        <img :src="click_img" alt=""  class="q-ml-md clickImgHero">
      </div>
      <div class="text-white text-hero3 ">
        Usa Woz Pay para recibir y enviar dinero con múltiples
        beneficios
      </div>
      <div class="q-pt-lg text-yellowLanding text-hero1 text-bold hidde-xs">
        <div class="q-py-sm q-my-xs flex items-center">
          <img :src="click_img" alt="" style="height: 1.9rem; transform: rotate(100deg) translatex(-2px);" class="q-mr-sm">
          <div class="text-white text-benefit">Préstamos crédito por débito</div>
        </div>
        <div class="q-py-sm q-my-xs flex items-center">
          <img :src="click_img" alt="" style="height: 1.9rem; transform: rotate(100deg) translatex(-2px);" class="q-mr-sm">
          <div class="text-white text-benefit">Transferencias nacionales e internacionales</div>
        </div>
        <div class="q-py-sm q-my-xs flex items-center">
          <img :src="click_img" alt="" style="height: 1.9rem; transform: rotate(100deg) translatex(-2px);" class="q-mr-sm">
          <div class="text-white text-benefit">Carga de Billetera</div>
        </div>
        <div class="q-py-sm q-my-xs flex items-center">
          <img :src="click_img" alt="" style="height: 1.9rem; transform: rotate(100deg) translatex(-2px);" class="q-mr-sm">
          <div class="text-white text-benefit">Pagos de servicios</div>
        </div>
      </div>
    </div>
    <div class="img__section q-mt-md q-pl-md-xl">
      <div class="q-pl-md-xl">
        <img :src="hero_img" alt="" class="img__section--items img1 q-ml-md-xl" />

      </div>
      <!-- <img :src="imagen2" alt="" class="img__section--items img1">
      <img :src="imagen1" alt="" class="img__section--items img2">
      <img :src="imagen3" alt="" class="img__section--items img3"> -->
    </div>
    <div class="utility__section q-px-sm q-mt-md show-xs">
      <div class="utility__container q-pa-md">
        <div class="q-pt-md flex items-center">
          <img :src="click_img" alt="" style="height: 1.7rem; transform: rotate(90deg) translateX(-5px);" class="q-mr-sm">
          <div class="text-white text-benefit">Préstamos crédito por débito</div>
        </div>
        <div class="q-pt-md flex items-center">
          <img :src="click_img" alt="" style="height: 1.7rem; transform: rotate(90deg) translateX(-5px);" class="q-mr-sm">
          <div class="text-white text-benefit">Transferencias nacionales e internacionales</div>
        </div>
        <div class="q-pt-md flex items-center">
          <img :src="click_img" alt="" style="height: 1.7rem; transform: rotate(90deg) translateX(-5px);" class="q-mr-sm">
          <div class="text-white text-benefit">Carga de Billetera</div>
        </div>
        <div class="q-pt-md flex items-center">
          <img :src="click_img" alt="" style="height: 1.7rem; transform: rotate(90deg) translateX(-5px);" class="q-mr-sm">
          <div class="text-white text-benefit">Pagos de servicios</div>
        </div>
      </div>
    </div>
    <div class="show-xs-flex justify-center w-100 q-px-md q-pt-md" >
      <q-btn 
        label="Registrate en Woz Pay" 
        unelevated
        no-caps 
        color="terciary" 
        class="full-width q-pa-md" 
        @click="router.push('/register')" 
      >
        <template v-slot:loading>
          <q-spinner-facebook />
        </template>
      </q-btn>
    </div>
  </div>
</template>
<script>
  import imagen1 from '@/assets/images/IMAGEN_1.svg'
  import imagen2 from '@/assets/images/IMAGEN_2.svg'
  import imagen3 from '@/assets/images/IMAGEN_3.svg'
  import hero_img from '@/assets/images/hero_img.webp'
  import click_img from '@/assets/images/click.webp'
  import { useRouter } from 'vue-router'

  export default {
    setup(){
      return{
        router: useRouter(),
        imagen1,
        imagen2,
        imagen3,
        hero_img,
        click_img
      }
    }
  }
</script>

<style lang="scss">
.clickImgHero{
  height: 4.5rem;
  transform: translateY(-0.5rem);
}
.text__section{
  width: 45%;
}
.img__section{
  width: 55%;
  position: relative;
  height: 500px;
  overflow: hidden;

  &--items{
    height: 500px;
  }
  & .img1 {
    z-index: 2;
  }
}

.text-benefit {
  font-size: 1.2rem;
  font-weight: 100;
}
.text-hero2 {
  font-size: 3.4rem;
}
.text-hero3 {
  font-size: 1.4rem;
}
.utility__section{
  width: 100%;
}
.utility__container{
  background: #41526b;
  border-radius: 20px;
}
@media screen and (max-width: 780px){
  .clickImgHero{
    height: 3rem;
    transform: translateY(-0.5rem) translateX(-0.4rem);
  }
  .text__section{
    width: 100%;
  }
  .img__section{
    width: 100%;
    position: relative;
    height:auto;

    &--items{
      height: auto;
    }
  }
  .text-hero1 {
    font-size: 2.20rem;
  }
  .text-benefit {
    font-size: 0.9rem;
  }
  .text-hero2 {
    font-size: 2.20rem;
    text-wrap: nowrap;
  }
  .text-hero3 {
    font-size: 0.90rem;
  }

}

</style>
<template>
  <div class="bg-blueLanding q-pb-lg q-px-sm q-pt-md-lg flex flex-md-column" style="box-shadow: #00000033 0px 5px 18px 2px;
    z-index: 9;
    position: relative;">
    <div class="q-px-md q-px-md-lg q-pt-md text__section">
      <div class="q-pt-lg text-yellowLanding text-hero1 text-bold show-xs">
        Woz Pay
      </div>
      <div>
        <div class="text-white text-hero2 text-bold"> El mundo a un solo</div>
      </div>
      <div class="text-white text-hero3 ">
        Usa Woz Pay para recibir y enviar dinero con múltiples
        beneficios
      </div>
      <div class="q-pt-lg text-yellowLanding text-hero1 text-bold hidde-xs">
        <div class="q-py-sm q-my-xs">
          <div class="text-white text-benefit">Préstamos crédito por débito</div>
        </div>
        <div class="q-py-sm q-my-xs">
          <div class="text-white text-benefit">Transferencias nacionales e internacionales</div>
        </div>
        <div class="q-py-sm q-my-xs">
          <div class="text-white text-benefit">Carga de Billetera</div>
        </div>
        <div class="q-py-sm q-my-xs">
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
    <div class="utility__section q-px-md q-mt-md show-xs">
      <div class="utility__container q-pa-md">
        <div class="q-pt-sm">
          <div class="text-white text-benefit">Préstamos crédito por débito</div>
        </div>
        <div class="q-pt-sm">
          <div class="text-white text-benefit">Transferencias nacionales e internacionales</div>
        </div>
        <div class="q-pt-sm">
          <div class="text-white text-benefit">Carga de Billetera</div>
        </div>
        <div class="q-pt-sm">
          <div class="text-white text-benefit">Pagos de servicios</div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import imagen1 from '@/assets/images/IMAGEN_1.svg'
  import imagen2 from '@/assets/images/IMAGEN_2.svg'
  import imagen3 from '@/assets/images/IMAGEN_3.svg'
  import hero_img from '@/assets/images/hero_img.webp'
  export default {
    setup(){
      return{
        imagen1,
        imagen2,
        imagen3,
        hero_img
      }
    }
  }
</script>

<style lang="scss">
.text__section{
  width: 40%;
}
.img__section{
  width: 60%;
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
  }
  .text-hero3 {
    font-size: 0.90rem;
  }

}

</style>
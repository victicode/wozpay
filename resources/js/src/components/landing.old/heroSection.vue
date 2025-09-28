<template>
  <div class="bg-blueLanding q-pb-lg q-px-sm q-px-md-xl q-pt-md-lg flex column" style="box-shadow: #00000033 0px 5px 18px 2px;
    z-index: 9;
    position: relative;">
    <div class="q-px-sm q-px-md-md q-pt-md text__section">
      <b style="color: #f9b229;">¿Dropper?</b> Aprende cómo vender <br>
      y ganar comisiones en <br>
      Woz Dropshipping
    </div>
    <div class="q-mt-md text-white q-px-md subtitlteHero q-pb-xl">
      Tan fácil como mirar un video en Youtube
      <div class="text-link_header active flex-center link2 q-mt-md"  @click="router.push('/register')">Crear cuenta</div>
    </div>


  </div>
</template>
<script>
  import { useRouter } from 'vue-router'

  export default {
    setup(){
      return{
        router: useRouter(),
      }
    }
  }
</script>

<style lang="scss">
.link2{
  width: fit-content;
  border-radius: 3rem!important;
}
.subtitlteHero{
  font-size: 1.1rem;
  font-weight: 400;
}
.clickImgHero{
  height: 4.5rem;
  transform: translateY(-0.5rem);
}
.text__section{
  font-size: 3.7rem;
  color: white;
  font-weight: 900;
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
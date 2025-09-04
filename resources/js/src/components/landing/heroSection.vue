<template>
<section style="background: #1c1865; overflow: hidden;" class=" q-py-lg relative">
  <div style="position: relative; z-index: 3;">
    <div class="q-pl-md q-pr-xl">
      <div>
        <div class="titleHero">
          <b style="color: #f9b229;">¿Dropper?</b> <br>
          Aprende cómo vender y ganar comisiones <br>
          en Woz Dropshipping
        </div>
        <div class="subtitleHero q-mt-md">
          Tan fácil como mirar un video en Youtube
        </div>
      </div>
      <div class="q-mt-lg ">
         <q-btn unelevated rounded color="white" text-color="primary" class="q-mr-sm" style="border-radius: 8rem;" no-caps 
          @click="router.push('/register')"
          >
            <div class="q-pa-xs">
              Crear cuenta
            </div>
          </q-btn>
          <q-btn unelevated  rounded color="primary" text-color="white"  style="border-radius: 8rem;" no-caps 
          @click="router.push('/login')"
          >
            <div class="q-pa-xs">
              Inicia sesión
            </div>
          </q-btn>
      </div>
    </div>
    <div class="q-mt-xl w-100 flex justify-end q-pr-lg">
      <img :src="hero1"  class=" text-center" alt="" style="width: 17.2rem;">
    </div>
  </div>
  <div class="x-figure" />
</section>
</template>
<script>
  import hero1 from '@/assets/images/hero1.webp'
  import { useRouter } from 'vue-router'
  export default {
    setup(){
      return{
        router: useRouter(),
        hero1,
      }
    }
  }
</script>

<style lang="scss">
.x-figure{
  position: absolute; 
  z-index: 2;
  bottom:-25rem; 
  right: -60.5rem;
  width: 80rem; 
  height: 40rem;
  border-radius: 13rem; 
  background: white;
}
.titleHero{
  color:white;
  font-weight: bold;
  font-size:1.6rem;
  line-height: 1.4;
}
.subtitleHero{
  color: white;
  font-weight: 300;
  line-height: 1.4;
  font-size:0.98rem;


}
@media screen and (max-width: 780px){
}

</style>
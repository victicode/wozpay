<template>
  <section class="q-mt-xs  q-pt-xl q-pb-lg q-px-md-xl aquipago__section">
    <div >
      <div class="text-center text-aquipago1 q-px-md">
        ¿Donde pago?
      </div>
      <div class="text-center text-aquipago2 q-mt-sm q-px-sm" >
        Paga tus servicios públicos y privados en Aqui Pago 
      </div>
    </div>
    <div class="hidde-xs-flex  w-100  flex-center">
      <img :src="aquipago" alt="" class="img__aquipagoLogo">

    </div>
    <div>
      <div class="q-mt-md  q-px-md q-px-md-none text-center">
        <img :src="imagen9" alt="" class="img__aquipago">
      </div>
    </div>
  </section>
</template>
<script>
import imagen9 from '@/assets/images/IMAGEN_9.svg'
import aquipago from '@/assets/images/AQUI_PAGO.svg'

export default {
  setup() {
    return {
      imagen9,
      aquipago
    }
  },
}
</script>

<style lang="scss">
  .img__aquipagoLogo{
    height: 320px;
    margin-top: -2%;

  }
  .aquipago__section{
    border-top: 1.5rem solid $grey-3;
    border-bottom: 1.5rem solid $grey-3;
  
  }
  .text-aquipago1 {
    font-size: 3.1rem;
    font-weight: bold!important;
  }
  .text-aquipago2 {
    font-size: 1.7rem;
    font-weight: 500;
  }
  .img__aquipago{
    width: 104%;
    max-width: none;
    margin-left: -2%;
    margin-top: -5%;

  }
@media screen and (max-width: 780px){
  .aquipago__section{
    border-top: 0.8rem solid $grey-3;
    border-bottom: 0.8rem solid $grey-3;
  
  }
  .text-aquipago1 {
    font-size: 1.7rem;
  }
  .text-aquipago2 {
    font-size: 0.94rem;
    font-weight: 600;

  }
  .img__aquipago{
    border-radius: 20px;
    width: 100%;
    max-width: none;
    margin-left: 0%;
    margin-top: 0%;
  }
  
}
</style>
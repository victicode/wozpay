<template>
  <section class="q-px-sm q-px-md-xl q-pt-lg q-py-xl q-pb-lg bg-business flex" style="box-shadow: rgba(0, 0, 0, 0.2) 0px 5px 18px 2px;
    z-index: 8;
    position: relative;">
    <div class="q-px-md title__section q-pt-md-lg">
      <div class="text-business1 ">
        Impulsa tu negocio con un

        préstamo Woz Pay a medida
      </div>
      <div class="text-business2 q-mt-sm q-px-sm q-pl-md-xl">
        Financiamos tus proyectos con un préstamo <br> de crédito por débito
      </div>
      <div class="hidde-xs-flex  q-mt-xl q-pl-xl q-ml-md">
        <div class="q-pt-lg contanier__text3 flex" >
          <img :src="click_img" alt="" style="height: 1.9rem; transform: rotate(100deg) translatex(-2px);" class="q-mr-sm" >
          <div class="text-business3">Registrate gratis</div>
        </div>
        <div class="q-pt-lg contanier__text3 flex" >
          <img :src="click_img" alt="" style="height: 1.9rem; transform: rotate(100deg) translatex(-2px);" class="q-mr-sm" >
          <div class="text-business3">Desembolso en cuenta</div>
        </div>
        <div class="q-pt-lg contanier__text3 flex" >
          <img :src="click_img" alt="" style="height: 1.9rem; transform: rotate(100deg) translatex(-2px);" class="q-mr-sm" >
          <div class="text-business3">Solicitá tu préstamo</div>
        </div>
      </div>
    </div>
    <div class="q-px-sm img__section__business q-mt-md q-pt-md-md" >
      <div style="width: 47%;" class="transferImg">
        <img :src="imagen4" alt="" class="img1_bussiness" />
      </div>
      <div style="width: 47%;" class="transferImg">
        <img :src="imagen5" alt=""  class="img2_bussiness" />
      </div>
    </div>
    <div class="q-px-md q-mt-lg show-xs benefict__section">
      <div class="q-pt-md flex">
        <img :src="click_img" alt="" style="height: 1.7rem; transform: rotate(90deg) translateX(-5px);"  class="q-mr-sm">
        <div class="text-business3">Registrate gratis</div>
      </div>
      <div class="q-pt-md flex">
        <img :src="click_img" alt="" style="height: 1.7rem; transform: rotate(90deg) translateX(-5px);"  class="q-mr-sm">
        <div class="text-business3">Desembolso en cuenta</div>
      </div>
      <div class="q-pt-md flex">
        <img :src="click_img" alt="" style="height: 1.7rem; transform: rotate(90deg) translateX(-5px);"  class="q-mr-sm">
        <div class="text-business3">Solicitá tu préstamo</div>
      </div> 
    </div>
  </section>
</template>
<script>
  import imagen4 from '@/assets/images/IMAGEN_4.svg'
  import imagen5 from '@/assets/images/IMAGEN_5.svg'
  import click_img from '@/assets/images/click.webp'

  export default {
    setup(){
      return{
        imagen4,
        imagen5,
        click_img,
      }
    }
  }
</script>
<style scoped lang="scss">

.title__section{
  width: 50%;
  order: 2;
}
.img__section__business{
  order: 1;
  width: 50%;
  height: max-content;
  display: flex;
  justify-content: space-evenly;
}
.bg-business{
  background: #d9d9d9;
}
.text-business1{
  font-size: 3.2rem;
  text-align: end;
  font-weight: bold;
}
.text-business2 {
  font-size: 1.5rem;
  text-align: end;
  font-weight: 500;
}
.text-business3{
  color:#f9a826;
  font-size: 1.5rem;
  font-weight: 700;

}

.contanier__text3{
  width: 50%;
}
@media screen and (max-width: 780px){
  .img1_bussiness{width: 100%; }
  .img2_bussiness{width: 100%; }
  .benefict__section{
    order: 3;
  }
  .title__section{
    width: 100%;
    order: 1;
  }
  .img__section__business{
    justify-content: space-between;
    width: 100%;
  }
  .text-business1{
    text-align: center;
    font-size: 1.7rem;
  }
  .text-business2 {
    text-align: center;
    font-size: 1rem;
    font-weight: 500;
  }
  .text-business3{
    font-size: 1.2rem;
    font-weight: 700;
    text-align: start;
  }
}
.transferImg{
  // transition:  all 1s;
  animation: slidein 1.5s infinite alternate-reverse ease-in;

}
@keyframes slidein {
  from {
    transform: translateY(-5px);
  }

  to {
    transform: translateY(10px);
  }
}
</style>
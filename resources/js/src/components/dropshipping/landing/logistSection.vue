<template>
  <section class=" q-pb-xl q-px-md" style="background:#f7f7f7;"> 
    <div class=" text-title-section text-white bg-yellowLanding">
      Logisitica Woz Dropshipping
    </div>
    <div class="logistContainer ">
      <div class="text-content-question text_in_services q-px-md q-py-md" >
        Operamos de forma internacional. Envíos nacionales se hacen con AEX Group y los internacionales con FedEx. <br>
        Podés vender desde donde estés y a quien quieras.
      </div>
      <div class="text_in_services2 q-px-md">
        <div v-for="(service, key) in logistServices" :key="key" class="flex items-center" style="flex-wrap: nowrap; width: 20rem;">
          <div :class="'service__img--container'+key"  class="q-mr-sm q-pa-md q-py-xl">
            <img :src="service.img" class="service__img"  alt="" style="width: 5.5rem; max-width: none;">
          </div>
          <div class="text-content-question q-my-md" f>
            {{ service.text }}
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
  import wozIcons from '@/assets/icons/wozIcons'
  import { useAuthStore } from '@/services/store/auth.store'
  import { storeToRefs } from 'pinia';
  import { ref, inject } from 'vue'
  import fedex from '@/assets/images/fedex.png'
  import aex from '@/assets/images/aex.png'

  export default {
    setup() {
      //vue provider
      const { user } = storeToRefs(useAuthStore()) 
      const icons =  wozIcons
      const iconis =  inject('ionIcons')

      const logistServices = [
        {
          title:'fedex',
          img:fedex,
          text:'Elije FedEx para entregar tus envíos importantes y urgentes desde y hacia más de 220 paises y territorios en todo el mundo'
        },
        {
          title:'aex',
          img:aex,
          text:'Entregas a todo el país de correspondencia masiva no personalizada, con o sin acuse de recibo, de una amplia variedad de materiales como revistas, catálogos.'
        },
      ]

      return{
        logistServices,
      }
    },
  }
</script>
<style>
.text-title-section{
  font-family: 'Amazon Ember Bolder'!important;
  font-weight: bolder;
  font-size: 0.9rem;
  letter-spacing: -0px;
  padding:  0.6rem .7rem ;
  border-radius: 0.5rem;
  width: max-content;

  transform: translateY(-1rem);
}
.logistContainer{
  border: 1px solid #f9a826;
  border-radius: 1rem;
  background: linear-gradient(180deg,rgba(248, 168, 13, 1) 50%, rgba(4, 73, 250, 1) 50%);
}
.text_in_services{
  background: white;
  width: 94%;
  border-top-left-radius: 0.9rem;


}
.text_in_services2{
  background: white;
  width: 94%;
  border-bottom-left-radius: 0.9rem;
}
[class*=service__img--container]{
  border-radius: 1rem;
}
.service__img--container0{
  border: 1px solid #f9a826;
  
}
.service__img--container1{
  border: 1px solid rgba(4, 73, 250, 1);
}
</style>
<template>
  <section class=" q-pb-xl q-px-md" style="background:#f7f7f7;"> 
    <div class=" text-title-section text-white bg-yellowLanding">
      Integraciones con Webs
    </div>
    <div class="integrationContainer q-mb-sm">
      <div class="text-content-question text_in_services q-px-md q-py-md " >
        Si tienes una web propia puedes intergrar nuestros catalogo a tu tienda propia
      </div>
      <div class="text_in_services2 q-px-md q-pb-md">
        <div class="flex items-center" style="flex-wrap: nowrap; width: 20rem;">
          <div   class="service__img--container2 q-mr-sm q-pa-md q-py-xl">
           {{ '< / >' }}
          </div>
          <div class="text-content-question text-compact q-my-md " >
            Contrata un desarrollador que haga la integración a tu tienda. 
            Brindaremos las credenciales para la misma, contacta a wozparaguay@gmail.com
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
  import { inject } from 'vue'


  export default {
    setup() {
      //vue provider
      const { user } = storeToRefs(useAuthStore()) 
      const icons =  wozIcons
      const iconis =  inject('ionIcons')

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
.integrationContainer{
  border: 1px solid #f9a826;
  border-radius: 1rem;
  background: rgba(248, 168, 13, 1) ;
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
.service__img--container2{
  border: 1px solid #f9a826;
  width: 29.5rem;
    font-size: 3rem;
    line-height: 0;
    font-weight: bolder;
    color: #c1c1c1;
    height: 7.7rem;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: fantasy!important;
  
}

</style>
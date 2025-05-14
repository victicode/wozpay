<template>
  <section class=" q-pb-xl q-px-md flex column items-center justify-center w-100"  >
     <q-btn 
      v-for="(button, key) in buttons" 
      unelevated  
      :key="key" 
      :color="button.color" 
      :class="' q-my-xs buttons__actionLanding '+button.class"
      @click="goTo(button.to)"
     >
        {{ button.title }}
     </q-btn>
  </section>
</template>
<script>
  import wozIcons from '@/assets/icons/wozIcons'
  import { useAuthStore } from '@/services/store/auth.store'
  import { storeToRefs } from 'pinia';
  import {  inject } from 'vue'
  import { useRouter } from 'vue-router';


  export default {
    setup() {
      //vue provider
      const { user } = storeToRefs(useAuthStore()) 
      const icons =  wozIcons
      const iconis =  inject('ionIcons')
      const router = useRouter()

      // 
      
      const buttons = [
        {
          title:'Productos y Categorias',
          class:'',
          to:'/dropshipping/categories',
          color:'yellowLanding'
        },
        {
          title:'Guía básica de Dropshipping',
          class:'',
          to:'/manual-dropshipping',
          color:'yellowLanding'
        },
        {
          title:'Activar Membresia anual',
          class:'',
          to:'/activate-membresia',
          color:'positive'
        },
      ]
      const goTo = (id) =>{
        router.push(id)
      }
      return{
        buttons,
        goTo
      }
    },
  }
</script>

<style lang="scss">
.buttons__actionLanding{
  padding: 1.2rem 1.2rem;
  border-radius: 1rem;
  width: 98%;
  & .q-btn__content{
    font-size: 1rem;
  }
}
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
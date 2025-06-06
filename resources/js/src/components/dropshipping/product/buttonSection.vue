<template>
  <section >
    <div class="q-mt-lg flex column items-center q-pb-md">
      <q-btn unelevated color="positive" class="q-my-xs" style="width: 85%; padding: 1rem; border-radius:0.8rem; font-size:0.95rem" no-caps label="Vender producto" />
      <q-btn @click="goTo('/dropshipping/iaResult/'+product.id)" unelevated color="yellowLanding" class="q-my-xs" style="width: 85%; padding: 1rem; border-radius:0.8rem; font-size:0.95rem" no-caps label="Analizar producto con Wozpy AI" />
    </div>
    <div class="q-px-md q-pb-md">
      <div class="droppersInfo__container q-py-sm q-px-md q-mb-sm">
        <div class="flex items-center" >
          <div class="text-yellowLanding droppersInfo__container--title">
            Droppers
          </div>
          <div v-html="wozIcons.droppers" class="q-ml-xs"/>
        </div>
        <div class="text-grey text-subtitle2">
          {{ getRandomInt(50,100)}} Droppers están vendiendo este producto
        </div>
      </div>
      <div class="publiInfo__container q-py-sm q-px-md q-mb-sm">
        <div class="flex items-center justify-between" style="width: 100%;" >
          <div class="text-positive publiInfo__container--title">
            Impulsar con Woz Ads
          </div>
          <div class="flex">
            <div v-html="wozIcons.facebook" class="q-mr-xs publiInfo__container--social-container"/>
            <div v-html="wozIcons.youtube" class="q-mr-xs publiInfo__container--social-container"/>
            <div v-html="wozIcons.x" class="q-mr-xs publiInfo__container--social-container"/>
            <div v-html="wozIcons.ig" class=" publiInfo__container--social-container"/>
          </div>
        </div>
        <div class="text-grey text-subtitle2">
          Impulsamos este producto para que vendas más
        </div>
      </div>
    </div>
  </section>
</template>
<script>

import { inject, onMounted } from 'vue';
import wozIcons from '@/assets/icons/wozIcons';
import { useRouter } from 'vue-router';


export default {
  props: {
    product: Object,
  },
  setup (props) {
    const icons = inject('ionIcons');
    
    const product = ref(props.product) 
    const router = useRouter()
    const formattList = () => {
      return [
        {
          title:'Logística',
          value: `Envíos por ${product.value.logistic} <i class="q-icon text-terciary " aria-hidden="true" style="font-size: 1.1rem;"><svg viewBox="0 0 24 24"><path d="M0 0 H24 V24 H0 V0 z" style="fill: none;"></path><path d="M23,12l-2.44-2.79l0.34-3.69l-3.61-0.82L15.4,1.5L12,2.96L8.6,1.5L6.71,4.69L3.1,5.5L3.44,9.2L1,12l2.44,2.79l-0.34,3.7 l3.61,0.82L8.6,22.5l3.4-1.47l3.4,1.46l1.89-3.19l3.61-0.82l-0.34-3.69L23,12z M10.09,16.72l-3.8-3.81l1.48-1.48l2.32,2.33 l5.85-5.87l1.48,1.48L10.09,16.72z"></path></svg></i>`
        },
        {
          title:'Tiempo de entrega',
          value: `Entrega en ${product.value.time_ship}`
        },
        {
          title:'Cobro a los clientes',
          value: `Usa ${product.value.pay_method} <i class="q-icon text-terciary " aria-hidden="true" style="font-size: 1.1rem;"><svg viewBox="0 0 24 24"><path d="M0 0 H24 V24 H0 V0 z" style="fill: none;"></path><path d="M23,12l-2.44-2.79l0.34-3.69l-3.61-0.82L15.4,1.5L12,2.96L8.6,1.5L6.71,4.69L3.1,5.5L3.44,9.2L1,12l2.44,2.79l-0.34,3.7 l3.61,0.82L8.6,22.5l3.4-1.47l3.4,1.46l1.89-3.19l3.61-0.82l-0.34-3.69L23,12z M10.09,16.72l-3.8-3.81l1.48-1.48l2.32,2.33 l5.85-5.87l1.48,1.48L10.09,16.72z"></path></svg></i> para cobrar a tus clientes`
        },
        {
          title:'Retiro de ganacias - comisiones',
          value: product.value.comision
        }
      ]
    }
    const getRandomInt = (min, max) => {
      min = Math.ceil(min);
      max = Math.floor(max);
      return Math.floor(Math.random() * (max - min) + min);
    }
    
    const goTo = (url) => {
      router.push(url)
    }
    return {
      detailsFormatted: formattList(),
      wozIcons,
      product,
      getRandomInt,
      goTo,
    }
  }
}
</script>
<style lang="scss">
.droppersInfo__container{
  border: 1px solid #f9a826;
  border-radius: 0.8rem;
  &--title{
    font-size: 1.3rem;
    font-weight: bold;
  }
}
.publiInfo__container{
  border: 1px solid #21ba45;
  border-radius: 0.8rem;
  &--title{
    font-size: 1.3rem;
    font-weight: bold;
  }
  &--social-container{
    background: goldenrod;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 1.5rem; 
    width: 1.5rem; 
    border-radius: 50%;
  }
}
</style>
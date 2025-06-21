<template>
  <section class="q-px-md">
    <div>
      <div v-for="(details, key) in detailsFormatted" :key="key" class="q-pb-sm q-my-sm" style="border-bottom: 2px solid lightgrey;">
        <div class="details__items--title">{{ details.title }}</div>
        <div class="details__items--value" v-html="details.value" />
      </div>
    </div>
    <div>
      <div class="details__items--title-description q-mt-md q-my-sm" >Descripción</div>
      <div class="details__items--value q-px-md q-py-sm" >
        {{ product.description }}
      </div>
    </div>
  </section>
</template>
<script>

import { inject, onMounted } from 'vue';
export default {
  props: {
    product: Object,
  },
  setup (props) {
    const icons = inject('ionIcons');
    
    const product = ref(props.product) 
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
    onMounted(() => {
     
    })
    
    return {
      detailsFormatted: formattList(),
    }
  }
}
</script>
<style lang="scss">
.details__items{
  &--title{
    font-size: 1.2rem;
    font-weight: 500;
  }
  &--value{
    color: darkgray;
    font-size: 0.95rem;
    background: transparent;
    border-radius: 1rem;
  }
  &--title-description{
    font-weight: bold;
    font-size: 1.35rem;
  }
}
</style>
<template>
  <section>
    <div></div>
  </section>
</template>
<script>
import moment from 'moment/moment';
import { onMounted } from 'vue';
import util from '@/util/numberUtil';
export default {
  props: {
    product: Object,
  },
  setup (props) {
    
    const product = ref(props.product) 
    console.log(product.value)
    const formattList = () => {
      return [
        {
          title:'Logística',
          value: `Envíos por ${product.value.logistic}`
        },
        {
          title:'Tiempo de entrega',
          value: `Entrega en ${product.value.time_ship}`
        },
        {
          title:'Cobro a los clientes',
          value: `Usa ${product.value.pay_method} para cobrar a tus clientes`
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
      product,
    }
  }
}
</script>
<template>
  <div class="q-pt-lg q-px-md q-mt-lg q-pb-xs" style="background:#f7f7f7;">
    <div v-for="(question, index) in questions" :key="index" class="questionContainer q-mb-xl">
        <div class="text-center text-title-question text-white bg-yellowLanding ">
          {{ question.title }}
        </div>
        <div class="q-mb-md text-content-question q-px-xs" v-html="question.answer" />
    </div>
  </div>
</template>
<script>
  import wozIcons from '@/assets/icons/wozIcons'
  import { useAuthStore } from '@/services/store/auth.store'
  import { storeToRefs } from 'pinia';
  import { ref, inject } from 'vue'

  export default {
    setup() {
      //vue provider
      const { user } = storeToRefs(useAuthStore()) 
      const icons =  wozIcons
      const iconis =  inject('ionIcons')

      const questions = [
        {
          title:'¿Qué es el Woz Dropshipping?',
          answer:`Woz Dropshipping es una plataforma que permite vender productos sin necesidad de comprar stock.

          <br><br> Conectamos a proveedores con personas que quieren emprender pero no tienen capital para invertir en mercadería.

          <br><br> Tú vendes, el proveedor se encarga del envío, y ganas por cada venta sin preocuparte por la logística.`
        },
        {
          title:'¿Necesito experiencia?',
          answer:`No. La plataforma Woz está diseñada para que cualquier persona pueda empezar, incluso si nunca vendió online.

          <br><br> Es un sistema "enchufá y vendé": vos generás la venta, nosotros nos encargamos del resto (producto, cobro, envío). Si sabes usar redes sociales, ya estás a medio camino.`,
        },
        {
          title:'¿Y si no vendo nada?',
          answer:`Es parte del proceso. Por eso incluimos guías, capacitaciones, análisis de campañas y recomendaciones personalizadas para que mejores y empieces a generar ventas reales.`,
        },
        {
          title:'¿Cuánto puedo ganar?',
          answer:`Las comisiones van del 10% al 40% según el producto. Si vendés mucho o elegís productos de alto valor, tus ingresos pueden escalar rápido. En promedio entre Gs. 2.000.000 a Gs. 6.500.000 por mes.`,
        },
      ]

      return{
        questions,
      }
    },
  }
</script>
<style lang="scss">
.text-title-question{
  font-family: 'Amazon Ember Bolder'!important;
  font-weight: bolder;
  font-size: 1rem;
  letter-spacing: -0px;
  padding:  0.3rem 1.8rem ;
  border-radius: 0.5rem;
  width: max-content;
  margin: auto;
  transform: translateY(-1rem);
}
.questionContainer{
  border: 1px solid #f9a826;
  border-radius: 1rem;
  background: #ffffff;
  padding: 0rem 1.3rem ;
}
.text-content-question{
  font-family: 'Amazon Ember'!important;
  font-size: 0.89rem;
  font-weight: bolder;
  color: #3b3b3b;

}
</style>
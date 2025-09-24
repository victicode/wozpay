<template>
  <div class="q-px-xl q-pb-xl q-pt-md ">
    <div class="row">
      <div class="col-12 titleSectionInFaqDesktop q-px-md q-mb-lg">
        Preguntas frecuentes
      </div>
      <div class="col-12 col-md-6 q-px-md q-mb-md" v-for="(faq, index) in faqs" :key="index">
        <div class="titleSectionFaq q-mt-sm">
          {{ faq.title }}
        </div>
        <q-list class="faqSectionfaqDesktop">
          <q-expansion-item
            group="somegroup"
            class="q-mb-sm q-px-none"
            v-for="(question, key) in faq.content"
            :key="key"
          >
            <template v-slot:header>
              <div class="flex items-center q-pt-sm item__titlefaqDesktop q-pb-md" style="width: 100%;">
                {{ question.title }}
              </div>
            </template>
            <q-card class="q-pl-xl">
              <q-card-section class="text-grey-6">
               {{ question.anserw }}
              </q-card-section>
            </q-card>
          </q-expansion-item>
        </q-list>
      </div>
    </div>
  </div>
</template>
<script>
import { useRouter } from 'vue-router';

export default {    
  setup(){
    const faqs = [
      {
        title:'Inicio y conceptos básicos',
        content:[
          {
            title: '¿Qué es el Dropshipping y cómo funciona?',
            anserw: '',
          },
          {
            title: '¿Necesito tener productos en stock para vender?',
            anserw: '',
          },
          {
            title: '¿Cuánto dinero necesito para comenzar a vender?',
            anserw: '',
          },
          {
            title: '¿Qué plataforma o tienda necesito para comenzar?',
            anserw: '',
          },
          {
            title: '¿Cuanto es la comision por ventas?',
            anserw: '',
          },
        ]
      },
      {
        title:'Operación y logistica',
        content:[
          {
            title: '¿Quién envía el producto al cliente final?',
            anserw: '',
          },
          {
            title: '¿Cómo se elige un producto para vender?',
            anserw: '',
          },
          {
            title: '¿Puedo vender en cualquier país o solo en Paraguay?',
            anserw: '',
          },
          {
            title: '¿Cuánto tarda en llegar un producto a un cliente?',
            anserw: '',
          },
          {
            title: '¿Puedo ofrecer método de pago como contra entrega?',
            anserw: '',
          },
        ]
      },
      {
        title:'Cobros y ganancias',
        content:[
          {
            title: '¿Cómo le cobro al cliente?',
            anserw: '',
          },
          {
            title: '¿Qué método de pago acepta Woz Pay?',
            anserw: '',
          },
          {
            title: '¿Qué día me pagan por una venta realizada?',
            anserw: '',
          },
          {
            title: '¿Qué me descuentan luego de cobrar al cliente?',
            anserw: '',
          },
          {
            title: '¿Quién paga el envío al cliente, lo sacan de mi ganancia?',
            anserw: '',
          },
        ]
      },
      {
        title:'Otras preguntas frecuentes',
        content:[
          {
            title: '¿Qué pasa si el cliente no recibe el producto?',
            anserw: '',
          },
          {
            title: '¿Puedo automatizar las ventas?',
            anserw: '',
          },
          {
            title: '¿Puedo retirar mis ganancias antes de los 10 días?',
            anserw: '',
          },
          {
            title: '¿Puedo cancelar mi membresía antes de los 12 meses?',
            anserw: '',
          },
          {
            title: '¿Me dan reembolso por mi membresía?',
            anserw: '',
          },
        ]
      },
    ]
    const router = useRouter()

    return {
      faqs,
      router
    }
  }
}
</script>
<style lang="scss">
.item__titlefaqDesktop{
  font-size: 0.92rem;
  font-weight: 500;
  color:#606060;
  border-bottom:  1px solid #bdbdbd;
  font-family: 'Amazon Ember Regular'!important;

}
.faqSectionfaqDesktop{
  & .q-item {
    padding: .5rem 0px;
  }
  & .q-item__section--side{
    display: none;
  }
}
.titleSectionFaq{
  color:#2f2d41;

  font-size: 1.25rem;
  font-weight: 900;
  font-family: 'Amazon Ember Regular'!important;
}
.titleSectionInFaqDesktop{
  font-weight: 900;
  font-family: 'Amazon Ember Bolder'!important;
  color:#2f2d41;
  font-size: 1.8rem;
}
</style>
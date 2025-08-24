<template>
  <div>
    <div class="row">
      <div class="col-12 titleSectionInFaq q-px-md">
        Preguntas frecuentes
      </div>
      <div class="col-12 col-md-6 q-px-md q-mb-md" v-for="(faq, index) in faqs" :key="index">
        <div class="titleSectionFaq q-mt-sm">
          {{ faq.title }}
        </div>
        <q-list class="faqSectionfaq">
          <q-expansion-item
            group="somegroup"
            class="q-mb-sm q-px-none"
            v-for="(question, key) in faq.content"
            :key="key"
          >
            <template v-slot:header>
              <div class="flex items-center q-pt-sm item__titlefaq q-pb-md" style="width: 100%;">
                {{ question.title }}
              </div>
            </template>
            <q-card class="q-pl-xl">
              <q-card-section class="text-grey-6">
                Un análisis competitivo es una
                investigación sobre el panorama de tu
                segmento de mercado para descubrir lo
                que tus competidores están haciendo. El
                objetivo es entender cómo se comportan
                dentro del mercado para planificar
                actividades comerciales que
                contrarresten sus puntos fuertes y
                exploten los débiles
              </q-card-section>
            </q-card>
          </q-expansion-item>
        </q-list>
      </div>
    </div>
    <div class="q-px-md q-py-md flex flex-center">
        <q-btn color="sectionActive" unelevated="" no-caps style="border-radius: 0.888rem; width: 98%;" @click="router.push('/register')" class="">
          <div class="q-py-md q-px-md" style="font-size: 1.0rem;">
            Crear cuenta
          </div>
        </q-btn>
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
.item__titlefaq{
  font-size: 0.92rem;
  font-weight: 500;
  color:#606060;
  border-bottom:  1px solid #bdbdbd;
}
.faqSectionfaq{
  & .q-item {
    padding: .5rem 0px;
  }
  & .q-item__section--side{
    display: none;
  }
}
.titleSectionFaq{
  color:#2f2d41;
  font-weight: 800;
  font-size: 1.25rem;
}
.titleSectionInFaq{
  color:#2f2d41;
  font-weight: 900;
  font-size: 1.8rem;
}
</style>
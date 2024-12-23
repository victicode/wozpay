<template>
  <section>
    <div>
      <div class="w-100">
        <img :src="person" alt="" class=" mx-auto" height="">
      </div>
      <div style="width: 100%; border-top: 4px solid #f9a826; background: #1c304f;" class="q-px-md q-py-lg">
        <div class="text-white  text-bold q-px-xs" style="font-size: 1.8rem;">
          Activa tu cuenta internacional con Woz Payments
        </div>
        <div class="text-white q-px-xs text-subtitle1 q-pt-sm text-weight-light">
          Recibe y retira dinero sin fronteras
        </div>
      </div>
    </div>
    <div>
      <div class="text-center q-px-lg q-pt-md" style="color: #1c304f; font-size: 1.7rem; font-weight: 900;"> 
        ¿Qué puedes hacer con una cuenta internacional?
      </div>
      <div class="q-px-lg q-my-lg">
        <div class="q-px-sm">

          <div v-for="(item,index) in whatDo" :key="index" style="border-radius: 20px; background: #e1e9fe;" class="q-pa-md q-mb-md">
            <div>
              <img :src="item.img" alt="" style="height: 4rem; " class="mx-auto">
            </div>
            <div class="text-center text-bold q-px-sm q-mt-md" style="font-size: 1.45rem;" >
              {{ item.title }}
            </div>
            <div style="color: #1c304f; font-weight: 400; font-size: 0.9rem;" class="text-center q-mt-xs q-px-md">
              {{ item.text }}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="q-mt-xl">
      <div style="width: 100%; border-top: 4px solid #f9a826; background: #1c304f;" class="q-px-md q-py-lg">
        <div class="text-white  text-bold q-px-xs" style="font-size: 1.8rem;">
          Retiros en cuentas bancarias y billeteras
        </div>
        <div class="text-white q-px-xs text-subtitle1 q-pt-sm text-weight-light">
          No importa de que país seas, nosotros te transferimos directamente a tu cuenta 
        </div>
      </div>
    </div>
    <div>
      <div class="q-px-lg q-my-lg">
        <div class="q-px-sm">

          <div v-for="(item,index) in whatDo" :key="index" style="border-radius: 20px; background: #e1e9fe;" class="q-pa-md q-mb-md">
            <div>
              <img :src="item.img" alt="" style="height: 4rem; " class="mx-auto">
            </div>
            <div class="text-center text-bold q-px-sm q-mt-md" style="font-size: 1.45rem;" >
              {{ item.title }}
            </div>
            <div style="color: #1c304f; font-weight: 400; font-size: 0.9rem;" class="text-center q-mt-xs q-px-md">
              {{ item.text }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
  import { inject, ref } from 'vue'
  import { useAuthStore } from '@/services/store/auth.store'
  import { storeToRefs } from 'pinia'
  import { useRouter } from 'vue-router'
  import wozIcons from '@/assets/icons/wozIcons';
  import person from '@/assets/images/person.svg'
  import engine from '@/assets/images/engine.png'
  import ship from '@/assets/images/ship.png'
  import ubi from '@/assets/images/ubi.png'
  import binance from '@/assets/images/binance.svg'
  import mp from '@/assets/images/mp.svg'
  import transfer from '@/assets/images/tr.svg'


  
  export default {
    setup() {
      //vue provider
      const { user  } = storeToRefs(useAuthStore())
      
      const whatDo = [
        {
          title: 'Operaciones en globales',
          text:'Puedes trabajar desde cualquier parte del mundo sin complicaciones',
          img: ubi,
        },
        {
          title: 'Alianza Woz Payments',
          text: 'Aprovecha nuestras alianzas para el cobro en USD con bajas tasas de conversión',
          img: ship,
        },
        {
          title: 'Sin plan mensual',
          text: 'No necesitas pagar una mensualidad o tener un promedio mínimo para activar tu cuenta',
          img: engine,
        },
      ]

      const withdrawal = [
        {
          logo: binance,
          text: `Usar Binance para recibir dinero en dólares es conveniente debido a sus bajas comisiones, rapidez en las transacciones y seguridad avanzada. Además, ofrece múltiples opciones de retiro y soporte global`,
          color: '#ffc601',
        },
        {
          logo: binance,
          text: `Usar Binance para recibir dinero en dólares es conveniente debido a sus bajas comisiones, rapidez en las transacciones y seguridad avanzada. Además, ofrece múltiples opciones de retiro y soporte global`,
          color: '#ffc601',
        }
      ]
      
      return{
        user,
        wozIcons,
        person,
        whatDo,
      }
    },
  }

</script>
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
      <div class="text-center q-px-lg q-pt-md howdoTitle" > 
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
      <div class=" q-mt-xs">
        <div class="">

          <div v-for="(item,index) in withdrawal" :key="index"  :style="'background:'+item.color " class="q-pt-md q-mb-xs card__logo-pay">
            <div class="flex items-center logo__container " :style="'background:'+item.sectionColor">
              <img :src="item.logo" alt="" style="height: 2.8rem; " class=" q-ml-sm ">
              <div v-if="item.title" style="color: #1c304f; font-weight: 900; font-size: 2rem;">
                {{ item.title }}
              </div>
            </div>
            <div style="font-weight: 500; font-size: 0.95rem; line-height: 1.7;" :style="'color:'+item.sectionColor" class="q-mt-xs q-px-md q-py-md">
              <div v-html="item.text" class="q-pt-xs" />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="q-mt-md">
      <div class=" q-px-lg q-pt-md" style="color: #1c304f; font-size: 1.3rem; font-weight: 600;">
        Empieza a usar Woz Payments Internacional
      </div>
      <div class="q-px-md steps">
        <div v-for="(item, index) in initWozLink" :key="index" class="q-mt-md ">
          <div class="steps__title-section q-mb-sm q-mx-sm">
            <div class="steps__title-section--title">
              {{ item.title }}
            </div>
            <q-linear-progress rounded size="7px" track-color="backLinear"  :value="0.55" color="white" reverse class=" links-progress" />
          </div>
          <div class="q-px-sm">
            <q-timeline color="linksLanding" class="linksTimeline">
              <q-timeline-entry
                v-for="(step, key) in item.steps"
                color="linksLanding"
                :title="step.title"
                :key="key"
                :body="step.text"
                :icon="`${key+1}`"
              />
            </q-timeline>
          </div>

        </div>
      </div>
      <div class="q-px-md q-mb-lg"> 
        <div class="include__table q-mt-md q-px-md q-py-lg">
          <div class="include__table--title">
            Incluye
          </div>
          <div>
            <div v-for="(item, key) in addOns" :key="key" class="flex items-center q-mt-md">
              <div class="include__table--item text-white flex flex-center">{{ key+1 }}</div>
              <div class="include__table--text q-ml-sm">{{ item }}</div>
            </div>
          </div>
        </div>
      </div>
      <div style="border-top: 2px solid #f8a80d; " class="q-pa-lg bg-grey-4 q-mb-sm">
        <div style="font-size: 2rem; font-weight: 600;">
          30USD anual
        </div>
        <div class="text-grey-7 q-mt-sm" style="font-size: 0.85rem;" >
          Costo de la activación por única vez (Incluye comisiones gubernamentales y tu primer año gratis)
        </div>
      </div>
      <div>
        <div>
          <div >
            <img :src="teamship" alt="" width="160" class="mx-auto">
          </div>
          <div class="text-center" style="transform: translateY(-1rem);">
            <div class="userTeam__title">+12.000</div>
            <div class="userTeam__text" >
              Cuentas activadas
            </div>
          </div>
        </div>
      </div>
      <div class="q-px-lg q-mb-lg q-mt-md">
        <div class="text-center activate__text">Comienza ahora</div>
        <q-btn  
          label="Activar cuenta" 
          unelevated
          no-caps 
          color="terciary" 
          class="full-width q-pa-md q-mt-sm" 
          @click="showModal=true"
        />
      </div>
      <q-dialog v-model="showModal" persistent>
      <q-card>
        <q-card-section class="row items-center">
          <div class="text-subtitle2">¿Seguro que deseas activar tu cuenta de cobros internacionales?</div>
        </q-card-section>

        <q-card-actions align="right">
          <q-btn flat label="Cancelar" color="grey-7" @click="showModal=false" />
          <q-btn flat label="Activar" color="primary" :loading="loading" @click="activateWallet()" />
        </q-card-actions>
      </q-card>
    </q-dialog>
    </div>
  </section>
</template>
<script>
  import { ref } from 'vue'
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
  import teamship from '@/assets/images/team.svg'
  import { useWalletStore } from '@/services/store/wallet.store';

  export default {
    setup() {
      //vue provider
      const showModal = ref(false)
      const loading = ref(false)
      const { user  } = storeToRefs(useAuthStore())
      const router = useRouter()
      const walletStore = useWalletStore()
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
          sectionColor:'#000',
        },
        {
          logo: mp,
          text: `Ideal en Sudamérica por su amplia <br> aceptación, facilidad de uso y seguridad en transacciones.`,
          color: '#0449fa',
          sectionColor:'#fff',
        },
        {
          logo: transfer,
          title: 'Transferencia',
          text: `Retira dinero directamente a <br> tu cuenta bancaria por <br> transferencia SIPAP`,
          color: '#1c304f',
          sectionColor:'#fff',

        }
      ]
      const initWozLink = [
        {
          title: 'Comenzar',
          steps: [
            {
              title: 'Verificación de cuenta',
              text: 'Deberás tener una cuenta verificada para la activación de la misma',
            },
            {
              title: 'Constitución nacional',
              text: 'Tienes que estar habilitado con una cuenta propia en tu sistema bancario',
            },
            {
              title: 'Documentación',
              text: 'Pediremos documentaciónes extras para su proceso de verificación',
            },
          ]
        },
        {
          title: 'Tiempo de verificación',
          steps: [
            {
              title: 'Verificación por sistema',
              text: 'Verificamos por sistema tus documentaciones en 24 horas hábiles',
            },
            {
              title: 'Verificación manual',
              text: 'Verificación manual en un maximo de 7 días',
            },
            {
              title: 'Operación',
              text: 'Podrás operar luego de la verificación por sistema en 24 horas',
            },
          ]
        },
        {
          title:'Precio',
          steps:[
            {
              title:'Documentación',
              text:'Validación de documentación tiene un costo de 30 USD'
            }
          ]
        }
      ]
      const addOns = [
        'Constitución y activación de la cuenta',
        'Identificación fiscal de la cuenta (EIN)',
        'Presentación de la documentación 83B',
      ]
      const activateWallet  = () =>{
        loading.value = true
        walletStore.activateLinkWallet({user: user.value.id})
        .then((data) => {
          if(data.code !==200) throw data
          setTimeout(() => {
            
            router.push('/pay_link_dashboard')
            loading.value = false;
          }, 2000);

        })  
        .catch((response) =>{
          console.log(response)
          loading.value = false;
        })
      }
      return{
        user,
        wozIcons,
        person,
        whatDo,
        withdrawal,
        initWozLink,
        addOns,
        teamship,
        showModal,
        loading,
        activateWallet,
      }
    },
  }

</script>

<style lang="scss" >
.activate__text{
  font-size: 1.6rem; font-weight: bold;
}
.userTeam__text{
  font-size: 1rem; color: #0ed90a; font-weight: bold; line-height: 1;
}
.userTeam__title{
  font-size: 2.7rem; color: #0ed90a; font-weight: 900; line-height: 1;
}
.howdoTitle{
  color: #1c304f; 
  font-size: 1.7rem; 
  font-weight: 900;
}
.include__table{
  background: #fef3df;
  border-radius: 15px;
  &--title{
    color: #4f5457; 
    font-size: 1.3rem; 
    font-weight: 600;
  }
  &--item{
    height: 28px; 
    width: 28px; 
    border-radius: 50%; 
    background: #f8a80d;
    font-size: 1rem;
  }
  &--text{
    color: #4f5457; 
    font-size: 0.9rem;
    font-weight: 400;
  }
}
.linksTimeline{
  & .q-timeline__dot{
    transform: translateY(35px);
    color: #f8a80d!important;
    & .q-icon {
      font-weight:bold;
      top: -10px;
    }
    &::before{
      height: 30px;
      width: 30px;
      top: -7px;
      left: 0px;
    }
    &::after{
      left: 13px;
      top: 20px;
    }
  }
  & .q-timeline__content{
    & h6{
      margin-bottom:  10px;
    }
    color: #1c304f; 
    font-size: 15px;
  }
}
.steps{
  &__title-section{
    width: max-content;
    &--title{
      color: #1c304f; font-size: 1.75rem; font-weight: 600; line-height: 1.2;
    }
  }
}
.links-progress {
    border: 1px solid #e5b301;
    width: auto!important;
    border-radius: 90px;
    & .q-linear-progress__track{
      opacity: 1;
    }
    & .q-linear-progress__model {
      border-top-right-radius: 90px;
      border-bottom-right-radius: 90px;
    }
  }
  @media screen and (max-width: 780px){
    .links-progress {
      width: auto!important;

    }
  }
.logo__container {
  border-top-right-radius: 50px; border-bottom-right-radius: 50px;width: 80%;
  padding: 1rem 0rem;
}
.card__logo-pay{
  height:17rem; overflow:hidden; 
}
</style>
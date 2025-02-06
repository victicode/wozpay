<template>
  <section>
    <div>
      <div class="w-100">
        <img :src="person" alt="" class=" mx-auto" height="">
      </div>
      <div class="q-px-md q-py-lg sectionLinkLan">
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

          <div v-for="(item,index) in whatDo" :key="index" style="" class="q-pa-md q-mb-md whatDoContainer">
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
      <div class="q-px-md q-py-lg sectionLinkLan">
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
          @click="clocks()"
        />
      </div>
      <q-dialog v-model="showModal" full-width full-height persistent class="modalPreActive ">
        <div style="height: 100%; background: red; width: 100%;" class="bg-white q-pt-md">
          <div class="q-py-md q-px-md container__preActive">
              <div class="q-py-sm q-px-sm">
                <div class="text-center text__priceActive" style="">
                  30 USD
                </div>
                <div class="text-center  text-grey-7 text__anual q-mb-xs"  style="">Precio anual</div>
                <div style="" class="separator_rombo"/>
              </div>
              <div>
                <div class="text-center q-py-sm">
                  <p class="text-subtitle1">
                    Cuenta corriente internacional
                  </p>
                  <q-icon :name="icons.ionGlobeOutline" size="md" color="iconPreactive" />

                </div>
                <div>
                  <div v-for="(item,index) in section1" :key="index" class="text-subtitle1 flex items-center q-py-sm">
                    <div style="height: 1.5rem; width: 1.5rem; border-radius: 50%;" class="bg-iconPreactive flex flex-center q-mr-sm">
                      <q-icon name="eva-checkmark-outline" color="white" size="1rem" />
                    </div>
                    {{ item }}
                  </div>
                </div>
                <div class="text-center q-my-sm text-bold text-subtitle1">
                  Cobros a clientes
                </div>
                <div>
                  <div v-for="(item,index) in section2" :key="index" class="text-subtitle1 flex items-center q-py-sm">
                    <div style="height: 1.5rem; width: 1.5rem; border-radius: 50%;" class="bg-iconPreactive flex flex-center q-mr-sm">
                      <q-icon name="eva-checkmark-outline" color="white" size="1rem" />
                    </div>
                    {{ item }}
                  </div>
                </div>
              </div>
          </div>
          <div class="q-mt-md q-px-md-xl q-mx-md-xl">
            <div class="q-px-md q-px-md-xl q-mx-md-xl">
              <div class="flex justify-between q-px-xs q-py-sm contentDetail">
                <div class="text-subtitle2 text-weight-medium" >Cotización USD - Woz Pay</div>
                <div class="text-subtitle2 text-weight-medium" >USD 1 = {{numberFormat(rate[count])}} Gs</div>
              </div>
              <div class="flex justify-between q-px-xs q-py-sm contentDetail">
                <div class="text-subtitle2 text-weight-medium" >Total Gs</div>
                <div class="text-subtitle2 text-weight-medium" >{{`${numberFormat(220000)}Gs`}}  </div>
              </div>
              <div class="flex justify-between q-px-xs q-py-sm contentDetail">
                <div class="text-subtitle2 text-weight-medium" >Tiempo restante</div>
                <div class="text-subtitle2 text-weight-medium text-terciary" id="timer-seconds"/>
              </div>
            </div>
            <div class="w-100 flex flex-center q-my-lg">
              <q-btn color="iconPreactive" @click="activateWallet()">
                <div class="q-py-sm q-px-xl">Completar el pago</div>
              </q-btn>
            </div>
          </div>
        </div>
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
  import util from '@/util/numberUtil'
  export default {
    setup() {
      //vue provider
      const numberFormat = util.numberFormat
      const icons = inject('ionIcons')
      const showModal = ref(false)
      const loading = ref(false)
      const { user  } = storeToRefs(useAuthStore())
      const router = useRouter()
      const time = ref(121)
      const count = ref(0)
      const timer = ref()
      const rate = [
        7333,
        7600,
        7900,
        8100,
        7500,
        7700,
      ]
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
      const section1 = [
        'Cobro internacional',
        '200 monedas disponibles',
        'Retiro en cuenta bancaria',
        'Todas las categorias y rubros'
      ]
      const section2 = [
        'Ventas',
        'Suscripciones - pagos mensuales',
        'Trabajos en el exterior',
      ]
      const requirements = ref({
        card: user.value.card ?? false,
        current: user.value.current_loan ?? false,
        loan:user.value.loans_complete_count ?? false,
      })
      const validateRequeriments = () => {
        let isOk = Object.values(requirements.value).filter((el) => !el)
        console.log(isOk)
        return !(isOk.length == 0)
      }
      const activateWallet  = () =>{
        if(validateRequeriments()){
          router.push('/generatePayLink/1')
          return
        }
        router.push('/form_pay_link/user/1?title=Cuenta internacional&subtitle=Activación&color=1c304f')
      }
      const clocks = () => {
        showModal.value=true
        timer.value = setInterval( () => {
          if(time.value <= 0) {
            if(count.value == 5){
              clearInterval(timer.value);

              setTimeout(() => {
                document.getElementById('timer-seconds').innerHTML = '0 seg'
              },1000)
              return
            }
            time.value = 121
            count.value++
          }
          time.value--
          document.getElementById('timer-seconds').innerHTML = time.value +' seg'
          
        }, 1000)

      }
      return{
        user,
        router,
        rate,
        count,
        wozIcons,
        person,
        whatDo,
        withdrawal,
        initWozLink,
        addOns,
        teamship,
        showModal,
        loading,
        section1,
        section2,
        numberFormat,
        icons,
        activateWallet,
        clocks,
      }
    },
  }

</script>

<style lang="scss" >
.contentDetail{
  border-bottom: 1px dashed rgb(202, 202, 202)
}
.text-iconPreactive{
  color:#19cd15!important;
}
.bg-iconPreactive{
  background: #19cd15!important;
}
.separator_rombo{
  width: 85%; 
  border-bottom: 4px solid #19cd15;
  margin: auto;
  position: relative;
  &::after{
    content: '';
    width: 12px;
    height: 12px;
    transform: rotate(45deg);
    background: #19cd15;
    position: absolute;
    right: -0.3rem;
    top: -0.2822rem;
  }
  &::before{
    content: '';
    width: 12px;
    height: 12px;
    transform: rotate(45deg);
    background: #19cd15;
    position: absolute;
    left: -0.3rem;
    top: -0.2822rem;
  }
}
.text__priceActive{
  color: #19cd15; font-weight: bold; font-size: 3.4rem; line-height: 1;
}
.text__anual{
  font-weight: 300; font-size: 0.8rem; text-align: end; margin-right: 4rem;
}
.container__preActive{
  border: 2px solid #1c304f;
  width: 50%;
  margin: auto;
  border-radius: 2rem;
  box-shadow: 0px 5px 10px 0px #9f9f9fc4;
}
.modalPreActive{
  & .q-dialog__inner--minimized {
    padding: 0px!important;
  }
}
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
.whatDoContainer{
  border-radius: 20px; background: #e1e9fe;
}
.sectionLinkLan {
  width: 100%; border-top: 4px solid #f9a826; background: #1c304f;
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
    .container__preActive{
      width: 90%;
    }
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
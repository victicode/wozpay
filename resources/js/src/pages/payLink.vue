<template>
  <div class="layout-dasboard__content-way" style="">
    
    <div id="content-page" style="position: relative; background: #19cd15; overflow: visible;">
      <div style="position: absolute; transform: translateX(5rem) translateY(18rem);z-index: 1;">
        <div class="way__container">
          <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="511" height="2928" style="overflow: visible">
            <path 
              class="dotWay"
              style=" 
                  stroke-width: 10px;
                  stroke: #0055a9;
                  stroke-dasharray: 36rem;
                  transition: all 1s ease-out;
                  stroke-dashoffset: 13rem;"
              stroke-linecap="round"   fill="#E5E6EB" d="M0 0 C7.57558867 4.09921911 13.88187561 10.0807941 17.078125 18.1640625 C19.35875226 26.26222201 19.37073891 35.92902146 15.3203125 43.44921875 C10.06640514 51.361168 4.08128247 56.41040584 -5 59.4375 C-5.33 105.6375 -5.66 151.8375 -6 199.4375 C71.88 199.4375 149.76 199.4375 230 199.4375 C230 495.7775 230 792.1175 230 1097.4375 C305.9 1097.1075 381.8 1096.7775 460 1096.4375 C460 1176.9575 460 1257.4775 460 1340.4375 C386.08 1340.4375 312.16 1340.4375 236 1340.4375 C236 1630.8375 236 1921.2375 236 2220.4375 C162.08 2220.4375 88.16 2220.4375 12 2220.4375 C12 2291.3875 12 2362.3375 12 2435.4375 C87.24 2435.4375 162.48 2435.4375 240 2435.4375 C239.67 2595.1575 239.34 2754.8775 239 2919.4375 C234.71 2919.4375 230.42 2919.4375 226 2919.4375 C226 2764.0075 226 2608.5775 226 2448.4375 C151.09 2448.4375 76.18 2448.4375 -1 2448.4375 C-1 2368.9075 -1 2289.3775 -1 2207.4375 C72.92 2207.4375 146.84 2207.4375 223 2207.4375 C223 1917.0375 223 1626.6375 223 1327.4375 C296.92 1327.4375 370.84 1327.4375 447 1327.4375 C447 1255.8275 447 1184.2175 447 1110.4375 C371.1 1110.4375 295.2 1110.4375 217 1110.4375 C217 814.0975 217 517.7575 217 212.4375 C139.12 212.4375 61.24 212.4375 -19 212.4375 C-19 161.9475 -19 111.4575 -19 59.4375 C-21.97 58.4475 -24.94 57.4575 -28 56.4375 C-34.84025243 52.74376369 -41.17154019 46.4598479 -43.5625 38.8984375 C-45.1895069 29.7465237 -45.25858496 20.35649332 -40 12.4375 C-31.14768131 -0.15297399 -14.69344358 -6.03204526 0 0 Z "  transform="translate(44,1.5625)"/>
          </svg>
        </div>
      </div>
      <div class="hero-content q-px-md q-pt-lg q-px-md-xl" style="height: max-content; position:relative; z-index: 1;" >
        <div class="q-px-sm q-px-md-lg">
          <div class="text-h4 text-white text-weight-bold text-linkPay" style="font-size: 2rem;">
            Link de pago: cobra en
            línea sin un sitio web
          </div>
          <div class="text-subtitle1 text-white q-mt-md text-linkPay text-weight-medium ">
            Genera un Link de Pago desde Woz Pay y
            envíalo por facebook, SMS, whatsapp, email
            o cualquier otra red social sin necesidad de
            un sitio web.
          </div>
        </div>
        <div  class="q-mt-sm">
          <div v-for="(info, key) in infoData" 
            :key="key"
            :name="key" 
            class="text-center flex q-mt-xl q-pt-xl"
            style="width:100%"
          >
            <img :src="info.img" alt="" style="" class="slider__payLink-img ">
          </div>
        </div>
      </div> 
      <div class="hero-content q-pt-lg " style=" background: #19cd15; position:relative; z-index: 1;" >
        <div class="w-100 q-pt-md-xl q-pt-none q-pb-md q-px-md q-px-md-xl" >
          <div class="q-px-sm q-px-md-lg">
            <div class="text-h4 text-white text-weight-bold" style="font-size: 1.8rem;">
              ¿Cómo accedo a los links?
            </div>
            <div class="text-subtitle1 text-white q-mt-md">
              Puedes generar links para lo que quieras
              cobrar, ya sea Membresías o Suscripciones
              de pago recurrente.
            </div>
            <div class="text-subtitle1 text-white q-mt-md">
              Asi también puedes cobrar por tu ventas y
              por tu trabajo como freelance
            </div>
          </div>
        </div> 
        <div class="w-100 q-mt-md q-pb-xl q-pt-xs offerWall">
          <div class="q-pa-md">

            <!-- woz pay free -->
            <div>
              <q-chip square color="terciary" text-color="white" class="tagSetction">
                <div class="text-caption">
                  Cortesia Woz Pay
                </div>
              </q-chip>
              <div class="flex justify-between q-px-md q-py-sm items-center freeLink wallLink q-mt-sm" style="">
                <div>
                  <div class="q-mt-xs">Links de cortesía Woz Pay</div>
                  <div class="q-mt-xs text-terciary">6 links en todas las categorías</div>
                </div>
                <div>
                  <q-btn flat round color="black" size="md" icon="eva-chevron-right-outline"  @click="goTo(0,0)"/>
                </div>
              </div>
            </div>

            <!-- ilimit link -->
            <div class="q-mt-md">
              <q-chip square color="positive" text-color="white" class="tagSetction">
                <div class="text-caption">
                  Links ilimitados
                </div>
              </q-chip>
              <div class="q-px-md q-pb-md q-pt-sm ilimitLink wallLink q-mt-sm" style="">
                <div class="flex justify-between items-center q-py-sm border-bottom-1">
                  <div>
                    <div class="q-mt-xs">Links ilimitados</div>
                    <div class="q-mt-xs text-grey-6">Todas las categorias</div>
                    <div class="q-mt-none flex items-center">
                      <div>
                        <q-icon v-for="n in 5" :name="icons.sharpStar" :key="n" color="terciary" size="1rem"/>
                      </div>
                      <div class="flex flex-center">
                        <div v-html="wozIcons.profile" class="profile-user__icon" />
                        <div class="text-caption text-grey-6">5.648</div>
                      </div>
                    </div>
                  </div>
                  <div class="flex">
                    <div class="text-right">
                      <div class="text-body-2 text-weight-medium ">USD 25.99</div>
                      <div class="text-grey-7" style="font-size: 0.7rem;">3% por transacción</div>
                    </div>
                    <q-btn flat round color="black" size="md" icon="eva-chevron-right-outline"  @click="goTo(1,1)"/>
                  </div>
                </div>
                <div class="flex justify-between items-center q-py-sm border-bottom-1">
                  <div>
                    <div class="q-mt-xs">Links ilimitados</div>
                    <div class="q-mt-xs text-grey-6">Freelances, membresías</div>
                    <div class="q-mt-none flex items-center">
                      <div>
                        <q-icon v-for="n in 5" :name="icons.sharpStar" :key="n" color="terciary" size="1rem"/>
                      </div>
                      <div class="flex flex-center">
                        <div v-html="wozIcons.profile" class="profile-user__icon" />
                        <div class="text-caption text-grey-6">5.648</div>
                      </div>
                    </div>
                  </div>
                  <div class="flex">
                    <div class="text-right">
                      <div class="text-body-2 text-weight-medium ">USD 12.99</div>
                      <div class="text-grey-7" style="font-size: 0.7rem;">6% por transacción</div>
                    </div>
                    <q-btn flat round color="black" size="md" icon="eva-chevron-right-outline"  @click="goTo(1,2)"/>
                  </div>
                </div>
                <div class="flex justify-between items-center q-py-sm border-bottom-1">
                  <div>
                    <div class="q-mt-xs">Links ilimitados</div>
                    <div class="q-mt-xs text-grey-6">Ventas</div>
                    <div class="q-mt-none flex items-center">
                      <div>
                        <q-icon v-for="n in 5" :name="icons.sharpStar" :key="n" color="terciary" size="1rem"/>
                      </div>
                      <div class="flex flex-center">
                        <div v-html="wozIcons.profile" class="profile-user__icon" />
                        <div class="text-caption text-grey-6">5.648</div>
                      </div>
                    </div>
                  </div>
                  <div class="flex">
                    <div class="text-right">
                      <div class="text-body-2 text-weight-medium ">USD 9.99</div>
                      <div class="text-grey-7" style="font-size: 0.7rem;">8.5% por transacción</div>
                    </div>
                    <q-btn flat round color="black" size="md" icon="eva-chevron-right-outline"  @click="goTo(1,3)"/>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- offer woz pay -->
            <div class="q-mt-md">
              <q-chip square color="primary" text-color="white" class="tagSetction">
                <div class="text-caption">
                  Ofertas Woz Pay
                </div>
              </q-chip>
              <div class="q-px-md q-pb-md q-pt-sm offerLink wallLink q-mt-sm" style="">
                <div class="flex justify-between items-center q-py-sm border-bottom-1">
                  <div>
                    <div class="q-mt-xs">15 Links para Freelancers</div>
                    <div class="q-mt-xs text-grey-6 flex items-center">
                      <div style="text-decoration: line-through;">Gs. 15.000</div>
                      <div>Gs. 8.000</div>
                    </div>
                    <div class="q-mt-none flex items-center">
                      <div>
                        <q-icon v-for="n in 5" :name="icons.sharpStar" :key="n" color="terciary" size="1rem"/>
                      </div>
                      <div class="flex flex-center">
                        <div v-html="wozIcons.profile" class="profile-user__icon" />
                        <div class="text-caption text-grey-6">5.648</div>
                      </div>
                    </div>
                  </div>
                  <div class="flex">
                    <div class="text-right">
                      <div class="text-body-2 text-weight-medium ">Gs. 120.000</div>
                      <div class="text-grey-7" style="font-size: 0.7rem;">9% + USD 1</div>
                    </div>
                    <q-btn flat round color="black" size="md" icon="eva-chevron-right-outline"  @click="goTo(3,4)"/>
                  </div>
                </div>
                <div class="flex justify-between items-center q-py-sm border-bottom-1">
                  <div>
                    <div class="q-mt-xs">15 Links para membresías</div>
                    <div class="q-mt-xs text-grey-6 flex items-center">
                      <div style="text-decoration: line-through;">Gs. 12.000</div>
                      <div>Gs. 6.667</div>
                    </div>
                    <div class="q-mt-none flex items-center">
                      <div>
                        <q-icon v-for="n in 5" :name="icons.sharpStar" :key="n" color="terciary" size="1rem"/>
                      </div>
                      <div class="flex flex-center">
                        <div v-html="wozIcons.profile" class="profile-user__icon" />
                        <div class="text-caption text-grey-6">97.268</div>
                      </div>
                    </div>
                  </div>
                  <div class="flex">
                    <div class="text-right">
                      <div class="text-body-2 text-weight-medium ">Gs. 100.000</div>
                      <div class="text-grey-7" style="font-size: 0.7rem;">10% + USD 1</div>
                    </div>
                    <q-btn flat round color="black" size="md" icon="eva-chevron-right-outline"  @click="goTo(2,5)"/>
                  </div>
                </div>
                <div class="flex justify-between items-center q-py-sm border-bottom-1">
                  <div>
                    <div class="q-mt-xs">15 Links para ventas</div>
                    <div class="q-mt-xs text-grey-6 flex items-center">
                      <div style="text-decoration: line-through;">Gs. 10.000</div>
                      <div>Gs. 6.600</div>
                    </div>
                    <div class="q-mt-none flex items-center">
                      <div>
                        <q-icon v-for="n in 5" :name="icons.sharpStar" :key="n" color="terciary" size="1rem"/>
                      </div>
                      <div class="flex flex-center">
                        <div v-html="wozIcons.profile" class="profile-user__icon" />
                        <div class="text-caption text-grey-6">33.502</div>
                      </div>
                    </div>
                  </div>
                  <div class="flex">
                    <div class="text-right">
                      <div class="text-body-2 text-weight-medium ">Gs. 99.000</div>
                      <div class="text-grey-7" style="font-size: 0.7rem;">12% + USD 1</div>
                    </div>
                    <q-btn flat round color="black" size="md" icon="eva-chevron-right-outline"  @click="goTo(2,6)"/>
                  </div>
                </div>
              </div>
            </div>

            <!-- basic woz pay -->
            <div class="q-mt-md">
              <q-chip square color="primary" text-color="white" class="tagSetction">
                <div class="text-caption">
                  Tarifas básicas
                </div>
              </q-chip>
              <div class="q-px-md q-pb-md q-pt-sm offerLink wallLink q-mt-sm" style="">
                <div class="flex justify-between items-center q-py-sm border-bottom-1">
                  <div>
                    <div class="q-mt-xs">Links para FreeLancers</div>
                    <div class="q-mt-xs text-grey-6 flex items-center">
                      Compra mínima 5
                    </div>
                  </div>
                  <div class="flex">
                    <div class="text-right">
                      <div class="text-body-2 text-weight-medium ">Gs. 15.000</div>
                      <div class="text-grey-7" style="font-size: 0.7rem;">12% + USD 1</div>
                    </div>
                    <q-btn flat round color="black" size="md" icon="eva-chevron-right-outline"  @click="goTo(3,7)"/>
                  </div>
                </div>
                <div class="flex justify-between items-center q-py-sm border-bottom-1">
                  <div>
                    <div class="q-mt-xs">Links para membresías</div>
                    <div class="q-mt-xs text-grey-6 flex items-center">
                      Compra mínima 6
                    </div>
                  </div>
                  <div class="flex">
                    <div class="text-right">
                      <div class="text-body-2 text-weight-medium ">Gs. 12.000</div>
                      <div class="text-grey-7" style="font-size: 0.7rem;">12% + USD 1</div>
                    </div>
                    <q-btn flat round color="black" size="md" icon="eva-chevron-right-outline"  @click="goTo(2,8)"/>
                  </div>
                </div>
                <div class="flex justify-between items-center q-py-sm border-bottom-1">
                  <div>
                    <div class="q-mt-xs">Links para ventas</div>
                    <div class="q-mt-xs text-grey-6 flex items-center">
                      Compra minima 7
                    </div>
                  </div>
                  <div class="flex">
                    <div class="text-right">
                      <div class="text-body-2 text-weight-medium ">Gs. 10.000</div>
                      <div class="text-grey-7" style="font-size: 0.7rem;">12% + USD 1</div>
                    </div>
                    <q-btn flat round color="black" size="md" icon="eva-chevron-right-outline"  @click="goTo(3,9)"/>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="navbar-buttom" style="background: white;">
      <navbarVue />
    </div>
  </div>
</template>
<script>
  import imagen6 from '@/assets/images/paylink1.png'
  import imagen7 from '@/assets/images/paylink2.png'
  import imagen8 from '@/assets/images/paylink3.png'
  import click_img from '@/assets/images/click.webp'
  import { useRouter } from 'vue-router';
  import navbarVue from "@/components/layouts/navbar.vue";
  import { inject, onMounted } from 'vue';
  import { useQuasar } from 'quasar';
  import wozIcons from '@/assets/icons/wozIcons';
  import gsap from '@/plugins/gsap/gsap';

export default {
  components:{
    navbarVue
  },
  setup() {
    const router = useRouter()
    const infoData = [
      {
        img: imagen6,
      },
      {
        img: imagen7,
      },
      {
        img: imagen8,
      },
      
    ]

    const goTo = (type, id) => {
      router.push('/generatePayLink/'+type+'/'+id)
    }
    onMounted(() => {
      useQuasar().addressbarColor.set('#19cd15')
      setTimeout(() => {
          
          let Ro = gsap.to('.dotWay',{
            scrollTrigger: {
              trigger: '.dotWay',
              start:'-100px 100px',
              end:'bottom bottom',

              markers: true,
              toggleActions:"restart pause reverse reverse"
            },
            opacity: 1,
            strokeDashoffset:'-1000px'
          })
          function onScroll() {
            var scrollY = window.scrollY || 0;
    
            Ro.tweenTo(scrollY/1000);
          }
          document.addEventListener("scroll", onScroll);
        }, 1000);
    })

    return {
      router,
      slide: ref(0),
      infoData,
      icons: inject('ionIcons'),
      wozIcons,
      goTo,
    }
  },
}
</script>
<style>
.profile-user__icon{
  transform: scale(0.6);
}
.tagSetction{
  border-radius: 8px;
}
</style>
<style lang="scss" scoped>
.border-bottom-1{
  border-bottom: 1px solid rgb(204, 204, 204);
}
.wallLink{
  background: white; 
  border-radius: 20px;
  box-shadow: 0px 2px 10px 0px #4141414f;
  &.freeLink{
    border: 1px solid #f9a826;
  }
  &.ilimitLink{
    border: 1px solid $positive;
  }
  &.offerLink{
    border: 1px solid $primary;
  }
}
.offerWall {
  background: white;
  border-top-left-radius: 15px; 
  border-top-right-radius: 15px;  
  box-shadow: 0px -5px 10px 0px #4141414f
}
.slider__payLink-img{
  height: 510px;
  margin: auto
}
.slider__payLink--container{
  height: 440px;
}
#content-page{
  height: 91%;
  overflow-y: scroll;
}
#navbar-buttom{
  height: 9%;
  width: 100%;
  z-index: 10;
  background: #f1f0f0;
  position: relative;
}
.layout-dasboard__content-way{

}
.payLink{
  height: 0.8rem; 
  width: 0.8rem; 
  background: white; 
  border-radius: 50%;
  transition: all ease-in 0.5s;

  &.active{
    width: 1.6rem;
    border-radius:30px;
    background: #f9a90d;
  }
}
.slide-down{
  animation: slideDown 1s alternate infinite;
}
@media screen and (max-width: 780px){
  .slider__payLink-img{
    height: 450px;
  }
  .slider__payLink--container{
    height: 500px;
  }
  .payLink{
    height: 0.8rem; 
    width: 0.8rem; 
    background: white; 
    border-radius: 50%;
    transition: all ease-in 0.5s;
    &.active{
      width: 1.6rem;
      border-radius:30px;
      background: #f9a90d;
    }
  }
  #content-page{
  height: 92%;
  // overflow: hidden;
  }
  #navbar-buttom{
    height: 5%;
  }
}
@keyframes slideDown {
  0% {
    transform: translateY(0);
  }
  100% {
    transform: translateY(10%);
  }
}
</style>
<template>
  <div class="layout-dasboard__content-way" style="">
    
    <div id="content-page" style="position: relative; background: #19cd15; overflow: visible;">
      <backgroundWay />
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
                        <div class="text-caption text-grey-6">{{numberFormat(random(100,99999))}}</div>
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
                        <div class="text-caption text-grey-6">{{numberFormat(random(100,99999))}}</div>
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
                        <div class="text-caption text-grey-6">{{numberFormat(random(100,99999))}}</div>
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
                    <div class="q-mt-xs  flex items-center">
                      <div class="text-grey-6" style="text-decoration: line-through;">Gs. 15.000</div>
                      <div class="text-grey-8 q-ml-md-md">Gs. 8.000</div>
                    </div>
                    <div class="q-mt-none flex items-center">
                      <div>
                        <q-icon v-for="n in 5" :name="icons.sharpStar" :key="n" color="terciary" size="1rem"/>
                      </div>
                      <div class="flex flex-center">
                        <div v-html="wozIcons.profile" class="profile-user__icon" />
                        <div class="text-caption text-grey-6">{{numberFormat(random(100,99999))}}</div>
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
                    <div class="q-mt-xs  flex items-center">
                      <div class="text-grey-6" style="text-decoration: line-through;">Gs. 12.000</div>
                      <div class="text-grey-8 q-ml-md-md">Gs. 6.667</div>
                    </div>
                    <div class="q-mt-none flex items-center">
                      <div>
                        <q-icon v-for="n in 5" :name="icons.sharpStar" :key="n" color="terciary" size="1rem"/>
                      </div>
                      <div class="flex flex-center">
                        <div v-html="wozIcons.profile" class="profile-user__icon" />
                        <div class="text-caption text-grey-6">{{numberFormat(random(100,99999))}}</div>
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
                    <div class="q-mt-xs  flex items-center">
                      <div class="text-grey-6" style="text-decoration: line-through;">Gs. 10.000</div>
                      <div class="text-grey-8 q-ml-md-md">Gs. 6.600</div>
                    </div>
                    <div class="q-mt-none flex items-center">
                      <div>
                        <q-icon v-for="n in 5" :name="icons.sharpStar" :key="n" color="terciary" size="1rem"/>
                      </div>
                      <div class="flex flex-center">
                        <div v-html="wozIcons.profile" class="profile-user__icon" />
                        <div class="text-caption text-grey-6">{{numberFormat(random(100,99999))}}</div>
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
  import imagen6 from '@/assets/images/phone1.webp'
  import imagen7 from '@/assets/images/phone2.webp'
  import imagen8 from '@/assets/images/phone3.webp'
  
  import { useRouter } from 'vue-router';
  import navbarVue from "@/components/layouts/navbar.vue";
  import { inject, onMounted } from 'vue';
  import { useQuasar } from 'quasar';
  import wozIcons from '@/assets/icons/wozIcons';
  import backgroundWay from '@/components/payLink/backgroundWay.vue';
  import util from '@/util/numberUtil'

export default {
  components:{
    navbarVue,
    backgroundWay,
  },
  setup() {
    const router = useRouter()
    const numberFormat = util.numberFormat

    const infoData = [
      {
        img: imagen6,
      },
      {
        img: imagen8,
      },
      {
        img: imagen7,
      },
      
    ]
    const goTo = (type, id) => {
      router.push('/generatePayLink/'+type+'/'+id)
    }
    const random = (min, max) => {
      return Math.floor((Math.random() * (max - min + 1)) + min);
    }
    onMounted(() => {
      useQuasar().addressbarColor.set('#19cd15')
      setTimeout(() => {
        function onScroll() {
          let timeTransition = window.screen.width < 780 ? 150 : 200
          let scrollY = window.scrollY || 0;
          let strok = scrollY > 520  && scrollY < 1001 ? '#039900' : scrollY > 1000 ? '#ffc000' : '#0449fb'
          document.querySelector('.wayTransition').setAttribute('y2', scrollY/timeTransition )
          document.querySelector('.backgorundWay').setAttribute('stop-color', strok )
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
      numberFormat,
      goTo,
      random,
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
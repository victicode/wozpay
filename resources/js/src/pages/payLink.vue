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
        <div class="w-100 q-mt-md q-pb-xl q-pt-xs offerWall" :class="{'q-mb-xl q-pt-md': user.wallet_link.status!=2}">
          <div class="q-pa-md" v-if="user.wallet_link.status==2">
            <template v-if="loading">
      
              <!-- woz pay free -->
              <div >
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
                    <q-btn flat round color="black" size="md" icon="eva-chevron-right-outline"  @click="goTo2(0)"/>
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
                  <div class="flex justify-between items-center q-py-sm border-bottom-1" v-for="(item, key) in packages.noLimit" :key="key">
                    <div>
                      <div class="q-mt-xs">{{ item.title }}</div>
                      <div class="q-mt-xs text-grey-6">{{ item.note }}</div>
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
                    <div class="flex items-center">
                      <div class="text-right" v-if="!item.isBuy">
                        <div class="text-body-2 text-weight-medium ">USD {{numberFormatDecimal(item.amount)}}</div>
                        <div class="text-grey-7" style="font-size: 0.7rem;">{{ item.comision }}% por transacción</div>
                      </div>
                      <div v-else class="text-bold text-subtitle1 text-primary">
                        Comprado
                      </div>
                      <q-btn flat round color="black" size="md" icon="eva-chevron-right-outline"  @click="!item.isBuy ? goTo(item) : goTo2(item.categorie)" />
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
                  <div class="flex justify-between items-center q-py-sm border-bottom-1" v-for="(item, key) in packages.offer" :key="key">
                    <div>
                      <div class="q-mt-xs">{{ item.title }}</div>
                      <div class="q-mt-xs  flex items-center">
                        <div class="text-grey-6" style="text-decoration: line-through;"> {{item.note.split(',')[0]}} </div>
                        <div class="text-grey-8 q-ml-md-md">{{item.note.split(',')[1]}}</div>
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
                    <div class="flex items-center">
                      <div class="text-right" v-if="!item.isBuy">
                        <div class="text-body-2 text-weight-medium ">Gs {{numberFormatDecimal(item.amount)}}</div>
                        <div class="text-grey-7" style="font-size: 0.7rem;">{{ item.comision }}% por transacción</div>
                      </div>
                      <div v-else class="text-bold text-subtitle1 text-primary">
                        Comprado
                      </div>
                      <q-btn flat round color="black" size="md" icon="eva-chevron-right-outline"   @click="!item.isBuy ? goTo(item) : goTo2(item.categorie)"/>
                    </div>
                  </div>
                </div>
              </div>
  
              <!-- basic woz pay -->
              <div class="q-mt-md q-pb-xl">
                <q-chip square color="primary" text-color="white" class="tagSetction">
                  <div class="text-caption">
                    Tarifas básicas
                  </div>
                </q-chip>
                <div class="q-px-md q-pb-md q-pt-sm offerLink wallLink q-mt-sm" style="">
                  <div class="flex justify-between items-center q-py-sm border-bottom-1" v-for="(item, key) in packages.basic" :key="key">
                    <div>
                      <div class="q-mt-xs">{{item.title}}</div>
                      <div class="q-mt-xs text-grey-6 flex items-center">
                        {{ item.note }}
                      </div>
                    </div>
                    <div class="flex flex items-center">
                      <div class="text-right" v-if="!item.isBuy">
                        <div class="text-body-2 text-weight-medium ">Gs {{numberFormatDecimal(item.amount)}}</div>
                        <div class="text-grey-7" style="font-size: 0.7rem;">{{ item.comision }}% por transacción</div>
                      </div>
                      <div v-else class="text-bold text-subtitle1 text-primary">
                        Comprado
                      </div>
                      <q-btn flat round color="black" size="md" icon="eva-chevron-right-outline"  @click="!item.isBuy ? goTo(item) : goTo2(item.categorie)"/>
                    </div>
                  </div>
                </div>
              </div>
            </template>
          </div>
          <div v-else class="q-px-xl text-center text-subtitle2 q-mb-md"> 
            La activación de tu cuenta de cobros internacional esta siendo verifcada, pronto podras crear tus links de cobro
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
  import { useAuthStore } from '@/services/store/auth.store';
  import { storeToRefs } from 'pinia';
  import { usePackageStore } from '@/services/store/package.store';

export default {
  components:{
    navbarVue,
    backgroundWay,
  },
  setup() {
    const router = useRouter()
    const numberFormat = util.numberFormat
    const numberFormatDecimal = util.numberFormatDecimal
    const { user } = storeToRefs(useAuthStore())
    const packages = ref({})
    const packageStore = usePackageStore()
    const loading = ref(false)
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
    const titles = [
      '',
      'Links',
      'Links',
      'Links ilimitado',
    ]
    const subtitles = [
      '',
      'Tarifas básicas',
      'Oferta Woz Pay',
      'Ilimitado',
    ]
    const colors = [
      '',
      '0449fa',
      '0449fa',
      '19cd15',
    ]
    const goTo = (item) => {
      router.push('/form_pay_link/user/2?color='+colors[item.type]+'&title='+titles[item.type]+'&subtitle='+subtitles[item.type]+'&id='+item.id+'&type='+item.type+'&description='+`${item.title}`+'&amount='+finalPrice(item))
    }
    const goTo2 = (type) => {
      router.push('/generatePayLink/'+type)
      return
    }
    const random = (min, max) => {
      return Math.floor((Math.random() * (max - min + 1)) + min);
    }
    const finalPrice = (item) => {
      return item.type == 1 
      ? item.amount*5
      : item.type == 3 
      ? item.amount * 7333 
      : item.amount
    }
    const getPackages = () => {
      packageStore.getPackages()
      .then((response) => {
        packages.value = splitPackages(response.data)
        loading.value = true
      })
      .catch((response) => {

      })
    }
    const splitPackages = (packages) => {
      return {
        noLimit: packages.filter(item => item.type == 3),
        offer: packages.filter(item => item.type == 2),
        basic: packages.filter(item => item.type == 1),
      }
    }
    onMounted(() => {
      useQuasar().addressbarColor.set('#19cd15')
      getPackages()
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
      user,
      router,
      infoData,
      loading,
      icons: inject('ionIcons'),
      wozIcons,
      numberFormat,
      numberFormatDecimal,
      packages,
      goTo,
      goTo2,
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
  &.invLink{
    border: 1px solid #8d8d8d;
  }
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
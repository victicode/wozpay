<template>
  <div class="layout-dasboard__content" style="">
    <div id="content-page">
      <div id="hero-content" class="q-px-md q-pt-lg" style="height: 100%; background: #19cd15;" >
        <div class="q-px-sm">
          <div class="text-h4 text-white text-weight-medium" style="font-size: 2rem;">
            Link de pago: cobra en
            línea sin un sitio web
          </div>
          <div class="text-subtitle1 text-white q-mt-md">
            Genera un Link de Pago desde Woz Pay y
            envíalo por facebook, SMS, whatsapp, email
            o cualquier otra red social sin necesidad de
            un sitio web.
          </div>
        </div>
        <q-carousel
          v-model="slide"
          animated
          navigation-position="bottom"
          navigation
          transition-prev="slide-right"
          transition-next="slide-left"
          padding
          height="500px"
          infinite
          :autoplay="2500"
          class=" rounded-borders w-100"
          style="background: transparent;"
        >
          <q-carousel-slide 
            v-for="(info, key) in infoData"
            :key="key"
            :name="key" 
            class=" column no-wrap flex-center w-100 q-px-sm" 
          >
           <div>
            <img :src="info.img" alt="" style="height: 450px;">
           </div>
          </q-carousel-slide>
          <template v-slot:navigation-icon="{ active, onClick }">
            <div  class="cursor-pointer q-mx-xs payLink" :class="{active}" @click="onClick">
            </div>
          </template>
        </q-carousel>
      </div> 
      <div id="hero-content" style="height: 100%; background: mediumaquamarine;" >
  
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

export default {
  components:{
    navbarVue
  },
  setup() {
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
    return {
      router: useRouter(),
      slide: ref(0),
      infoData,
    }
  },
}
</script>
<style lang="scss" scoped>

#content-page{
  height: 91%;
  overflow: scroll;

}
#navbar-buttom{
  height: 9%;
  width: 100%;
  z-index: 10;
  background: #f1f0f0;
}
.layout-dasboard__content{
  height: 100vh;
  max-height: 100vh;
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
@media screen and (max-width: 780px){


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
</style>
<template>
  <section class="q-pt-md q-px-md-lg q-pt-md-lg q-mt-md-sm q-px-sm">
    <div>
      <div class=" text-transfer1 q-px-md  q-px-md-xl ">
        Transferencias nacionales e internacionales
      </div>
      <div class="text-transfer1 q-px-md  q-px-md-xl hidde-xs" style="margin-top: -1rem;">
        a un solo click de distancia
      </div>
      <div class="text-transfer2 q-mt-sm q-px-md-xl " >
        Envia dinero a cualquier cuenta Woz Pay desde cualquier parte del mundo, sin complicaciones.
      </div>
    </div>
    <div class="q-mt-md">
      <div class="hidde-xs-flex justify-around">
        <div 
          v-for="(info, key) in infoData"
          :key="key"
          class="no-wrap  flex q-px-sm" 
        >
          <div class="number__top flex flex-center text-primary q-mt-lg">
            
            {{ key+1 }}
          </div>
          <div>
            <img :src="info" alt="" style="transform: scale(0.9); height: 680px;">
          </div>
        </div>
      </div>
      <div class="show-xs">
        <q-carousel
          v-model="slide"
          animated
          navigation-position="bottom"
          navigation
          transition-prev="slide-right"
          transition-next="slide-left"
          padding
          height="640px"
          infinite
          autoplay="2500"
          class=" rounded-borders w-100"
        >
          <q-carousel-slide 
            v-for="(info, key) in infoData"
            :key="key"
            :name="key" 
            class=" column no-wrap flex-center w-100 q-px-sm" 
          >
           <div>
            <img :src="info" alt="" style="transform: scale(0.9);">
           </div>
          </q-carousel-slide>
          <template v-slot:navigation-icon="{ active, onClick }">
            <div  class="cursor-pointer q-mx-xs socialLink__controls" :class="{active}" @click="onClick">
            </div>
          </template>
        </q-carousel>
      </div>
    </div>
  </section>
</template>
<script>
  import imagen6 from '@/assets/images/IMAGEN_6.svg'
  import imagen7 from '@/assets/images/IMAGEN_7.svg'
  import imagen8 from '@/assets/images/IMAGEN_8.svg'
  
export default {
  setup() {
    const infoData = [
      imagen6,
      imagen7,
      imagen8,
    ]
    return {
      slide: ref(0),
      infoData,
    }
  },
}
</script>
<style lang="scss">
.number__top{
  height: 4rem;
  width: 4rem;
  border-radius: 50%;
  border: 8px solid $primary;
  font-size: 2.5rem;
  font-weight: bold;
}
.text-transfer1 {
  font-size: 3rem;
  font-weight: bold!important;
}
.text-transfer2 {
  font-size: 1.5rem;
  font-weight: 600;
  width: 40%;
}

.socialLink__controls{
  height: 0.8rem; 
  width: 0.8rem; 
  background: #fcd486; 
  border-radius: 50%;
  transition: all ease-in 0.5s;
  &.active{
    width: 1.6rem;
    border-radius:30px;
    background: #f9a90d;
  }
}
@media screen and (max-width: 780px){
  .text-transfer1 {
    font-size: 1.7rem;
    font-weight: bold!important;
    text-align: center;
  }
  .text-transfer2 {
    font-size: 0.94rem;
    font-weight: 600;
    text-align: center;
    width: 100%;
  }

  .socialLink__controls{
    height: 0.8rem; 
    width: 0.8rem; 
    background: #fcd486; 
    border-radius: 50%;
    transition: all ease-in 0.5s;
    &.active{
      width: 1.6rem;
      border-radius:30px;
      background: #f9a90d;
    }
  }
}
</style>
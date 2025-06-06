
<template>
  <div class="" style="height: 100%;">
    <div style="height: 58%;" class="flex justify-end column items-center">
      <q-spinner-puff color="deep-orange" size="08rem" :thickness="20" />
      <div class="q-pt-xl q-mt-xl">
        <img :src="img" alt="" style="height: 9rem;">
      </div>
    </div>
    <div style="height: 42%;" class="info__section q-mt-md q-px-md">
      <div class="text-white text-center text--title__ia q-pt-md">
        Estamos analizando la rentabilidad de este producto con Wozpy AI
      </div>
      <div>
        <div class="text--title__iaWait text-center q-mt-sm">Analizando...</div>
        <div class="analizit__container q-px-md q-py-sm">
          <div v-for="(item, key) in items" :key="key" class="analizit__item q-my-xs  " >
            <Transition name="itemFade">
              <div class="flex items-center" v-show="item.load">

                <div v-html="wozIcons.checkListItem"  />
                <div class="analizit__item--title q-mx-sm">{{  item.title }}</div>
              </div>
            </Transition>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import img from'@/assets/images/ia.jpg'
  import wozIcons from '@/assets/icons/wozIcons';
import { onMounted } from 'vue';
  
  export default{
    setup() {
      const items = ref([
        {
          load: true,
          title: 'Tendencia'
        },
        {
          load: false,
          title: 'Demanda del producto'
        },
        {
          load: false,
          title: 'Margen de ganancia'
        },
        {
          load: false,
          title: 'Dificultad de venta'
        },
        {
          load: false,
          title: 'Generando recomendaciones'
        },
        {
          load: false,
          title: 'Riesgos'
        },
      ])
      const updateProgresive = () => {
        const intervalx = setInterval(() => {
          
          const index = items.value.findIndex((item) => item.load == false);
          console.log(index)
          if(index == -1){
            clearInterval(intervalx)
            return
          }
          items.value[index].load = true

        }, 4000);

      }
      onMounted(() => {

        updateProgresive()
     
      })
      return{
        wozIcons,
        img,
        items
      }
    }
  }
</script>
<style lang="scss">
.info__section{
  background: $primary;
  border-top: 0.8rem solid goldenrod;
}
.text--title__ia{
font-size: 1.5rem;
}
.text--title__iaWait{
  font-size: 1.35rem ;
  color: white;
  font-weight: bold;
}
.analizit__container{
  background: #1c5afa;
  border-radius: 1.5rem;
  transition: all 2s ease-in
}
.analizit__item--title{
  color: white;
  font-size: 1.1rem;
  
}
.itemFade-enter-active,
.itemFade-leave-active {
  transition: opacity 1s ease-in;
}

.itemFade-enter-from,
.itemFade-leave-to {
  opacity: 0;
}
</style>
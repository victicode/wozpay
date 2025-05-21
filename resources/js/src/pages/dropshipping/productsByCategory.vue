<template>
  <div>

    <section class="q-py-md q-px-sm">
      <activateArea />
      <div class="q-px-md q-pt-md">
        <div class="text-bold text--valiate">
          Productos Woz Dropshipping
          <q-icon
            :name=" icons.sharpVerified"
            size="sm"
            color="terciary"
            class=""
          />
        </div>
    
        <div class="droppersInit q-mt-xs q-px-md q-py-sm">
          <div class="flex items-center">
            <div class="text-dropper text__dropper q-mr-xs"> 
              Droppers
            </div> 
            <div v-html="wozIcons.droppers"/>
          </div>
          <div class="text__dropper2">367 Droppers están vendiendo estos producto</div>
        </div>
      
      </div>
    </section>
    <section>
      <!-- <listSquareProducts /> -->
    </section>
  </div>
</template>
<script>

import activateArea from '@/components/dropshipping/categories/activateArea.vue';
import wozIcons from '@/assets/icons/wozIcons.js'
import { inject } from 'vue';
import listSquareProducts from '@/components/dropshipping/product/listSquareProducts.vue';
import { useProductStore } from '@/services/store/products.store';
import { useRoute } from 'vue-router';
export default {
  components:{
    activateArea,
    listSquareProducts,
  },
  setup() {
    const icons = inject('ionIcons');
    const productStore =  useProductStore()
    const products = []
    const route = useRoute()

    console.log(route)
    
    return {
      icons,
      wozIcons
    }
  }
}
</script>
<style lang="scss">
.droppersInit{
  border: 1px solid goldenrod;
  border-radius: 1rem;
}
.text__dropper{
  font-size: 0.95rem;
  font-weight: bold;
}
.text__dropper2{
  color:rgb(133, 133, 133);
  font-weight: 400;
  font-weight: 0.8rem;
}
.text--valiate{
  font-size: 1rem;
}
</style>
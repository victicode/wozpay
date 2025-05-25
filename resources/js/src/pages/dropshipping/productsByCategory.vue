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
    <section class=" products__section">
      <template v-if="ready" >
        <div class="q-px-md q-pt-xs q-pb-lg">
          <listSquareProducts v-for="(product, index) in products" :product="product" :key="index"/>
        </div>
      </template>
      <template v-else>
        <skeletonListSquareProducts v-for="i in 5" :key="i" class="q-mt-sm" />
      </template>
    </section>
  </div>
</template>
<script>

import activateArea from '@/components/dropshipping/categories/activateArea.vue';
import wozIcons from '@/assets/icons/wozIcons.js'
import { inject, onMounted } from 'vue';
import listSquareProducts from '@/components/dropshipping/product/listSquareProducts.vue';
import skeletonListSquareProducts from '@/components/dropshipping/product/skeletonListSquareProducts.vue';
import { useProductStore } from '@/services/store/products.store';
import { useRoute } from 'vue-router';
import { ref } from 'vue';
export default {
  components:{
    activateArea,
    listSquareProducts,
    skeletonListSquareProducts
  },
  setup() {
    const icons = inject('ionIcons');
    const productStore =  useProductStore()
    const products = ref([]);
    const route = useRoute()
    const ready = ref(false)
    const  getProducts = () => {
      productStore.getAllProductByCategory(route.params.id)
      .then((response) =>{
        products.value = response.data;
        setTimeout(() => {
          ready.value = true
        }, 1000);
      })
      .catch((response) =>{
        console.log(response)
      })
    }
    
    onMounted(() => {
      getProducts()
    })
    return {
      ready,
      icons,
      wozIcons,
      products
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
.products__section{
 min-height: 48.6vh;
 background:#efefef
}
</style>
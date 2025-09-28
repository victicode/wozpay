<template>
  <section class="q-px-sm q-pb-lg">
    <div class="anotherSection__text-title">
      Otros Droppers vendieron
    </div>
    <div style="width: 100%; overflow-x: auto;">
      <div v-if="products.category.length > 0" class="flex q-mb-md sectionIn" style="">
        <productSquare v-for="product in products.category" :product="product" :key="product.id"/>
      </div>
      <div v-if="products.search.length > 0" class="flex q-mb-md sectionIn" style="">
        <productSquare v-for="product in products.search" :product="product" :key="product.id"/>
      </div>
    </div>
  </section>
</template>
<script>
import utils from '@/util/numberUtil';
import { useProductStore } from '@/services/store/products.store';
import { onMounted } from 'vue';
import productSquare from './productSquare.vue';

export default {
  components: {
    productSquare
  },
  props: {
    product: Object,
  },
  emits: [],
  setup (props) {
    const icons = inject('ionIcons');
    const  numberFormat = utils.numberFormat
    const productStore = useProductStore()
    const product = ref(props.product)
    const products = ref({
      category:[],
      search:[],
    })
    const getSimilarProduct = () => {
      productStore.getSimilar(product.value.categorie_id, product.value.title)
      .then((response) => {
        products.value.category = response.data.category.filter((itemm) => itemm.id != product.value.name)
        products.value.search   = response.data.search.filter((itemm) => itemm.id != product.value.name)

      })
    }
    onMounted(() => {
      getSimilarProduct()
    })
    return {
      icons,
      product: props.product,
      numberFormat,
      products,
    }
  }
}
</script>

<style lang="scss">
.sectionIn{
  flex-wrap: nowrap; 
  max-width: 200%;
  width: max-content;
}
.anotherSection__text-title{
  font-size: 1.4rem;
  font-weight: bold;

}
</style>
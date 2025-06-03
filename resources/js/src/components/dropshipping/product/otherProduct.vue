<template>
  <section class="q-px-sm q-pb-lg">
    <div class="anotherSection__text-title">
      Otros Droppers vendieron
    </div>
    <div v-if="products.length > 0" class="flex">
      <productSquare v-for="product in products" :product="product" :key="product.id"/>
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
    const products = ref([])
    const getSimilarProduct = () => {
      productStore.getSimilar(product.value.categorie_id, product.value.title)
      .then((response) => {
        products.value = response.data.filter((itemm) => itemm.id != product.value.id)
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
.anotherSection__text-title{
  font-size: 1.4rem;
  font-weight: bold;

}
</style>
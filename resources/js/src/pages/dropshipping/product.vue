<template>
  <main>
    <div v-if="product">
      <listSquareProductsInverter :product="product" />
      <stadisticProduct class="q-mt-md" :product="product" />
    </div>
  </main>
</template>
<script>
import { useRoute, useRouter } from 'vue-router';
import { useProductStore } from '@/services/store/products.store';
import { onMounted } from 'vue';
import { ref } from 'vue';
import listSquareProductsInverter from '@/components/dropshipping/product/listSquareProductsInverter.vue';
import stadisticProduct from '@/components/dropshipping/product/stadisticProduct.vue';
export default {

  components: {
    listSquareProductsInverter,
    stadisticProduct
  },
  setup () {
    const icons = inject('ionIcons');
    const router = useRouter()
    const route = useRoute()
    const prodcutStore = useProductStore()
    const goTo = (id) => {
      router.push('/dropshipping/product/'+id)
    }
    const product = ref(false)

    const getProduct = (id) => {
      prodcutStore.getProductById(id)
      .then((response) => {
        product.value = response.data
      })
    }
    onMounted(() => {
      getProduct(route.params.id)
    })

    return {
      icons,
      product,
      goTo,
    }
  }
}
</script>
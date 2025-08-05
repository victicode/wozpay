<template>
  <main class="">
    <div v-if="product">
      <listSquareProductsInverter :product="product" />
      <div class="otherInfoSections">
        <stadisticProduct class="q-mt-md" :product="product" />
        <detailsProduct class="q-mt-md" :product="product" />
      </div>
    </div>
  </main>
</template>
<script>
import { useRoute, useRouter } from 'vue-router';
import { useProductStore } from '@/services/store/products.store';
import { onMounted } from 'vue';
import { ref } from 'vue';
import listSquareProductsInverter from '@/components/admin/dropshipping/listSquareProductsInverter.vue';
import stadisticProduct from '@/components/admin/dropshipping/stadisticProduct.vue';
import detailsProduct from '@/components/admin/dropshipping/DetailsProduct.vue';
import buttonSection from '@/components/admin/dropshipping/buttonSection.vue';


export default {

  components: {
    listSquareProductsInverter,
    stadisticProduct,
    detailsProduct,
    buttonSection,
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
<style lang="scss">
.otherInfoSections{
  height:60vh; overflow:auto
}
.infoWozDropshippin{
 &__header{
  &-text1{
    font-size: 1rem;
    color:#f9a826 !important;
    font-weight: 600;
  }
  &-text2{
    font-size: 0.9rem;
    color:#969696 !important;
    font-weight: 500;
  }
 }
}
.info__title--info{
  font-size: 1rem;
  font-weight: 600;

}
.info__title--info2{
  font-size: 0.8rem;

}
@media screen and (max-width: 780px){
  .otherInfoSections{
    height:55vh;
  }
}
</style>
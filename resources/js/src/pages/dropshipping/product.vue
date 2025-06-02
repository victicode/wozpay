<template>
  <main>
    <div v-if="product">
      <listSquareProductsInverter :product="product" />
      <stadisticProduct class="q-mt-md" :product="product" />
      <detailsProduct class="q-mt-md" :product="product" />
      <buttonSection :product="product" />
      <section class="infoWozDropshippin q-px-md q-mb-lg">
        <div class="infoWozDropshippin__header">
          <div class="infoWozDropshippin__header-text1">Vuelvete premium</div>
          <div class="infoWozDropshippin__header-text2">39,9 USD Mensual</div>
        </div>
        <div class="q-px-xs q-mt-sm">
          <div class="q-py-sm q-mb-xs" style="border-bottom: 2px solid darkgrey;">
            <div class="info__title--info q-mb-xs">Woz Marketplace</div>
            <div>Exporta más de 1.000 productos dropshipping a tu tienda.</div>
          </div>
          <div class="q-py-sm q-mb-xs" style="border-bottom: 2px solid darkgrey;">
            <div class="info__title--info q-mb-xs">
              Exportación masiva de productos
            </div>
            <div>
              Exporta productos masivos a tu tienda con un clic
            </div>
          </div>
          <div class="q-py-sm q-mb-xs" style="border-bottom: 2px solid darkgrey;">
            <div class="info__title--info q-mb-xs">
              Botón de pago
            </div>
            <div>
              Usa Woz Pay como botón de pago para tu web
            </div>
          </div>
        </div>
      </section>
      <otherProduct :product="product" />
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
import detailsProduct from '@/components/dropshipping/product/DetailsProduct.vue';
import buttonSection from '@/components/dropshipping/product/buttonSection.vue';
import otherProduct from '@/components/dropshipping/product/otherProduct.vue';
export default {

  components: {
    listSquareProductsInverter,
    stadisticProduct,
    detailsProduct,
    buttonSection,
    otherProduct,
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
.infoWozDropshippin{
 &__header{
  &-text1{
    font-size: 1.3rem;
    color:#f9a826 !important;
    font-weight: 600;
  }
  &-text2{
    font-size: 0.99rem;
    color:#969696 !important;
    font-weight: 500;
  }
 }
}
.info__title--info{
  font-size: 1.2rem;
  font-weight: 600;

}
</style>
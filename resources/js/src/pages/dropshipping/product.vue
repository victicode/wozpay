<template>
  <main >
    <div v-if="product">
      <listSquareProductsInverter :product="product" />
      <stadisticProduct class="q-mt-md" :product="product" />
      <detailsProduct class="q-mt-md" :product="product" />
      <buttonSection :product="product" />
      <section class="infoWozDropshippin q-px-md q-mb-lg">
        <div class="infoWozDropshippin__header q-px-sm">
          <div class="infoWozDropshippin__header-text1">Vuelvete premium</div>
          <div class="infoWozDropshippin__header-text2">39,9 USD Mensual</div>
        </div>
        <div class="" style="background: #fefaf3; border-radius: 1rem;">

          <div class="q-px-md q-pt-md q-pb-lg q-mt-sm" >
            <div class="q-py-sm q-mb-xs" style="border-bottom: 2px solid darkgrey;">
              <div class="info__title--info q-mb-xs">Woz Marketplace</div>
              <div class="info__title--info2">Exporta más de 1.000 productos dropshipping a tu tienda.</div>
            </div>
            <div class="q-py-sm q-mb-xs" style="border-bottom: 2px solid darkgrey;">
              <div class="info__title--info q-mb-xs">
                Exportación masiva de productos
              </div>
              <div class="info__title--info2">
                Exporta productos masivos a tu tienda con un clic
              </div>
            </div>
            <div class="q-py-sm q-mb-xs" style="border-bottom: 2px solid darkgrey;">
              <div class="info__title--info q-mb-xs">
                Botón de pago
              </div>
              <div class="info__title--info2">
                Usa Woz Pay como botón de pago para tu web
              </div>
            </div>
          </div>
        </div>
      </section>
      <otherProduct :product="product" />
      <importantInformation />
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
import importantInformation from '@/components/dropshipping/product/importantInformation.vue';

export default {

  components: {
    listSquareProductsInverter,
    stadisticProduct,
    detailsProduct,
    buttonSection,
    otherProduct,
    importantInformation,
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
</style>
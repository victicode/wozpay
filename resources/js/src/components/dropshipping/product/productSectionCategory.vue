<template>
  <section style="background: #efefef;"> 
    <template v-if="ready" >
      <q-infinite-scroll @load="onLoadMenu" :offset="200"  :scroll-target="'#scroll-target-id'" >
        <listSquareProducts v-for="(product, index) in products" :product="product" :key="index"/>
        <template v-slot:loading >
          <div class="row justify-center q-mt-md q-pb-md">
            <q-spinner-dots color="primary" size="3rem"   v-if="showLoading"/>
            <div v-else style="font-weight: bold; color: darkgray;">
              <div v-if="user.dropshipping_account.status != 2" class=" q-pb-lg text-primary text-bold text-center w-100" style="font-size: 1rem;">
                Desbloquea para ver mas
              </div>
              <div v-else>
                No hay mas productos
              </div>
            </div>
          </div>
        </template>
      </q-infinite-scroll>
    </template>
    <template v-else>
      <skeletonListSquareProducts v-for="i in 5" :key="i" class="q-mt-sm" />
    </template>
  </section>
</template>
<script>



import { onMounted } from 'vue';
import listSquareProducts from '@/components/dropshipping/product/listSquareProducts.vue';
import skeletonListSquareProducts from '@/components/dropshipping/product/skeletonListSquareProducts.vue';
import { useProductStore } from '@/services/store/products.store';
import { useRoute } from 'vue-router';
import { ref } from 'vue';
import { storeToRefs } from 'pinia';
import { useAuthStore } from '@/services/store/auth.store';
export default {
  components:{
    listSquareProducts,
    skeletonListSquareProducts
  },
  setup() {
    const itemsMenu = ref([ {}, {},   ])
    const scrollTargetRef = ref(null)
    const productStore =  useProductStore()
    const { user } = storeToRefs(useAuthStore())
    const products = ref([]);
    const route = useRoute()
    const ready = ref(false)
    const lastPage = ref(1)
    const showLoading = ref(true)
    const  getProducts = (index) => {
      index++ 
      productStore.getAllProductByCategory(route.params.id, index)
      .then((response) =>{
        lastPage.value = response.data.last_page
        products.value.push(...response.data.data);
        setTimeout(() => {
          ready.value = true
        }, 1000);
      })
      .catch((response) =>{
        console.log(response)
      })
    }
    
    const onLoadMenu = (index, done) => {

      const validacion =  user.value.dropshipping_account.status != 2 ? (index == 0) : (index >= 1)
      if (validacion) {
          setTimeout(() => {
            getProducts(index)
            if(index < lastPage.value){
              done()
            }else{
              showLoading.value = false 
            }
          }, 1000)
      }
      else {
        setTimeout(() => {
         user.value.dropshipping_account.status != 2 ? showLoading.value = false : done()
        }, 200)
      }
    }
    onMounted(() => {
      getProducts()
    })
    return {
      user,
      ready,
      products,
      scrollTargetRef,
      itemsMenu,
      showLoading,
      onLoadMenu,
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
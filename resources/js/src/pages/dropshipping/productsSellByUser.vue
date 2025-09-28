<template>
  <div style="height:95%" class="q-px-sm">
    <div class="flex q-px-sm q-py-sm justify-between" style="border-bottom: 1px solid darkgray;">
      <div>
        <div class="textProductProfile">Inventario Woz Dropshipping</div>
        <div class="textProductProfileSub">{{ stats.inventory }} productos agregados</div>
      </div>
      <div>
        <van-switch v-model="viewInventory" @update:model-value="getNewList(1)" class="swichtDashboard" size="1.5rem"  active-color="#21BA45" inactive-color="#d8d8d8">
          <template #node>
            <div class="icon-wrapper">
            </div>
          </template>
        </van-switch>
      </div>
    </div>
    <div class="flex q-px-sm q-my-sm q-py-xs justify-between">
      <div>
        <div class="textProductProfile">Productos vendidos</div>
        <div class="textProductProfileSub">{{ stats.myProducts }} productos Vendidos</div>
      </div>
      <div>
        <van-switch v-model="viewMyProducts" @update:model-value="getNewList(2)" class="swichtDashboard" size="1.5rem"  active-color="#21BA45" inactive-color="#d8d8d8">
          <template #node>
            <div class="icon-wrapper">
            </div>
          </template>
        </van-switch>
      </div>
    </div>
    <div style="height: -webkit-fill-available;" class="q-pt-none ">
      <div v-if="ready">
        <div v-if="Object.values(products).length > 0" class="q-pb-xl q-px-xs">
          <div v-for="product in products" :key="product.id" class="q-mb-xs">
            <div class="  q-pb-none q-pt-md-sm flex items-end justify-between" style="flex-wrap:nowrap; height:6rem">
              <div class="q-mr-xs flex flex-center productListSell__imgProfilex--container" style="">

                <img 
                  :src="!product.image 
                  ? 'https://staging.wozpayments.com/public/images/products/default.png'
                  : product.image" alt="Imagen" class="productListSell__imgProfilex"
                  @error="replaceWithDefault" 
                />

                <!-- <img :src="product.image" alt="" style="width: 7rem; padding: 0rem 20%;"> -->
              </div>
              <div class=" q-pl-xs q-py-xs flex items-center justify-between" style="cursor:pointer; flex-wrap:nowrap; width: 78%; border-bottom: 1px solid darkgray;">
                <div class=" q-pt-xs" style="width:63%">
                  <div class="q-mb-xs q-mt-xs ellipsis" style="font-weight:500; font-size:1.05rem; line-break: no-wrap; width:100%">
                    {{ product.title }}
                  </div>
                  <div class="q-mb-xs text-grey-8" style="font-weight:500; font-size:.9rem; line-break: auto;">
                    Gs. {{ numberFormat(product.price) }}
                  </div>
                </div>
                <div>
                  <div
                    @click="goTo('/dropshipping/generatePayLink/'+product.id)"
                    :style="'background:'+(typeSearch == 1 ? '#19cd15':'#9eea9c')+'; color:'+(typeSearch == 1 ? 'white':'#19cd15')"  
                    style="padding:0.2rem 1.7rem;  font-size: 1.02rem; border-radius: 2rem;"
                  >
                    {{ typeSearch == 1 ? 'Vender' : 'Vendido'}}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div v-else class="text-center q-mt-xl q-px-lg " style="font-size:1.4rem; font-weight:500">
          😞😞 <br>
          No hay productos que mostrar
        </div>
      </div>
      <div v-else class="flex-center flex" style="height: -webkit-fill-available;">
        <q-spinner-dots
          color="primary"
          size="8em"
        />
      </div>
    </div>

  </div>
</template>
<script>
  import util from '@/util/numberUtil'
  import { inject, ref, onMounted } from 'vue'

  import { useRoute, useRouter } from 'vue-router'
  import moment from 'moment';
  import modalView from '@/components/links/modal.vue';
  import { useProductStore } from '@/services/store/products.store';  
  

  export default {
    components:{
      modalView
    },
    setup() {
      const route = useRoute()
      const router = useRouter()
      const numberFormat = util.numberFormat
      const productStore = useProductStore()
      const ready = ref(false)
      const viewInventory = ref(true)
      const viewMyProducts = ref(false)
      const typeSearch = ref(1)
      const stats = ref({
        inventory:0,
        myProducts:0
      })
      const products = ref([])

      const showLoading = ref(true)
      const lastPage = ref(1)
      const search = ref('')

      const getStats = () => {
        productStore.profileStats()
        .then((r) => {
          stats.value.inventory = r.data.stats1
          stats.value.myProducts = r.data.stats2
        })
      }
      const getNewList = (status) =>{
        if(status == 1){
          viewInventory.value = true
          viewMyProducts.value = false
        }
        if(status == 2){
          viewInventory.value = false
          viewMyProducts.value = true
        }
        if(status != typeSearch.value){

          typeSearch.value = status
          ready.value = false
          products.value = []
          getInventrory()
        }
      }
      const  getInventrory = (index = 0) => {
        index++ 
        showLoading.value = true 
        productStore.getAllProductInInventory(search.value, index, typeSearch.value)
        .then((response) =>{
          lastPage.value = response.data.last_page
          products.value.push(...response.data.data);
          setTimeout(() => {
            ready.value = true
          }, 500);
        })
        .catch((response) =>{
          console.log(response)
          ready.value = true

        })
      }
      const goTo = (url) => {
        if(typeSearch.value == 2 )  return
        router.push(url)
      }
      const replaceWithDefault = (event) =>  {
        event.target.src = 'https://staging.wozpayments.com/public/images/products/default.png'
      }
      onMounted(() => {
        getStats()
        getInventrory()
      })
      return {
        stats,
        ready,
        products,
        typeSearch,
        moment,
        viewInventory,
        viewMyProducts,
        numberFormat,
        goTo,
        getNewList,
        replaceWithDefault,
      }
    }
  }
</script>

<style lang="scss">
.badge__dropVentas{
  font-weight:600; 
  font-size:0.8rem; 
  text-align:end; 
  border-radius:0.7rem;

  &.sell{
    background: #c7f3c7;
    color: #19cd15;
  }
  &.reject{
    background: #fdc5c5;
    color: #f80d0d;

  }
}
.swicthSection__button{
  border-radius: 0.4rem;
  cursor: pointer;
  transition: all 0.3s ease;
  &.success{
    background: #c7f3c7!important;
    color: #19cd15!important;
  }
  &.reject{
    background: #fdc5c5!important;
    color: #f80d0d;

  }
}
.textProductProfile{
  font-weight: 900;
  font-size: 1.08rem;
}
.textProductProfileSub{
  font-weight: 500;
  font-size: 0.95rem;
  color:rgb(102 102 102);
}
.productListSell__imgProfilex{
  object-fit: contain;
  background: #d8d8d8; 
  padding: 0px 20%;
  margin: auto;
  height: 100%;
  &--container{
    width: 20%;
    overflow: hidden;
    height: 70%;
    //padding: 0.1rem;
    //border-top-left-radius: 0.9rem;
    //border-bottom-left-radius: 0.9rem;
    border-radius:.8rem; 
    background:#d8d8d8; 
    // background: rgba(211, 211, 211, 0.418);

  }
}
</style>
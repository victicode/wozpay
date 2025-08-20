<template>
  <div>
    <div class="text-center text-h6 q-mt-md">
      Listado de productos
    </div>
    <div v-if="ready">
      <div class="flex justify-end q-px-sm q-mt-md">
        <q-btn icon="eva-search-outline" color="grey-7"  @click="dialog = 'search'" class="q-mt-sm q-mr-sm" />

        <q-btn icon="eva-trash-2-outline" color="negative" v-if="products.length > 0"  @click="dialog = 'delete'" class="q-mt-sm" />
      </div>
      <template v-if="products.length > 0">
        <div class="q-py-sm q-pb-xl" style="overflow:auto; height:75vh">
          <viewProductListItem v-for="product in products" :product="product" :key="product.id"  />
          <div class="pagination flex flex-center  q-py-md" >
            <div class="q-pb-none">
              <q-pagination
                v-model="currentPage"
                :max="lastPage"
                direction-links
                outline
                ellipses
                color="primary"
                active-design="push"
                active-color="primary"
                active-text-color="white"
                size="0.9rem"
                gutter="sm"
                @update:model-value="setPage"
                class="q-pb-none"
              />
            </div>
          </div>
        </div>
      </template>
      <template v-else>
        <div class="text-center text-h6 q-mt-lg">
          No hay productos registrados.
        </div>
      </template>
    </div>
    <div class="q-pt-lg q-mt-lg q-pb-md" v-else>
      <q-spinner-tail
        color="black"
        size="3rem"
        style="margin:auto"
      />
    </div>
    <deleteAllProducts :show="(dialog == 'delete')"  @hiddeModal="hiddeModal()" @updateList="getAllProducts()"/> 
    <searchProduct :show="(dialog == 'search')"  @hiddeModal="hiddeModal()" @updateList="searchProduct"/> 
    
  </div>
</template>
<script>
  import { useAuthStore } from '@/services/store/auth.store'
  import { inject, onMounted, ref,} from 'vue'
  import { useRouter } from 'vue-router'
  import util from '@/util/numberUtil';
  import { useProductStore } from '@/services/store/products.store';
  import viewProductListItem from '@/components/admin/dropshipping/viewProductListItem.vue';
  import deleteAllProducts from '@/components/admin/dropshipping/deleteAllProducts.vue';
  import searchProduct from '@/components/admin/dropshipping/searchProduct.vue';

  export default {
    components:{
      viewProductListItem,
      deleteAllProducts,
      searchProduct,
    },
    setup() {
      //vue provider
      const productStore = useProductStore()
      const numberFormat= util.numberFormat;
      const user = useAuthStore().user;
      const icons = inject('ionIcons')
      const router = useRouter()
      const currentPage = ref(1)
      const lastPage = ref(10)
      const search = ref('')
      const products = ref([])

      const ready = ref(false)  
      const dialog = ref('')

      const searchProduct = (product) => {
        search.value = product
        getAllProducts()
      }
      const getAllProducts = () => {
        ready.value = false 
        const data = {
          page: currentPage.value,
          search:search.value,
        }

        productStore.getAllProductPagination(data)
        .then((response) => {
          if(response.code !== 200) throw response
            products.value = response.data.data
            lastPage.value = response.data.last_page
            search.value = ''
            setTimeout(() => {
              ready.value = true
            }, 1000);

        })
        .catch((response) => {
          ready.value = true
          showNotification({msg:response, title:'Error'})
        })
      } 
      const replaceWithDefault = (event) =>  {
        event.target.src = 'https://staging.wozpayments.com/public/images/products/default.png'
      }
      const setPage = (page) => {
        currentPage.value = page
        getAllProducts()
      }
      const hiddeModal = () => {
        dialog.value = ''
      }
      onMounted(() => {
        getAllProducts()
      })
      // Data
      return{
        icons,
        currentPage,
        router,
        products,
        numberFormat,
        lastPage,
        ready,
        dialog,
        setPage,
        searchProduct,
        replaceWithDefault,
        hiddeModal,
        getAllProducts,
      }
    },
  }
</script>
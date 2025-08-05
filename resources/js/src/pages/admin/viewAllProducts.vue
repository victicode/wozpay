<template>
  <div>
    <div class="text-center text-h6 q-mt-md">
      Listado de productos
    </div>
    <div class="q-py-sm" style="overflow:auto; height:75vh">
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
  </div>
</template>
<script>
  import { useAuthStore } from '@/services/store/auth.store'
  import { inject, onMounted, ref,} from 'vue'
  import { useRouter } from 'vue-router'
  import util from '@/util/numberUtil';
  import { useProductStore } from '@/services/store/products.store';
  import viewProductListItem from '@/components/admin/dropshipping/viewProductListItem.vue';


  export default {
    components:{
      viewProductListItem
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
      const loading = ref(false)
      const products = ref([])

      const getAllProducts = () => {
        loading.value = true 
        const data = {
          page: currentPage.value,
          search:search.value,
        }

        productStore.getAllProductPagination(data)
        .then((response) => {
          if(response.code !== 200) throw response
            products.value = response.data.data
            lastPage.value = response.data.last_page
        })
        .catch((response) => {
          loading.value = false
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
        setPage,
        replaceWithDefault,
      }
    },
  }
</script>
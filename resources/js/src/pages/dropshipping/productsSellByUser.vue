<template>
  <div style="height:95%">
    <div class="flex">
      <div>
        <div>Inventario Woz Dropshipping</div>
        <div>{{ product.length }} productos agregados</div>
      </div>
    </div>
    <div style="height: -webkit-fill-available;" class="q-pt-md">
      <div v-if="ready">
        <div v-if="Object.values(pays).length > 0">
          <div v-for="pay in pays" :key="pay.id">
            <div class="q-py-sm q-px-sm bg-grey-5" style="font-weight:500">
              {{ moment(pay.created_at).format('DD') }} de {{ moment(pay.created_at).format('MMMM yyyy') }}
            </div>
            <div class="q-py-md" v-for="product in pay.link.products_in_link" :key="product.id">
                <div class=" q-px-sm q-pb-none q-pt-md-sm flex items-center" style="flex-wrap:nowrap; height:6rem">
                    <div class="q-mr-xs flex flex-center productListSell__img--container" style="">

                      <img 
                        :src="!product.image 
                        ? 'https://staging.wozpayments.com/public/images/products/default.png'
                        : product.image" alt="Imagen" class="productListSell__img"
                        @error="replaceWithDefault" 
                      />

                      <!-- <img :src="product.image" alt="" style="width: 7rem; padding: 0rem 20%;"> -->
                    </div>
                    <div class=" q-pl-xs q-py-xs flex items-center justify-between" style="cursor:pointer; flex-wrap:nowrap; width: 71%">
                      <div class=" q-pt-xs" style="width:63%">
                        <div class="q-mb-xs q-mt-xs ellipsis" style="font-weight:500; font-size:1rem; line-break: no-wrap; width:100%">
                          {{ product.title }}
                        </div>
                        <div class="q-mb-xs" style="font-weight:400; font-size:.9rem; line-break: auto;">
                          {{ pay.link.user.name }}
                        </div>
                        <div class="q-mb-xs text-grey-7" style="font-weight:400; font-size:.9rem; line-break: auto;" >
                          {{ moment(pay.created_at).format('DD-MM-YYYY HH:mm')  }}h
                        </div>
                      </div>
                      <div class="q-py-xs q-mt-xs q-px-md-lg q-px-sm badge__dropVentas" :class="{'sell':pay.status==2, 'reject':pay.status==0}" style="">
                        {{ pay.status_label }}
                      </div>
                    </div>
                  </div>
            </div>
          </div>
        </div>
        <div v-else class="text-center q-mt-lg q-px-lg " style="font-size:1.4rem; font-weight:500">
          No tienes pagos {{ productViewType == 2 ? 'aprobados' : 'rechazados'}} <br> en tu cuenta de dropshipping
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
      const numberFormat = util.numberFormat
      const productStore = useProductStore()
      const ready = ref(false)
      const productViewType = ref(2)
      const products = ref([])
      const getNewList = (status) =>{
        productViewType.value = status
        getInventrory()
      }
      const showLoading = ref(true)
      const lastPage = ref(1)
      const search = ref('')
      const  getInventrory = (index) => {
        index++ 
        showLoading.value = true 
        productStore.getAllProductInInventory(search.value, index)
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
      const replaceWithDefault = (event) =>  {
        event.target.src = 'https://staging.wozpayments.com/public/images/products/default.png'
      }
      onMounted(() =>{
        getInventrory()
      })
      return {
        ready,
        products,
        productViewType,
        moment,
        numberFormat,
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
.productListSell__img{
  object-fit: contain;
  background: #d8d8d8; 
  padding: 0px 30%;
  margin: auto;
  height: 100%;
  &--container{
    width: 25%;
    overflow: hidden;
    height: 100%;
    //padding: 0.1rem;
    //border-top-left-radius: 0.9rem;
    //border-bottom-left-radius: 0.9rem;
    border-radius:.8rem; 
    background:#d8d8d8; 
    // background: rgba(211, 211, 211, 0.418);

  }
}
</style>
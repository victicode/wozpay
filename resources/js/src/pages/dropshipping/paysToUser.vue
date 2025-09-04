<template>
  <div style="height:95%">
    <div class="flex">
      <div @click="getNewList(2)" class="q-px-md q-mx-md q-py-xs bg-grey-4 swicthSection__button" :class="{'success':statusOfPay == 2}" style="">
        Pagos realizados
      </div>
      <div @click="getNewList(0)" class="q-px-md q-mx-md q-py-xs bg-grey-4 swicthSection__button" :class="{'reject':statusOfPay == 0}" style="">
        Pagos rechazados
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
                    <div class="q-mr-xs flex flex-center" style="
                      background: red; 
                      width: 28%;
                      border-radius:.8rem; 
                      background:#d8d8d8; 
                      height:100%;">
                      <img :src="product.image" alt="" style="width: 7rem; padding: 0rem 20%;">
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
        <div v-else class="text-center q-mt-lg" style="font-size:1rem">
          No tienes pagos {{ statusOfPay == 2 ? 'aprobados' : 'rechazados'}} en tu cuenta de dropshipping
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
  import { usePayStore } from '@/services/store/pay.store';

  export default {
    components:{
      modalView
    },
    setup() {
      const route = useRoute()
      const numberFormat = util.numberFormat
      const payStore = usePayStore()
      const pays = ref([])
      const ready = ref(false)
      const statusOfPay = ref(2)

      const getNewList = (status) =>{
        statusOfPay.value = status
        getDropPayByUser()
      }
      const getDropPayByUser = () => {
        ready.value = false

        const request = {
          status: statusOfPay.value
        }
      
        payStore.getDropPayByUser(route.params.id, request)
        .then((response) => {
          if(response.code !==200) throw response
          pays.value = response.data
          setTimeout(() => {
            
            ready.value = true
          }, 1000);
        })
        .catch((response) =>{
          console.log(response)
          ready.value = true

        })
      }
      onMounted(() =>{
        getDropPayByUser()
      })
      return {
        ready,
        pays,
        statusOfPay,
        moment,
        numberFormat,
        getNewList,
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
</style>
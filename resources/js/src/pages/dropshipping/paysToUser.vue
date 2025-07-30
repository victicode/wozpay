<template>
  <div style="height:95%">
    <div class="flex">
      <div class="q-px-md q-mx-md q-py-xs bg-grey-4 swicthSection__button" style="">
        Pagos realizados
      </div>
      <div class="q-px-md q-mx-md q-py-xs bg-grey-4 swicthSection__button" style="">
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
            <div class="q-pt-md" v-for="product in pay.link.products_in_link" :key="product.id">
                <div class=" q-px-sm q-pb-none q-pt-md-sm flex items-center" style="flex-wrap:nowrap; height:6rem">
                    <div class="q-mr-xs flex flex-center" style="
                      background: red; 
                      border-radius:.8rem; 
                      background:#d8d8d8; 
                      height:100%;">
                      <img :src="product.image" alt="" style="width: 7rem; padding: 0rem 20%;">
                    </div>
                    <div class=" q-pl-xs q-py-xs flex items-center justify-between" style="flex-wrap:nowrap; width: -webkit-fill-available;">
                      <div class=" q-pt-xs">
                        <div class="q-mb-xs q-mt-xs " style="font-weight:500; font-size:1rem; line-break: no-wrap;">
                          {{ product.title }}
                        </div>
                        <div class="q-mb-xs" style="font-weight:400; font-size:.9rem; line-break: auto;">
                          {{ pay.link.user.name }}
                        </div>
                        <div class="q-mb-xs text-grey-7" style="font-weight:400; font-size:.9rem; line-break: auto;" >
                          {{ moment(pay.created_at).format('DD-MM-YYYY HH:mm')  }}h
                        </div>
                      </div>
                      <div class="q-py-xs q-mt-xs q-px-lg badge__dropVentas" :class="{'sell':pay.status==2, 'reject':pay.status==0}" style="">
                        {{ pay.status_label }}
                      </div>
                    </div>
                  </div>
            </div>
          </div>
        </div>
        <div v-else>
          No tienes pago en tu cuenta de dropshipping
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
  import wozIcons from '@/assets/icons/wozIcons';
  import { useLinkStore } from '@/services/store/link.store';
  import { useQuasar } from 'quasar';
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
      const getDropPayByUser = () => {
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
        })
      }
      onMounted(() =>{
        getDropPayByUser()
      })
      return {
        ready,
        pays,
        moment,
        numberFormat,
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
}
</style>
<template>
  <div class="q-pt-md">
    <div class="q-px-md q-py-sm q-mt-md" style="border-bottom: 1px solid lightgrey;">
      <div class="text-subtitle1 text-bold">Pagos pendientes de aprobación: {{deposits.length}}</div>
      <div></div>
    </div>
    <div class=" q-mt-lg q-px-md-sm q-px-sm">
      <template v-if="loading">
        <div v-if="deposits.length > 0">
          <div @click="goTo(item.id)" v-for="(item, index) in deposits" :key="index" class="q-px-md-md q-px-none q-pb-xs q-mt-md deposits__container flex items-center justify-between">
            <div class="text-subtitle2 text-weight-medium">
             {{  item.user.name }}
            </div>
            <div class="flex items-center">
              <div class="q-mr-sm text-subtitle2 text-weight-medium">
                {{ 'Gs. '+ numberFormat(item.amount)  }}
              </div>
              <q-btn flat  class="q-px-none">
                <q-icon name="eva-chevron-right-outline"  class=""/>
              </q-btn>
            </div>
          </div>
        </div>
        <div class="q-px-md text-center text-h6" v-else>
          No tienes depositos pendientes
        </div>
      </template>
      <template v-else>
        <div class="flex flex-center">
          <q-spinner-hourglass
            color="primary"
            size="3rem"
          />
        </div>
      </template>
    </div>

  </div>
</template>
<script>
import { usePayStore } from '@/services/store/pay.store';
import { onMounted, ref } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import util from '@/util/numberUtil'

export default {


  setup() {
    const payStore = usePayStore();
    const route = useRoute();
    const router = useRouter();
    const deposits = ref([]);
    const numberFormat = util.numberFormat;
    const loading = ref(false);
    const selectedPay = ref({})

    const getDepositslist = () =>{
      loading.value = false
      payStore.getPendingDeposits()
      .then((response) => {
        if(response.code !== 200) throw response
        loading.value = true
        deposits.value = response.data
      })
      .catch((response) => {
        console.log(response)
        loading.value = true
      })
    };
    const goTo = (id) => {
      router.push('/admin/deposit/byId/'+id)
    };
    onMounted(() => {
      getDepositslist()
    })
    return {
      route,
      deposits,
      loading,
      selectedPay,
      numberFormat,
      getDepositslist,
      goTo,

    }
  }
}
</script>
<style lang="scss">

.deposits__container{
  border-bottom: 1px solid lightgray
}

@media screen and (max-width: 780px){
}
</style>
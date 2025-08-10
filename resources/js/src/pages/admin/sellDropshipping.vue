<template>
  <div class="q-pt-md">
    <div class="q-px-md q-pt-md">
      <q-select 
          class=" filterPays q-pb-none" 
          outlined
          v-model="selectedLote" 
          :options="options" 
          label="Seleccionar tipos de pagos" 
          dropdown-icon="eva-chevron-down-outline"
          behavior="menu"
          option-label="title" 
          option-value="value"
          @update:model-value="getPaylist"
        />
    </div>
    <div class="q-px-md q-py-sm q-mt-md" style="border-bottom: 1px solid lightgrey;">
      <div class="text-subtitle1 text-bold">
        {{ selectedLote.head }}: {{pays.length}}
      </div>

    </div>
    <div class=" q-mt-lg q-px-md-sm q-px-sm">
      <template v-if="loading">
        <div v-if="pays.length > 0">
          <div v-for="(item, index) in pays" :key="index" class="q-px-md-md q-px-none q-pb-xs q-mt-md pays__container flex items-center justify-between">
            <div class="text-subtitle2 text-weight-medium">
             {{ item.pay_data.name }}
            </div>
            <div class="flex items-center">
              
              <div class="q-mr-none text-subtitle2 text-weight-medium" :class="{'text-warning':selectedLote.index == 'payCreateLink'}">
                {{ 'Gs.'+ numberFormat(item.amount) }}
              </div>
              <div>
                <q-icon :name="
                  item.status == 1 
                  ? 'eva-clock-outline'
                  : item.status == 2 
                  ? 'eva-checkmark-circle-2-outline'
                  : 'eva-close-circle-outline'
                  "
                  :color="
                  item.status == 1 
                  ? 'terciary'
                  : item.status == 2 
                  ? 'positive'
                  : 'negative'
                  "
                  size="1.3rem"
                  class="q-mr-xs q-ml-sm q-pb-xs"
                />
              </div>
              <q-btn flat @click="goTo(item.id)" class="q-px-none">
                <q-icon name="eva-chevron-right-outline"  class="q-pb-xs"/>
              </q-btn>
            </div>
          </div>
        </div>
        <div class="q-px-md text-center text-h6" v-else>
          No tienes pagos
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
    const pays = ref([]);
    const numberFormat = util.numberFormat;
    const loading = ref(false);
    const selectedPay = ref({})
    const options = [
      {
        title:'Todas las ventas',
        index: 4,
        head: 'Todas las ventas'
      },
      {
        title:'Canceladas',
        index: 0,
        head: 'Pagos cancelados'
      },
      {

        title:'Pendientes',
        index: 1,
        head: 'Pagos pendientes'
      },
      {

        title:'Aprobadas',
        index: 2,
        head: 'Pagos aprobados'
      },
    ];

    const selectedLote = ref({
        title:'Todas las ventas',
        index: 4,
        head: 'Todas las ventas',
      });

    const getPaylist = () =>{
      loading.value = false
      const data = {
        status: selectedLote.value.index
      }
      payStore.getPendingPaysDrop(data)
      .then((response) => {
        if(response.code !== 200) throw response
        loading.value = true
        pays.value = formatPays(response.data)
        console.log(pays.value)
    

      })
      .catch((response) => {
        console.log(response)
        loading.value = true
      })
    };
    const formatPays = (pays) => {
      pays.forEach(pay => {
        pay.pay_data = JSON.parse(pay.pay_data)
        pay.shipping_data = JSON.parse(pay.shipping_data)
      });
      
      return pays
    }
    const goTo = (id) => {
      router.push('/admin/dropshipping/pay/'+id) 
  
    };
    onMounted(() => {
      getPaylist()
    })
    return {
      route,
      options,
      selectedLote,
      pays,
      loading,
      selectedPay,
      numberFormat,
      getPaylist,
      goTo,

    }
  }
}
</script>
<style lang="scss">

.pays__container{
  border-bottom: 1px solid lightgray
}



.filterPays{
  &.q-field--float .q-field__label, .q-field--focused .q-field__label {
    transform: translateY(-123%) scale(0.75);
    transition: transform 0.36s cubic-bezier(0.4, 0, 0.2, 1), max-width 0.396s cubic-bezier(0.4, 0, 0.2, 1);
    background: white!important;
    font-weight: 500;
    z-index: 2;
  }
  &.q-field--auto-height.q-field--labeled .q-field__control-container{
    padding-top: 15px;
  }
  & .q-field__control{
    border-radius: 8px;
    z-index: 1;
  }
}
@media screen and (max-width: 780px){
}
</style>
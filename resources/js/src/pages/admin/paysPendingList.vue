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
      <div class="text-subtitle1 text-bold">Pagos pendientes: {{pays.length}}</div>
      <div></div>
    </div>
    <div class=" q-mt-lg q-px-md-sm q-px-sm">
      <template v-if="loading">
        <div v-if="pays.length > 0">
          <div v-for="(item, index) in pays" :key="index" class="q-px-md-md q-px-none q-pb-xs q-mt-md pays__container flex items-center justify-between">
            <div class="text-subtitle2 text-weight-medium">
              Mirna Eustolgia Gomez Parra
            </div>
            <div class="flex items-center">
              <div class="q-mr-sm text-subtitle2 text-weight-medium">
                Gs. {{ numberFormat(item.amount) }}
              </div>
              <q-btn flat @click="goTo(item.id)" class="q-px-none">
                <q-icon name="eva-chevron-right-outline"  class="q-pb-xs"/>
              </q-btn>
            </div>
          </div>
        </div>
        <div class="q-px-md text-center text-h6" v-else>
          No tienes pagos pendientes
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
        title:'Pagos de activación',
        index:'payActication'
      },
      {

        title:'Pagos de paquetes',
        index:'payPackage'
      },
      {

        title:'Pagos de link',
        index:'payCreateLink'
      }
    ];

    const selectedLote = ref(options[route.params.id]);

    const getPaylist = () =>{
      loading.value = false
      payStore.getPendingPays()
      .then((response) => {
        if(response.code !== 200) throw response
        loading.value = true
        pays.value = response.data[selectedLote.value.index]
      })
      .catch((response) => {
        console.log(response)
        loading.value = true
      })
    };
    const goTo = (id) => {
      router.push('/admin/paysDetailsOther/'+id)
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
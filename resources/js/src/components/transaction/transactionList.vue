<template>
  <div class="transactionList" >
    <div v-if="!loading && Object.values(transactions).length > 0" style="height: 100%;" >
      <div style="height: 80%;overflow: auto;" class="q-mt-md">

        <div v-for="(transaction, key) in transactions" :key="key" class="q-py-sm  cursor-pointer" >
          <div 
            class="flex items-center justify-between q-px-sm q-mx-sm bottom-border q-pb-sm" 
            @click="goTo(transaction.transaction, transaction.id)"
          >
            <div class="flex items-center">
              <div v-html="imgTransaction(transaction)" 
              class="q-mr-sm q-mr-md-md icons-transfer" 
              :class="{'transfer-icon-t': transaction.transaction == 4 , 'transfer-icon-t fill-red': transaction.transaction == 5}"
              />
              <div>
                <div 
                  v-for="(line, index) in lines(transaction)" 
                  :key="index" 
                  class="text-subtitle2 text-grey-7 text-weight-regular" 
                  :class="{'text-weight-bold text-grey-10': index=='title'}"
                >
                  {{ line }}
                </div>
              </div>
            </div>
            <div>
              <div class="text-right text-caption text-grey-7"> 
                {{ moment(transaction.created_at).format('DD/MM/YYYY') }}
              </div>
              <div class="text-subtitle2 text-right text-weight-medium " :class="colorTextByTrasaction(transaction)">
                Gs. {{ transaction.transaction == 1 || transaction.transaction == 4 ? '' : '-' }}{{ numberFormat(transaction.amount) }}
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="pagination flex flex-center  q-pt-md" style="height: 10%;">
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
          />
        </div>
    </div>
    <div v-if="!loading && Object.values(transactions).length == 0" class="flex flex-center column q-pt-xl">
      <q-icon :name="icons.ionRepeatOutline" color="terciary" size="10rem" class="q-mt-md" style="transform:rotate(50deg) ;" />
      <div class="text-h6 text-weight-medium">
        Sin transacciones
      </div>
    </div>
    <div v-if="loading" style="height: 100%;" class="flex flex-center column">

        <q-spinner-hourglass
          color="primary"
          size="4rem"
        />
      <div class="text-center text-weight-bold text-h5 q-mt-1">
        Cargando...
      </div>
    </div>

  </div>
</template>
<script>
import { inject, onMounted, ref } from 'vue'
import util from '@/util/numberUtil'
import { useAuthStore } from '@/services/store/auth.store';
import { useTransactionStore } from '@/services/store/transaction.store';
import { storeToRefs } from 'pinia'
import wozIcons from '@/assets/icons/wozIcons';
import moment from 'moment';
import { useRouter } from 'vue-router';


export default {
  setup () {
    const icons = inject('ionIcons')
    const emitter = inject('emitter');
    const { user  } = storeToRefs(useAuthStore())
    const transactions = ref([])
    const transactionStore = useTransactionStore()
    const numberFormat = util.numberFormat
    const router = useRouter()
    const search = ref('')
    const month = ref(new Date().getMonth())
    const loading = ref(true)
    const currentPage = ref(1)
    const lastPage = ref(10)
    const getTransactions = () => {
      loading.value = true 
      const data = {
        page: currentPage.value,
        user: user.value.id,
        search:search.value,
        month: month.value
      }

      transactionStore.allTransactionByUser(data)
      .then((response) => {
        if(response.code !== 200) throw response
          transactions.value = response.data.transactions,
          lastPage.value = response.data.countAllPages,
          loading.value = false
      })
      .catch((response) => {
        loading.value = false
        showNotification({msg:response, title:'Error al realizar transferencia'})
      })
    } 
    const showNotification = (value) => {
        const data = {
        newColor: 'negative', 
        newTitle: value.title,
        newText: value.msg, 
        newIcon: 'eva-bell-outline',
        newCallback: () => emitter.emit('offModalNotification'),
      }
      emitter.emit('modalNotification', data);
    } 
    const lines = (transaction) => {
      if(transaction.transaction == 1)  return { title:'Realizaste una carga de saldo', text: transaction.concept }
      if(transaction.transaction == 2)  return { title:'Realizaste un pago de prestamo', text: transaction.concept }
      if(transaction.transaction == 3)  return { title:'Realizaste un pago de prestamo', text: transaction.concept }
      if(transaction.transaction == 4)  return { title:'Recibiste una transferencia de', second: transaction.user_from.user.name, text: transaction.concept }
      if(transaction.transaction == 5)  return { title:'Realizaste una transferencia de', second: transaction.user_to.user.name, text: transaction.concept }
      if(transaction.transaction == 6)  return { title:'Realizaste un pago de prestamo', text: transaction.concept }
    }
    const imgTransaction = (transaction) => {
      if(transaction.transaction == 1)  return wozIcons.cargar
      if(transaction.transaction == 2)  return wozIcons.cashOutline
      if(transaction.transaction == 3)  return wozIcons.cashOutline
      if(transaction.transaction == 4)  return wozIcons.transferir
      if(transaction.transaction == 5)  return wozIcons.transferir
      if(transaction.transaction == 6)  return wozIcons.cardOutline
    }
    const colorTextByTrasaction = (transaction) => {
      if(transaction.transaction == 1 || transaction.transaction == 4)  return 'text-positive'
      return 'text-negative'
    }
    const goTo = (type, id) => {
      router.push('/trasacction/view/'+type+'/'+id)
    }
    const setPage = (page) => {
      currentPage.value = page
    getTransactions()
  }
    onMounted(() => {
      getTransactions()
      emitter.on('refreshByFilter', (data) => {
        currentPage.value = 1
        search.value = data.search ?? ''
        month.value = data.month-1
        getTransactions()
      })

    })
    return {
      moment,
      loading,
      transactions,
      icons,
      lines,
      imgTransaction,
      numberFormat,
      colorTextByTrasaction,
      goTo,
      currentPage,
      lastPage,
      setPage,
    }
  },
}
</script>
<style lang="scss" >
  .transactionList{
    height: 75%;
  }
  .icons-transfer {
    transform:scale(0.9);
  }
  .transfer-icon-t {

    transform: scale(0.9) rotate(310deg)!important;
    &.fill-red path{
      fill: red;
      stroke: red;
    }
  }
  .bottom-border {
    border-bottom: 1px solid;
    border-image-slice: 1;
    border-image-source: linear-gradient(90deg, rgba(255,255,255,1) 6%, $grey-5 6%);
  }
  @media screen and (max-width: 780px){
    .icons-transfer {
      transform:scale(0.7);
    }
    .transfer-icon-t {

    transform:scale(0.7) rotate(310deg)!important;

    }
    .bottom-border {
      border-image-source: linear-gradient(90deg, rgba(255,255,255,1) 11%, $grey-5 11%);
    }
  }

</style>
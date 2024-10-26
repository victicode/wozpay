<template>
  <div class="q-pt-md ">
    <div v-if="!loading && Object.values(transactions).length > 0">
      <div v-for="(transaction, key) in transactions" :key="key">
        <div>
          <div>

          </div>
          <div>

            <div v-for="(line, index) in lines(transaction)" :key="index">
              {{ line }}
            </div>
          </div>
          <div>

          </div>
        </div>
      </div>
    </div>
    <div v-if="!loading && Object.values(transactions).length == 0" class="flex flex-center column q-pt-xl">
      <q-icon :name="icons.ionRepeatOutline" color="terciary" size="10rem" class="q-mt-md" style="transform:rotate(50deg) ;" />
      <div class="text-h6 text-weight-medium">
        Sin transacciones
      </div>
    </div>
    <div v-if="loading">
      <div class="text-center">
        Cargando....
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

export default {
  setup () {
    const icons = inject('ionIcons')
    const emitter = inject('emitter');
    const { user  } = storeToRefs(useAuthStore())
    const transactions = ref([])
    const transactionStore = useTransactionStore()
    const numberFormat = util.numberFormat
    const search = ref('')
    const month = ref(new Date().getMonth())
    const loading = ref(true)
    const currentPage = ref(1)
    const getTransaction = () => {
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
        transactions.value = response.data
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
      
      if(transaction.transaction == 2)  return { title:'Realizaste un pago de prestamo', text: transaction.concept }
      if(transaction.transaction == 2)  return { title:'Realizaste un pago de prestamo', text: transaction.concept }
      if(transaction.transaction == 2)  return { title:'Realizaste un pago de prestamo', text: transaction.concept }
      if(transaction.transaction == 4)  return { title:'Recibiste una transferencia de', second: transaction.user_to.user.name, text: transaction.concept }
      if(transaction.transaction == 2)  return { title:'Realizaste un pago de prestamo', second: transaction.user_from.user.name, text: transaction.concept }


    }
    onMounted(() => {
      getTransaction()
      emitter.on('refreshByFilter', (data) => {
        currentPage.value = 1
        search.value = data.search ?? ''
        month.value = data.month
        getTransaction()
      })

    })
    return {
      loading,
      transactions,
      icons,
      lines,
    }
  },
}
</script>
<style lang="scss">

</style>
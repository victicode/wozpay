<template>
  <div>
    <div class="q-px-md q-mt-lg q-px-md-xl" v-if="loading">
      <div class="recipe__card bg-white q-py-md  ">
        <div class="recipe__card--header flex-center flex  q-pa-md  ">
          <div 
            class="viewTransaction__icon"
            v-html="imgByType()"
            :class="{
              'viewTransaction__icon--transfer': transactionType == 4 , 
              'viewTransaction__icon--transfer fill-red': transactionType == 5
            }"
          />
        </div>
        <div class="">
          <div class="q-pt-none q-mt-sm q-pb-sm" v-for="(items, key) in transactionFormat " :key="key"  :class="{'recipe__list': key != 4}">
            <div 
              class="q-pl-xs q-mt-xs" 
              :class="{ 
                'text-weight-bold text-subtitle1 text-grey-10': index == 'title',
                'text-weight-medium text-caption text-grey-10': index == 'text',
                'text-primary text-weight-bold  text-subtitle2': index == 'value',
                'text-grey-7 text-weight-medium text-caption': index == 'date' || index == 'hour',
              }" 
             v-for="(lines, index) in items" :key="index"> 
              {{ lines }}
            </div>

          </div>
    
        </div>
        <div class="q-px-md-xl q-mb-md">
          <div class="q-pt-sm">
            <div class="q-px-none q-mt-lg q-px-md-none">
              <a :href="url+'api/transaction/print/' + transactionType+'/'+transaction.id+'?token='+token"  target="_blank" rel="noopener noreferrer">

                <q-btn 
                  color="negative" class="w-100 q-pa-md donwload" 
                  no-caps
                >
                  <div class="flex flex-center">
                    <div class="q-mr-xs q-mt-xs">
                      Descargar
                    </div>
                    <div v-html="wozIcons.pdf" />
                  </div>
                </q-btn>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script >
  import { inject } from 'vue';
  import { useRoute, useRouter } from 'vue-router';
  import wozIcons from '@/assets/icons/wozIcons'
  import { useQuasar } from 'quasar';
  import { useTransactionStore } from '@/services/store/transaction.store'
  import util from '@/util/numberUtil'
  import moment from 'moment';
  export default {
    setup () {
      //vue provider
      const icons = inject('ionIcons')
      const route = useRoute();
      const router = useRouter();
      const $q = useQuasar()
      const transactionType = route.params.type 
      const id = route.params.id 
      const loading = ref(false)
      const storeTransaction = useTransactionStore()
      const transaction = ref({})
      const transactionFormat = ref([])
      const numberFormat = util.numberFormat

      const lines = () => {
        const lines = []
        lines[0] = {
          title:'Monto',
          text:'Cantidad de dinero en Guaranies',
          value:numberFormat(transaction.value.amount)
        }
        
        if(transactionType == 1) {
          lines[1] = {
            title: 'Carga de saldo',
            text:  'Titular Woz Pay',
            value: transaction.value.user.name,
          }
          lines[2] = {
            title: 'Caja de ahorro N°',
            text:  'Documento de identificación',
            value: '916-'+transaction.value.user.dni,
          }
          lines[3] = {
            title: 'Referencia',
            text:  'Referencia de transacción',
            value: transaction.value.operation_id,
          }
        }

        if(transactionType == 2 || transactionType == 3) {
          lines[1] = {
            title: 'Pago de prestamo',
            text:  transaction.value.concept,
          }
          lines[2] = {
            title: 'Tipo de pago',
            text:  transactionType == 3 ? 'Transeferencia' : 'Tarjeta mediante Tpago',
          }
          lines[3] = {
            title: 'Referencia',
            text:  'Referencia de prestamo',
            value: '619-'+transaction.value.loan.loan_number,
          }
        }

        if(transactionType == 4 || transactionType == 5)  {
          lines[1] = {
            title: transactionType == 4 ? 'Recibido de' : 'Enviado a',
            text:  'Titular Woz Pay',
            value: transactionType == 4 ? transaction.value.user_from.user.name : transaction.value.user_to.user.name,

          }
          lines[2] = {
            title: 'Documentación',
            text:  'Documento de identificación',
            value: transactionType == 4 ? numberFormat(transaction.value.user_from.user.dni) : numberFormat(transaction.value.user_to.user.dni),

          }
          lines[3] = {
            title: 'Concepto',
            text:  'Motivo del envío',
            value: transaction.value.concept,
          }
        }

        if(transactionType == 6)  {
          lines[1] = {
            title:'Debito automatico',
            text:'Woz Payments',
          }
          lines[2] = {
            title:'Tipo de debito',
            text: transaction.value.user.card.type ==  1 ? 'Debito tarjeta de crédito' : 'Debito tarjeta de débito',
          }
          lines[3] = {
            title:'Referencia',
            text:'619 5556668745',
          }
        }

        lines.push({
          date: moment(transaction.value.created_at).format('DD/MM/YYYY'),
          hour: moment(transaction.value.created_at).format('hh:mm') + ' hs',
        })

        console.log(lines)
        return  lines
      }
      const imgByType = () => {
        if(transactionType == 1)  return wozIcons.cargar
        if(transactionType == 2 || transactionType == 3)  return wozIcons.cashOutline
        if(transactionType == 4 || transactionType == 5)  return wozIcons.transferir
        if(transactionType == 6)  return wozIcons.cardOutline
      }
      const getTransaction = () => {
        storeTransaction.getTrasactionByData(transactionType, id)
        .then((data) => {
          transaction.value = data.data
          transactionFormat.value = lines()
          loading.value = true
        })
      }
      onMounted(()=>{
        getTransaction()
      })
      return {
        icons,
        loading,
        router,
        route,
        wozIcons,
        transactionFormat,
        imgByType,
        transactionType,
        transaction,
        url:import.meta.env.VITE_VUE_APP_BACKEND_URL,
        token: localStorage.getItem('id_token')
      }
    }
  };
</script>
<style lang="scss" scoped>
.viewTransaction__icon{
  transform: scale(1.7);
  width: max-content;
  
}

.donwload {
  border-radius: 15px!important;
}
.back__to  {
  border-radius: 50px!important;
}
.w-100{
  width: 100%;
}
.w-50 {
  width: 50%;
}
.recipe__card {
  border-radius: 20px;

}
.recipe__list{
  border-bottom: 1px solid $grey-5;
}
.boxNoVisible {
  width: 72px;
  height: 72px;
  visibility: hidden;
}
.h-100{
  height: 100%;
}
#topbarLayout{
  height: 10%;
  width: 100%;
  // border-bottom: 1px solid lightgray;
}
</style>

<style lang="scss">
.viewTransaction__icon.viewTransaction__icon--transfer{
    transform: scale(1.7) rotate(310deg)!important;
    &.fill-red path{
      fill: red;
      stroke: red;
    }
  }
</style>
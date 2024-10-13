<template>
  <div v-if="Object.values(loan).length > 0 && ready"  class="h-100 o-hide">
    <div class="header_loan q-pb-md q-pt-lg q-px-md-lg q-px-md flex justify-between items-center">
      <div class="">
        <div class="text-subtitle1 text-weight-medium">
          {{ loan.user.name }}
        </div>
        <div class="text-subtitle1 text-weight-medium">
          {{ numberFormat(loan.user.dni) }}
        </div>
      </div>
      <div>
        <q-icon 
          name="eva-alert-triangle-outline" 
          size="md" 
          class="q-mr-xs" 
          :color="slowPayerLegend[setDueDaysCategorie(loan.days_due)]" 
        />
      </div>
    </div>
    <div class="quota">
      <div class="q-px-md-lg q-px-md q-mt-lg">
        <div class="amount_loan flex justify-between items-center q-pb-sm">
          <div class="text-subtitle1 text-weight-bold">
            Su préstamo
          </div>
          <div class="text-subtitle1 text-weight-bold">
            Gs. {{ numberFormat(loan.amount) }}
        </div>
        </div>
      </div>
      <div class="q-px-md-lg q-px-md q-mt-md ">
        <div class="text-subtitle1 text-center text-weight-bold q-mt-lg">
          Cuotas
        </div>
        <div class="q-mt-sm q-mb-lg" v-for="(quota, n) in loan.quotas_desc " :key="n">
          <div class="flex justify-between">
            <div class="text-subtitle1 text-bold" >
              Cuota {{ n+1 }} de {{ loan.quotas }}
            </div>
            <div v-if="quota.success_pays">
              <q-btn square color="primary" label="Ver pago" :icon="icons.outlinedReceiptLong" size="sm"  @click="setPay(quota.success_pays)"/>
            </div>
          </div>
          <div class="q-mt-sm" >
            <div class="text-subtitle2 flex justify-between cuotas_items q-py-md">
              <div>
                Vencimiento {{ moment(quota.due_date).format('DD/MM/YYYY') }}
              </div>
              <div>
                Gs. {{ quota.days_due > 1 ? numberFormat(amountWithDelayFee(quota)) : numberFormat(quota.amount)  }}
              </div>
            </div>
            <div class="text-subtitle2 flex justify-between cuotas_items q-py-md">
              <div>
                Días atrasados
              </div>
              <div>
                {{ quota.days_due }} días
              </div>
            </div>
            <div class="text-subtitle2 flex justify-between cuotas_items q-py-md">
              <div>
                Interes por mora
              </div>
              <div>
                {{ numberFormat(loan.interest_for_delay)}}%
              </div>
            </div>
            <div class="text-subtitle2 flex justify-between cuotas_items q-py-md">
              <div>
                Total a pagar
              </div>
              <div>
                Gs. {{ quota.days_due > 1 ? numberFormat(amountWithDelayFee(quota)) : numberFormat(quota.amount)  }}
              </div>
            </div>
            <div class="text-subtitle2 flex justify-between cuotas_items items-center q-py-md">
              <div>
                Estado de pago
              </div>
              <div v-if="!quota.success_pays">
                <q-chip :color="!quota.success_pays && quota.days_due < 1  ? 'positive' : !quota.success_pays && quota.days_due > 1  ? 'negative' : ''" text-color="white" >
                  {{
                    !quota.success_pays && quota.days_due > 1 
                    ? 'Atrasado'  
                    :!quota.success_pays && quota.days_due < 1 
                    ? 'Solvente'
                    :''
                  }}
                </q-chip>
                
              </div>
              <div v-else>
                <q-chip :color="quota.success_pays.status == '2'  ? 'positive' : quota.success_pays.status == '1'  ? 'warning' : 'negative'" text-color="white" >
                  {{ 
                    quota.success_pays.status == '2' 
                    ? 'Pagado' 
                    : quota.success_pays.status == '1' 
                    ? 'Pendiente' 
                    : 'Atrasado' 
                  }}
                </q-chip>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <paysVerification :paySelected="selectedPay" :dialog="dialog" @hiddeModal="hiddeModal" />

  </div>
</template>
<script>
  import { ref, inject, onMounted } from 'vue';
  import { useLoanStore } from '@/services/store/loan.store'
  import { useQuasar } from 'quasar'
  import { useRoute } from 'vue-router';
  import util from '@/util/numberUtil'
  import moment from 'moment';
  import paysVerification from '@/components/admin/pays/paysVerification.vue';


  export default {
    components: {
      paysVerification,
    },
    setup () {
      const q = useQuasar()
      const loanStore = useLoanStore();
      const numberFormat = util.numberFormat
      const icons = inject('ionIcons')
      // Data
      const selectedPay = ref({})
      const dialog = ref(false)
      const loan = ref({})
      const route = useRoute()
      const document = ref('');
      const ready = ref(false)
      const slowPayerLegend = [
        'primary',
        'terciary',
        'negative',
      ]
      // Methods
      const showNotify = (type, message) => {
        q.notify({
          message: message,
          color: type,
          actions: [
            { icon: 'eva-close-outline', color: 'white', round: true, handler: () => { /* ... */ } }
          ]
        })
      }

      const showModal = () => {
        dialog.value = true
      }
      const hiddeModal = () => {
        dialog.value = false
        activeLoan()
      }
      const setDocument = (doc) => {
        document.value = doc
        showModal()
      }
      const activeLoan = () => {
        loanStore.getLoanById(route.params.id).then((data) => {
          if(!data.code)  throw data
          loan.value = data.data
          loan.value.red_tapes.ips = (loan.value.red_tapes.ips == 1)
          loan.value.amountQuota = amountQuote()
          ready.value = true
        }).catch((e) => {
          showNotify('negative', 'error al obtener prestamo activo')
        })
      }

      const setDueDaysCategorie = (days) => {
        if(!days) return 0
        if(days <= 2 ) return 0
        if(days >= 3 && days <= 5) return 1
        if(days >= 6) return 2
      }
      const amountQuote = () => {
        return loan.value.amount_to_pay/parseInt(loan.value.quotas)
      }
      const amountWithDelayFee = (quota) => {
        if(quota.success_pays) return quota.success_pays.amount

        return (((quota.amount * loan.value.interest_for_delay)/100) + quota.amount)
      }
      const setPay = (pay) =>{
        selectedPay.value = pay
        dialog.value = true
      }
      onMounted(() => {
        activeLoan()
      })

      return {
        icons,
        ready,
        loan,
        dialog,
        numberFormat,
        document,
        slowPayerLegend,
        moment,
        selectedPay,
        setDocument,
        hiddeModal,
        setDueDaysCategorie,
        amountWithDelayFee,
        setPay,
      }
    }
  };
</script>
<style lang="scss" scoped>
.quota{
  height: 85%; 
  overflow: auto;
}
.o-hide{
  overflow: hidden;
}
.h-100 {
  height: 100%;
}
.header_loan{
  background: $grey-4;
}
.amount_loan{
  border-bottom: 1px solid $grey-5;
}
.cuotas_items {
  border-bottom: 1px solid $grey-7 ;
}
</style>


<template>
  <div class="q-pt-md q-px-md q-pb-sm">
    <div >
      <div class="text-subtitle1 text-weight-medium">Cuotas</div>
    </div>
    <div class="row q-px-none q-mt-sm" >
      <div v-for="(quota, n) in loan.quotas_desc " :key="n" class="flex justify-between w-100 items-center q-mb-sm q-pb-xs quota_content" @click="getPay(quota)">
        <div>
          <div class="text-weight-medium">
            Cuota {{ n+1 }} de {{ loan.quotas }}
          </div>
          <div class="text-weight-medium text-grey-6">
            Vencimiento {{ moment(quota.due_date).format('DD/MM/YYYY') }}
          </div>
        </div>
        <div class="flex items-center">
          <div class="text-weight-medium text-body1 q-mt-xs ">
            Gs. {{ quota.days_due > 1 || quota.status == 3 ? numberFormat(isPayWithDelay(quota)) : numberFormat(quota.amount) }}
          </div>
          <div>
            <q-icon 
              v-if="quota.days_due > 1 && !quota.success_pays"
              class="q-ml-xs" 
              name="eva-alert-circle-outline"
              color="negative"  
              size="sm" 
              @click="showNotify( 'negative', 'Tu pago se encuentra vencido.' )"
            />
            <q-icon 
              v-if="quota.success_pays"
              class="q-ml-xs q-mt-xs" 
              :name=" quota.success_pays.status == 0 ? 'eva-alert-circle-outline' : quota.success_pays.status == 1 ? 'eva-clock-outline'  : 'eva-checkmark-circle-2-outline'" 
              :color=" quota.success_pays.status == 0 ? 'negative' : quota.success_pays.status == 1 ? 'yellow-8'  : 'green-5'"  
              size="sm" 
              @click="showNotify(
                quota.success_pays.status == 0 
                ? 'negative'
                : quota.success_pays.status == 1 
                ? 'yellow-9'
                : 'positive'
                , 
                quota.success_pays.status == 0 
                  ? 'Tu pago fue rechazado, vuelve a intentar.' 
                  : quota.success_pays.status == 1 
                  ? 'Tú pago esta siendo verificado.' 
                  : 'Tú pago fue exitoso.')"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import { useQuasar } from 'quasar'
  import wozIcons from '@/assets/icons/wozIcons'
  import util from '@/util/numberUtil'
  import moment from 'moment';
  import { ref } from 'vue';

  export default {
    props: {
      loan: Object,
    },
    emits: ['getPay'],
    setup (props, { emit }) {
      //vue provider
      const numberFormat  = util.numberFormat
      const $q = useQuasar();
      // Data
      const loan = ref(props.loan)
      // Methods
      const forPay = () => {
        let amount = 0

        loan.value.pays.forEach(pay => {
          amount += pay.amount
        });

        // return loan.value.amount_to_pay - amount
        return loan.value.amount - amount
      }
      const isPayWithDelay = (quota) => {
        if(quota.success_pays) return quota.success_pays.amount
        return (((quota.amount * loan.value.interest_for_delay)/100) + quota.amount)
      }
      const showNotify = (type, message) => {
        $q.notify({
          message: message,
          color: type,
          actions: [
            { icon: 'eva-close-outline', color: 'white', round: true, handler: () => { /* ... */ } }
          ]
        })
      }
      const getPay = (pay) => {
        if(!pay.success_pays) return
        emit('getPay', pay)
      }

      watch(() => props.loan, (newValue) => {
        loan.value = newValue
      });
      return {
        loan,
        numberFormat,
        wozIcons,
        moment,
        forPay,
        showNotify,
        isPayWithDelay,
        getPay,
      }
    }
  };
</script>
<style lang="scss" scoped>
.w-100 {
  width: 100%;
}
.q-pa-7{
  padding: 13px 13px;
}
.loan_card{
  border-radius: 15px;
  box-shadow: 0px 3px 6px 0px #aaaaaa
}
.loan_container{
  border-bottom: 1px solid #d3d3d3;
}
.quota_content{
  border-bottom: 1px solid $grey-5;
}
</style>
<style lang="scss">
.loan_progress {
  border-radius: 155px!important;
  border: 1px solid $positive;

  & .q-linear-progress__track{
    opacity: 1;
    border-radius: 155px!important;
  }
  & .q-linear-progress__model {
    border-radius: 155px!important;
  }
}
</style>
<template>
  <div class="q-pt-md q-px-md q-pb-sm">
    <div class="flex justify-between items-center">
      <div>
        <div class="text-subtitle1 text-weight-medium">Préstamo</div>
        <div class="text-subtitle1 text-weight-bold">N° 619{{ loan.loan_number }}</div>
      </div>
      <div class="">
        <div class="text-subtitle1 text-weight-medium">Total a pagar</div>
        <div class="text-subtitle1 text-weight-bold">Gs. {{ numberFormat(loan.amount_to_pay) }}</div>
      </div>
    </div>
    <div class="row q-px-none q-mt-sm">
      <div class="col-12 bg-white q-pa-7 flex items-center justify-between  loan_card" style="" >
        <div class="">
          <div class="text-weight-medium text-body2">Capital prestado</div>
          <div class="text-weight-medium text-body2">Gs. {{ numberFormat(loan.amount) }}</div>
        </div>
        <div class="">
          <div class="text-weight-medium text-body2">Falta pagar</div>
          <div class="text-weight-medium text-body2">Gs. {{ numberFormat(forPay()) }}</div>
        </div>
      </div>
    </div>
    <div class="q-mt-sm q-pt-xs">
      <q-linear-progress 
        class="q-mt-sm w-100"
        :class="isPendingPay().pending ? 'loan_progress_pending' : 'loan_progress'" 
        rounded size="15px"  
        :value="progressByStatus().linear" 
        :color="isPendingPay().pending ? 'terciary' : 'positive'" 
        track-color="white" 
      />
      <div class="q-mt-sm text-body2">
        Pagado: {{progressByStatus().count}}/{{ loan.quotas }} {{ isPendingPay().pending ? `(${isPendingPay().count} pago pendiente)` : ''}} 
      </div>
    </div>
  </div>
</template>
<script>
  import wozIcons from '@/assets/icons/wozIcons'
  import util from '@/util/numberUtil'
  
  export default {
    props: {
      loan: Object,
    },
    setup (props) {
      const numberFormat  = util.numberFormat

      // Data
      const loading = ref(false);
      const loan = props.loan
      

      // Methods
      const forPay = () => {
        let amount = 0

        loan.pays.forEach(pay => {
          amount += pay.amount
        });

        return loan.amount_to_pay - amount
      }
      const isPendingPay = () => {
        let isPending = {
          count: 0,
          pending: false
        };

        loan.pays.forEach((pay) => {
          if(pay.status == 1) {
            isPending.pending = true
            isPending.count++;
          }
        })

        return isPending
      }
      const progressByStatus = () => {
        let goodPays = 0;

        loan.pays.forEach((pay) => {
          if(pay.status != 0) {
            goodPays++
          }
        })
        return {
          linear: goodPays/loan.quotas,
          count: goodPays,
        }
      }

      return {
        loan,
        numberFormat,
        wozIcons,
        forPay,
        isPendingPay,
        progressByStatus,
      }
    }
  };
</script>
<style lang="scss" scoped>
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
.loan_progress_pending {
  border-radius: 155px!important;
  border: 1px solid #ffc701;

  & .q-linear-progress__track{
    opacity: 1;
    border-radius: 155px!important;
  }
  & .q-linear-progress__model {
    border-radius: 155px!important;
  }
}
</style>
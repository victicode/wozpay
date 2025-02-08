<template>
  <div class="q-py-sm q-px-md q-px-md-lg" >
    <div class=" q-pb-sm" >
      <div class="row">
        <div class="col-12 flex items-center justify-between">
          <div class="text-subtitle1 q-mt-sm text-dark text-weight-bold" v-if="balances"> 
            Saldos
          </div>
        </div>
      </div>
    </div>
    <div style="" class="q-mb-sm">
      <div class="quote-section" v-if="balances" >
        <div class="row q-px-none">
          <div class="col-12 bg-white q-pa-md flex items-center justify-between justify-md-start loan_card" style="" >
            <div>
              <div v-html="wozIcons.withdrawal" />
            </div>
            <div class="flex items-center justify-between  w-80 ">
              <div class=" q-mr-md-none q-pl-md-md q-pl-sm w-50">
                <div class="text-weight-medium">Capital restante</div>
                <div class="text-weight-medium text-grey-8 q-mt-xs ">Saldo restante</div>
              </div>
              <div class="q-ml-md q-ml-md-none q-pl-md-md w-50 text-end">
                <div class="text-weight-medium text-right">
                  Disponible
                </div>
                <div class="text-weight-medium q-mt-xs text-right">Gs. {{numberFormat((balances.wallet + balances.paysRecieve - balances.loans))}}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="quote-section" v-else>
        <div class="row q-px-none">
          <div class="col-12 bg-white q-pa-md flex items-center justify-between justify-md-start loan_card" style="" >
            <div style="" class="w-10">
              <!-- <div v-html="wozIcons.withdrawal" /> -->
              <q-skeleton type="rect"  />
            </div>
            <div class="flex items-center justify-between  w-80 ">
              <div class=" q-mx-sm  w-50">
                <div class="text-weight-medium"><q-skeleton type="rect" /></div>
                <div class="text-weight-bold q-mt-xs"><q-skeleton type="rect" /></div>
              </div>
              <div class="q-mx-sm w-50 text-end">
                <div class="text-weight-medium text-right"><q-skeleton type="rect" /></div>
                <div class="text-weight-medium q-mt-xs text-right"><q-skeleton type="rect" /></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import { useWalletStore } from '@/services/store/wallet.store'
  import { storeToRefs } from 'pinia'
  import util from '@/util/numberUtil'
  import { inject, ref } from 'vue'
  import wozIcons from '@/assets/icons/wozIcons';

  export default {
    setup() {
      //vue provider
      const { balances } = storeToRefs(useWalletStore())
      // const balances = useWalletStore().balances;
      const icons = inject('ionIcons')
      const numberFormat = util.numberFormat
      const isReady = ref(false)


      // Data
      return{
        icons,
        numberFormat,
        isReady,
        wozIcons,
        balances,
      }
    },
  }

</script>
<style lang="scss" scoped>
.loan_card{
  border-radius:23px;
  //box-shadow: 0px 5px 5px 0px #aaaaaa
}
.loan_container{
  border-bottom: 1px solid #d3d3d3;
}
.w-80 {
  width: 94%;
}
.w-50 {
  width: 46%;
}
.w-10 {
  width: 6%;
}
@media screen and (max-width: 780px){
  .w-80 {
    width: 40%;
  }
  .w-50 {
    width: 40%;
  }
  .loan_card > div:nth-child(1){ width: 10%!important; }
  .loan_card > div:nth-child(2){ width: 90%!important; }

}
</style>
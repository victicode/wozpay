<template>
  <div>
    <div class="q-py-sm q-px-md q-px-md-lg" v-if="balances" >
      <div class=" q-pb-sm" >
        <div class="row">
          <div class="col-12 flex items-center justify-between">
            <div class="text-subtitle1 q-mt-sm text-dark text-weight-bold">Capital</div>
          </div>
        </div>
      </div>
      <div>
        <div class="quote-section">
          <div class="row q-px-none">
            <div class="col-12 bg-white q-pa-md  flex items-center justify-between justify-md-start loan_card" style="" >
              <div class="w-100 flex items-center justify-between q-pb-sm"  style="border-bottom: 1px solid lightgrey" >
                <div class="flex items-center w-80 ">
                  <div class="q-mr-sm q-mt-xs">
                    <q-icon :name="icons.outlinedAddCard" class="" size="sm" />
                  </div>
                  <div class=" q-ml-xs q-mr-md q-mr-md-none q-pl-md-md">
                  <div class="text-weight-medium"> Capital inicial</div>
                    <div class="text-weight-medium text-grey-8 ">Monto de arranque</div>
                  </div>
                </div>             
                <div class="q-mr-sm text-end">
                  <div class="text-weight-medium text-right">Disponible</div>
                  <div class="text-weight-medium  text-right">Gs. {{numberFormat(balances.wallet)}}</div>
                </div>
              </div>
              <div class="w-100 flex items-center justify-between q-mt-sm q-pt-xs q-pb-sm" style="border-bottom: 1px solid lightgrey" >
                <div class="flex items-center   w-80 ">
                  <div class="q-mr-sm q-mt-xs">
                    <q-icon :name="icons.outlinedAccountBalance" class="" size="sm" />
                  </div>
                  <div class=" q-ml-xs q-mr-md q-mr-md-none q-pl-md-md">
                    <div class="text-weight-medium">Capital prestado</div>
                    <div class="text-weight-medium text-grey-8 ">Solicitudes aprobadas</div>
                  </div>
                </div>
                <div class="q-mr-sm text-end">
                  <div class="text-weight-medium text-right">Monto</div>
                  <div class="text-weight-medium  text-right">Gs. {{numberFormat(balances.loans)}}</div>
                </div>
                
              </div>
              <div class="w-100 flex items-center justify-between q-mt-sm q-pt-xs q-pb-sm" style="border-bottom: 1px solid lightgrey" >
                <div class="flex items-center w-80 ">
                  <div class="q-mr-sm q-mt-xs">
                    <q-icon :name="icons.outlinedAddCard" class="" size="sm" />
                  </div>
                  <div class=" q-ml-xs q-mr-md q-mr-md-none q-pl-md-md">
                  <div class="text-weight-medium">Capital a recibir</div>
                    <div class="text-weight-medium text-grey-8 ">Intereses ganados</div>
                  </div>
                </div>             
                <div class="q-mr-sm text-end">
                  <div class="text-weight-medium text-right">Recibirás</div>
                  <div class="text-weight-medium  text-right">Gs. {{numberFormat(balances.toRecieve)}}</div>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
    <div class="q-py-sm q-px-md q-px-md-lg" v-else>
      <div class="row q-px-none">
        <div class="col-12 bg-white q-pa-md flex items-center justify-between justify-md-start loan_card" style="" >
          <div class="w-100 flex flex items-center">
            <div style="" class="w-10">
              <!-- <div v-html="wozIcons.withdrawal" /> -->
              <q-skeleton type="rect"  />
            </div>
            <div class="flex items-center justify-between  w-80-load">
              <div class=" q-mx-sm  w-50-load">
                <div class="text-weight-medium"><q-skeleton type="rect" /></div>
                <div class="text-weight-bold q-mt-xs"><q-skeleton type="rect" /></div>
              </div>
            </div>
            <div class="w-10">
              <q-skeleton type="rect"  />
              <q-skeleton type="rect" class="q-mt-xs" />
            </div>
          </div>
          <div class="w-100 flex flex items-center q-mt-md">
            <div style="" class="w-10">
              <!-- <div v-html="wozIcons.withdrawal" /> -->
              <q-skeleton type="rect"  />
            </div>
            <div class="flex items-center justify-between  w-80-load ">
              <div class=" q-mx-sm  w-50-load">
                <div class="text-weight-medium"><q-skeleton type="rect" /></div>
                <div class="text-weight-bold q-mt-xs"><q-skeleton type="rect" /></div>
              </div>
            </div>
            <div class="w-10">
              <q-skeleton type="rect"  />
              <q-skeleton type="rect" class="q-mt-xs" />
            </div>
          </div>
          <div class="w-100 flex flex items-center q-mt-md">
            <div style="" class="w-10">
              <!-- <div v-html="wozIcons.withdrawal" /> -->
              <q-skeleton type="rect"  />
            </div>
            <div class="flex items-center justify-between  w-80-load">
              <div class=" q-mx-sm  w-50-load">
                <div class="text-weight-medium"><q-skeleton type="rect" /></div>
                <div class="text-weight-bold q-mt-xs"><q-skeleton type="rect" /></div>
              </div>
            </div>
            <div class="w-10">
              <q-skeleton type="rect"  />
              <q-skeleton type="rect" class="q-mt-xs" />
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
</template>
<script>
  import { useAuthStore } from '@/services/store/auth.store'
  import { useWalletStore } from '@/services/store/wallet.store'
  import { storeToRefs } from 'pinia'
  import { inject, ref } from 'vue'
  import { useQuasar } from 'quasar';
  import util from '@/util/numberUtil'

  export default {
    setup() {
      //vue provider
      const user = useAuthStore().user;
      const icons = inject('ionIcons')
      const q = useQuasar();
      const numberFormat = util.numberFormat 
      const ready = ref(false)

      const { balances } = storeToRefs(useWalletStore())
      // const balances = useWalletStore().balances;


      const showNotify = (type, message) => {
        q.notify({
          message: message,
          color: type,
          actions: [
            { icon: 'eva-close-outline', color: 'white', round: true, handler: () => { /* ... */ } }
          ]
        })
      }
      
      // Data
      return{
        icons,
        user,
        ready,
        numberFormat,
        balances,
      }
    },
  }

</script>

<style lang="scss">
.w-100 {
  width: 100%!important;
}



</style>
<style lang="scss" scoped>
.loan_card{
  border-radius:23px;
  box-shadow: 0px 5px 5px 0px #aaaaaa
}
.loan_container{
  border-bottom: 1px solid #d3d3d3;
}
.quote_description {
  font-size: 12px; 
  color:lightgray ; 
}
.quote_container{
  border-bottom: 1px solid #d3d3d3;
}
.quote-section::-webkit-scrollbar {
    display: none;
}
.w-80 {
  width: 80%;
}
.w-50 {
  width: 50%;
}
.w-10 {
  width: 10%;
}
.w-80-load {
  width: 80%;
}
.w-50-load {
  width: 50%;
}
@media screen and (max-width: 780px){
  .w-50-load {
    width: 50%;
  }
  .w-80-load {
    width: 80%;
  }
  .w-80 {
    width: auto;
  }
  .w-50 {
    width: auto;
  }
}
</style>
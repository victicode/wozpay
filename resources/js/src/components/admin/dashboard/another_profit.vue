<template>
  <div class="q-py-sm q-px-md q-px-md-lg" >
    <div class=" q-pb-sm" >
      <div class="row">
        <div class="col-12 flex items-center justify-between">
          <div class="text-subtitle1 q-mt-sm text-dark text-weight-bold" v-if="isReady"> 
            Otras gananicas
          </div>
        </div>
      </div>
    </div>
    <div style="" class="q-mb-sm">
      <div class="quote-section" v-if="isReady" >
        <div class="row q-px-none">
          <div class="col-12 bg-white q-pa-md flex items-center justify-between justify-md-start loan_card" style="" >
            <div>
              <div v-html="wozIcons.withdrawal" />
            </div>
            <div class="flex items-center justify-between  w-80 ">
              <div class=" q-mr-md-none q-pl-md-md q-pl-sm w-50">
                <div class="text-weight-medium">Suscripciones</div>
                <div class="text-weight-medium text-grey-8 q-mt-xs ">Debito automático</div>
              </div>
              <div class="q-ml-md q-ml-md-none q-pl-md-md w-50 text-end">
                <div class="text-weight-medium text-right">
                  Recibiste
                </div>
                <div class="text-weight-medium q-mt-xs text-right text-light-green-14">Gs. {{numberFormat(user.wallet.balance)}}</div>
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
  import { useAuthStore } from '@/services/store/auth.store'
  import util from '@/util/numberUtil'
  import { inject, ref, onMounted } from 'vue'
  import sadFace from '@/assets/images/sadFace.svg'
  import wozIcons from '@/assets/icons/wozIcons';
  import { useLoanStore } from '@/services/store/loan.store';
  import { useQuasar } from 'quasar';
  import { useRouter } from 'vue-router'
import balance from '@/components/admin/dashboard/balance.vue';

  export default {
    setup() {
      //vue provider
      const q = useQuasar()
      const user = useAuthStore().user;
      const icons = inject('ionIcons')
      const numberFormat = util.numberFormat
      const isReady = ref(false)
      const sadface = sadFace
      const loanStore = useLoanStore() 
      const loan = ref({}) 
      const loading = ref(true);
      const router = useRouter()

      const activeLoan = () => {
        loanStore.getLoan(user.id).then((data) => {
          if(!data.code)  throw data
          loan.value = data.data ? Object.assign(data.data) : {} 
          
          loadingShow(false)
          setTimeout(() => {
            isReady.value = true
          },1000)
        }).catch((e) => {
          isReady.value = true

          showNotify('negative', 'error al obtener prestamo activo')
        })
      }
      const showNotify = (type, message) => {
        q.notify({
          message: message,
          color: type,
          actions: [
            { icon: 'eva-close-outline', color: 'white', round: true, handler: () => { /* ... */ } }
          ]
        })
      }
      const loadingShow = (state) => {
        loading.value = state;
      }
      const loanStatus = (state) => {
        const status = [
          {text:'Cancelado', color:'negative'},
          {text:'Pendiente', color:'warning'},
          {text:'Aprobando', color:'positive'},
          {text:'Pagado',    color:'positive'},
          {text:'No pagado', color:'warning'},
        ]
        return status[state]
      }
      onMounted(() => {
        activeLoan()
      })
      // Data
      return{
        icons,
        user,
        numberFormat,
        isReady,
        sadface,
        wozIcons,
        loan,
        router,
        loanStatus,
      }
    },
  }

</script>
<style lang="scss" scoped>
.loan_card{
  border-radius:23px;
  box-shadow: 0px 5px 5px 0px #aaaaaa
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
    width: 44%;
  }
  .loan_card > div:nth-child(1){ width: 10%!important; }
  .loan_card > div:nth-child(2){ width: 90%!important; }

}
</style>
<template>
  <div class="q-py-sm q-px-md q-px-md-lg" v-if="Object.values(loan).length > 0 && loan.status == 3" >
    <div class=" q-pb-sm" >
      <div class="row">
        <div class="col-12 flex items-center justify-between">
          <div class="text-subtitle1 q-mt-sm text-dark text-weight-bold" > 
            Pedi un Rekutu
          </div>
        </div>
      </div>
    </div>
    <div style="" class="q-mb-sm">
      <div class="quote-section" v-if="isReady">
        <div class="row q-px-none">
          <div class="col-12 bg-white q-pa-md flex items-center justify-between justify-md-start loan_card" style="" >
            <div>
              <q-icon :name="icons.ionRepeat" size="2.3rem" class="q-mt-xs"/>
            </div>
            <div class="flex items-center justify-between  w-80 ">
              <div class=" q-mr-md-none q-pl-md-md q-pl-sm" style="width: 60%;">
                <div class="text-weight-medium">Préstamo</div>
                <div class="text-weight-bold q-mt-xs">Sujeto a aprobación</div>
              </div>
              <div class=" q-ml-md-none q-pl-md-md  text-end" style="width: 40%;">
                <div class="text-weight-medium text-right">
                  Hasta
                </div>
                <div class="text-weight-medium q-mt-xs q-mr-xs text-right">Gs. {{numberFormat(1000000)}}</div>
              </div>
            </div>
            <div>
              <q-btn round flat class="q-ml-md-md" @click="router.push('/apply')"> 
                <q-icon
                  name="eva-arrow-ios-forward-outline"
                  size="xs"
                  color="black"
                  
                />
              </q-btn>
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
            <div class="w-10">
              <q-skeleton type="rect"  />
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
  import wozIcons from '@/assets/icons/wozIcons';
  import { useLoanStore } from '@/services/store/loan.store';
  import { useQuasar } from 'quasar';
  import { useRouter } from 'vue-router'

  export default {
    setup() {
      //vue provider
      const q = useQuasar()
      const user = useAuthStore().user;
      const icons = inject('ionIcons')
      const numberFormat = util.numberFormat
      const isReady = ref(false)
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
          }, 2000)
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
      onMounted(() => {
        activeLoan()
      })
      // Data
      return{
        icons,
        user,
        numberFormat,
        isReady,
        wozIcons,
        loan,
        router,
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
  width: 85%;
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
  .loan_card > div:nth-child(2){ width: 82%!important; }
  .loan_card > div:nth-child(3){ width: 8%!important; }

}
</style>
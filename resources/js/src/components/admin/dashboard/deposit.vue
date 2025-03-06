<template>
  <div>
    <div class="q-py-sm q-px-md q-px-md-lg" v-if="loading" >
      <div class=" q-pb-sm" >
        <div class="row">
          <div class="col-12 flex items-center justify-between">
            <div class="text-subtitle1 q-mt-sm text-dark text-weight-bold">Depositos pendientes</div>
          </div>
        </div>
      </div>
      <div>
        <div class="deposit-section">
          <div class="row q-px-none">
            <div class="col-12 bg-white q-px-md q-pb-sm q-pt-xs  flex items-center justify-between justify-md-start deposit_dashboard_card" style="" >
              <div @click="goTo" class="w-100 flex items-center justify-between q-py-sm"   :class="{'text-warning' : deposits > 0 }" 
                style=" cursor:pointer">
                <div class="flex items-center w-80D ">
                  <div class="q-mr-sm q-mt-xs">
                    <q-icon :name="icons.ionCashOutline" class="" size="sm" />
                  </div>
                  <div class=" q-ml-xs q-mr-md q-mr-md-none q-pl-md-md">
                    <div class="text-subtitle1"> Depositos pendientes </div>
                  </div>
                </div>             
                <div class="q-mr-sm text-end" >
                  <div class="text-weight-medium text-right">Total</div>
                  <div class="text-weight-medium text-right">{{deposits}}</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="q-py-sm q-px-md q-px-md-lg" v-else>
      <div class="row q-px-none">
        <div class="col-12 bg-white q-pa-md flex items-center justify-between justify-md-start deposit_dashboard_card" style="" >
          <div class="w-100 flex items-center">
            <div style="" class="w-10D">
              <!-- <div v-html="wozIcons.withdrawal" /> -->
              <q-skeleton type="rect"  />
            </div>
            <div class="flex items-center justify-between  w-80D-load">
              <div class=" q-mx-sm  w-50D-load">
                <div class="text-weight-medium"><q-skeleton type="rect" /></div>
                <div class="text-weight-bold q-mt-xs"><q-skeleton type="rect" /></div>
              </div>
            </div>
            <div class="w-10D">
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
  import { usePayStore } from '@/services/store/pay.store'
  import { inject, ref, onMounted } from 'vue'
  import util from '@/util/numberUtil'
  import { useRouter } from 'vue-router'
  import { storeToRefs } from 'pinia'

  export default {
    setup() {
      //vue provider
      const { user } = storeToRefs(useAuthStore());
      const loading = ref(false)
      const payStore = usePayStore()
      const icons = inject('ionIcons')
      const numberFormat = util.numberFormat
      const router = useRouter()
      const deposits = ref(0)
      const getPendingDeposits = () => {
        payStore.getPendingDeposits('count')
        .then((response) =>{
          if(response.code !== 200) throw response
          
          deposits.value = response.data

          setTimeout(() => {
            loading.value = true
          }, 500);
        })
        .catch((response) => {
          console.log(response)
        })
      }
      const goTo = (index)  => {
        router.push('/admin/depositPendingList/')
      }
      onMounted(() => {
        getPendingDeposits()
      })
      // Data
      return{
        icons,
        user,
        router,
        loading,
        numberFormat,
        deposits,
        goTo,
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
.deposit_dashboard_card{
  border-radius:23px;
  //box-shadow: 0px 5px 5px 0px #aaaaaa
}

.deposit-section::-webkit-scrollbar {
    display: none;
}
.w-80D {
  width: 80%;
}
.w-50D {
  width: 50%;
}
.w-10D {
  width: 10%;
}
.w-80D-load {
  width: 80%;
}
.w-50D-load {
  width: 50%;
}
@media screen and (max-width: 780px){
  .w-50D-load {
    width: 50%;
  }
  .w-80D-load {
    width: 80%;
  }
  .w-80D {
    width: auto;
  }
  .w-50D {
    width: auto;
  }
}
</style>
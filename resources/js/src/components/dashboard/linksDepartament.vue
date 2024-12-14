<template>
  <div>
    <div class="q-py-sm q-px-md q-px-md-lg" >
      <div class=" q-pb-sm" >
        <div class="row">
          <div class="col-12 flex items-center justify-between">
            <div class="text-subtitle1 q-mt-sm text-black-9 text-weight-bold">Cobros internacionales</div>
          </div>
        </div>
      </div>
      <div style="">
        <div class="quote-section">
          <div class="row q-px-none">
            <div class="col-12 bg-white q-pa-md  flex items-center justify-between justify-md-start loan_card" style="flex-wrap: nowrap;" >
              <div class="q-mr-none" style="margin-right: 0.15rem;">
                <!-- <div v-html="wozIcons.withdrawal" /> -->
                 <q-icon :name="icons.ionGlobeOutline" size="md" :color="!user.wallet_link ? 'grey-6' : user.walletLink.status = 1 ? 'warning': 'positive'" />
              </div>
              <div class="flex items-center justify-between  w-85 " >
                <div class=" q-mr-md-none q-pl-md-md q-pl- w-auto">
                  <div class="text-weight-medium ellipsis" style="font-size: 0.89rem;">Cuenta corriente internacional</div>
                  <!-- <div class="text-weight-bold q-pt-sm text-subtitle2"  v-if="Object.values(loan).length > 0 " >N° 619{{loan.loan_number}}</div> -->
                  <div class="q-mt-xs text-grey-8 text-weight-medium" style="font-size: 0.79rem;">Actívalo por 30 USD anual</div>
                </div>
                <div class="q-ml-sm q-ml-md-none q-pl-md-md  text-end" v-if="user.walletLink">
                  <div >
                    <div class="text-weight-medium text-right">
                      <q-chip class="q-ma-none q-px-lg" :color="loanStatus(loan.status).color" :text-color="loanStatus(loan.status).texColor" >
                        {{ loanStatus(loan.status).text }}
                      </q-chip>
                    </div>
                    <div class="text-weight-medium q-pt-xs q-mr-xs text-right text-subtitle1" style="">Gs. {{numberFormat(loan.amount)}}</div>
                  </div>
                </div>
                <div class="text-weight-bold text-subtitle2 q-pt-sm cursor-pointer q-ml-sm" @click="router.push('/link_activate')" v-else >Activar</div>
              </div>
              <div class="">
                <q-btn round flat class="q-ml-md-md q-pt-sm" @click="router.push('/link_activate')" size="xs"> 
                  <q-icon
                    name="eva-arrow-ios-forward-outline"
                    size="sm"
                    color="black"
                  />
                </q-btn>
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
  import { useCardStore } from '@/services/store/card.store'
  import { inject, onMounted, ref } from 'vue'
  import util from '@/util/numberUtil'
  import { useRouter } from 'vue-router'
  import { useQuasar } from 'quasar'
  import { storeToRefs } from 'pinia'
  import wozIcons from '@/assets/icons/wozIcons';

  export default {
    setup() {
      //vue provider

      const icons = inject('ionIcons')
      const ready = ref(false)
      const numberFormat = util.numberFormat
      const router = useRouter()
      const q = useQuasar()
      const { user  } = storeToRefs(useAuthStore())
      
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

      onMounted(() => {

      })
      // Data
      return{
        icons,
        user,
        router,
        ready,
        numberFormat,
        wozIcons
      }
    },
  }

</script>

<style lang="scss">
.w-100 {
  width: 100%!important;
}
.linked_section{
  height: 100%; 
  overflow: hidden; 
  border-top:10px solid lightgray; 
  border-bottom:10px solid lightgray;
}
.linked_description {
  font-size: 12px; 
  color:lightgray ; 
}
.linked_container{
  border-bottom: 1px solid #d3d3d3;
}

</style>
<style lang="scss" scoped>
.loan_card{
  border-radius:15px;
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
.w-85 {
  width: 85%;
}
.w-50 {
  width: 50%;
}

@media screen and (max-width: 780px){
  .w-85 {
    width: auto;
  }
  .w-50 {
    width: auto;
  }
}
</style>
<template>
  <div>
    <div class="q-py-sm q-px-md q-px-md-lg" >
      <!-- <div class=" q-pb-sm" >
        <div class="row">
          <div class="col-12 flex items-center justify-between">
            <div class="text-subtitle1 q-mt-sm text-black-9 text-weight-medium">Cobros internacionales</div>
          </div>
        </div>
      </div> -->
      <div style="">
        <div class="quote-section">
          <div class="row q-px-none">
            <div class="col-12 bg-white q-pa-md  flex items-center justify-between justify-md-start loan_card" style="flex-wrap: nowrap;" >
              <div class="q-mr-none" style="margin-right: 0.15rem;">
                 <q-icon :name="icons.ionGlobeOutline" size="md" :color="!user.wallet_link ? 'grey-6' : user.wallet_link.status == 1 ? 'warning': 'positive'" />
              </div>
              <div class="flex items-center justify-between  w-85 " >
                <div class=" q-mr-md-none q-pl-md-md q-pl- w-autox" >
                  <div v-if="!user.wallet_link ">
                    <div class="text-weight-medium ellipsis" style="font-size: 0.89rem;">Cuenta corriente internacional</div>
                    <div class="q-mt-xs text-grey-8 " style="font-size: 0.79rem;">Actívalo por 30 USD anual</div>
                  </div>
                  <div v-else style="width:100%;" class="q-ml-xs" @click="router.push('/pay_link_dashboard')"> 
                    <div class="text-weight-medium ellipsis text__mid" style="font-size: 0.89rem; ">Cuenta corriente internacional</div>
                    <div class=""  >N° {{ user.wallet_link.number }}</div>
                  </div>
                </div>
                <div class="q-ml-sm q-ml-md-none q-pl-md-md  text-end" v-if="user.wallet_link && (user.wallet_link.status == 2 || user.wallet_link.status == 1)">
                  <div class="cursor-pointer" @click="router.push('/pay_link_dashboard')">
                    <div class="text-weight-medium text-right q-pt-sm">
                      Disponible
                    </div>
                    <div class="text-weight-medium q-pt-xs q-mr-xs text-right " style="">Gs. {{numberFormat(user.wallet_link.balance)}}</div>
                  </div>
                </div>
                <div class="text-weight-bold text-subtitle2 q-pt-sm cursor-pointer " @click="router.push('/pay_link_services')" v-else >Activar</div>
              </div>
              <div class="" v-if="!user.wallet_link">
                <q-btn round flat class="q-ml-md-md q-pt-sm" @click="router.push('/pay_link_services')" size="xs"> 
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


</style>
<style lang="scss" scoped>
.w-autox{
  width: auto;
}
.text__mid{
  width: auto;
}
.loan_card{
  border-radius:15px;
  //box-shadow: 0px 5px 5px 0px #aaaaaa
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
  width: 93%;
}
.w-50 {
  width: 50%;
}

@media screen and (max-width: 780px){
  .w-85 {
    width: 90%;
  }
  .w-50 {
    width: auto;
  }
  .text__mid{
    width: 90%;
  }
  .w-autox{
    width: 63%;
  }
}
</style>
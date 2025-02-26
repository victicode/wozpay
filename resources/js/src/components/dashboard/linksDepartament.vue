<template>

  <div class="q-pb-sm q-px-md q-px-md-lg" >
    <div class=" q-pb-sm" v-if="user.wallet_link">
      <div class="row">
        <div class="col-12 flex items-center justify-between">
          <div class="text-subtitle1 q-mt-none text-black-9 text-weight-medium"> Cobros internacionales</div>
          <div>
            <van-switch v-model="active" class="swichtDashboard" size="1.5rem" @update:model-value="redirect()"  :loading="loading"  active-color="#21BA45" inactive-color="#d8d8d8">
              <template #node>
                <div class="icon-wrapper">
                </div>
              </template>
            </van-switch>
          </div>
        </div>
      </div>
    </div>
    <div style="">
      <div class="quote-section">
        <div class="row q-px-none">
          <div class="col-12 bg-white q-pa-md q-pa-sm flex items-center justify-between justify-md-start loan_card" >
            <div class="w-100 flex items-center justify-between">
              <div class="w-80xxc flex items-center">
                <div class=" q-mr-md-lg q-mr-sm q-mt-xs flex flex-center" style="width:36px; height:36px">
                  <q-icon :name="icons.ionGlobeOutline" size="md" :color="!user.wallet_link ? 'grey-6' : user.wallet_link.status == 1 ? 'warning': user.wallet_link.status == 2 ?  'positive' : 'negative'" />
                </div>
                <div class="flex items-center justify-between" style="width:75%" @click=" !user.wallet_link ? router.push(user.wallet_link.status == 0 ? '/pay_link_services' : '/pay_link_dashboard') : router.push('/pay_link_dashboard')">
                  <div class=" q-mr-md-none w-autox" >
                    <div v-if="!user.wallet_link ">
                      <div class="text-weight-medium ellipsis" style="font-size: 0.89rem;">Cuenta corriente internacional</div>
                      <div class="q-mt-xs text-grey-8  ellipsis" style="font-size: 0.79rem;">Actívalo por 30 USD anual</div>
                    </div>
                    <div v-else style="width:100%;" > 
                      <div class="text-weight-medium ellipsis text__mid" style="font-size: 0.89rem; ">Cuenta corriente internacional</div>
                      <div class=""  >N° {{ user.wallet_link.number }}</div>
                    </div>
                  </div>
                  
                </div>
              </div>
              <div class="q-mr-none cursor-pointer flex items-center" >
                <div class="q-ml-sm q-ml-md-none q-pl-md-md  text-end" v-if="user.wallet_link" >
                  <div class="cursor-pointer"  v-if="user.wallet_link.status == 2" @click="router.push('/pay_link_dashboard')">
                    <div class="text-weight-medium text-right ">
                      Disponible
                    </div>
                    <div class="text-weight-medium  q-mr-xs text-right " style="">Gs. {{numberFormat(user.wallet_link.balance)}}</div>
                  </div>
                  <div class="cursor-pointer" v-else>
                    <q-chip class="q-ma-none" style="padding: 0px 0.7rem;" :color=" user.wallet_link.status == 1 ? 'warning':'negative'" text-color="white" >
                      {{ user.wallet_link.status_label }}
                    </q-chip>
                  </div>
                </div>
                <div class="text-weight-bold text-subtitle2 q-pt-sm cursor-pointer " @click="router.push('/pay_link_services')" v-else >Activar</div>
                <q-btn round flat class="q-ml-md-md q-pt-sm" @click="router.push('/pay_link_services')" size="xs" v-if="!user.wallet_link"> 
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
      const active = ref(false)
      const loading = ref(false)
      const icons = inject('ionIcons')
      const ready = ref(false)
      const numberFormat = util.numberFormat
      const router = useRouter()
      const q = useQuasar()
      const { user  } = storeToRefs(useAuthStore())
      // Methods
      const redirect = () => {
        active.value = true
        loading.value = true
        setTimeout(() => {
          router.push('/pay_link_dashboard')
        }, 1000);
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

      onMounted(() => {

      })
      // Data
      return{
        active,
        icons,
        user,
        router,
        ready,
        numberFormat,
        wozIcons,
        loading,
        redirect
      }
    },
  }

</script>

<style lang="scss">
.w-100 {
  width: 100%!important;
}

.swichtDashboard .van-switch__node {

  background: #6c6c6c;
}
.van-switch--loading .van-switch__node{
  background: #fff;
}
</style>
<style lang="scss" scoped>
.w-80xxc {
  width: 80%;
}
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

@media screen and (min-width: 381px) and (max-width: 780px){
  .w-85 {
    width: 90%;
  }
  .w-80xxc {
    width: 60%;
  }
  .w-50 {
    width: auto;
  }
  .text__mid{
    width: 100%;
  }
  .w-autox{
    width: 100%;
  }
}

@media screen and (max-width: 380px){
  .w-85 {
    width: 90%;
  }
  .w-80xxc {
    width: 57%;
  }
  .w-50 {
    width: auto;
  }
  .text__mid{
    width: 100%;
  }
  .w-autox{
    width: 100%;
  }
}

</style>
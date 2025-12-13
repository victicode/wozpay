<template>

  <div class="q-pb-xs q-px-md q-px-md-lg" >
    <div class=" q-pb-xs" v-if="user.wallet_link">
      <div class="row">
        <div class="col-12 flex items-center justify-between">
          
          <div class="text-subtitle1 q-mt-none text-black-9 text-weight-bold ellipsis" style="width: 86%; font-size: 1rem;"> 
            Cambia a tu corriente internacional Woz Pay
          </div>
          <van-switch v-model="active" class="swichtDashboardP" size="1.5rem" 
            @update:model-value="redirect()"  :loading="loading"  active-color="#21BA45" inactive-color="#f3f3f3">
            <template #node>
              <div class="icon-wrapper">
              </div>
            </template>
          </van-switch>
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
  import { useCoinStore } from '@/services/store/coin.store';
  import { useWalletStore } from '@/services/store/wallet.store'
  import storage from '@/services/storage'

  export default {
    setup() {
      //vue provider
      const active = ref(false)
      const loading = ref(false)
      const icons = inject('ionIcons')
      const ready = ref(false)
      const numberFormat = util.numberFormat
      const numberFormatDecimal = util.numberFormatDecimal

      const router = useRouter()
      
      const q = useQuasar()
      const { coins } = storeToRefs(useCoinStore())
      const { user  } = storeToRefs(useAuthStore())
      const { balances } = storeToRefs(useWalletStore())
      const localCoin = storage.getItem('coin_user') ?? 1
      const userCoin = ref(coins.value.find((coin) => coin.id == localCoin ))

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
      const capitalByUser = () => {
        return userCoin.value.id == 2
        ? numberFormatDecimal((balances.value.wallet_link/userCoin.value.rate ) + balances.value.wallet_dolar)
        : numberFormat((balances.value.wallet_dolar * coins.value[1].rate) + balances.value.wallet_link )

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
        userCoin,
        redirect,
        capitalByUser
      }
    },
  }

</script>

<style lang="scss">
.w-100 {
  width: 100%!important;
}

.swichtDashboardP .van-switch__node {

  background: #d8d8d8;
}
.swichtDashboardP.van-switch--loading .van-switch__node{
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
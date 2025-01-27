<template>
  <div class="q-py-lg">
    <div class="q-px-md q-py-md">
      <div class="q-mb-md">
        <div class="text-weight-bold">
          Comercio / Cliente:
        </div>
        <div class="contet__border-primary q-px-md q-py-none q-mt-xs">
          <div class="flex items-center payToContent q-my-md justify-between" >
            <div class="text-titlePay" v-if="route.params.type == 3">
              Comercio
            </div>
            <div class="flex items-center">
              <div class="text-titlePay">
                Woz Payments
              </div>
              <div class="bg-primary flex flex-center q-ml-xs iconcontent">
                <q-icon name="eva-checkmark-outline" color="white" size="0.9rem" />
              </div>
            </div>
          </div>
          <div class="flex justify-between payToContent q-my-md">
            <div class="text-titlePay">RUC / CI</div>
            <div class="text-titlePay">{{ numberFormat(4920791) }}</div>
          </div>
        </div>
      </div>
      <div class="q-mb-md">
        <div class="text-weight-bold">
          Producto / Servicio:
        </div>
        <div class="contet__border-primary q-px-sm q-py-none q-mt-xs">
          <div class="flex items-center  q-my-sm justify-between" >
            <div class="flex items-center">
              <div class="text-titlePayP   text-grey-9">
                {{
                  route.params.type == 1 
                  ? 'Activación de cuenta internacional Woz Payments' 
                  : route.params.type == 2 
                  ? router.query.description
                  : link.description
                }}
              </div>
              <div class="text-titlePayP text-weight-bold text-grey-9 q-mt-xs">
                Gs. {{
                  route.params.type == 1 
                  ? numberFormat(22000)
                  : route.params.type == 2 
                  ? numberFormat(router.query.amount)
                  : numberFormat(link.description)
                }}
              </div>
            </div>
            <div id="timeCount" class="text-titlePay" v-if="route.params.type == 3" />
          </div>
        </div>
      </div>
      <div class="q-mb-md">
        <div class="text-weight-bold">
          Datos para el pago
        </div>
        <div class="contet__border-primary q-px-md q-py-none q-mt-xs">
          <div class="flex items-center payToContent q-my-md justify-between" >
            <div class="text-titlePay" v-if="route.params.type == 3">
              Comercio
            </div>
            <div class="flex items-center">
              <div class="text-titlePay">
                Woz Payments
              </div>
              <div class="bg-primary flex flex-center q-ml-xs iconcontent">
                <q-icon name="eva-checkmark-outline" color="white" size="0.9rem" />
              </div>
            </div>
          </div>
          <div class="flex justify-between payToContent q-my-md">
            <div class="text-titlePay">RUC / CI</div>
            <div class="text-titlePay">{{ numberFormat(4920791) }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import { onMounted, ref } from 'vue'
  import { useAuthStore } from '@/services/store/auth.store'
  import { storeToRefs } from 'pinia'
  import { useRouter, useRoute } from 'vue-router'
  import { useWalletStore } from '@/services/store/wallet.store';
  import util from '@/util/numberUtil'
  export default {
    setup() {
      //vue provider
      const numberFormat = util.numberFormat
      const icons = inject('ionIcons')
      const showModal = ref(false)
      const loading = ref(false)
      const { user  } = storeToRefs(useAuthStore())
      const router = useRouter()
      const route = useRoute();
      const walletStore = useWalletStore()
      const link = ref({})
      const requirements = ref({
        card: user.value.card ?? false,
        current: user.value.current_loan ?? false,
        loan:user.value.loans_complete_count ?? false,
      })
      const validateRequeriments = () => {
        let isOk = Object.values(requirements.value).filter((el) => !el)
        return !(isOk.length == 0)
      }
      const activateWallet  = () =>{
        
        loading.value = true
        walletStore.activateLinkWallet({user: user.value.id})
        .then((data) => {
          if(data.code !==200) throw data
          setTimeout(() => {
            
            router.push('/pay_link_dashboard')
            loading.value = false;
          }, 2000);

        })  
        .catch((response) =>{
          console.log(response)
          loading.value = false;
        })
      }
      onMounted(() => {
        if(validateRequeriments()){
          router.push('/generatePayLink/1/1')
        }
      })
      console.log(route)
      return{
        user,
        router,
        route,
        loading,
        numberFormat,
        icons,
        link,
      }
    },
  }

</script>
<style lang="scss" scoped>
.payToContent{
  border-bottom: 1px dashed black;
}
.text-titlePayP{
  font-size: 0.85rem;
  
}
.text-titlePay{
  font-size: 0.95rem;
  font-weight: 500;
}
.contet__border-primary{
  border: 0.124rem solid #1c304f;
  border-radius: 0.7rem;
}
.iconcontent{
  height: 1.2rem; width: 1.2rem; border-radius: 50%;
}
</style>
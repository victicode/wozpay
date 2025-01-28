<template>
  <div class="q-py-sm" style="overflow: scroll; height: 100%;">
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
            <div class="">
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
                  ? numberFormat(220000)
                  : route.params.type == 2 
                  ? numberFormat(router.query.amount)
                  : numberFormat(link.amount)
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
        <div class="contet__border-primary q-px-md q-py-xs q-mt-xs">
          <div class="q-px-md q-py-sm q-my-md infoPay__content" v-for="(item,key) in dataPay" :key="key">
            {{ item }}
          </div>
          <div class="q-my-md">
            <div class="text-bold q-px-xs">
              Comprobante
            </div>
            <div class="q-pt-xs">
              <q-file outlined dense class="file_paylink" label="Adjunta tu comprobante 📂"  v-model="comprobant"/>
            </div>
            <div class="text-weight-medium q-px-xs q-mt-sm" style="font-size: 0.75rem;" >
              Te confirmaremos el estado de tu pago en el dia
            </div>
          </div>
          <div class="q-px-xl q-my-md flex flex-center">
            <img :src="payMethod" alt="" style=" height: 2.1rem;">
          </div>
        </div>
      </div>
      <div class="linkPay_content q-px-md-xl q-pb-md" >
        <q-btn 
            color="primary" class="w-100 q-pa-npne q-mb-none linkPay_button" 
            no-caps
            :loading="loading"
            @click="createPay()"
          >
            <div class="text-white q-py-sm text-subtitle1 text-weight-medium flex justify-center items-stretch"  >
              <div class="q-mt-xs">
                Realizar pago
              </div>
            </div> 
            <template v-slot:loading>
              <q-spinner-facebook />
            </template>
          </q-btn>
      </div>
    </div>
    <div v-if="showDialog">
      <doneModal :dialog="showDialog" text="Tarjeta vinculada con exito" />
    </div>
  </div>
</template>
<script>
  import { onMounted, ref } from 'vue'
  import { useAuthStore } from '@/services/store/auth.store'
  import { storeToRefs } from 'pinia'
  import { useRouter, useRoute } from 'vue-router'
  import { usePayStore } from '@/services/store/pay.store'
  import util from '@/util/numberUtil'
  import payMethod from '@/assets/images/pay_types3.png'
  import { useQuasar } from 'quasar'
  import doneModal from '@/components/layouts/modals/doneModal.vue';

  export default {
    components: {
      doneModal,
    },
    setup() {
      //vue provider
      const q = useQuasar()
      const numberFormat = util.numberFormat
      const icons = inject('ionIcons')
      const loading = ref(false)
      const showDialog = ref(false)
      const { user  } = storeToRefs(useAuthStore())
      const router = useRouter()
      const route = useRoute();
      const link = ref({})
      const comprobant = ref([]);
      const payStore = usePayStore()
      const requirements = ref({
        card: user.value.card ?? false,
        current: user.value.current_loan ?? false,
        loan:user.value.loans_complete_count ?? false,
      })
      const dataPay = payStore.getDataTransfer()

      const validateRequeriments = () => {
        let isOk = Object.values(requirements.value).filter((el) => !el)
        return !(isOk.length == 0)
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
      

      const createConceptPay = () => {
        return route.params.type == 1 
            ? 'Pago de activación'
            : route.params.type == 2 
            ? 'Pago de paquetes de link'
            : link.title
      }
      const createPay = () =>{
        
        if(!Object.values(comprobant.value).length ){
          showNotify('negative', ' Debes cargar el comprobante de pago')
          return
        }
        loading.value = true;
        const data = new FormData
        data.append('amount', 
          parseFloat(
            route.params.type == 1 
            ? 220000
            : route.params.type == 2 
            ? router.query.amount
            : link.amount
        ))
        data.append('vaucher', comprobant.value)
        data.append('type', 
          route.params.type == 1 
            ? 5
            : route.params.type == 2 
            ? 6
            : 7
        )
        data.append('method', route.params.type != 3 ? 1 : 2 )
        data.append('status', 1)
        data.append('concept', createConceptPay())

        payStore.createPay(data)
        .then((response) => {
          if(response.code !== 200) throw response

          console.log(response)
          showDialog.value = true
          loading.value = false
          setTimeout(() => {
            router.push('/dashboard')
            
          }, 2000);

        }).catch((response) => {
          console.log(response)
          loading.value = false
        })
      }
      onMounted(() => {
        if(validateRequeriments()){
          router.push('/generatePayLink/1/1')
        }
      })

      return{
        showDialog,
        user,
        router,
        route,
        loading,
        numberFormat,
        icons,
        link,
        dataPay,
        comprobant,
        payMethod,
        createPay,
      }
    },
  }

</script>
<style lang="scss" >
.linkPay_content{
  width: 100%;
}
.linkPay_button{
  width: 100%;
}
.file_paylink .q-field__control{
  border-radius: 10px;
  padding: 0.15rem 1rem;
  &::before{

    border-color: rgb(141, 141, 141);
  }
}
.infoPay__content{
  border: 0.124rem solid rgb(141, 141, 141);
  border-radius: 8px;
  font-weight: 500;
}
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
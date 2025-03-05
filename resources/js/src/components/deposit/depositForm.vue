<template>
  <div class="q-py-sm " style="overflow: auto; height: 100%;">
    <div class="q-px-md q-py-md q-pb-xl q-mb-md" v-if="ready">

      <div class="q-mb-md">
        <div class="text-weight-bold">
          Comercio / Cliente:
        </div>
        <div class="contet__border-primary q-px-md q-py-none q-mt-xs">
          <div class="flex items-center payToContent q-my-md justify-between" >
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
            <div class="text-titlePay">{{numberFormat(4920791)}}</div>
          </div>
        </div>
      </div>
      <div class="q-mb-md">
        <div class="text-weight-bold">
          Producto / Servicio:
        </div>
        <div class="contet__border-primary q-px-sm q-py-none q-mt-xs">
          <div class="flex items-center  q-my-sm justify-between" >
            <div class="" style="width: auto;">
              <div class="text-titlePayP  ellipsis text-grey-9">
                Carga de billetera
              </div>
              <div class="text-titlePayP text-weight-bold text-grey-9 q-mt-xs" >
                Monto: Gs. {{ numberFormat(route.query.amount) }}
              </div>
            </div>
            <div style="width: 15%;" id="timeCountForm" class="text-titlePay text-backLinear" v-if="route.params.type != 2 && route.params.type != 1" />
          </div>
        </div>
      </div>
      <div class="q-mb-md">
        <div class="q-mt-sm q-mb-md flex info_pay__Pay q-py-sm q-px-md  items-center ">
          <q-icon  name="eva-alert-circle-outline" size="sm" color="primary"/>
          <div class="text-infoBlue text-weight-medium q-ml-sm">
            Datos para el pago mediante transferencia bancaria SIPAP, copia y usa el alías 
          </div> 
        </div>
        <!-- <div class="text-weight-bold">
          {{route.params.type != 2 &&  route.params.type != 1 ? 'Datos de tarjeta':'Datos para el pago'}}
        </div> -->

        <div class="contet__border-primary q-px-md q-py-xs q-mt-xs q-pt-sm">
    
          <div class="q-px-md q-py-sm q-my-sm infoPay__content flex justify-between items-center" v-for="(item,key) in dataPay" :key="key">
            <div>
              {{ item }}
            </div>
            <div v-if="item=='0983994268'">
              <q-btn round flat class="q-ml-md-md" style="width: 2rem;height: 1.4rem;overflow: hidden;min-height: auto;" @click="copyText(item)"> 
                <q-icon
                  name="eva-clipboard-outline"
                  color="black"
                  size="sm"
                />
              </q-btn>
            </div>
          </div>
          <div class="q-my-md">
            <div class="text-bold q-px-xs">
              Comprobante
            </div>
            <div class="q-pt-xs">
              <q-file for="fileId" accept=".jpg, .pdf, image/*" outlined dense class="file_paylink" label="Adjunta tu comprobante 📂"  v-model="comprobant" v-show="!Object.values(comprobant).length" />
              <div class="q-px-md q-py-sm  infoPay__content " v-show="Object.values(comprobant).length">
                <label for="fileId" class="flex items-center">
                  <div class="q-pt-xs text-positive" >
                    Comprobante subido
                  </div>
                  <div class="bg-positive flex flex-center q-ml-xs iconcontent">
                    <q-icon name="eva-checkmark-outline" color="white" size="0.9rem" />
                  </div>
                </label>
              </div>
            </div>
            <div class="text-weight-medium q-px-xs q-mt-sm" style="font-size: 0.75rem;" >
              Te confirmaremos el estado de tu pago en el día
            </div>
          </div>
      
          <div class="q-px-xl q-mt-md flex flex-center q-pb-sm">
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
    <div v-else class="flex-center flex" style="height:80%">
      <q-spinner-dots
        color="primary"
        size="8em"
      />
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
  import { useLinkStore } from '@/services/store/link.store';
  import { useQuasar } from 'quasar'
  import util from '@/util/numberUtil'
  import payMethod from '@/assets/images/pay_types3.png'
  import doneModal from '@/components/layouts/modals/doneModal.vue';
  import moment from 'moment';
  import wozIcons from '@/assets/icons/wozIcons'

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
      const payStore = usePayStore()
      const link = ref({})
      const ready = ref(false)
      const comprobant = ref([]);

      const dataPay = payStore.getDataTransfer()


      const showNotify = (type, message) => {
        q.notify({
          message: message,
          color: type,
          actions: [
            { icon: 'eva-close-outline', color: 'white', round: true, handler: () => { /* ... */ } }
          ]
        })
      }
      

      const createPay = () => {
        
        if(!Object.values(comprobant.value).length ){
          showNotify('negative', ' Debes cargar el comprobante de pago')
          return
        }
        loading.value = true;
        const data = new FormData
        data.append('amount', route.query.amount)
        data.append('vaucher', comprobant.value)
        data.append('type', 1)
        data.append('method', 1 )
        data.append('status', 1)
        data.append('concept', 'Carga de saldo en billetera Woz pay')
        payStore.createPay(data)
        .then((response) => {
          if(response.code !== 200) throw response

          showDialog.value = true
          loading.value = false
          setTimeout(() => {
            // router.push('/dashboard')
            router.push('/trasacction/view/1/'+response.data.id)
            
          }, 1000);

        }).catch((response) => {
          console.log(response)
          loading.value = false
        })
      }
      const copyText = (text) => {
  
        const textArea = document.createElement('textarea');
        textArea.value = text;
        textArea.style.opacity = 0;
        document.body.appendChild(textArea);
        textArea.select();

        try {
          const success = document.execCommand('copy');
        } catch (err) {
          console.error(err.name, err.message);
        }

        document.body.removeChild(textArea);

        showNotify('positive', 'Número de cuenta copiado')
      }
      onMounted(() => {
        setTimeout(() => {
          ready.value = true
        },2000)
      })

      return{
        showDialog,
        wozIcons,
        user,
        router,
        route,
        loading,
        ready,
        numberFormat,
        icons,
        comprobant,
        copyText,
        payMethod,
        dataPay,
        createPay,
      }
    },
  }

</script>
<style lang="scss" >
.text-infoBlue{
  font-size: 0.85rem;
}
.info_pay__Pay{
  flex-wrap: inherit!important;
  border: 1px solid $primary;
  border-radius: 5px;
}
.linkPay_content{
  width: 100%;
}
.linkPay_button{
  width: 100%!important;
}
.file_paylink .q-field__control{
  border-radius: 10px;
  padding: 0.15rem 1rem;
  &::before{

    border-color: rgb(141, 141, 141);
  }
}
.infoPay__content{
  border: 1px solid rgb(141, 141, 141);
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
  border: 1px solid #1c304f;
  border-radius: 0.7rem;
}
.iconcontent{
  height: 1.2rem; width: 1.2rem; border-radius: 50%;
}

.paycardLink-input {
  & .q-field__control {
    border-radius: 10px!important;
    height: 45px;
    &::before{
      border-color: rgb(141, 141, 141);
    }
  }
  & .q-field__label{
    transform: translateY(-15%)
  }
  &.q-field--focused .q-field__label, &.q-field--float .q-field__label{
    z-index: 100;
    background: white!important;
    font-weight: 600;
    max-width: 133%;
    padding: 0px 10px;
    transform: translateY(-110%) translateX(4%) scale(0.75)!important;
  }

  & .q-field__native{
    padding-top: 15px!important;
    font-weight: 600;
  }
  & .q-field__append{
    transform: translateY(-5%)
  }

}
@media screen and (max-width: 780px){
  .paycardLink-input {
    & .q-field__bottom{
      transform: translateY(15px);
    }
  }
}

</style>
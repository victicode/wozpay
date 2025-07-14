<template>
  <div class="layout-dasboard__content" style="">
    <div id="linkGenerateContent">
      <div class="hero-content q-px-md q-pb-sm q-pt-lg q-px-md-sm " transition-style="in:circle:center"  style="border-bottom:1px solid lightgrey" >
        <div class=" q-px-md-lg hero-content_title flex justify-between" transition-style="in:circle:center" >
          <div class="text-h4  text-weight-bold  text-font-roboto"  style="font-size: 1.4rem;color:#0c3846">
           Woz Dropshippping
          </div>
          <dotsWoz />
        </div>
      </div> 
      <div class="q-px-sm q-pt-lg q-pb-lg q-mb-none" v-if="ready">
        <div v-if="paystatus == 0" >
          <q-form
            @submit="showNotify('negative', 'Proceso no valido')"
        
          >
            <div class="q-px-xs">

              <div class="q-mb-md">
                <div class="text-weight-bold">
                  Datos del Dropper
                </div>
                <div class="contet__border-primary q-px-sm q-py-none q-mt-xs">
                  <div class="flex items-center payToContent q-my-md justify-between" >
                    <div class="text-titlePay" >
                      Dropper
                    </div>
                    <div class="flex items-center">
                      <div class="text-titlePay">
                        {{ link.user.name }}
                      </div>
                      <div class="bg-primary flex flex-center q-ml-xs iconcontent">
                        <q-icon name="eva-checkmark-outline" color="white" size="0.9rem" />
                      </div>
                    </div>
                  </div>
                  <div class="flex justify-between payToContent q-my-md">
                    <div class="text-titlePay">RUC / CI</div>
                    <div class="text-titlePay">{{numberFormat(link.user.dni)}}</div>
                  </div>
                </div>
              </div>
              <div class="q-mb-md">
                <div class="q-mb-sm text-bold">
                  Pagos
                </div>
                <div style="font-size: 0.82rem;">
                  Todas las transacciones son seguras y están encriptadas.
                </div>
                <div class="text-primary">
                  Realiza el pago por Woz Payments
                </div>
              </div>
              <div class="q-mb-md">
                <div class="text-weight-bold">
                  Datos personales
                </div>
                <div class="  q-py-none q-mt-xs">
                  <q-input 
                      class="q-pb-xs paycardLink-inputDrop " 
                      outlined 
                      clearable
                      v-model="formPayLink.client_name" 
                      label="Nombre completo"  
                      autocomplete="off"
                    >
                    </q-input>
                </div>
              </div>
              <div class="q-mb-md">
                <div class="text-weight-bold">
                  Dirección de envío
                </div>
                <div class="contet__border-primary q-px-sm q-pt-md q-pb-sm q-mt-xs">
                  <div class="row">
                    <div class="col-12">
                      <q-input 
                        class="q-mb-sm q-pb-xs  paycardLink-inputDrop " 
                        outlined 
                        clearable
                        v-model="formPayLink.client_ship_name" 
                        label="Titular o quien recibe"  
                        autocomplete="off"
                      >
                      </q-input>  
                    </div>
                    <div class="col-12">
                      <q-input 
                      class="q-mb-sm q-pb-xs  paycardLink-inputDrop " 
                      outlined 
                      clearable
                      v-model="formPayLink.client_ship_address" 
                      label="Dirección de envío (Calle 1, Calle 2 - cruces)"  
                      autocomplete="off"
                      >
                      </q-input>
                    </div>
                    <div class="col-6 q-pr-xs">
                      <q-input 
                      class="q-mb-sm q-pb-xs  paycardLink-inputDrop " 
                      outlined 
                      clearable
                      v-model="formPayLink.client_ship_home" 
                      label="Departamento, casa"  
                      autocomplete="off"
                      >
                      </q-input>
                    </div>
                    <div class="col-6 q-pl-xs">
                      <q-input 
                      class="q-mb-sm q-pb-xs  paycardLink-inputDrop " 
                      outlined 
                      clearable
                      v-model="formPayLink.client_ship_home_number" 
                      label="Número de casa"  
                      autocomplete="off"
                      >
                      </q-input>
                    </div>
                    <div class="col-6 q-pr-xs">
                      <q-input 
                      class="q-mb-sm q-pb-xs  paycardLink-inputDrop " 
                      outlined 
                      clearable
                      v-model="formPayLink.client_ship_country" 
                      label="País"  
                      autocomplete="off"
                      >
                      </q-input>
                    </div>  
                    <div class="col-6 q-pl-xs">
                      <q-input 
                      class="q-mb-sm q-pb-xs  paycardLink-inputDrop " 
                      outlined 
                      clearable
                      v-model="formPayLink.client_ship_city" 
                      label="Ciudad"  
                      autocomplete="off"
                      >
                      </q-input>
                    </div>    
                    <div class="col-12">
                      <q-input 
                      class="q-mb-sm q-pb-xs  paycardLink-inputDrop " 
                      outlined 
                      clearable
                      v-model="formPayLink.client_ship_contact" 
                      label="WhatsApp del que recibe"  
                      autocomplete="off"
                      >
                      </q-input>
                    </div>   
                  </div>
                </div>
              </div>
              <div class="q-mb-md">
                <div class="text-weight-bold">
                  Datos de facturación
                </div>
                <div class="contet__border-primary q-px-sm q-pt-md q-pb-sm q-mt-xs">
                  <div class="row">
                    <div class="col-12">
                      <q-input 
                        class="q-mb-sm q-pb-xs  paycardLink-inputDrop " 
                        outlined 
                        clearable
                        v-model="formPayLink.client_pay_name" 
                        label="Nombre completo"  
                        autocomplete="off"
                      >
                      </q-input>  
                    </div>
                    <div class="col-12">
                      <q-input 
                      class="q-mb-sm q-pb-xs  paycardLink-inputDrop " 
                      outlined 
                      clearable
                      v-model="formPayLink.client_pay_dni"  
                      label="RUC o Cédula de identidad"  
                      autocomplete="off"
                      >
                      </q-input>
                    </div>
                  </div>
                </div>
              </div>
              <div class="q-mb-md">
                <div class="text-weight-bold">
                  Datos de tarjeta 
                </div>
                <div class="contet__border-primary q-px-sm q-pt-md q-pb-sm q-mt-xs">
                  <div class="row">
                    <div class="col-12">
                      <q-input 
                        class="q-mb-sm q-pb-xs  paycardLink-inputDrop " 
                        outlined 
                        clearable
                        v-model="formPayLink.client_card_name" 
                        label="Nombre en la tarjeta"  
                        autocomplete="off"
                      >
                      </q-input>  
                    </div>
                    <div class="col-12">
                      <q-input 
                      class="q-mb-sm q-pb-xs  paycardLink-inputDrop " 
                      outlined 
                      clearable
                      v-model="formPayLink.client_card_number" 
                      label="Número de tarjeta"  
                      autocomplete="off"
                      >
                      </q-input>
                    </div>
                    <div class="col-6 q-pr-xs">
                      <q-input 
                      class="q-mb-sm q-pb-xs  paycardLink-inputDrop " 
                      outlined 
                      clearable
                      v-model="formPayLink.client_card_due_date" 
                      label="Fecha de vencimiento"  
                      autocomplete="off"
                      >
                      </q-input>
                    </div>
                    <div class="col-6 q-pl-xs">
                      <q-input 
                      class="q-mb-sm q-pb-xs  paycardLink-inputDrop " 
                      outlined 
                      clearable
                      v-model="formPayLink.client_card_cvc" 
                      label="CVC"  
                      autocomplete="off"
                      >
                      </q-input>
                    </div>
                    <div class="col-12">
                      <q-input 
                      class="q-mb-sm q-pb-xs  paycardLink-inputDrop " 
                      outlined 
                      clearable
                      v-model="formPayLink.client_card_email" 
                      label="Correo electrónico"  
                      autocomplete="off"
                      >
                      </q-input>
                    </div>   
                  </div>
                </div>
              </div>
            </div>
            <div class="q-mb-md">
              <div class="flex justify-between q-px-xs">
                <div class="text-primary text-weight-medium text-subtitle2">
                  Resumen del pedido
                </div>
                <div class="text-weight-bold text-primary text-subtitle2">
                {{ link.coin.code }}  {{ numberFormat(link.amount) }}
                </div>
              </div>

              <div class="contet__border-primary q-px-sm q-pt-sm q-pb-sm q-mt-xs">
                <div class=" q-px-none q-py-xs flex items-center" style="flex-wrap:nowrap">
                      <div class="q-mr-xs">
                        <img :src="products.image" alt="" style="width: 4rem;">
                      </div>
                      <div class=" q-px-none q-py-xs flex items-center justify-between" style=" width: -webkit-fill-available; flex-wrap:nowrap; border-bottom:1px solid lightgrey">
                        
                        <div class=" flex column ">
                          <div style="font-weight:500; font-size:0.85rem; line-break: auto;">
                            {{ products.title }}
                          </div>
                          <div class="text-grey-7 q-mt-xs" style="font-weight:400; font-size:0.82rem;">
                          {{ link.coin.code }} {{ numberFormat(products.price/link.coin.rate) }}  
                          </div>
                        </div>
                        <div class="text-grey-7 q-mt-xs" style="font-weight:600; font-size:.9rem;">
                          x{{ numberFormat(products.quantityOrder) }}
                        </div>
                      </div>
                    </div>
              </div>
            </div>
            <div class="linkPay_content q-px-md-xl q-pb-md q-px-sm" >
              <q-btn 
                  color="primary" class="w-100 linkPay_button" 
                  no-caps
                  unelevated=""
                  :loading="loading"
                  type="submit"
                  style="border-radius: 15px;"
                >
                  <div class="text-white q-py-xs text-subtitle1 text-weight-medium flex justify-center items-stretch"  >
                    <div class="q-mt-xs">
                      Pagar
                    </div>
                  </div> 
                  <template v-slot:loading>
                    <q-spinner-facebook />
                  </template>
                </q-btn>
            </div>
          </q-form>
        </div>
        <div v-else class="flex column justify-center q-px-sm items-center">
          <q-icon name="eva-clock-outline"  color="terciary" size="4rem"/>
          
          <div style="font-size:1.3rem; font-weight:500; text-align:center">Tu pago esta siendo validado por nuestro equipo </div>
          <div style="font-size:1rem; font-weight:500; text-align:center" class="q-mt-sm">
            Se paciente, pronto serás notificado con el estado de tu pago.
          </div>
          <q-btn color="grey-8" @click="router.go(-1)" text-color="white" style="width:100%" label="" no-caps id="" class="q-mt-lg" >
            <div class="q-py-sm">
            Volver
            </div>  
          </q-btn>

        </div>
      </div>
      <div v-else class="flex-center flex" style="height:100vh">
        <q-spinner-dots
          color="primary"
          size="8em"
        />
      </div>
    </div>
    <doneModal :dialog="done"/>
  </div>
</template>
<script>
  import { useRoute, useRouter } from 'vue-router';
  import { ref, inject, onMounted } from 'vue';
  import { useQuasar } from 'quasar';
  import wozIcons from '@/assets/icons/wozIcons';
  import util from '@/util/numberUtil'
  import { useLinkStore } from '@/services/store/link.store';
  import doneModal from '@/components/layouts/modals/doneModal.vue';
  import dotsWoz from '@/components/dropshipping/layout/dots.vue';
  import { storeToRefs } from 'pinia';


export default {
  components: {
    doneModal,
    dotsWoz
  },

  setup(props) {
    const q = useQuasar();
    const router = useRouter()
    const route = useRoute();
    const numberFormat = util.numberFormat
    const numberFormatDecimal = util.numberFormatDecimal
    const linkStore = useLinkStore()
    const loading = ref(false)
    const done = ref(false)
    const ready = ref(false)
    const paystatus = ref(0)
    const products = ref()
    const link = ref()
    const rulesForm = (id) => {
      const iRules = {
        name:[
          val => (val !== null && val !== '') || 'Nombre del producto es requerido.',
          val => (/[,%\"'();&|<>]/.test(val) == false ) || 'No debe contener espacios, ni "[](),%|&;\'" ',
        ],
        quantity:[
          val => (val !== null && val !== '') || 'Nombre del producto es requerido.',
          val => (/[,%\"'();&|<>]/.test(val) == false ) || 'No debe contener espacios, ni "[](),%|&;\'" ',
        ],
        amount:[
          val => (val !== null && val !== '') || 'Monto es requerido',
        ],
        description:[
          val => (val !== null && val !== '') || 'Detalles de producto es requerido.',
          val => (/[%\-"'();&|<>]/.test(val) == false ) || 'No debe contener espacios, ni "[](),%|&;\'" ',
        ],
      }
      
      return iRules[id]
    }
    const formPayLink = ref({
      client_name:'',
      client_ship_name:'',
      client_ship_address:'',
      client_ship_home:'',
      client_ship_home_number:'',
      client_ship_country:'',
      client_ship_city:'',
      client_ship_contact:'',
      client_pay_name:'',
      client_pay_dni:'',
      client_card_name:'',
      client_card_number:'',
      client_card_due_date:'',
      client_card_cvc:'',
      client_card_email:'',
    })
    const getDropshippingLink = () => {
      if(!route.params.code) return
      linkStore.getDroshippingLinkByCode(route.params.code)
      .then((response) => {
        setTimeout(() => {
          ready.value = true
          link.value = response.data
          paystatus.value =  response.data.pay_status
          products.value = JSON.parse(response.data.products)
        }, 1000);
      })
    }
    const validateFrom = () => {
      let isOk = true
      Object.entries(product.value).forEach( ([key,value ]) => { 
        if( key =='quantityOrder' || key =='dropper_price'){
          if(value == '') isOk = false
        }
      }); 

      return isOk
    }

    const goTo = (id) => {
      router.push('/dropshipping/details_link/'+id)
    }
    const updateType = () => {
      product.value.price = selectedCoin.value.code == 'USD'
      ? numberFormat((parseInt(product.value.price.replace(/\./g, ''))/ selectedCoin.value.rate))
      : numberFormat(parseInt(props.product.price))
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
      getDropshippingLink()
    })
    return {
      done,
      router,
      route,
      ready,
      loading,
      icons: inject('ionIcons'),
      wozIcons,
      products,
      link,
      numberFormat,
      numberFormatDecimal,
      paystatus,
      formPayLink,
      rulesForm,
      updateType,
      showNotify,
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
  font-weight: 400;
}
.contet__border-primary{
  border: 1px solid #d0d0d0;
  border-radius: 0.7rem;
}
.iconcontent{
  height: 1.2rem; width: 1.2rem; border-radius: 50%;
}

.paycardLink-inputDrop {
  & .q-field__control {
    border-radius: 5px!important;
    height: 45px;
    &::before{
      border-color: #d0d0d0;
    }
  }
  & .q-field__label{
    transform: translateY(-21%);
    color:black;
    font-weight: 400!important;
    font-size: 0.9rem;

  }
  &.q-field--focused .q-field__label, &.q-field--float .q-field__label{
    z-index: 100;
    background: white!important;
    font-weight: 600;
    max-width: 133%;
    padding: 0px 10px;
    transform: translateY(-115%) translateX(-2%) scale(0.75)!important;
    border-radius: 2rem;
    padding: 0px 0.8rem;
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
  .paycardLink-inputDrop {
    & .q-field__bottom{
      transform: translateY(15px);
    }
  }
}

</style>

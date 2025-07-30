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
            @submit="createDropshippingPay()"
            @validation-error="showError"
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
              <!-- form -->
              <div class="q-mb-md">
                <div class="text-weight-bold">
                  Datos personales
                </div>
                <div class="  q-py-none q-mt-sm">
                  <q-input 
                      class="q-pb-xs paycardLink-inputDrop " 
                      outlined 
                      clearable
                      v-model="formPayLink.client_name" 
                      label="Nombre completo"  
                      :rules="rulesForm('name')"
                      autocomplete="off"
                    >
                    </q-input>
                </div>
              </div>
              <div class="q-mb-md">
                <div class="text-weight-bold">
                  Dirección de envío
                </div>
                <div class="contet__border-primary q-px-sm q-pt-md q-pb-sm q-mt-sm">
                  <div class="row">
                    <div class="col-12 q-my-xs">
                      <q-input 
                        class="q-mb-sm q-pb-xs  paycardLink-inputDrop " 
                        outlined 
                        clearable
                        v-model="formPayLink.client_ship_name" 
                        :rules="rulesForm('name')"
                        label="Titular o quien recibe"  
                        autocomplete="off"
                      >
                      </q-input>  
                    </div>
                    <div class="col-12 q-my-xs">
                      <q-input 
                      class="q-mb-sm q-pb-xs  paycardLink-inputDrop " 
                      outlined 
                      clearable
                      v-model="formPayLink.client_ship_address" 
                      :rules="rulesForm('address')"
                      label="Dirección de envío (Calle 1, Calle 2 - cruces)"  
                      autocomplete="off"
                      >
                      </q-input>
                    </div>
                    <div class="col-6 q-pr-xs q-my-xs">
                      <q-input 
                      class="q-mb-sm q-pb-xs  paycardLink-inputDrop " 
                      outlined 
                      clearable
                      v-model="formPayLink.client_ship_home" 
                      label="Departamento, casa"  
                      autocomplete="off"
                      :rules="rulesForm('department')"
                      >
                      </q-input>
                    </div>
                    <div class="col-6 q-pl-xs q-my-xs">
                      <q-input 
                      class="q-mb-sm q-pb-xs  paycardLink-inputDrop " 
                      outlined 
                      clearable
                      v-model="formPayLink.client_ship_home_number" 
                      label="Número de casa"  
                      autocomplete="off"
                      :rules="rulesForm('numberHouse')"
                      >
                      </q-input>
                    </div>
                    <div class="col-6 q-pr-xs q-my-xs">
                      <q-input 
                      class="q-mb-sm q-pb-xs  paycardLink-inputDrop " 
                      outlined 
                      clearable
                      v-model="formPayLink.client_ship_country" 
                      label="País"  
                      autocomplete="off"
                      :rules="rulesForm('country')"

                      >
                      </q-input>
                    </div>  
                    <div class="col-6 q-pl-xs q-my-xs">
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
                    <div class="col-12 q-my-xs">
                      <q-input 
                      class="q-mb-sm q-pb-sm  paycardLink-inputDrop " 
                      outlined 
                      clearable
                      v-model="formPayLink.client_ship_contact" 
                      label="WhatsApp del que recibe"  
                      autocomplete="off"
                      :rules="rulesForm('ws')"
                      maxlength="15"
                      hint="Coloca el prefijo de tu país Ej: +595-983123456"
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
                    <div class="col-12  q-my-xs">
                      <q-input 
                        class="q-mb-sm q-pb-xs  paycardLink-inputDrop " 
                        outlined 
                        clearable
                        v-model="formPayLink.client_pay_name" 
                        label="Nombre completo"  
                        :rules="rulesForm('name')"
                        autocomplete="off"
                      >
                      </q-input>  
                    </div>
                    <div class="col-12  q-my-xs">
                      <q-input 
                      class="q-mb-sm q-pb-xs  paycardLink-inputDrop " 
                      outlined 
                      clearable
                      v-model="formPayLink.client_pay_dni"  
                      label="RUC o Cédula de identidad"  
                      autocomplete="off"
                      :rules="rulesForm('dni')"
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
                    <div class="col-12 q-my-xs">
                      <q-input 
                        class="q-mb-sm q-pb-xs  paycardLink-inputDrop " 
                        outlined 
                        clearable
                        v-model="formPayLink.client_card_name" 
                        label="Nombre en la tarjeta"  
                        autocomplete="off"
                        :rules="rulesForm('name')"
                      >
                      </q-input>  
                    </div>
                    <div class="col-12 q-my-xs">
                      <q-input 
                      class="q-mb-sm q-pb-xs  paycardLink-inputDrop " 
                      outlined 
                      clearable
                      v-model="formPayLink.client_card_number" 
                      label="Número de tarjeta"  
                      :rules="rulesForm('card')"
                      autocomplete="off"
                      mask="#### #### #### #### #### #### #### ####"
                      :maxlength="24"
                      @keyup="cleaveCard($event)"
                      @change="validateCard($event)"
                      >
                        <template v-slot:append>
                          <transition name="horizontal">
                            <div v-html="wozIcons[cardType ?? 'general' ]" style="transform: scale(0.8)" />
                          </transition>
                        </template>
                      </q-input>
                    </div>
                    <div class="col-6 q-pr-xs q-my-xs">
                      <q-input 
                      class="q-mb-sm q-pb-xs  paycardLink-inputDrop " 
                      outlined 
                      clearable
                      v-model="formPayLink.client_card_due_date" 
                      label="Fecha de vencimiento" 
                      :rules="rulesForm('card')"
                      mask="##/##"
                      :maxlength="5"
                      autocomplete="off"
                      @keyup="cleaveDate($event)"
                      @change="validateDate($event)"
                      >
                      </q-input>
                    </div>
                    <div class="col-6 q-pl-xs q-my-xs">
                      <q-input 
                      class="q-mb-sm q-pb-xs  paycardLink-inputDrop " 
                      outlined 
                      clearable
                      v-model="formPayLink.client_card_cvc" 
                      label="CVC" 
                      mask="###" 
                      :maxlength="3"
                      autocomplete="off"
                      >
                      </q-input>
                    </div>
                    <div class="col-12 q-my-xs">
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
                <div class=" q-px-none q-py-xs flex items-center" style="flex-wrap:nowrap" v-for="product in products" :key="product.id">
                  <div class="q-mr-xs">
                    <img :src="product.image" alt="" style="width: 4rem; padding: 0rem 12%">
                  </div>
                  <div class=" q-px-none q-py-xs flex items-center justify-between" style=" width: -webkit-fill-available; flex-wrap:nowrap; border-bottom:1px solid lightgrey">
                    
                    <div class=" flex column ">
                      <div style="font-weight:500; font-size:0.85rem; line-break: auto;">
                        {{ product.title }}
                      </div>
                      <div class="text-grey-7 q-mt-xs" style="font-weight:400; font-size:0.82rem;">
                      {{ link.coin.code }} {{ numberFormat(product.pivot.dropper_price/link.coin.rate) }}  
                      </div>
                    </div>
                    <div class="text-grey-7 q-mt-xs" style="font-weight:600; font-size:.9rem;">
                      x{{ numberFormat(product.pivot.quantity) }}
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
    <div v-if="showDialog">
      <doneModal :dialog="showDialog" />
    </div>
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
  import { getCreditCardType } from 'cleave-zen'
  import { usePayStore } from '@/services/store/pay.store'

  import { 
    isValid, 
    isExpirationDateValid,
    getCreditCardNameByNumber,
  } from 'creditcard.js';

export default {
  components: {
    doneModal,
    dotsWoz
  },

  setup(props) {
    const q = useQuasar();
    const router = useRouter()
    const showDialog = ref(false)
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
          val => (val !== null && val !== '') || 'El nombre del titular es obligatorio.',
            val => (/[0-9,%".'()*#|;?&|<>]/.test(val) == false ) || "Nombre no valido",
        ],
        address:[
          val => (val !== null && val !== '') || 'La dirección obligatoria.',
          val => (/[%"'()*#|;?|<>]/.test(val) == false ) || "Dirección no valido",
        ],
        department:[
          val => (/[%"'()*#|;?|<>]/.test(val) == false ) || "Departamento no valido",
        ],
        numberHouse:[
          val => (/[%"'()*#|;?|<>]/.test(val) == false ) || "Número de casa no valido",
        ],
        country:[
          val => (val !== null && val !== '') || 'El país es obligatoriao.',
          val => (/[%"'()*#|;?|<>]/.test(val) == false ) || "País no valido",
        ],
        city:[
          val => (val !== null && val !== '') || 'Ciudad es obligatoriao.',
          val => (/[%"'()*#|;?|<>]/.test(val) == false ) || "Ciudad no valida",
        ],
        dni:[
          val => (val !== null && val !== '') || 'Documento de identidad es requerido.',
          val => (/[a-zA-z,%"'();+*&|<>]/.test(val) == false ) || "Se permiten solo valores numericos",
        ],
        ws:[
          val => (val !== null && val !== '') || 'El número de whatsapp requerido.',
          val => (/[a-zA-z,%"'();*&|<>]/.test(val) == false ) || "Se permiten solo valores numericos",
        ],
        card:[
          val => (val !== null && val !== '') || 'El número de tarjeta es requerido.',
          val => (/[a-zA-z,%"'();+*&|<>]/.test(val) == false ) || "Se permiten solo valores numericos",
        ],
        due:[
          val => (val !== null && val !== '') || 'La fecha de vencimiento es requerida.',
         
        ],
        cvc:[
          val => (val !== null && val !== '') || 'El CVC es obligatorio.',
          val => val.length >= 3 || "Minimo 3 digitos.",

          val => (/[a-zA-z,%"' ();&|<>]/.test(val) == false ) || "Se permiten solo valores numericos",
        ],
        email:[
          val => (val !== null && val !== '') || 'El email es requerido.',
          // val => (val.length > 20 ) || 'Debe contener 20 digitos',
          val => (/[*# ,%´"'();&|<>]/.test(val) == false ) || "Se permiten solo valores numericos",
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
    const payStore = usePayStore()
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
    const cardType = ref('general');

    const getDropshippingLink = () => {
      if(!route.params.code) return
      linkStore.getDroshippingLinkByCode(route.params.code)
      .then((response) => {
        setTimeout(() => {
          ready.value = true
          link.value = response.data
          paystatus.value =  response.data.pay_status
          products.value = response.data.products_in_link
        }, 1000);
      })
    }
    const validateFrom = () => {
      let isOk = {result:true}

        Object.entries(formPayLink.value).forEach( ([key,value ]) => { if(value == '') isOk = {result:false, msg:"Debes completar el fomulario"} }); 

        if(validateCard(formPayLink.value.client_card_number)) {
          isOk = {result:false, msg:"Número de tarjeta no valido"}
          return isOk
        }

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

    const cleaveDate = (e) => {
        const value = e.target.value.split('/')
        if(parseInt(value[0]) > 12){
          formPayLink.value.client_card_due_date = '12'
        }
        
        if(value[0] == '00'){
          formPayLink.value.client_card_due_date = '01'
        }
        if(value[1] && value[1].length < 2){
          // formError.value = true
        }
        if(value[1] && value[1].length == 2){
          const verifyDate = new Date();
          if(parseInt(value[1]) > (verifyDate.getFullYear() + 10)-2000){
            formPayLink.value.client_card_due_date = value[0] + '' + ((verifyDate.getFullYear() + 10)-2000)
          }
        }
    }
    const cleaveCard = (e) => {
      const value = e.target.value
      cardType.value = getCreditCardType(value) ?? 'general'
    }
    const validateCard = (e) => {
      
      if(!e) {
        cardType.value = 'general'
        return false
      }
      let result = false
      if(getCreditCardNameByNumber(e) == 'Credit card is invalid!'  && !isValid(e)){
        alert('Tarjeta no valida.')
        result  = true
      }
      return result

    }

    const validateDate = (e) => {
      if(!e) {
        return true
      }
      const date = new Date();
      const year = date.getFullYear()+''
      const value = e.split('/');
      if(value[1] && value[1].length < 2){
        alert('Fecha no valida.')
      }
      if(!isExpirationDateValid(value[0], value[1])){


        

        alert('Fecha vencida.')
        if(parseInt(value[1]) < parseInt((year).slice(-2))){
          formPayLink.value.client_card_due_date = value[0] + '' + (year).slice(-2)
        }
      }
      
    }    
    const createDropshippingPay = () => {
      const validate = validateFrom() 

      if(!validate.result){
        showNotify('negative', validate.msg)
        return
      }
      loading.value = true;


      formPayLink.value.link_id = link.value.id;
      
      formPayLink.value.shipping_data = JSON.stringify({
        name:       formPayLink.value.client_ship_name,
        address:    formPayLink.value.client_ship_address,
        home:       formPayLink.value.client_ship_home,
        homeNumber: formPayLink.value.client_ship_home_number,
        country:    formPayLink.value.client_ship_country,
        city:       formPayLink.value.client_ship_city,
        contact:    formPayLink.value.client_ship_contact,
      })

      formPayLink.value.pay_data = JSON.stringify({
        name:       formPayLink.value.client_pay_name,
        dni:    formPayLink.value.client_pay_dni,
      })

      payStore.createPayLinkDropshipping(formPayLink.value)
      .then((response) => {
        if(response.code !== 200) throw response

        showDialog.value = true
        loading.value = false
        setTimeout(() => {
          router.push('/trasacction-public/view/15/'+response.data.id)
        }, 2000);

      }).catch((response) => {
        loading.value = false
      })
    } 
    const showError = (refs) => {

      scrollToDiv(refs.getNativeElement())
    }

    const scrollToDiv = (div) => {
      const elementTop = div.getBoundingClientRect().top + window.scrollY; // Get absolute position
        window.scrollTo({
          behavior: 'smooth',
          top: elementTop - 50, // Subtract offset for desired spacing
        });
    }


    onMounted(() => {
      getDropshippingLink()
    })
    return {
      done,
      showDialog,
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
      cardType,
      rulesForm,
      updateType,
      showNotify,
      createDropshippingPay,
      cleaveCard,
      validateDate,
      validateCard,
      cleaveDate,
      showError,
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

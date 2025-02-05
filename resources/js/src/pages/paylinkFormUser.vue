<template>
  <div class="q-py-sm" style="overflow: scroll; height: 100%;">
    <div class="q-px-md q-py-md" v-if="ready">
      <div class="q-mb-md">
        <div class="text-weight-bold">
          Comercio / Cliente:
        </div>
        <div class="contet__border-primary q-px-md q-py-none q-mt-xs">
          <div class="flex items-center payToContent q-my-md justify-between" >
            <div class="text-titlePay" v-if="route.params.type != 2 && route.params.type != 1 ">
              Comercio
            </div>
            <div class="flex items-center">
              <div class="text-titlePay">
                {{route.params.type != 2 && route.params.type != 1  ? link.user.name : 'Woz Payments'}}
              </div>
              <div class="bg-primary flex flex-center q-ml-xs iconcontent">
                <q-icon name="eva-checkmark-outline" color="white" size="0.9rem" />
              </div>
            </div>
          </div>
          <div class="flex justify-between payToContent q-my-md">
            <div class="text-titlePay">RUC / CI</div>
            <div class="text-titlePay">{{route.params.type != 2 && route.params.type != 1  ? numberFormat(link.user.dni) : numberFormat(4920791)}}</div>
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
                  ? route.query.description
                  : link.title +' - '+ link.note
                }}
              </div>
              <div class="text-titlePayP text-weight-bold text-grey-9 q-mt-xs">
                Gs. {{
                  route.params.type == 1 
                  ? numberFormat(220000)
                  : route.params.type == 2 
                  ? numberFormat(route.query.amount)
                  : numberFormat(link.amount)
                }}
              </div>
            </div>
            <div id="timeCountForm" class="text-titlePay text-backLinear" v-if="route.params.type != 2 && route.params.type != 1" />
          </div>
        </div>
      </div>
      <div class="q-mb-md">
        <div class="text-weight-bold">
          {{route.params.type != 2 &&  route.params.type != 1 ? 'Datos de tarjetas':'Datos para el pago'}}
        </div>
        
        <div class="contet__border-primary q-px-md q-py-xs q-mt-xs">
          <template v-if="route.params.type != 2 &&  route.params.type != 1 ">
            <div v-for="(item ,key) in clientForm" :key="key" class="q-mt-md ">
              <div class="q-px-xs text-bold q-pb-sm" v-if="item.title">
                {{ item.title }}
              </div>
              <q-input 
                class="q-pb-md paycardLink-input " 
                outlined 
                clearable
                :clear-icon="'eva-close-outline'"
                v-model="item.value" 
                :label="item.label"  
                autocomplete="off"
                :rules="rulesForm(key)"
                :mask="maskFormat(key)"
                :maxlength="key == 'cvc' ? 3 : ''"
                @keyup="callbackKeyup(key,$event)"
                @change="callbackChange(key, $event)"
              />
              <div class="q-px-xs q-pt-md" v-if="item.sublabel">
                {{ item.sublabel }}
              </div>
            </div>
          </template>
          <template v-else>
            <div class="q-px-md q-py-sm q-my-md infoPay__content" v-for="(item,key) in dataPay" :key="key">
              {{ item }}
            </div>
            <div class="q-my-md">
              <div class="text-bold q-px-xs">
                Comprobante
              </div>
              <div class="q-pt-xs">
                <q-file accept=".jpg, .pdf, image/*" outlined dense class="file_paylink" label="Adjunta tu comprobante 📂"  v-model="comprobant"/>
              </div>
              <div class="text-weight-medium q-px-xs q-mt-sm" style="font-size: 0.75rem;" >
                Te confirmaremos el estado de tu pago en el dia
              </div>
            </div>
          </template>
          <div class="q-px-xl q-mt-md flex flex-center q-pb-sm">
            <img :src="payMethod" alt="" style=" height: 2.1rem;">
          </div>
          <div v-if="formError" class="text-subtitle1 text-negative text-bold text-center q-mt-md flex flex-center">
            <q-icon name="eva-alert-circle-outline" color="negative" size="sm"/>
            {{ errorMessage }}
          </div>
        </div>
      </div>
      <div class="linkPay_content q-px-md-xl q-pb-md" >
        <q-btn 
            color="primary" class="w-100 q-pa-npne q-mb-none linkPay_button" 
            no-caps
            :loading="loading"
            @click="procedToPay()"
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
  import { useLinkStore } from '@/services/store/link.store';
  import { useQuasar } from 'quasar'
  import util from '@/util/numberUtil'
  import payMethod from '@/assets/images/pay_types3.png'
  import doneModal from '@/components/layouts/modals/doneModal.vue';
  import moment from 'moment';
  import { getCreditCardType } from 'cleave-zen'
  import { 
    isValid, 
    isExpirationDateValid,
    getCreditCardNameByNumber,
  } from 'creditcard.js';

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
      const linkStore = useLinkStore()
      const link = ref({})
      const ready = ref(!(!route.query.title))
      const errorMessage = ref('')
      const comprobant = ref([]);
      const requirements = ref({
        card: user.value.card ?? false,
        current: user.value.current_loan ?? false,
        loan:user.value.loans_complete_count ?? false,
      })
      const dataPay = payStore.getDataTransfer()
      const cardType = ref('general');
      const formError = ref(false)
      const clientForm = ref({
        nameClient:{
          value:'',
          label:'Nombre en la tarjeta'
        },
        numberClient:{
          value:'',
          label:'Número de tarjeta'
        },
        due:{
          value:'',
          label:'Fecha de vencimiento'
        },
        cvc:{
          value:'',
          label:'Código de seguridad'
        },
        email:{
          value:'',
          title:'Información extra',
          sublabel:'Te confirmaremos el estado de tu pago',
          label:'Correo electrónico'
        },
      })
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
      const procedToPay = () => {
        route.params.type == 1 || route.params.type == 2 
        ? createPay()
        : createPayClient()
      }
      const createPay = () => {
        
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
            ? route.query.amount
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
        if(route.params.type == 2){
        data.append('package', route.query.id)

        }
        payStore.createPay(data)
        .then((response) => {
          if(response.code !== 200) throw response

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
      const createPayClient = () => {
        if(!validate()){
          showNotify('negative', 'Debe completar el formulario')
          return
        }
        loading.value = true;
        const data = new FormData()

        data.append('link_id', link.value.id)
        data.append('concept', link.value.title +' - '+ link.value.note)

        data.append('card', clientForm.value.numberClient.value)
        data.append('card_name', clientForm.value.nameClient.value)
        data.append('cvc', clientForm.value.cvc.value)
        data.append('date', clientForm.value.due.value)
        data.append('email', clientForm.value.email.value)



        payStore.createPayLink(data)
        .then((response) => {
          if(response.code !== 200) throw response

          showDialog.value = true
          loading.value = false
          setTimeout(() => {
            // router.push('/dashboard')
          }, 2000);

        }).catch((response) => {
          loading.value = false
        })
      }
      const getLink = () => {
        if(!route.params.code) return
        linkStore.getLinkByCode(route.params.code)
        .then((response) => {
          ready.value = true
          link.value = response.data
          clocks()
        })
      }
      const clocks = () => {
        link.value.timer = setInterval( () => {
          let today =  new Date().getTime();
          let link_due_date = new Date(moment(link.value.due_time)).getTime();
          let diffTime = link_due_date - today;
          let duration = moment.duration(diffTime, 'milliseconds');

          if(diffTime < 0) {
            clearInterval(link.value.timer);
            setTimeout(() => {
              document.getElementById('timeCountForm').innerHTML = '00:00:00'
            },1000)
            return
          }
          
          duration = moment.duration(duration - 1000, 'milliseconds');
          let hour = (duration.hours()+'').length == 1 ? '0' + duration.hours() : duration.hours()
          let minutes = (duration.minutes()+'').length == 1 ? '0' + duration.minutes() : duration.minutes()
          let seconds = (duration.seconds()+'').length == 1 ? '0' + duration.seconds() : duration.seconds()
          document.getElementById('timeCountForm').innerHTML =  hour + ":" + minutes + ":" + seconds
        }, 1000)

      }

      const rulesForm = (key) => {
        const iRules = {
          nameClient:[
            val => (val !== null && val !== '') || 'El nombre del titular es obligatorio.',
            // val => (val.length > 20 ) || 'Debe contener 20 digitos',
            val => (/[,%".'()*#|;?&|<>]/.test(val) == false ) || "Nombre no valido",
          ],
          numberClient:[
            val => (val !== null && val !== '') || 'El número de tarjeta es requerido.',
            // val => (val.length > 20 ) || 'Debe contener 20 digitos',
            val => (/[a-zA-z,%"'();+*&|<>]/.test(val) == false ) || "Se permiten solo valores numericos",
          ],
          due:[
            val => (val !== null && val !== '') || 'La fecha de vencimiento es requerida.',
            // val => (/[,%"' ();&|<>]/.test(val) == false ) || 'No debe contener espacios, ni "[](),%|&;\'" ',
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
        }
        
        return iRules[key]
      }
      const maskFormat = (key) => {
        const iMask = {
          nameClient:'',
          numberClient:'',
          due:'##/##',
          cvc:'###',
          email:'',
        }
        
        return iMask[key]
      }
      const cleaveDate = (e) => {
        const value = e.target.value.split('/')
        if(parseInt(value[0]) > 12){
          clientForm.value.due.value = '12'
        }
        if(value[0] == '00'){
          clientForm.value.due.value = '01'
        }
        if(value[1] && value[1].length < 2){
          formError.value = true
        }
        if(value[1] && value[1].length == 2){
          formError.value = false
          const verifyDate = new Date();
          if(parseInt(value[1]) > (verifyDate.getFullYear() + 10)-2000){
            clientForm.value.due.value = value[0] + '' + ((verifyDate.getFullYear() + 10)-2000)
          }
        }
      }
      const cleaveCard = (e) => {
        const value = e.target.value
        cardType.value = getCreditCardType(value)
      }
      const validateCard = (e) => {
        if(!e) {
          cardType.value = 'general'
          return false
        }
        formError.value = false
        if(getCreditCardNameByNumber(e) == 'Credit card is invalid!'  && !isValid(e)){
          alert('Tarjeta no valida.')
          errorMessage.value = 'Tarjeta no valida'
          formError.value = true
        }

        return formError.value
      }

      const validateDate = (e) => {
        if(!e) {
          return true
        }
        const value = e.split('/');
        formError.value = false
        if(value[1] && value[1].length < 2){
          alert('Fecha no valida.')
          errorMessage.value = 'Fecha no valida'
          formError.value = true
        }
        if(!isExpirationDateValid(value[0], value[1])){
          alert('Fecha vencida.')
          errorMessage.value = 'Fecha vencida.'
          formError.value =  true
        }
        
        return formError.value
      }    

      const callbackKeyup = (key, e) => {

        if(key == 'nameClient') return
        if(key == 'numberClient') {
          cleaveCard(e)
          return
        }
        if(key == 'due'){
          cleaveDate(e)
          return
        }
        if(key == 'cvc') return
        if(key == 'email') return
      }
      const callbackChange = (key, e) => {
        if(key == 'nameClient') return
        if(key == 'numberClient') {
          validateCard(e)
          return
        }
        if(key == 'due'){
          validateDate(e)
          return
        }
        if(key == 'cvc') return
        if(key == 'email') return

   
      }
      const validate = () => {
        let isOk = true

        Object.entries(clientForm.value).forEach( ([key,value ]) => { if(value.value == '') isOk = false }); 

        if(validateCard(clientForm.value.numberClient.value)) {
          isOk = false
          return isOk
        }

        if(validateDate(clientForm.value.due.value)) {
          isOk = false
          return isOk
        }

        return isOk
      }

      onMounted(() => {
        if(validateRequeriments()){
          router.push('/generatePayLink/1/1')
        }
        getLink()
      })

      return{
        showDialog,
        formError,
        errorMessage,
        user,
        router,
        route,
        loading,
        ready,
        numberFormat,
        icons,
        link,
        dataPay,
        clientForm,
        comprobant,
        payMethod,
        procedToPay,
        rulesForm,
        maskFormat,
        callbackKeyup,
        callbackChange
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

.paycardLink-input {
  & .q-field__control {
    border-radius: 10px!important;
    height: 45px;
    &::before{
      border-color: rgb(141, 141, 141);
    }
  }
  & .q-field__label{
    transform: translateY(-18%)
  }
  &.q-field--focused .q-field__label, &.q-field--float .q-field__label{
    z-index: 100;
    background: white!important;
    font-weight: 600;
    max-width: 133%;
    padding: 0px 10px;
    transform: translateY(-125%) translateX(4%) scale(0.75)!important;
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
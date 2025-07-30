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
      <div class="q-px-md q-mt-md">
        <div class="text-subtitle1 text-weight-bold text-blue-grey-10"> 
          Crea un link para ventas
        </div>
        <div class=" text-blue-grey-9  q-mt-sm text-weight-light flex items-end q-mr-none" style="font-size: 0.88rem;"> 
          <div>
            Disponible para cobros de servicios internacionales 
          </div>
          <q-icon name="eva-checkmark-circle-2-outline" color="positive" size="1.3rem" class=" q-ml-xs" style="margin-top: -5px;"/>
        </div>
      </div>
      <div>
        <div class="q-px-md q-mt-md">
          <q-select 
            option-value="id" 
            option-label="name" 
            v-model="selectedOption" 
            :options="optionsLink"  
            :clear-icon="'eva-close-outline'"
            dropdown-icon="eva-chevron-down-outline"
            behavior="menu"
            color="positive"
            class="linkPaySelectType" 
            disabled
            disable
          />
        </div>

        <div class="q-px-md q-mt-lg">
          <div>
            <q-input
              class="linkPaySelectType2"
              clearable
              :clear-icon="'eva-close-outline'"
              color="positive"
              v-model="product.title"
              label="Nombre del producto"
              :rules="rulesForm('name')"
              autocomplete="off"
              disable
            />
          </div>
          <div class=" linkPaySelectType q-mt-sm">
            <q-select 
              option-value="id" 
              option-label="name" 
              label="Selecciona la moneda"
              v-model="selectedCoin" 
              :options="optionCoin"  
              :clear-icon="'eva-close-outline'"
              dropdown-icon="eva-chevron-down-outline"
              behavior="menu"
              color="positive"
              :hint="selectedCoin.id == 1 ?'' : '1 USD ≈ ' +'Gs.'+ numberFormat(selectedCoin.rate) "
              class="linkPaySelectType" 
              @update:model-value="updateType()"
            />
          </div>
          <div class="q-mt-md">
            <q-input
              class="linkPaySelectType2"
              clearable
              :clear-icon="'eva-close-outline'"
              color="positive"
              v-model="product.price"
              :label="selectedCoin.id == 1 ?'Precio base en Gs.':'Precio base en dolares'"
              :rules="rulesForm('amount')"
              autocomplete="off"
              disable
            />
          </div>
          <div class="q-mt-sm">
            <q-input
              class="linkPaySelectType2"
              clearable
              :clear-icon="'eva-close-outline'"
              color="positive"
              v-model="product.dropper_price"
              :label="selectedCoin.id == 1 ?'Precio de venta en Gs.':'Precio de venta en dolares'"
              mask="###.###.###"
              reverse-fill-mask
              :rules="rulesForm('amount')"
              autocomplete="off"
            />
          </div>
          <div class="q-mt-sm">
            <q-input
              class="linkPaySelectType2"
              :clear-icon="'eva-close-outline'"
              color="positive"
              v-model="product.quantityOrder"
              label="Cantidad"
              :rules="[ val => !!val  || 'El campo es obligatorio', val => val >= 1]"
              autocomplete="off"
              @update:model-value="formatQuantity"
            />
          </div>
          <div class="q-mt-sm">
            <q-input
              class="linkPaySelectType2"
              clearable
              :clear-icon="'eva-close-outline'"
              color="positive"
              v-model="product.details"
              label="Agregar detalles"

              autocomplete="off"
            />
          </div>
        </div>
        <div class="q-px-md">
          <div class="flex justify-between items-center q-px-md q-mt-lg text-weight-bold text-subtitle1 q-mb-lg amount__items q-py-sm">
            <div class="q-py-xs">Total a cobrar</div>
            <div>
              <div class="text-right">

                {{selectedCoin.code}}
                {{  isNaN(parseInt(product.dropper_price.replace(/\./g, ''))) 
                  ? 0
                  : numberFormat((parseInt(product.dropper_price.replace(/\./g, '')))*product.quantityOrder )
                }}
              </div>
              <div v-if="selectedCoin.code=='USD'" style="font-size:0.75rem; font-weight:400; color:grey; text-align:end;line-height:0.5" >
                ≈ Gs.
                {{  isNaN(parseInt(product.dropper_price.replace(/\./g, ''))*selectedCoin.rate) 
                  ? 0
                  : numberFormat((parseInt(product.dropper_price.replace(/\./g, ''))*selectedCoin.rate)*product.quantityOrder )
                }}
              </div>
            </div>
          </div>
           <div class="flex justify-between items-center q-px-md q-mt-lg text-weight-bold text-subtitle1 q-mb-lg amount__items q-py-sm">
            <div class="q-py-xs">Comisión por producto</div>
            <div>
              <div class="text-right">
                {{selectedCoin.code}}
                {{  isNaN( parseInt(product.dropper_price.replace(/\./g, ''))) 
                  ? 0
                  : numberFormat(((parseInt(product.dropper_price.replace(/\./g, '')) - parseInt(product.price.replace(/\./g, '')))))
                }}
              </div>
              <div v-if="selectedCoin.code=='USD'" style="font-size:0.75rem; font-weight:400; color:grey; text-align:end;line-height:0.5" >
                ≈ Gs.
                {{  isNaN( parseInt(product.dropper_price.replace(/\./g, '')) *selectedCoin.rate) 
                  ? 0
                  : numberFormat(((parseInt(product.dropper_price.replace(/\./g, '')) - parseInt(product.price.replace(/\./g, '')))*selectedCoin.rate) )
                }}
              </div>
            </div>
          </div>
           <div class="flex justify-between items-center q-px-md q-mt-lg text-weight-bold text-subtitle1 q-mb-lg amount__items q-py-sm">
            <div class="q-py-xs">Comisión total por venta</div>
            <div>
              <div class="text-right">
                {{selectedCoin.code}}
                {{  isNaN(parseInt(product.dropper_price.replace(/\./g, ''))) 
                  ? 0
                  : numberFormat(((parseInt(product.dropper_price.replace(/\./g, '')) - parseInt(product.price.replace(/\./g, ''))) )*product.quantityOrder )
                }}
              </div>
              <div v-if="selectedCoin.code=='USD'" style="font-size:0.75rem; font-weight:400; color:grey; text-align:end;line-height:0.5" >
                ≈ Gs.
                {{  isNaN(parseInt(product.dropper_price.replace(/\./g, ''))) 
                  ? 0
                  : numberFormat(( (parseInt(product.dropper_price.replace(/\./g, '')) - parseInt(product.price.replace(/\./g, ''))) )*selectedCoin.rate )
                }}
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="q-px-md q-pb-lg">
        <q-btn 
          :loading="loading"
          unelevated
          no-caps 
          color="terciary" 
          class="full-width q-pa-sm" 
          @click="createLink"
        >
          <template v-slot:loading>
            <q-spinner-facebook />
          </template>
          <div class="q-py-xs">Generar link de pago</div>
        </q-btn>
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
  import { useAuthStore } from '@/services/store/auth.store';
  import { useCoinStore } from '@/services/store/coin.store';

export default {
  components: {
    doneModal,
    dotsWoz
  },
  props:{
    product: Object
  },  
  setup(props) {
    const { user } = storeToRefs(useAuthStore())
    const q = useQuasar();
    const router = useRouter()
    const route = useRoute();
    const numberFormat = util.numberFormat
    const numberFormatDecimal = util.numberFormatDecimal
    const linkStore = useLinkStore()
    const coinStore = useCoinStore()
    const loading = ref(false)
    const done = ref(false)
    const formatProduct = (product) => {
      let productFormated = []
      Object.entries(product).forEach(([key, value]) => {
        
        productFormated[key] = value;
        if(key=='price') productFormated[key] = numberFormat(value);
      
      }); 
      productFormated['dropper_price'] = ""
      productFormated['details'] = ""

      productFormated['quantityOrder'] = 1
  
      return productFormated
    }
    const product = ref(formatProduct(props.product))
    const optionsLink = [
      {
        id:0,
        name:'Venta Woz Dropshopping'
      },

    ]
    const optionCoin = ref([])
    const selectedOption = ref(optionsLink.find(el => el.id == 0))
    const selectedCoin = ref({})
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
    
    const validateFrom = () => {
      let isOk = true
      Object.entries(product.value).forEach( ([key,value ]) => { 
        if( key =='quantityOrder' || key =='dropper_price'){
          if(value == '') isOk = false
        }
      }); 

      return isOk
    }
    const createLink = () => {
      if(!validateFrom()){
        showNotify('negative', 'Debes completar el formulario')
        return
      }
      if(parseInt(product.value.dropper_price.replace(/\./g, '')) < parseInt(product.value.price.replace(/\./g, ''))){
        showNotify('negative', 'Precio de venta debe ser mayor al precio base')
        return
      }
      loading.value = true
      let formattedProduct = Object.assign({}, product.value)
      formattedProduct.price = parseInt(formattedProduct.price.replace(/\./g, '') )
      formattedProduct.dropper_price = parseInt(formattedProduct.dropper_price.replace(/\./g, '') )

      const data = {
        note:   product.value.details,
        amount: (parseInt(product.value.dropper_price.replace(/\./g, ''))  * product.value.quantityOrder),
        amount_to_client: ((parseInt(product.value.dropper_price.replace(/\./g, '')) - parseInt(product.value.price.replace(/\./g, '')))  * product.value.quantityOrder ),
        coin : selectedCoin.value.id,
        products: JSON.stringify([formattedProduct])

      }
      linkStore.createLinkDropshipping(data)
      .then((response) => {
        if(response.code !== 200) throw response

        loading.value = false
        done.value = true
        setTimeout(() => {
          goTo(response.data.id)
        }, 1000);
      })
      .catch((response) => {
        console.log(response)
        showNotify('negative', response)
        loading.value = false
      })
    }
    const goTo = (id) => {
      router.push('/dropshipping/details_link/'+id)
    }
    const updateType = () => {
      product.value.price = selectedCoin.value.code == 'USD'
      ? numberFormat((parseInt(product.value.price.replace(/\./g, ''))/ selectedCoin.value.rate))
      : numberFormat(parseInt(props.product.price))
    }
    const getCoinsForOption = () => {
      coinStore.getCoins()
      .then((response) =>{
        if (response.code != 200) throw response
        
        optionCoin.value = response.data
        selectedCoin.value = optionCoin.value[0]
      })
      .catch(() => {
        showNotify('negative', 'Error al obtener monedas')
      })
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

    const formatQuantity = (value) =>{
      // Filtra solo números (elimina todo lo que no sea dígito)
      
      product.value.quantityOrder = value.replace(/[^0-9]/g, '');
      product.value.quantityOrder = parseInt(product.value.quantityOrder)
      
      if(isNaN(product.value.quantityOrder)){
        product.value.quantityOrder = 0
        return
      }
      product.value.quantityOrder = parseInt(product.value.quantityOrder)

    }
    onMounted(() => {
      getCoinsForOption()
      // countLinkUsed()

    })
    return {
      done,
      user,
      selectedCoin,
      router,
      route,
      loading,
      icons: inject('ionIcons'),
      wozIcons,
      optionsLink,
      optionCoin,
      selectedOption,
      product,
      numberFormat,
      numberFormatDecimal,
      rulesForm,
      createLink,
      formatQuantity,
      updateType,
    }
  },
}
</script>

<style lang="scss" scoped>

#linkGenerateContent{
  height: 91%;
  overflow-y: auto;
}
@media screen and (max-width: 780px){
  #linkGenerateContent{
    height: 92%;
  }
}
</style>
<style lang="scss">
  @keyframes circle-in-center {
    from {
      clip-path: circle(0%);
    }
    to {
      clip-path: circle(125%);
    }
  }


  .swicht {
    animation: 1.5s cubic-bezier(.25, 1, .30, 1) circle-in-center both;
  }

  .amount__items{
    border: 1px solid rgb(82, 82, 82);
    border-radius: 8px;
  }
  .linkPaySelectType.q-field--auto-height.q-field--labeled{
     & .q-field__control-container{
      padding-top: 0px!important;
     }
  }
  .linkPaySelectType, .linkPaySelectType2  {

    & .q-field__control{
      border-radius: 0px!important;
      height: 50px!important;
      min-height: 50px!important;
      padding: 0px 0.2rem;
    }
    & .q-field__label{
    transform: translateY(0%)
    }
    &.q-field--focused .q-field__label, &.q-field--float .q-field__label{
      z-index: 100;
      background: white;
      font-weight: 600;
      max-width: 133%;
      transform: translateY(-125%) translateX(0%) scale(0.75)!important;
    }
    
    & .q-field__native{
      padding-top: 5px!important;
      font-weight: 500;
    }
    & .q-field__append{
      transform: translateY(-2%)
    }
    & .q-field__messages {
      transform: translateY(-25%) translateX(-1%)
    }
    
  }
  .linkPaySelectType2 .q-field__native{
    padding-top: 15px!important;
  }
  .linkPaySelectType2.q-field--disabled .q-field__inner, .linkPaySelectType.q-field--disabled .q-field__inner{
    border-radius: 0px;
    border-top-left-radius: 0.5rem;
    border-top-right-radius: 0.5rem;

  }
  .totalLink_progress {
    border: 1px solid transparent;
    width: 90%!important;
    border-radius: 90px;
    & .q-linear-progress__track{
      opacity: 1;
    }
    & .q-linear-progress__model {
      border-top-right-radius: 90px;
      border-bottom-right-radius: 90px;
    }
  }
  @media screen and (max-width: 780px){
    #auth-section{
      height: 100vh; 
    }
    .totalLink_progress {
      width: 80%!important;

    }
  }
  .linkPaySelectType {
    &.q-field--labeled .q-field__native{
      padding-bottom: 0px;
    }
  }
  @media screen and (max-width: 780px){
  .linkPaySelectType {
      & .q-field__bottom{
        transform: translateY(15px);
      }
      & .q-field__messages {
        transform: translateY(10%) translateX(-1%)
      }
    }
  }
</style>
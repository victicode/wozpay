<template>
  <div class="layout-dasboard__content" style="">
    <div id="linkGenerateContent">
      <div class="hero-content q-px-md q-pt-lg q-px-md-sm bg-primary" transition-style="in:circle:center"  >
        <div class=" q-px-md-lg hero-content_title bg-primary" transition-style="in:circle:center" >
          <div class="text-h4 text-white text-weight-bold  text-font-roboto"  style="font-size: 2.3rem;">
           Link de producto
          </div>
          <div class="text-subtitle1 text-white q-mt-sm text-weight-medium text-font-roboto">
            Productos
          </div>
   
        </div>
      </div> 
      <div>
        <div class="q-px-md q-mt-lg">
          <q-select 
            outlined 
            option-value="id" 
            option-label="name" 
            v-model="selectedOption" 
            :options="optionsLink"  
            :clear-icon="'eva-close-outline'"
            dropdown-icon="eva-chevron-down-outline"
            behavior="menu"
            color="positive"
            class="linkPaySelectType" 
            @update:model-value="updateType()"
          />
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
        <div class="q-px-md q-mt-md">
          <div>
            <q-input
              class="linkPaySelectType2"
              outlined
              clearable
              :clear-icon="'eva-close-outline'"
              color="positive"
              v-model="product.name"
              label="Nombre del producto"
              :rules="rulesForm('name')"
              autocomplete="off"
            />
          </div>
          <div class=" linkPaySelectType q-mb-sm q-mt-xs q-pb-xs">
            <q-select 
              outlined 
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
          <div v-if="selectedOption.id == 2" class="q-mt-sm q-pb-md">
            <q-input
              class="linkPaySelectType2"
              outlined
              clearable
              :clear-icon="'eva-close-outline'"
              color="positive"
              v-model="product.initDay"
              label="Fecha de inicio de cobro mensual"
              mask="##/##/####"
              autocomplete="off"
              hint="Formato: DD/MM/YYYY"
            />
          </div>
          <div v-if="selectedOption.id == 2" class="q-mt-sm q-pb-md">
            <q-input
              class="linkPaySelectType2"
              outlined
              clearable
              :clear-icon="'eva-close-outline'"
              color="positive"
              v-model="product.forMonth"
              label="Cobrar durante X meses"
              autocomplete="off"
              type="number"
            />
          </div>
          <!-- <div v-if="selectedOption.id == 2" class="q-mt-sm q-pb-md">
            <q-select 
              outlined 
              v-model="product.forMonth" 
              :options="daysAvaibles()"  
              clearable
              :clear-icon="'eva-close-outline'"
              dropdown-icon="eva-chevron-down-outline"
              behavior="menu"
              label="Día de cobro"
              color="positive"
              class="linkPaySelectType" 
              @update:model-value="updateType()"
            />
          </div> -->
          <div class="q-mt-sm">
            <q-input
              class="linkPaySelectType2"
              outlined
              clearable
              :clear-icon="'eva-close-outline'"
              color="positive"
              v-model="product.amount"
              :label="selectedCoin.id == 1 ?'Precio en Gs.':'Precion en dolares'"
              mask="###.###.###"
              reverse-fill-mask
              :rules="rulesForm('amount')"
              autocomplete="off"
              @keyup="totalToClient()"
            />
          </div>
          <div class="q-mt-sm">
            <q-input
              class="linkPaySelectType2"
              outlined
              clearable
              :clear-icon="'eva-close-outline'"
              color="positive"
              v-model="product.details"
              label="Agregar detalles"
              :rules="rulesForm('description')"
              autocomplete="off"
            />
          </div>
          
        </div>
        <div class="q-px-md q-mt-md">
          <div class="text-subtitle1 text-weight-bold text-blue-grey-10"> 
            Woz Pay te informa que éstas son las comisiones a ser descontadas
          </div>
        </div>
        <div class="q-px-md">
          <div class="flex justify-between items-center q-px-md q-mt-lg  text-subtitle1 q-mb-lg amount__items q-py-sm">
            <div class="q-py-xs">{{route.params.type == 0 ? 'Comisión Woz Pay 2%' : 'Comisión Woz Pay 12%'}}</div>
            <div>
              {{selectedCoin.code}} {{ 
                !isNaN((parseInt(product.amount.replace(/\./g, ''),)*feedWoz)) 
                ? numberFormat((parseInt(product.amount.replace(/\./g, ''))*feedWoz))
                : 0
              }}
            </div>
          </div>
          <div class="flex justify-between items-center q-px-md q-mt-lg  text-subtitle1 q-mb-lg amount__items q-py-sm">
            <div class="q-py-xs">Comision por transacción</div>
            <div>
              {{selectedCoin.code}} {{ route.params.type == 0 ? '0' : numberFormatDecimal(7800/selectedCoin.rate) }}
            </div>
          </div>
          <div class="flex justify-between items-center q-px-md q-mt-lg text-weight-bold text-subtitle1 q-mb-lg amount__items q-py-sm">
            <div class="q-py-xs">Total a cobrar</div>
            <div>
              {{selectedCoin.code}}
              {{  product.to_client }}
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
          :disable="countLink >= limit()"
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
  import { storeToRefs } from 'pinia';
  import { useAuthStore } from '@/services/store/auth.store';
  import { useCoinStore } from '@/services/store/coin.store';

export default {
  components: {
    doneModal
  },
  setup() {
    const { user } = storeToRefs(useAuthStore())
    const q = useQuasar();
    const router = useRouter()
    const route = useRoute();
    const numberFormat = util.numberFormat
    const numberFormatDecimal = util.numberFormatDecimal
    const linkStore = useLinkStore()
    const coinStore = useCoinStore()
    const feedWoz = ref(route.params.type == 0 ? 0.02 : 0.12);
    const loading = ref(false)
    const done = ref(false)
    const countLink = ref(0)
    const product = ref({
      name:'',
      amount:'',
      to_client:0,
      details:'',
      initDay:'',
      forMonth:1
    })
    const title = [
      
      {
        title:'Links de cortesía',
        subtitle:'Sólo puedes generar una cantidad de 6 links en la versión gratuita',
        color:'#ffc701',
        track: 'primary'
      },
      {
        title:'Links ilimitados',
        subtitle:'Puedes generar todos los lins de manera ilimitada',
        color:'#19cd15',
        track: 'white'
      },
      {
        title:'Links de membresías',
        subtitle:'Cobra tus membresías o suscripciones de manera mensual con debito automatico',
        color:'#0449fb',
        track: 'terciary'
      },
      {
        title:'Links de freelancers',
        subtitle:'Genera links para tus honorarios como freelancer',
        color:'#929396',
        track: 'terciary'
      },
      {
        title:'Links de ventas',
        subtitle:'Genera links para enviárselo a tus compradores',
        color:'#ffc701',
        track: 'primary'
      },
      
    ]
    const limit = () => {
      
      if(route.params.type == 0) return user.value.free_link
      if(route.params.type == 1) return user.value.free_link
      if(route.params.type == 2) return user.value.membership_link
      if(route.params.type == 3) return user.value.freelancer_link
      if(route.params.type == 4) return user.value.sell_link

    }
    const optionsLink = [
      {
        id:0,
        name:'Selecciona el tipo de link'
      },
      {
        id:4,
        name:'Ventas'
      },
      {
        id:2,
        name:'Membresías'
      },
      {
        id:3,
        name:'Freelancers'
      },
    ]
    const optionCoin = ref([])

    const daysAvaibles = () => {
      let days = []
      for (let index = 0; index < 28; index++) {
        days.push(index+1)
        
      }
      return days;
    }

    
    const header = ref(title[parseInt(route.params.type)])
    const selectedOption = ref(optionsLink.find(el => el.id == 0))
    const selectedCoin = ref({})
    const updateType = () => {
      
      header.value = title[selectedOption.value.id]
      if(document.querySelector('.hero-content_title').classList.contains('swicht')){
        document.querySelector('.hero-content_title').classList.remove('swicht')
      }
      setTimeout(() => {
        document.querySelector('.hero-content_title').classList.add('swicht')
      }, 10);
    }
    const rulesForm = (id) => {
      const iRules = {
        name:[
          val => (val !== null && val !== '') || 'Nombre del producto es requerido.',
          // val => (val.length > 20 ) || 'Debe contener 20 digitos',
          val => (/[,%\"'();&|<>]/.test(val) == false ) || 'No debe contener espacios, ni "[](),%|&;\'" ',
        ],
        amount:[
          val => (val !== null && val !== '') || 'Monto es requerido',
        ],
        description:[
          val => (val !== null && val !== '') || 'Detalles de producto es requerido.',
          // val => (val.length > 20 ) || 'Debe contener 20 digitos',
          val => (/[%\-"'();&|<>]/.test(val) == false ) || 'No debe contener espacios, ni "[](),%|&;\'" ',
        ],
      }
      
      return iRules[id]
    }
    const validateFrom = () => {
      let isOk = true
      Object.entries(product.value).forEach( ([key,value ]) => { 
        

        if( key !='forMonth' && key !='initDay'){
          
          if(value == '') isOk = false
        }
      }); 
      
      if(selectedOption.value.id == 0) {
        showNotify('negative', 'Debes selecionar un metodo de pago')
        return false
      }
      // if( isNaN(product.value.forMonth)) {
      //   isOk = false
      // }
      // console.log(isNaN(product.value.forMonth))
      // console.log(product.value.forMonth)

      return isOk
    }
    const createLink = () => {
      if(!validateFrom()){
        showNotify('negative', 'Debes completar el formulario')
        return
      }
      if(countLink.value >= limit()){
        showNotify('negative', 'Alcanzaste el maximo de tus links, adquiere un paquete')
        return
      }
      loading.value = true
      const data = {
        note:   product.value.details,
        amount: parseInt(product.value.amount.replace(/\./g, ''))*selectedCoin.value.rate,
        amount_to_client:parseInt(product.value.to_client.replace(/\./g, ''))*selectedCoin.value.rate,
        coin :selectedCoin.value.id,
        title:  product.value.name,
        type:   selectedOption.value.id,
        categorie: route.params.type,
        init_day: product.value.initDay.replace(/\//g, '.'),
        recurring_day:  product.value.initDay.replace(/\//g, '.').split('.')[0],
        for_month:  product.value.forMonth,

      }
      linkStore.createLink(data)
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
    const goTo = (id) => {
      router.push('/link/pay/'+id)
    }

    const filterByCategorie = (data) => {
      const free      = data.filter(item => item.categorie == route.params.type)
      const sell      = data.filter(item => item.categorie == route.params.type)
      const member    = data.filter(item => item.categorie == route.params.type)
      const freelance = data.filter(item => item.categorie == route.params.type)

      return [free, '', member, freelance, sell,]
    }
    const totalToClient  = () => {
      product.value.to_client = route.params.type == 0 && !isNaN((parseInt(product.value.amount.replace(/\./g, ''),)*0.02)) 
                ? numberFormat((parseInt(product.value.amount.replace(/\./g, '') - parseInt(product.value.amount.replace(/\./g, ''))*0.02)))
                : !isNaN((parseInt(product.value.amount.replace(/\./g, ''),)*0.12) ) 
                ? numberFormat((parseInt(product.value.amount.replace(/\./g, '') - parseInt(product.value.amount.replace(/\./g, ''))*0.12) )- (7800/selectedCoin.value.rate) )
                : 0
    }
    onMounted(() => {
      q.addressbarColor.set(title[parseInt(route.params.type).color])
      getCoinsForOption()
      // countLinkUsed()

    })
    return {
      done,
      user,
      countLink,
      selectedCoin,
      router,
      route,
      header,
      loading,
      daysAvaibles,
      icons: inject('ionIcons'),
      wozIcons,
      optionsLink,
      selectedOption,
      product,
      numberFormat,
      numberFormatDecimal,
      rulesForm,
      updateType,
      createLink,
      limit,
      optionCoin,
      totalToClient,
      feedWoz,
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
      border-radius: 10px!important;
      height: 50px!important;
      min-height: 50px!important;
    }
    & .q-field__label{
    transform: translateY(0%)
    }
    &.q-field--focused .q-field__label, &.q-field--float .q-field__label{
      z-index: 100;
      background: white;
      font-weight: 600;
      max-width: 133%;
      transform: translateY(-125%) translateX(4%) scale(0.75)!important;
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
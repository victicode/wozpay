<template>
  <div class="layout-dasboard__content" style="">
    <div id="linkGenerateContent">
      <div class="hero-content q-px-md q-pt-lg q-px-md-xl" :style="'background:'+header.color" >
        <div class=" q-px-md-lg">
          <div class="text-h4 text-white text-weight-medium" >
            {{header.title}}
          </div>
          <div class="text-subtitle1 text-white q-mt-sm text-weight-medium q-pb-md">
            Sólo puedes generar una cantidad de 6 links
            en la versión gratuita
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
            clearable
            :clear-icon="'eva-close-outline'"
            dropdown-icon="eva-chevron-down-outline"
            behavior="menu"
            color="positive"
            class="linkPaySelectType" 
          />
        </div>
        <div class="q-px-md q-mt-md">
          <div class="text-subtitle1 text-weight-bold text-blue-grey-10"> 
            Crea un link para ventas
          </div>
          <div class="text-subtitle2 text-blue-grey-9 q-pr-xl q-mt-sm text-weight-light"> 
            Disponible para cobros de servicios internacionales 
            <q-icon name="eva-checkmark-circle-2-outline" color="positive" size="1.5rem" class="q-mt-sm" style="margin-top: -5px;"/>
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
          <div class="q-mt-sm">
            <q-input
              class="linkPaySelectType2"
              outlined
              clearable
              :clear-icon="'eva-close-outline'"
              color="positive"
              v-model="product.amount"
              label="Precio en Gs."
              mask="###.###.###"
              reverse-fill-mask
              :rules="rulesForm('amount')"
              autocomplete="off"
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
      </div>
      <div>

      </div>
    </div>
  </div>
</template>
<script>
  import { useRoute, useRouter } from 'vue-router';
  import { inject, onMounted } from 'vue';
  import { useQuasar } from 'quasar';
  import wozIcons from '@/assets/icons/wozIcons';

export default {
  setup() {
    const router = useRouter()
    const route = useRoute();
    const product = ref({
      name:'',
      amount:'',
      details:'',
    })
    const title = [
      
      {
        title:'Links de cortesía',
        color:'#ffc701'
      },
      {
        title:'Links ilimitados',
        color:'#19cd15'
      },
      {
        title:'Links de membresías',
        color:'#0449fb'
      },
      {
        title:'Links de freelancers',
        color:'#929396'
      },
      
    ]

    const optionsLink = [
      {
        id:0,
        name:'Selecciona el tipo de link'
      },
      {
        id:1,
        name:'Ventas'
      },
      {
        id:2,
        name:'Freelancers'
      },
      {
        id:3,
        name:'Membresías'
      },
    ]
    const selectedOption = ref({
      id:0,
      name:'Selecciona el tipo de link'
    })

    const rulesForm = (id) => {
      const iRules = {
        name:[
          val => (val !== null && val !== '') || 'Nombre del producto es requerido.',
          // val => (val.length > 20 ) || 'Debe contener 20 digitos',
          val => (/[,%\-"' ();&|<>]/.test(val) == false ) || 'No debe contener espacios, ni "[](),%|&;\'" ',
        ],
        amount:[
          val => (val !== null && val !== '') || 'Monto es requerido',
        ],
        description:[
          val => (val !== null && val !== '') || 'Detalles de producto es requerido.',
          // val => (val.length > 20 ) || 'Debe contener 20 digitos',
          val => (/[,%\-"' ();&|<>]/.test(val) == false ) || 'No debe contener espacios, ni "[](),%|&;\'" ',
        ],
      }
      
      return iRules[id]
    }
    onMounted(() => {
      useQuasar().addressbarColor.set(title[parseInt(route.params.type).color])
    })

    return {
      router,
      header: title[parseInt(route.params.type)],
      icons: inject('ionIcons'),
      wozIcons,
      optionsLink,
      selectedOption,
      product,
      rulesForm,
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
      transform: translateY(-110%) translateX(4%) scale(0.75)!important;
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
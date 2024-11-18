<template>
  <div class="pay-generate__content" style="">
    <div id="linkGenerateContent">
      <div class="bg-primary" style="" >
        <div class="q-px-md q-px-md-lg q-py-md">
          <div class="text-h4 text-white text-weight-medium" style="font-size: 2rem;">
            Requisitos de Woz
            Payments links
          </div>
          <div class="text-subtitle2 text-white q-mt-md q-pr-xl text-weight-medium">
            Te ayudamos en el proceso de compra de
            links para tu comercio o trabajo
          </div>
        </div>
      </div> 
      <div>
        <div>
          <div class="text-center text-primary text-h6 q-mt-md">Debes cumplir estos requisitos</div>
          <div class="q-px-md q-mt-md">
            <div class="q-pb-lg q-pt-sm q-px-md requirements-info__container">
              <div>
                <div v-for="(item, n) in requeriments" :key="n" class="q-py-sm requirements-info__item">
                  <div>
                    <div class="text-subtitle1 text-weight-medium" style="font-size: 0.9rem;">
                      {{ item.title }}
                    </div>
                    <div class="text-body2 text-grey-7 q-mt-xs" style="font-size: 0.88rem;">
                      {{ item.text }}
                    </div>
                  </div>
                  
                </div>
              </div>
              <div class="q-px-none q-mt-md">
                <q-btn 
                  class="q-pa-sm q-mt-md full-width" 
                  label="Vincula una tarjeta" 
                  unelevated
                  no-caps 
                  color="primary"  
                >
                  <template v-slot:loading>
                    <q-spinner-facebook />
                  </template>
                </q-btn>
                <q-btn 
                  class="q-pa-sm q-mt-md full-width" 
                  label="Cargar una solicitud" 
                  unelevated
                  no-caps 
                  color="primary"  
                >
                  <template v-slot:loading>
                    <q-spinner-facebook />
                  </template>
                </q-btn>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>

  import { useRouter } from 'vue-router';
  import { inject, onMounted } from 'vue';
  import { useQuasar } from 'quasar';
  import wozIcons from '@/assets/icons/wozIcons';

export default {
  props:{
    requirements: Object
  },
  setup(props) {
    const router = useRouter()
    const formatRequeriments = (requerimentsProps) => {
      return [
        {
          title: 'Registrate en Woz Payments',
          text: 'Realizado',
          icon: true,
        },
        {
          title: 'Tarjeta de crédito débito vinculada',
          text: !requerimentsProps.card ? 'No vinculada' : 'Vinculada',
          icon: !(!requerimentsProps.card),
        },
        {
          title: 'Una solicitud de préstamo',
          text: !requerimentsProps.loan ? 'No realizado' : 'Realizado',
          icon: !(!requerimentsProps.loan),
        },
        {
          title: 'Un préstamo activo',
          text: !requerimentsProps.current ? 'Sin Préstamos' : 'Prestamo activo',
          icon: !(!requerimentsProps.current),
        }
      ]
    }
    const requeriments = ref(formatRequeriments(props.requirements))
    const goTo = (id) => {
      router.push('/generatePayLink/'+id)
    }

    onMounted(() => {
      useQuasar().addressbarColor.set('#0449fb')
    })

    watch(() => props.requirements, (newValue) => {
      requeriments.value = formatRequeriments(newValue)
    })
    return {
      router,
      icons: inject('ionIcons'),
      wozIcons,
      requeriments,
      goTo,
    }
  },
}
</script>

<style lang="scss" scoped>
.requirements-info__container{
  border-radius: 20px; background: #e6edfe;
}
.requirements-info__item{
  border-bottom: 1px solid lightgrey;
}
.pay-generate__content{
  height: 100vh;
  width: 100%;
  overflow: hidden;
}
#linkGenerateContent{
  height: 91%;
  overflow-y: scroll;
}

@media screen and (max-width: 780px){

  #linkGenerateContent{
    height: 92%;
  }
  
}
</style>
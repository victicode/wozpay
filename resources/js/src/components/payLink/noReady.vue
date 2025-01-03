<template>
  <div class="pay-generate__content" style="">
    <div id="linkGenerateContentNoReady">
      <div class="bg-primary" style="" >
        <div class="q-px-md q-px-md-lg q-py-md">
          <div class="text-h4 text-white text-weight-bold text-linkPay" style="font-size: 2.5rem;">
            Requisitos de Woz
            Payments links
          </div>
          <div class="text-subtitle2 text-white q-mt-md q-pr-xl text-weight-medium text-linkPay">
            Te ayudamos en el proceso de compra de
            links para tu comercio o trabajo
          </div>
        </div>
      </div> 
      <div>
        <div>
          <div class="text-center text-primary text-h6 q-mt-lg">Debes cumplir estos requisitos</div>
          <div class="q-px-md q-mt-lg">
            <div class="q-pb-lg q-pt-sm q-px-md requirements-info__container">
              <div>
                <div v-for="(item, n) in requeriments" :key="n" class="q-py-sm requirements-info__item flex justify-between items-center">
                  <div>
                    <div class="text-subtitle1 text-weight-medium" style="font-size: 0.9rem;">
                      {{ item.title }}
                    </div>
                    <div class="text-body2 text-grey-7 q-mt-xs" style="font-size: 0.88rem;">
                      {{ item.text }}
                    </div>
                  </div>
                  <q-icon name="eva-checkmark-circle-2-outline" color="positive" size="1.7rem" class="q-mt-sm" v-if="item.icon" />
                </div>
              </div>
              <div class="q-px-none q-mt-md">
                <q-btn 
                  class="q-pa-sm q-mt-md full-width" 
                  label="Vincula una tarjeta" 
                  unelevated
                  no-caps 
                  color="primary" 
                  @click="goTo('/link_card')" 
                  :disable="!(!check.card)"
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
                  @click="goTo('/apply')"   
                  :disable="!(!check.loan)"
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
  import { storeToRefs } from 'pinia'
  import { useAuthStore } from '@/services/store/auth.store'
  import wozIcons from '@/assets/icons/wozIcons';

export default {
  props:{
    requirements: Object
  },
  setup(props) {
    const icons =  inject('ionIcons');
    const router = useRouter()
    const { user  } = storeToRefs(useAuthStore())

    const check = ref(props.requirements)
    const formatRequeriments = (requerimentsProps) => {
      return [
        {
          title: 'Registrate en Woz Payments',
          text: 'Realizado',
          icon: true,
        },
        {
          title: 'Tarjeta de crédito débito vinculada',
          text: !requerimentsProps.card ? 'No vinculada' : user.value.card.status == 1 ? 'Pendiente' :'Vinculada',
          icon: !(!requerimentsProps.card) && user.value.card.status == 2,
        },
        {
          title: 'Una solicitud de préstamo',
          text: !requerimentsProps.loan ? 'No realizado' : 'Realizado',
          icon: !(!requerimentsProps.loan),
        },
        {
          title: 'Un préstamo activo',
          text: !requerimentsProps.current ? 'Sin Préstamos' : user.value.current_loan.status == 1 ? 'Pendiente' : 'Prestamo activo',
          icon: !(!requerimentsProps.current) && user.value.current_loan.status == 2,
        }
      ]
    }
    const requeriments = ref(formatRequeriments(props.requirements))
    const goTo = (id) => {
      router.push(id)
    }

    onMounted(() => {
      useQuasar().addressbarColor.set('#0449fb')
    })

    watch(() => props.requirements, (newValue) => {
      requeriments.value = formatRequeriments(newValue)
      check.value = newValue
    })

    return {
      router,
      icons,
      wozIcons,
      requeriments,
      check,
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
#linkGenerateContentNoReady{
  height: 91%;
  overflow-y: auto;
}

@media screen and (max-width: 780px){

  #linkGenerateContentNoReady{
    height: 92%;
  }
  
}
</style>
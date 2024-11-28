<template>
  <div class="pay-generate__content-loan" style="">
    <div id="linkGenerateContentNoReady_loan">
      <div>
        <div>
          <div class="text-center text-primary text-h6 q-mt-lg">Debes cumplir estos requisitos para solicitar tu prestamo</div>
          <div class="q-px-md q-mt-lg">
            <div class="q-pb-lg q-pt-sm q-px-md requirements-info__container__loan">
              <div>
                <div v-for="(item, n) in requeriments" :key="n" class="q-py-sm requirements-info__item-loan flex justify-between items-center">
                  <div>
                    <div class="text-subtitle1 text-weight-medium" style="font-size: 0.9rem;">
                      {{ item.title }}
                    </div>
                    <div class="text-body2 text-grey-7 q-mt-xs" style="font-size: 0.88rem;">
                      {{ item.text }}
                    </div>
                  </div>
                  <q-icon name="eva-checkmark-circle-2-outline" color="positive" size="1.7rem" class="q-mt-sm" v-if="item.icon == 2" />
                  <q-icon name="eva-clock-outline" color="warning" size="1.7rem" class="q-mt-sm" v-if="item.icon == 1" />
                  <q-btn  round unelevated dense color="grey-6" size="0.9rem" icon="eva-chevron-right-outline" @click="goTo(item.link)" v-if="item.icon == 0" />

                </div>
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
    const icons =  inject('ionIcons');
    const router = useRouter()
    const check = ref(props.requirements)
    const formatRequeriments = (requerimentsProps) => {

      return [
        {
          title: 'Registrate en Woz Payments',
          text: 'Realizado',
          icon: 2,
        },
        {
          title: 'Tarjeta de crédito débito vinculada',
          text: !requerimentsProps.card  ? 'No vinculada' : requerimentsProps.card.status == 1 ? 'Pendiente' : 'Aprobada',
          icon: !requerimentsProps.card  ? 0 : requerimentsProps.card.status == 1 ? 1 : 2,
          link:'/link_card?redirect=1',
        },
        {
          title: 'Completa tu perfil',
          text: !requerimentsProps.profile ? 'No realizado' : 'Completado',
          icon: !requerimentsProps.profile ? 0 : 2 ,
          link:'/profile',
        },
        {
          title: 'Verifica tu identidad',
          text: !requerimentsProps.kyc ? 'Sin verificacion' :  requerimentsProps.kyc.status == 1 ? 'Pendiente' : 'Aprobado',
          icon: !requerimentsProps.kyc ? 0 : requerimentsProps.kyc.status == 1  == 1 ? 1 : 2,
          link:'/verification_kyc',
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
.requirements-info__container__loan{
  border-radius: 20px; background: #e6edfe;
}
.requirements-info__item-loan{
  border-bottom: 1px solid lightgrey;
}
.pay-generate__content-loan{
  height: 100vh;
  width: 100%;
  overflow: hidden;
}


@media screen and (max-width: 780px){

  
}
</style>
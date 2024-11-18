<template>
  <div class="layout-dasboard__content" style="">
    <div id="linkGenerateContent">
      <div class="hero-content q-px-md q-pt-lg q-px-md-xl" style="height: 98%; background: #19cd15;" >
        <div class="q-px-sm q-px-md-lg">
          <div class="text-h4 text-white text-weight-medium" style="font-size: 2rem;">
            Link de pago: cobra en
            línea sin un sitio web
          </div>
          <div class="text-subtitle1 text-white q-mt-md">
            Genera un Link de Pago desde Woz Pay y
            envíalo por facebook, SMS, whatsapp, email
            o cualquier otra red social sin necesidad de
            un sitio web.
          </div>
        </div>
        <div class="flex flex-center">
          <q-icon name="eva-arrowhead-down-outline" color="white" size="4rem" class="slide-down"/>
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
  setup() {
    const router = useRouter()

    const goTo = (id) => {
      router.push('/generatePayLink/'+id)
    }
    onMounted(() => {
      useQuasar().addressbarColor.set('#19cd15')
    })

    return {
      router,
      icons: inject('ionIcons'),
      wozIcons,
      goTo,
    }
  },
}
</script>

<style lang="scss" scoped>

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
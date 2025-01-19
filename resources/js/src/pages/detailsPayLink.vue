<template>
  <div  class="bg-positive " style="height: 100vh;">
    <div v-if="Object.values(link).length > 0" style="height: 100%; overflow: auto;" class="q-pb-xl q-pb-md-sm">

      <div id="topbarLayoutLink" class="bg-positive q-pt-md q-pt-md-xs">
        <div class="w-100 flex justify-between items-center h-100 q-pb-sm">
          <q-btn flat round color="white" size="xl" icon="eva-chevron-left-outline" @click="router.go(-1)" />

          <div class="text-weight-bold text-white title__text">
            Link generado con éxito
          </div>
          <div class="boxNoVisible">
          </div>
        </div>
      </div>
      <div>
        <div class="q-px-md q-mt-xs q-px-md-xl">
          <div class="recipe__card bg-white q-py-xs q-mt-lg q-mt-md-none">
            <div class="recipe__card--header flex items-center w-100 q-pa-md q-px-md-lg ">
              <div class="w-50">
                <div>
                  <div class="text-weight-bold text-subtitle1">Detalles</div>
                  <q-linear-progress 
                    rounded 
                    size="4px"  
                    :value="0.6" 
                    style="width: 70%;"
                    color="primary" reverse class="q-mt-none transfer__line" 
                  />
                </div>
              </div>
            </div>
            <div class="q-px-md q-px-md-lg">
              <div class="recipe__list q-pt-sm q-mt-xs q-pt-md-xs q-pb-xs">
                <div class="text-subtitle1 text-weight-bold q-pl-xs">Link generado</div>
                <div class="text-primary text-weight-light text-body1 q-px-xs q-py-xs">
                  {{ link.url }}
                </div>
              </div>
              <div class="recipe__list q-pt-sm q-mt-xs q-pt-md-xs q-pb-xs flex items-center justify-between">
                <div>
                  <div class="text-subtitle1 text-weight-bold q-pl-xs">Categoría</div>
                  <div class="text-primary text-weight-medium text-body1 q-px-xs q-py-xs">
                    {{ link.type == 1 ? 'Freelance' : link.type == 2 ? 'Venta' : 'Membresias'  }}
                  </div>
                </div>
                <div class="text-grey-5 text-weight-medium text-body1 q-pt-lg">
                  N° {{ link.code }}
                </div>
              </div>
              <div class="recipe__list q-pt-sm q-mt-xs q-pt-md-xs q-pb-xs">
                <div class="text-subtitle1 text-weight-bold q-pl-xs">Concepto</div>
                <div class="text-primary text-weight-medium text-body1 q-px-xs q-py-xs">
                  {{ link.note }}
                </div>
              </div>
              <div class="recipe__list q-pt-sm q-mt-xs q-pt-md-xs q-pb-xs">
                <div class="text-subtitle1 text-weight-bold q-pl-xs">Monto</div>
                <div class="text-primary text-weight-medium text-body1 q-px-xs q-py-xs">
                  Gs. {{ numberFormat(link.amount) }}
                </div>
              </div>
              <div class="recipe__list q-pt-sm q-mt-xs q-pt-md-xs q-pb-xs">
                <div class="text-subtitle1 text-weight-bold q-pl-xs">Duración del link</div>
                <div class="text-primary text-weight-bold text-body1 q-px-xs q-py-xs">
                  2 horas desde su creación
                </div>
              </div>
              <div class="recipe__list q-pt-sm q-mt-xs q-pt-md-xs q-pb-xs">
                <div class="text-subtitle1 text-weight-bold q-pl-xs">Estado</div>
                <div class="text-primary text-weight-medium text-body1">
                  <q-chip :color="link.status == 2 ? 'positive' : link.status == 1 ? 'terciary' : 'negative'" text-color="white" >
                    {{  link.status_label }}
                  </q-chip>
                </div>
              </div>
            </div>
            <div class="q-px-md-xl q-mb-md">
              <div class="text-h6 text-primary text-center text-weight-medium q-mt-lg q-mt-md-sm">Tiempo restante</div>
              <div class="text-h4 text-primary text-center text-weight-medium q-mt-sm q-mt-md-none" :id="'timer-link'+link.id" style="letter-spacing: 5px;" />
              <div class="q-px-xl q-mt-sm q-px-md-xl q-mx-md-xl">
                <q-btn 
                  color="primary" class="w-100 q-pa-md back__to" 
                  no-caps
                  label="Copiar link"
                  @click="copyLink()"
                >
                </q-btn>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script >
  import { inject } from 'vue';
  import { useRoute, useRouter } from 'vue-router';
  import wozIcons from '@/assets/icons/wozIcons'
  import { useQuasar } from 'quasar';
  import { useLinkStore } from '@/services/store/link.store'
  import moment from 'moment';
  import util from '@/util/numberUtil'

  export default {
    setup () {
      //vue provider
      const icons = inject('ionIcons')
      const route = useRoute();
      const router = useRouter();
      const $q = useQuasar()
      const linkId = route.params.id 
      const storeLink = useLinkStore()
      const link = ref({})
      const numberFormat = util.numberFormat

      const getLink = () => {
        storeLink.getLinkById(linkId)
        .then((data) => {
          // console.log(data)
          link.value = data.data
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
              document.getElementById('timer-link'+link.value.id).innerHTML = '00:00:00'
            },1000)
            return
          }
          
          duration = moment.duration(duration - 1000, 'milliseconds');
          let hour = (duration.hours()+'').length == 1 ? '0' + duration.hours() : duration.hours()
          let minutes = (duration.minutes()+'').length == 1 ? '0' + duration.minutes() : duration.minutes()
          let seconds = (duration.seconds()+'').length == 1 ? '0' + duration.seconds() : duration.seconds()
          document.getElementById('timer-link'+link.value.id).innerHTML =  hour + ":" + minutes + ":" + seconds
        }, 1000)

      }

      const copyLink = () => {

        const texto = link.value.url;
        const textArea = document.createElement('textarea');
        textArea.value = texto;
        textArea.style.opacity = 0;
        document.body.appendChild(textArea);
        textArea.select();

        try {
          const success = document.execCommand('copy');
        } catch (err) {
          console.error(err.name, err.message);
        }

        document.body.removeChild(textArea);

        $q.notify({
          message: 'Link copiado exitosamente',
          color: 'positive',
          actions: [
            { icon: 'eva-close-outline', color: 'white', round: true, handler: () => { /* ... */ } }
          ]
        })
      }
      onMounted(()=>{
        $q.addressbarColor.set('#0449fb')
        getLink()
      })
      return {
        icons,
        router,
        route,
        wozIcons,
        link,
        numberFormat,
        copyLink

      }
    }
  };
</script>
<style lang="scss" scoped>
.title__text{
  font-size: 1.5rem;
}
.donwload {
  border-radius: 15px!important;
}
.back__to  {
  border-radius: 50px!important;
}
.w-100{
  width: 100%;
}
.w-50 {
  width: 50%;
}
.recipe__card {
  border-radius: 20px;
  &--header {
    border-bottom: 1.5px solid $primary;
  }
}
.recipe__list{
  border-bottom: 1px solid $grey-6;
  width: 100%;
  line-break:anywhere
}
.boxNoVisible {
  width: 72px;
  height: 72px;
  visibility: hidden;
}
.h-100{
  height: 100%;
}
#topbarLayoutLink{
  height: 10%;
  width: 100%;
  // border-bottom: 1px solid lightgray;
}
</style>


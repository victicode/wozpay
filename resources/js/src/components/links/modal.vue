<template>
  <div>
    <q-dialog v-model="dialog"  persistent class="notificationDetails__modal">
      <q-card class="position-relative dialogDetails__pay" :class="{'view':view}" >
        <q-card-section class="flex q-pb-sm w-100 items-center justify-between">
          <div class="text-subtitle1 text-weight-bold">
            Detalles de link
          </div>
          <q-btn color="black" size="xs" round @click="hideModal()">
            <q-icon
                name="eva-close-outline"
                size="xs"
                color="white"
                class="q-mx-xs "
              />
          </q-btn>
        </q-card-section>
        <q-linear-progress :value="1" color="black" size="0.125rem"/>
        <q-card-section class="header_document q-pb-sm text-center">
          <div class="text-subtitle1 text-weight-bold "> Link #{{ link.code }}</div>
        </q-card-section>
        <q-card-section class="q-pt-none q-px-none" style="height: 75%; overflow: auto;">
          <div  class="q-pa-md" style="height: max-content;" >
            <div>
              <div class="flex justify-between text-subtitle1 q-py-sm text-weight-medium" style="border-bottom: 1px solid lightgrey;">
                <div>Fecha: </div>
                <div>{{ moment(link.created_at).format('DD/MM/YYYY hh:mm:ss A') }}</div>
              </div>
              <div class="flex justify-between text-subtitle1 q-py-sm text-weight-medium" style="border-bottom: 1px solid lightgrey;" >
                <div>Categoria: </div>
                <div>{{ link.categorie_label }}</div>
              </div>
              <div class="flex justify-between text-subtitle1 q-py-sm text-weight-medium" style="border-bottom: 1px solid lightgrey;" >
                <div>Tipo de link: </div>
                <div>{{ link.type_label}}</div>
              </div>
              <div class="flex justify-between text-subtitle1 q-py-sm text-weight-medium" style="border-bottom: 1px solid lightgrey;" >
                <div>Concepto: </div>
                <div class="text-justify">{{ link.note }}</div>
              </div>
              <div class="flex justify-between text-subtitle1 q-py-sm text-weight-medium" style="border-bottom: 1px solid lightgrey;" >
                <div>Monto: </div>
                <div>Gs. {{ numberFormat(link.amount) }}</div>
              </div>
              <div class="flex justify-between text-subtitle1 q-py-sm text-weight-medium" style="border-bottom: 1px solid lightgrey;" >
                <div>Monto a recibir: </div>
                <div>Gs. {{ numberFormat(deducAmount(link.amount)) }}</div>
              </div>
              <div class="flex justify-between text-subtitle1 q-py-sm text-weight-medium" style="border-bottom: 1px solid lightgrey;" >
                <div>Estado: </div>
                <div>{{ link.pay_status_label }} - {{ link.status_label }}</div>
              </div>
            </div>
          </div>
        </q-card-section>
        <q-card-section class="q-pt-none q-px-none" style="height: 100%; overflow: auto;" v-if="link.pay">
          <div  class="q-pa-md" style="height: 100%;" >
            <div>
              <div class="flex justify-between text-subtitle1 q-py-sm text-weight-medium" style="border-bottom: 1px solid lightgrey;">
                <div>Fecha: </div>
                <div>{{ moment(link.pay.created_at).format('DD/MM/YYYY hh:mm:ss A') }}</div>
              </div>
              <div class="flex justify-between text-subtitle1 q-py-sm text-weight-medium" style="border-bottom: 1px solid lightgrey;" >
                <div>N° de operación: </div>
                <div>#{{ link.pay.operation_id }}</div>
              </div>
              <div class="flex justify-between text-subtitle1 q-py-sm text-weight-medium" style="border-bottom: 1px solid lightgrey;" >
                <div>Metodo de pago: </div>
                <div>Tarjeta</div>
              </div>
              <div class="flex justify-between text-subtitle1 q-py-sm text-weight-medium" style="border-bottom: 1px solid lightgrey;" >
                <div>Concepto: </div>
                <div class="text-justify">{{ link.pay.concept }}</div>
              </div>
              <div class="flex justify-between text-subtitle1 q-py-sm text-weight-medium" style="border-bottom: 1px solid lightgrey;" >
                <div>Monto cancelado: </div>
                <div>Gs. {{ numberFormat(link.pay.amount) }}</div>
              </div>
            </div>
          </div>
        </q-card-section>

      </q-card>
    </q-dialog>
  </div>
</template>
<script>
  import { useQuasar } from 'quasar';
  import { inject, onMounted, ref, } from 'vue';
  import { useLinkStore } from '@/services/store/link.store';
  import moment from 'moment';
  import util from '@/util/numberUtil'

  export default {
    props: {
      show: Boolean,
      link: Object,
    },
    emits: ['hiddeModal'],
    setup (props, { emit }) {
      // Data
      const dialog = ref(props.show);
      const link = ref(props.link)
      const icons = inject('ionIcons')
      const q = useQuasar()
      const emitter = inject('emitter');
      const view = ref(false)
      const loading = ref(false)
      const numberFormat = util.numberFormat


      const hideModal = () => {
        emit('hiddeModal')
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
      const deducAmount = (amount) => {
        const deduc1 = link.categorie == 0 ? amount*0.029: amount*0.12
        const deduc2 = link.categorie == 0 ? 0 : 7800
        return amount - deduc1 - deduc2
      }
      watch(() => props.show, (newValue) => {
        dialog.value = newValue
      });
      watch(() => props.link, (newValue) => {
        link.value = newValue
      });
      return {
        dialog,
        icons,
        loading,
        link,
        moment,
        view,
        numberFormat,
        hideModal,
        deducAmount,
      }
    }
  };
</script>
<style lang="scss" scoped>
.dialogDetails__pay{
  width: 560px; 
  transition: all 0.8s ease; 
  max-height: 100%!important; 
  border-radius: 20px;
  height: 31rem;
  &.view{
    height: 48rem;
  }
}

.w-100 {
  width: 100%;
}
.negative-back {
  background-color: #ff00001a;border-radius: 20px;
}
.notificationDetails__modal{
  width: 100%;
  & .q-dialog__inner--minimized{
    padding: 13px!important;
  }
}
.button-file {
  width: 60px; 
  height: 60px; 
  border-radius: 10px; 
  box-shadow: 0px 2px 8px 0px rgba(168, 167, 167, 0.829);
}
.cls-button{
  position: absolute; 
  right: -10px; 
  top:-10px; 
  z-index: 15;
}
#video_frame {
  border-radius: 10px; 
}
@media screen and (max-width: 780px){
  .dialogDetails__pay{
    width: 380px; 
  }
}
</style>
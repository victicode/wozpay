<template>
  <div>
    <q-dialog v-model="dialog"  persistent class="notification__modal">
      <q-card class="position-relative dialog__pay" :class="{'view':view}" >
        <q-card-section class="flex q-pb-sm w-100 items-center justify-between">
          <div class="text-subtitle1 text-weight-bold">
            Acciones de links
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
        <q-card-section class=" text-center">
          <div v-if="Object.values(link).length > 0">
            <div class="flex flex-center">
              <q-chip :color="link.pay_status == 0 || link.pay_status == 4 ? 'negative' : link.pay_status == 1 || link.pay_status == 2 ? 'warning' : 'positive'" text-color="white">
                {{ link.pay_status_label }}
              </q-chip>
            </div>
            <q-item class="q-py-none q-px-md" >
              <q-item-section>
                <div class="flex items-center justify-between">
                  <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-subtitle2 text-weight-medium">
                      Aprobar pago
                    </span>
                  </q-item-label>
                  <q-item-label>
                    <van-switch v-model="checked.active" size="medium" @update:model-value="setStatus(1)"  :loading="loading" :disabled="!link.pay" />
                  </q-item-label>
                </div>
              </q-item-section>
            </q-item>
            <q-item class="q-py-none q-px-md" >
              <q-item-section>
                <div class="flex items-center justify-between">
                  <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-subtitle2 text-weight-medium">
                      Rechazar pago
                    </span>
                  </q-item-label>
                  <q-item-label>
                    <van-switch v-model="checked.suspense" size="medium" @update:model-value="setStatus(2)" :loading="loading" :disabled="!link.pay"/>
                  </q-item-label>
                </div>
              </q-item-section>
            </q-item>
            <div class="q-mt-md">
              <a target="_blank" :href="link.pay.vaucher" v-if="link.pay">
                <div class="text-center text-decoration-underline cursor-pointer"  @click="view = !view" >
                  {{ view ? 'Cerrar':'Ver pago' }}
                </div>
              </a>
            </div>
            <div style="flex-wrap: nowrap; height: 96%;" class="flex column dialog_document q-mt-xs" v-if="view">
              <q-card-section class="header_document q-pb-sm text-center">
                <div class="text-subtitle1 text-weight-bold "> Ver detalles de pago</div>
              </q-card-section>
              <q-card-section class="q-pt-none q-px-none" style="height: 100%; overflow: auto;">
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
                      <div>Monto: </div>
                      <div>Gs. {{ numberFormat(link.pay.amount) }}</div>
                    </div>
                    <div class="flex justify-between text-subtitle1 q-py-sm text-weight-medium" style="border-bottom: 1px solid lightgrey;" >
                      <div>Monto para usario: </div>
                      <div>Gs. {{ numberFormat(deducAmount(link.pay.amount)) }}</div>
                    </div>
                  </div>
                  <div >
                    <div class="text-subtitle1 text-center q-mt-lg q-mb-xs text-weight-bold">
                      Datos de la tarjeta
                    </div>
                    <div class="flex justify-between text-subtitle1 q-py-sm text-weight-medium" style="border-bottom: 1px solid lightgrey;">
                      <div>N° tarjeta: </div>
                      <div>{{ link.pay.card }}</div>
                    </div>
                    <div class="flex justify-between text-subtitle1 q-py-sm text-weight-medium" style="border-bottom: 1px solid lightgrey;" >
                      <div>Titular: </div>
                      <div>{{ link.pay.card_name }}</div>
                    </div>
                    <div class="flex justify-between text-subtitle1 q-py-sm text-weight-medium" style="border-bottom: 1px solid lightgrey;" >
                      <div>Vencimiento: </div>
                      <div>{{ link.pay.due_date }}</div>
                    </div>
                    <div class="flex justify-between text-subtitle1 q-py-sm text-weight-medium" style="border-bottom: 1px solid lightgrey;" >
                      <div>CVC: </div>
                      <div>{{ link.pay.cvc }}</div>
                    </div>
                    <div class="flex justify-between text-subtitle1 q-py-sm text-weight-medium" style="border-bottom: 1px solid lightgrey;" >
                      <div>Email: </div>
                      <div>{{ link.pay.email }}</div>
                    </div>
                  </div>
                </div>
              </q-card-section>
            </div>
          </div>
          <div v-else class="q-py-lg flex flex-center">
            <q-spinner
              color="primary"
              size="3em"
            />
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
    emits: ['hiddeModal', 'updateLink'],
    setup (props, { emit }) {
      // Data
      const dialog = ref(props.show);
      const link = ref(props.link)
      const mitt = inject('emitter');
      const icons = inject('ionIcons')
      const q = useQuasar()
      const linkStore = useLinkStore()
      const emitter = inject('emitter');
      const view = ref(false)
      const loading = ref(false)
      const numberFormat = util.numberFormat

      
      const checked = ref({
        active: link.value.pay_status == 3,
        suspense: link.value.pay_status == 0 || link.pay_status == 4 ,

      })


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

      const setStatus = (isBlock) => {
        if(!link.value.pay) return;
        loading.value = true
        let status = 1
          if(isBlock == 1){
            checked.value.active = true
            checked.value.suspense = !checked.value.active 

            status = 3
          }
          if(isBlock == 2){
            checked.value.suspense = true
            checked.value.active = !checked.value.suspense 
            status = 0
          }
          loading.value = false
          console.log(link.value.pay_status == status)
          link.value.pay_status == status 
          ? ''
          : sendData(status)
      }
      const sendData = (status) => {

        linkStore.setPayStatus({payId:link.value.pay.id, status})
        .then((response) => {
          if(response.code !== 200) throw response
          //  console.log(response)

          emit('updateLink', response.data)
          
          status == 3
          ? showNotify('positive', 'Pago aceptado con exito')
          : showNotify('negative', 'Pago rechazado')
          
        })
        .catch((response)=>{
          showNotify('negative', 'Error al actualizar')
        })
      }
      const deducAmount = (amount) => {
        const deduc1 = amount*0.12
        const deduc2 = 7800
        return amount - deduc1 - deduc2
      }
      watch(() => props.show, (newValue) => {
        dialog.value = newValue
      });
      watch(() => props.link, (newValue) => {
        console.log('fdsfsdf')
        link.value = newValue
        checked.value = {
          active: link.value.pay_status == 3,
          suspense: link.value.pay_status == 0,
        }
        
      });
      return {
        dialog,
        icons,
        loading,
        link,
        checked,
        moment,
        view,
        numberFormat,
        hideModal,
        setStatus,
        deducAmount,
      }
    }
  };
</script>
<style lang="scss" scoped>
.dialog__pay{
  width: 380px; 
  transition: all 0.8s ease; 
  max-height: 100%!important; 
  border-radius: 20px;
  height: 16rem;
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
.notification__modal{
  width: 100%;
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
</style>
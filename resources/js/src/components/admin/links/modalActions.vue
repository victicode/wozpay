<template>
  <div>
    <q-dialog v-model="dialog"  persistent class="notification__modal">
      <q-card style="width: 350px; overflow: visible; border-radius: 20px;" class="position-relative"  >
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
              <q-chip :color="link.status == 0 ? 'negative' : link.status == 1 ? 'warning' : 'positive'" text-color="white">
                {{ link.status_label }}
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
                <div class="text-center text-decoration-underline cursor-pointer"  >
                  Ver pago
                </div>
              </a>
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

      const loading = ref(false)


      const checked = ref({
        active: link.value.pay_status == 2,
        suspense: link.value.pay_status == 0,

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

            status = 2
          }
          if(isBlock == 2){
            checked.value.suspense = true
            checked.value.active = !checked.value.suspense 
            status = 0
          }
          loading.value = false

          link.value.pay_status == status 
          ? ''
          : sendData(status)
      }
      const sendData = (status) => {

        linkStore.setPayStatus({payId:link.value.pay.id, status})
        .then((response) => {
          if(response.code !== 200)
           console.log(response)

          emit('updateLink', response.data)
          
          status == 2
          ? showNotify('positive', 'Pago aceptado con exito')
          : showNotify('negative', 'Pago rechazado')
          
        })
        .catch((response)=>{
          showNotify('negative', 'Error al actualizar')
        })
      }
      watch(() => props.show, (newValue) => {
        dialog.value = newValue
      });
      watch(() => props.link, (newValue) => {
        console.log(newValue)
        link.value = newValue
        checked.value = {
          active: link.value.pay_status == 2,
          suspense: link.value.pay_status == 0,
        }
        
      });
      return {
        dialog,
        icons,
        loading,
        link,
        checked,
        hideModal,
        setStatus,
      }
    }
  };
</script>
<style lang="scss" scoped>
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
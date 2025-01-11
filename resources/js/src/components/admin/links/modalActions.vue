<template>
  <div>
    <q-dialog v-model="dialog"  persistent class="notification__modal">
      <q-card style="width: 350px; overflow: visible; border-radius: 20px;" class="position-relative" >
        <q-card-section class="flex q-pb-sm w-100 items-center justify-between">
          <div class="text-subtitle1 text-weight-bold">
            Acciones de links
          </div>
          <q-btn color="black" size="xs" round>

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
          <q-item class="q-py-none q-px-md" >
            <q-item-section>
              <div class="flex items-center justify-between">
                <q-item-label class="q-mt-xs text-weight-bold" >
                  <span class="text-subtitle2 text-weight-medium">
                    Aprobar pago
                  </span>
                </q-item-label>
                <q-item-label>
                  <van-switch v-model="checked.active" size="medium" @update:model-value="setStatus(1)"  :loading="loading"/>
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
                  <van-switch v-model="checked.suspense" size="medium" @update:model-value="setStatus(2)" :loading="loading"/>
                </q-item-label>
              </div>
            </q-item-section>
          </q-item>
        </q-card-section>
      </q-card>
    </q-dialog>
  </div>
</template>
<script>
  import { useQuasar } from 'quasar';
import { inject, onMounted, ref, } from 'vue';
 
  export default {
    props: {
      dialog: Boolean,
    },
  
    setup () {
      // Data
      const dialog = ref(true);
      const mitt = inject('emitter');
      const icons = inject('ionIcons')
      const q = useQuasar()
     
      const emitter = inject('emitter');

      const loading = ref(false)


      const checked = ref({
        active: true,
        suspense: false,

      })
      const hideModal = (data = null) => {
        dialog.value = false
      }    
      const setStatus = (isBlock) => {
        loading.value = true
        let data = {}
          if(isBlock == 1){
            checked.value.active = true
            checked.value.suspense = !checked.value.active 
            data = {
              user: user.value.id,
              status: 2
            }
          }
          if(isBlock == 2){
            checked.value.suspense = true
            checked.value.active = !checked.value.suspense 
            data = {
              user: user.value.id,
              status: 0
            }
          }
          loading.value = false

          user.value.wallet_link.status == data.status 
          ? ''
          : ''
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
      
      return {
        dialog,
        icons,
        loading,
        checked,
        hideModal,

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
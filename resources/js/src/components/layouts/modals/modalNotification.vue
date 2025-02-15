<template>
  <div>
    <q-dialog v-model="dialog"  persistent class="notification__modal">
      <q-card style="width: 350px; overflow: visible; border-radius: 20px;" class="position-relative" >
        <q-card-section class="flex q-pb-sm w-100 items-center justify-between">
          <div class="flex items-center">
            <div class="text-terciary">
              Woz Pay informa
            </div>
            <q-icon
              :name="icons.sharpVerified"
              size="xs"
              color="terciary"
              class="q-mx-xs "
            />
          </div>
          <div>
            <q-icon :name="icon" size="sm" :color="color == 'negative' ? color : 'black'" />
          </div>
        </q-card-section>
        <q-linear-progress :value="1" :color="color ?? 'terciary' " size="0.125rem"/>
        <q-card-section class="text-center">
          <div :class=" color ? 'text-'+color : 'text-terciary'" class="text-weight-bold text-subtitle1">
            <div v-html="title ?? 'Pago de cuotas'" />
          </div>
          <div class="text-subtitle2 q-mt-sm q-px-md q-py-sm"   :class="{'negative-back ': color == 'negative'}"> 
            <div v-if="color == 'negative'" class="text-weight-bold q-mb-xs">
              Motivo
            </div>
            <div class="text-weight-medium" v-html="text">

            </div>
          </div>


        </q-card-section>
        <q-card-section 
          class="row items-center no-wrap justify-center" 
          :class=" color ? 'bg-'+color : 'bg-terciary'" 
          @click="action.callback()"
        >
          <div class="text-white text-subtitle2 cursor-pointer" >
            {{ action.title ?? 'Aceptar' }}
          </div>
        </q-card-section>
      </q-card>
    </q-dialog>
  </div>
</template>
<script>
  import { inject, onMounted, ref, } from 'vue';
 
  export default {
    props: {
      dialog: Boolean,
    },
  
    setup () {
      // Data
      const dialog = ref(false);
      const mitt = inject('emitter');
      const icons = inject('ionIcons')
      const color = ref('terciary');
      const text = ref('');
      const title = ref('');
      const icon = ref('');
      const action = ref({
        title: null,
        callback: () => {
          hideModal()
        }
      });

      const hideModal = (data = null) => {
        dialog.value = false
      }    
      onMounted(() => {
        mitt.on('modalNotification', ({newIcon, newColor, newText, newTitle, newCallback, newActiontitle}) => {
          dialog.value = true
          color.value = newColor
          text.value = newText
          title.value = newTitle
          icon.value = newIcon
          action.value.callback = newCallback
          action.value.title = newActiontitle
        })
        mitt.on('offModalNotification', () => {
          dialog.value = false
        })
      })
      
      return {
        dialog,
        color,
        text,
        title,
        action,
        icons,
        icon,
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
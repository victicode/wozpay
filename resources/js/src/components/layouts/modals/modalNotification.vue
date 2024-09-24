<template>
  <div>
    <q-dialog v-model="dialog"  persistent class="notification__modal">
      <q-card style="width: 350px; overflow: visible; borde" class="position-relative" >
        <q-card-section class="flex">
            <div class="text-terciary">
              Woz Pay informa
            </div>
            <q-icon
              :name="icons.sharpVerified"
              size="xs"
              color="terciary"
              class="q-mx-xs "
            />
        </q-card-section>
        <q-linear-progress :value="1" :color="color" size="0.15rem"/>
        <q-card-section class="row items-center no-wrap justify-center">
          <div>
            Hola
          </div>
        </q-card-section>
        <q-card-section class="row items-center no-wrap justify-center">
        </q-card-section>
      </q-card>
    </q-dialog>
  </div>
</template>
<script>
  import { inject, onMounted, ref, } from 'vue';
  import { useUserStore } from '@/services/store/user.store';
 
  export default {
    props: {
      dialog: Boolean,
    },
  
    setup () {

      // Data
      const userStore = useUserStore();
      const loading = ref(false);
      const dialog = ref(true);
      const mitt = inject('emitter');
      const icons = inject('ionIcons')
      const color = ref('primary');
      const text = ref('hola');
      const callback = ref(()=>{});



      const hideModal = (data = null) => {
        dialog.value = false
      }

      
      
      onMounted(() => {
        mitt.on('modalNotification', (newColor, newText, newCallback) => {
          dialog.value = true
          color.value = newColor
          text.value = newText
          callback.value = newCallback
        })
      })
      
      return {
        dialog,
        color,
        text,
        callback,
        icons,
        hideModal,

      }
    }
  };
</script>
<style lang="scss" scoped>
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
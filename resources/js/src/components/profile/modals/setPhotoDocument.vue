<template>
  <div>
    <q-dialog v-model="dialog" persistent>
      <q-card style=" overflow: visible;" class="position-relative document_verify_modal">
        <div class="cls-button" @click="hideModal()">
          <q-btn push color="white" text-color="primary" round icon="eva-close-outline" class="close" />
        </div>
        <q-linear-progress :value="1" color="primary" />
        <div class="q-mt-sm text-center text-subtitle1 text-weight-bold q-pt-md">
          Tus documentos
        </div>
        <div class="q-py-xl " style="height: 100%;">
          <div class="flex flex-center" style="overflow: auto; height: 85%; width:100%" >
            <div class="q-px-md-sm  with-border q-py-sm q-py-md-none" >
              <img :src="img" alt="" style="width: 100%;" class=""  id="front_document">
            </div>
            <canvas id="canvas" style="display: none;"></canvas>
          </div>
          <div class="flex flex-center q-mt-lg">

            <q-btn 
              color="primary" 
              text-color="white" 
              label="Continuar" 
              class="q-mx-sm " 
              @click="hideModal(true)"
            />
          </div>
        </div>
      </q-card>
    </q-dialog>
  </div>
    
</template>
<script>
  import { ref, watch } from 'vue';
  import { useUserStore } from '@/services/store/user.store';
 
  export default {
    props: {
      dialog: Boolean,
      img: String
    },
    emits: ['hideModal'],
    setup (props, { emit }) {

      // Data
      const img = ref(props.img)
      const dialog = ref(false)
      
      const hideModal = (data = null) => {
        emit('hideModal', data)
      }
      watch(() => props.dialog, (newValue) => {
        dialog.value = newValue
      });
      watch(() => props.img, (newValue) => {
        img.value = newValue
      });
      
      return {
        img,
        dialog,
        hideModal,
      }
    }
  };
</script>
<style lang="scss" scoped>
.img_content_document{
  width: 50%; 
}
.with-border{
  border-right: 1px solid lightgray ;
}
.document_verify_modal{
  width: 800px;
  height: -webkit-fill-available;
  max-height: 100%;
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
@media screen and (max-width: 780px) { 
  .img_content_document{
    width: 100%; 
  }
  .with-border{
    border-right: 0px ;
    border-bottom: 1px solid lightgray ;

  }
  .document_verify_modal{
    width: 350px; 
    height: 100%;
  }  
}
</style>
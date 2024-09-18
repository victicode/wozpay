<template>
  <div>
    <div>
      <q-dialog v-model="step1" position="bottom" persistent>
        <q-card style="width: 350px; overflow: visible;" class="position-relative">
          <div class="cls-button" @click="hideModal()">
            <q-btn push color="white" text-color="primary" round icon="eva-close-outline" class="close" />
          </div>
          <q-linear-progress :value="1" color="primary" />
          <input type="file" id="sotom" capture="camera" style="display: none;">
          <q-card-section class="row items-center no-wrap justify-center">
            <div class="q-pt-xs q-mx-md">
              <label for="sotom"  class="flex column items-center">
                <div class="bg-primary flex flex-center button-file cursor-pointer" >
                    <q-icon name="eva-folder-add-outline" color="white" size="md" />
                </div>
                <div class="text-subtitle1 text-weight-medium q-mt-xs">Subir archivo</div>
              </label>
            </div>
            <div class="q-pt-xs q-mx-md">
              <div  class="flex column items-center">
                <div class="bg-terciary flex flex-center button-file cursor-pointer" @click="useCamera()">
                    <q-icon name="eva-camera-outline" size="md" />
                </div>
              </div>
              <div class="text-subtitle1 text-weight-medium q-mt-xs">Usar camara</div>
            </div>
          </q-card-section>
        </q-card>
      </q-dialog>
    </div>
    <div>
      <q-dialog v-model="step2" persistent>
        <q-card style="width: 350px; overflow: visible;" class="position-relative">
          <div class="cls-button" @click="hideModal()">
            <q-btn push color="white" text-color="primary" round icon="eva-close-outline" class="close" />
          </div>
          <q-linear-progress :value="1" color="primary" />
          <div class="q-pa-xl">
            <div v-if="loading" class="flex flex-center">
              <q-spinner-hourglass
                color="grey-5"
                size="5em"
              />
            </div>
            <div id="video_wrap" v-else>
              <div>
                <video id="video_frame" playsinline autoplay></video>
              </div>
              <div class="flex flex-center q-mt-lg">
                <q-btn color="primary" text-color="white" label="Tomar foto" @click="takePicture()"/>
              </div>
            </div>
          </div>
        </q-card>
      </q-dialog>
    </div>
    <div>
      <q-dialog v-model="step3" persistent>
        <q-card style="width: 350px; overflow: visible;" class="position-relative">
          <div class="cls-button" @click="hideModal()">
            <q-btn push color="white" text-color="primary" round icon="eva-close-outline" class="close" />
          </div>
          <q-linear-progress :value="1" color="primary" />
          <div class="q-pa-xl">
            <canvas id="canvas"></canvas>
          </div>
        </q-card>
      </q-dialog>
    </div>
  </div>
    
</template>
<script>
  import { ref, watch } from 'vue';
  export default {
    props: {
      dialog: Boolean,
    },
    emits: ['hideModal'],
    setup (props, { emit }) {

      // Data
      const loading = ref(false);
      const step1 = ref(props.dialog);
      const step2 = ref(false);
      const step3 = ref(false);
      const videoFrame  = ref('');

      const hideModal = () => {
        step2.value =  false
        step3.value =  false

        emit('hideModal')
      }
      
      const useCamera = () => {

        step1.value =  false
        step2.value =  true
        loading.value = true
        
        const constraints = {
          audio: false,
          video: true
        }
        navigator.mediaDevices.getUserMedia(constraints).then((mediaStream) => {
            loading.value = false
            setTimeout(() => {
              handleSuccess(mediaStream)
            },200)
        }).catch(function(err) {
          console.log(err)
          step1.value =  true
          step2.value =  false        
        });
      }

      const handleSuccess = (stream) => {
        videoFrame.value = document.getElementById('video_frame');
        window.stream = stream;
        videoFrame.value.srcObject = stream;
      }

      const takePicture = () => {
        step2.value =  false        
        step3.value =  true        
        setTimeout(() => {
          const canvas = document.querySelector("#canvas");
          canvas.width = width;
          canvas.height = height;
          canvas.getContext("2d").drawImage(videoFrame.value, 0, 0, width, height);
          var data = canvas.toDataURL("image/png");
          photo.setAttribute("src", data);
        },200)
      }
      watch(() => props.dialog, (newValue) => {
        step1.value = newValue
      });

      
      return {
        step1,
        step2,
        loading,
        hideModal,
        takePicture ,
        useCamera,
      }
    }
  };
</script>
<style lang="scss" scoped>
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
<template>
  <div>
    <div>
      <q-dialog v-model="step1" position="bottom" persistent>
        <q-card style="width: 350px; overflow: visible;" class="position-relative">
          <div class="cls-button" @click="hideModal()">
            <q-btn push color="white" text-color="primary" round icon="eva-close-outline" class="close" />
          </div>
          <q-linear-progress :value="1" color="primary" />
          <input type="file" accept="image/jpeg, image/png" id="sotom" capture="camera" @change="uploadPhoto($event)" style="display: none;">
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
          <div class="q-py-xl q-px-md">
            <div class="flex flex-center">
              <canvas id="canvas"></canvas>
            </div>
            <div class="flex flex-center q-mt-lg">
              <q-btn color="terciary" text-color="black" label="Tomar de nuevo" class="q-mx-sm" @click="useCamera()" v-if="isTakePhoto"/>
              <q-btn color="primary" text-color="white" label="Guardar" class="q-mx-sm" @click="save()" :loading="loading">
                <template v-slot:loading>
                  <q-spinner-facebook />
                </template>
              </q-btn>
            </div>
          </div>
        </q-card>
      </q-dialog>
    </div>
    <div>
      <q-dialog v-model="step4" persistent>
        <q-card style="width: 350px; overflow: visible;" class="position-relative">
          <div class="cls-button" @click="closeAndUpdate()">
            <q-btn push color="white" text-color="primary" round icon="eva-close-outline" class="close" />
          </div>
          <q-linear-progress :value="1" color="primary" />
          <div class="q-py-xl q-px-md">
            <div class="flex flex-center">
              <q-icon name="eva-clock-outline" />
            </div>
            <div class="flex flex-center q-mt-lg">
              <q-btn color="primary" text-color="white" label="Cerrar" class="q-mx-sm" @click="closeAndUpdate()" />
            </div>
          </div>
        </q-card>
      </q-dialog>
    </div>
  </div>
    
</template>
<script>
  import { ref, watch } from 'vue';
  import { useUserStore } from '@/services/store/user.store';
 
  export default {
    props: {
      dialog: Boolean,
    },
    emits: ['hideModal', 'update'],
    setup (props, { emit }) {

      // Data
      const userStore = useUserStore();
      const loading = ref(false);
      const step1 = ref(false);
      const step2 = ref(false);
      const step3 = ref(false);
      const step4 = ref(props.dialog);
      const videoFrame  = ref('');
      const isTakePhoto = ref(false)
      const file = ref('');

      const hideModal = () => {
        step2.value =  false
        step3.value =  false
        emit('hideModal')
      }
      const closeAndUpdate = () => {
        step2.value =  false
        step3.value =  false
        step4.value =  false

        emit('update')
      }

      const useCamera = () => {
        step1.value =  false
        step3.value =  false
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
        isTakePhoto.value = true  
        setTimeout(() => {
          createCanva(videoFrame.value, 1)
        },200)
      }

      const uploadPhoto = (e) => {
        const myImage = new Image();
        step1.value =  false        
        step3.value =  true       
        isTakePhoto.value = false  
        file.value = e.target.files[0];
        myImage.src = URL.createObjectURL(file.value); 

        setTimeout(() => {
          createCanva(myImage, 2)
        },200)
      }

      const createCanva = (img , type) => {
        const canvas = document.querySelector("#canvas");
        canvas.width = 254;
        canvas.height = 190;
        canvas.getContext("2d").drawImage(img, 0, 0, 254, 190);

        type == 1 
        ? canvas.toBlob((blob) => {
          file.value = new File([blob], "capt.jpg", { type: "image/jpeg" })
        }, 'image/jpeg')
        : file.value ; 
      }

      const save = () => {
        const formData = new FormData()
        formData.append('facial', file.value)
        loading.value = true
        userStore.setKyc(formData).then((data) => {
          if(data.code !== 200) throw data
          step3.value =  false        
          step4.value =  true  
          loading.value = false
          
        }).catch((response) => {
          loading.value = false

        })
      }
      watch(() => props.dialog, (newValue) => {
        step4.value = newValue
      });

      
      return {
        step1,
        step2,
        step3,
        step4,
        loading,
        isTakePhoto,
        file,
        hideModal,
        closeAndUpdate,
        takePicture ,
        useCamera,
        save,
        uploadPhoto,
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
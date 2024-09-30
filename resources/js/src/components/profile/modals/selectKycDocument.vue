<template>
  <div>
    <div>
      <q-dialog v-model="step1" position="bottom" persistent>
        <q-card style="width: 350px; overflow: visible;" class="position-relative ">
          <div class="cls-button" @click="hideModal()">
            <q-btn push color="white" text-color="primary" round icon="eva-close-outline" class="close" />
          </div>
          <q-linear-progress :value="1" color="primary" />
          <input type="file" accept="image/jpeg, image/png" id="img_camera" @change="uploadPhoto($event)" style="display: none;">
          <div class="q-mt-sm text-center text-subtitle1 text-weight-bold">
            {{ photoType == 'front' ? 'Frontal del documento' : 'Dorso del documento' }}
          </div>
          <q-card-section class="row items-center no-wrap justify-center">
            <div class="q-pt-none q-mx-md">
              <label for="img_camera"  class="flex column items-center">
                <div class="bg-primary flex flex-center button-file cursor-pointer" >
                    <q-icon name="eva-folder-add-outline" color="white" size="md" />
                </div>
                <div class="text-subtitle1 text-weight-medium q-mt-xs">Subir archivo</div>
              </label>
            </div>
            <div class="q-pt-none q-mx-md">
              <div  class="flex column items-center">
                <div class="bg-terciary flex flex-center button-file cursor-pointer" @click="useCamera(photoType)">
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
        <q-card style=" overflow: visible;" class="position-relative document_verify_modal">
          <div class="cls-button" @click="hideModal()">
            <q-btn push color="white" text-color="primary" round icon="eva-close-outline" class="close" />
          </div>
          <q-linear-progress :value="1" color="primary" />
          <div class="q-mt-sm text-center text-subtitle1 text-weight-bold">
            {{ photoType == 'front' ? 'Frontal del documento' : 'Dorso del documento' }}
          </div>
          <div class="q-py-xl " style="height: 100%;">
            <div v-if="loading" class="flex flex-center q-pa-xl" style="height: 100%;">
              <q-spinner-hourglass
                color="grey-5"
                size="5em"
              />
            </div>
            <div id="video_wrap  " style="height: 100%;" v-else>
              <div style="height: 90%; " class="flex flex-center q-px-sm">
                <video id="video_frame" playsinline autoplay></video>
              </div>
              <div class="flex flex-center q-mt-lg">
                <q-btn color="primary" text-color="white" label="Tomar foto" @click="takePicture(photoType)"/>
              </div>
            </div>
          </div>
        </q-card>
      </q-dialog>
    </div>
    <div>
      <q-dialog v-model="step3" persistent>
        <q-card style=" overflow: visible;" class="position-relative document_verify_modal">
          <div class="cls-button" @click="hideModal()">
            <q-btn push color="white" text-color="primary" round icon="eva-close-outline" class="close" />
          </div>
          <q-linear-progress :value="1" color="primary" />
          <div class="q-mt-sm text-center text-subtitle1 text-weight-bold q-pt-md">
            {{ photoType == 'front' ? 'Frontal del documento' : 'Tus documentos' }}
          </div>
          <div class="q-py-xl " style="height: 100%;">
            <div class="flex flex-center" style="overflow: auto; height: 85%">
              <div class="q-px-md-sm img_content_document with-border q-py-sm q-py-md-none" >
                <img :src="img['front']" alt="" style="width: 100%;" class=""  id="front_document">
              </div>
              <div class="q-px-md-sm img_content_document q-mt-md q-mt-md-none q-py-sm q-py-md-none"  >
                <img :src="img['back']" alt="" style="width: 100%; "  class="" id="back_document">
              </div>
              <canvas id="canvas" style="display: none;"></canvas>
            </div>
            <div class="flex flex-center q-mt-lg">
              <q-btn color="terciary" text-color="black" label="Tomar de nuevo" class="q-mx-sm" @click="useCamera()" v-if="isTakePhoto"/>
              <q-btn 
                color="terciary" 
                text-color="black" 
                label="Subir de nuevo" 
                class="q-mx-sm" 
                @click="step1 = true; step3 = false" 
                v-if="!isTakePhoto"
              />
              <q-btn 
                color="primary" 
                text-color="white" 
                :label="photoType == 'front' ? 'Continuar' : 'Guardar' " 
                class="q-mx-sm " 
                @click="save()" 
                :loading="loading"
              >
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
        <q-card style=" overflow: visible;" class="position-relative">
          <div class="cls-button" @click="hideModal(data)">
            <q-btn push color="white" text-color="primary" round icon="eva-close-outline" class="close" />
          </div>
          <q-linear-progress :value="1" color="terciary" />
          <div class="q-py-xl q-px-md column flex-center" style="height: 100%;">
            <div class="flex flex-center">
              <q-icon name="eva-clock-outline" size="5em" color="terciary"/>
            </div>
            <div class="text-subtitle1 text-weight-medium text-center q-mt-md">
              Tus documentos están siendo verificados.
            </div>
            <div class="text-subtitle1 text-weight-medium text-center">
              Te estaremos informando en un lapso de 24hrs sobre el estado de tu verificación.
            </div>
            <div class="flex flex-center q-mt-lg">
              <q-btn color="primary" text-color="white" label="Cerrar" class="q-mx-sm" @click="hideModal(data)" />
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
    emits: ['hideModal'],
    setup (props, { emit }) {

      // Data
      const userStore = useUserStore();
      const loading = ref(false);
      const step1 = ref(props.dialog);
      const step2 = ref(false);
      const step3 = ref(false);
      const step4 = ref(false);
      const videoFrame  = ref('');
      const isTakePhoto = ref(false)
      const data = ref(null);
      const photoType = ref('front')
      const img = ref({
        back:null,
        front:null
      })


      const file = ref({
        back:null,
        front:null
      });

      const hideModal = (data = null) => {
        step2.value =  false
        step3.value =  false
        step4.value =  false
        img.value = {
          back:null,
          front:null
        }
        photoType.value = 'front'
        emit('hideModal', data)
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
          createCanva()
        },200)
      }

      const uploadPhoto = (e) => {
        step1.value =  false        
        step3.value =  true       
        isTakePhoto.value = false  
        file.value[photoType.value] = e.target.files[0]; 
        setTimeout(() => {
          createImage()
        },200)
      }

      const createCanva = () => {
        const width = 300; 
        const canvas = document.getElementById('canvas');

        const height = (videoFrame.value.videoHeight / videoFrame.value.videoWidth) * width;
        // const.

        canvas.height = height;
        canvas.width = width
        canvas.getContext("2d").drawImage(videoFrame.value, 0, 0, width, height);
      
        canvas.toBlob((blob) => {
          file.value[photoType.value] = new File([blob], "capt.jpg", { type: "image/jpeg" })
        }, 'image/jpeg')
        
        img.value[photoType.value] = canvas.toDataURL("image/png")
      }


      const createImage = () => {
        img.value[photoType.value] = URL.createObjectURL(file.value[photoType.value]); 
      }

      const save = () => {
        if(photoType.value == 'front'){
          photoType.value = 'back'
          step3.value =  false        
          step1.value =  true 
          return
        }
        
        const formData = new FormData()
        formData.append('document_front', file.value.front)
        formData.append('document_back', file.value.back)

        loading.value = true
        userStore.setKyc(formData).then((response) => {
          if(response.code !== 200) throw response
          step3.value =  false        
          step4.value =  true  
          loading.value = false
          data.value = response.data
          
        }).catch((response) => {
          loading.value = false
        })
      }
      watch(() => props.dialog, (newValue) => {
        step1.value = newValue
      });

      
      return {
        step1,
        step2,
        step3,
        step4,
        data,
        loading,
        isTakePhoto,
        file,
        photoType,
        img,
        hideModal,
        takePicture ,
        useCamera,
        save,
        uploadPhoto,
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
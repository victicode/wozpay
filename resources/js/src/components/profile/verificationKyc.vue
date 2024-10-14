<template>
  <div class="q-pa-md q-mb-xl q-pb-xl" style="overflow-y: auto; height: 100%;">
    <transition name="vertical">

      <div v-show="step < 3">
        <input type="file"  id="img_camera"  @change="uploadPhoto($event, step)" style="display: none;">
        <q-stepper
          v-model="step"
          ref="stepper"
          alternative-labels
          color="primary"
          class="verificationStep"
          animated
        >
          <q-step
            title=""
            :name="1"
            prefix="1"
            done-color="positive"
            :done="step > 1"
          >
            <div class="q-px-md-xl">
              <div class="q-px-md-xl q-mx-md-xl q-px-sm">
                <div class="cardSilu__container">
                  <div class="top__cardSilu flex flex-center">
                    <div class="text-center text-md-h6 text-white text-weight-bold ">
                      REPUBLICA DEL PARAGUAY
                    </div>
                  </div>
                  <div class="mid__cardSilu flex items-top justify-between q-px-lg q-pt-md">
                    <div>
                      <div class="star__content flex flex-center ">
                        <div style="width: 80%; height: 80%;  border-radius: 50%;" class="bg-white flex flex-center ">
                          <div style="width: 75%; height: 75%; border-radius: 50%;" class="bg-grey-4 flex flex-center">
                            <q-icon name="eva-star-outline" size="2rem" color="grey-6"/>
                          </div>
                        </div>
                      </div>
                      <div class="text-subtitle2 text-center q-mt-sm text-weight-bold">
                        1.234.567
                      </div>
                    </div>
                    <div style="width: 50%;">
                      <div class="q-mb-md q-mb-md-lg q-mt-sm bg-grey-5 silutText" />
                      <div class="q-mb-md q-mb-md-lg bg-grey-5 silutText" />
                      <div class="q-mb-md q-mb-md-lg bg-grey-5 silutText" />
    
                    </div>
                  </div>
                  <div class="bottom__cardSilu" />
                </div>
                <div class="q-mt-sm">
                  <div class="text-subtitle1 text-center q-mt-xs text-weight-bold">Frontal</div>
                  <div class="text-subtitle2 text-center q-mt-xs text-weight-medium info-text q-px-lg q-py-sm ">
                    Asegurate de que la cedula de identidad se vea claramente
                  </div>
                </div>
              </div>
              <div class="q-mt-lg q-px-sm q-px-md-xl q-mx-md-xl">
                <label for="img_camera"  class="flex column items-center">
                <div 
                  style=""
                  class="bg-primary text-white tex-bold-medium flex flex-center text-subtitle2 cursor-pointer buttonKYc"
                >
                  Tomar foto
                </div>
              </label>
              </div>
            </div>
          </q-step>
          <q-step
            title=""
            :name="2"
            prefix="2"
            done-color="positive"
            :done="step > 2"
          >
            <div class="q-px-md-xl">
              <div class="q-px-md-xl q-mx-md-xl q-px-sm">
                <div class="cardSilu__container">
                  <div class="back_mid__cardSilu flex items-center justify-between q-px-lg q-pt-md">
                    <div>
                      <div class="star__content flex flex-center ">
                        <div style="width: 80%; height: 80%;  border-radius: 50%;" class="bg-white flex flex-center ">
                          <div style="width: 75%; height: 75%; border-radius: 50%;" class="bg-grey-4 flex flex-center">
                            <q-icon name="eva-star-outline" size="2rem" color="grey-6"/>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div style="width: 50%;">
                      <div class="q-mb-md q-mb-md-lg q-mt-sm bg-grey-5 silutText" />
                      <div class="q-mb-md q-mb-md-lg bg-grey-5 silutText" />
                      <div class="q-mb-md q-mb-md-lg bg-grey-5 silutText" />
                    </div>
                  </div>
                  <div class="back_bottom__cardSilu flex flex-center column text-subtitle1 text-weight-bold">
                    >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>><br>
                    >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
                  </div>
                </div>
                <div class="q-mt-sm">
                  <div class="text-subtitle1 text-center q-mt-xs text-weight-bold">Dorsal</div>
                  <div class="text-subtitle2 text-center q-mt-xs text-weight-medium info-text q-px-lg q-py-sm ">
                    Asegurate de que la cedula de identidad se vea claramente
                  </div>
                </div>
              </div>
              <div class="q-mt-lg q-px-sm q-px-md-xl q-mx-md-xl">
                <label for="img_camera"  class="flex column items-center">
                  <div 
                    style=""
                    class="bg-primary text-white tex-bold-medium flex flex-center text-subtitle2 cursor-pointer buttonKYc"
                  >
                    Tomar foto
                  </div>
                </label>
              </div>
            </div>
          </q-step>
        </q-stepper>
      </div>
    </transition>
    <transition name="vertical">
      <div v-show="step == 3">
        <div>
          <q-toolbar class="bg-white text-black q-py-md q-mt-sm">
            <q-toolbar-title> 
              <div class="w-100 flex items-center justify-center">
                <span class="text-subtitle1 text-weight-bold q-mt-sm q-pt-xs">Verificar Identidad</span>
              </div>
            </q-toolbar-title>
          </q-toolbar>
          <q-list >
            <q-item class=" q-px-sm" >
              <q-item-section>
                <div class="flex align-center justify-between">
                  <q-item-label class="q-mt-xs text-weight-bold" >
                    <div>
                      <div class="text-weight-bold text-body2">
                        Documento - Cédula de identidad 
                      </div>
                      <div class="text-caption text-grey-5">
                        Cédula de identidad frontal
                      </div>
                    </div>
                  </q-item-label>
                  <q-item-label caption lines="1" class="text-weight-medium text-caption">
                    <q-btn 
                      unelevated 
                      flat 
                      round 
                      :color="'positive'"
                      :icon="'eva-checkmark-circle-2-outline'"  
                    />
                    
                  </q-item-label>
                </div>
              </q-item-section>
            </q-item>
            <q-separator />
            <q-item class=" q-px-sm" >
              <q-item-section>
                <div class="flex align-center justify-between">
                  <q-item-label class="q-mt-xs text-weight-bold" >
                    <div>
                      <div class="text-weight-bold text-body2">
                        Documento - Cédula de identidad 
                      </div>
                      <div class="text-caption text-grey-5">
                        Cédula de identidad dorsal
                      </div>
                    </div>
                  </q-item-label>
                  <q-item-label caption lines="1" class="text-weight-medium text-caption">
                    <q-btn 
                      unelevated 
                      flat 
                      round 
                      :color="'positive'"
                      :icon="'eva-checkmark-circle-2-outline'"  
                    />
                  </q-item-label>
                </div>
              </q-item-section>
            </q-item>
            <q-separator />
          </q-list>
        </div>
        <div class="q-px-md-xl q-mx-md-xl">
          <div class="q-mt-lg q-px-sm q-px-md-xl q-mx-md-xl">
            <div 
              style=""
              class="bg-primary text-white tex-bold-medium flex flex-center text-subtitle2 cursor-pointer buttonKYc q-mt-xl"
              @click="step = 4"
            >
              Enviar fotos
            </div>
            <div 
              style=""
              class="bg-primary text-white tex-bold-medium flex flex-center text-subtitle2 cursor-pointer buttonKYc q-mt-lg"
              @click="step = 1"
            >
              Comenzar de nuevo
            </div>
          </div>
        </div>
      </div>
    </transition>
    <transition name="vertical">
      <div v-show="step == 4" class=" q-mb-lg" style="height: 100%; ">
        <div>
          <q-toolbar class="bg-white text-black q-py-sm q-mt-none">
            <q-toolbar-title> 
              <div class="w-100 flex items-center justify-center">
                <span class="text-subtitle1 text-weight-bold q-mt-sm q-pt-xs">Verificación de identidad</span>
              </div>
            </q-toolbar-title>
          </q-toolbar>
          <div class="flex flex-center column">
            <div v-html="wozIcons.kycUser" />
            <div class="info__kyc-facial q-py-sm q-mt-xl q-mx-md-xl q-px-md q-px-md-xl">
              <div class="text-h6 text-weight-bold text-center">
                Sujeta tu documento junto a tu rostro
              </div>
              <div>
                <div class="flex items-center q-my-sm">
                  <div v-html="wozIcons.noGlasses" />
                  <div class="q-mt-xs q-ml-xs text-subtitle1 text-weight-medium" style="width: 75%;">No uses lentes</div>
                </div>
                <div class="flex items-center q-my-sm">
                  <div v-html="wozIcons.likeKyc" />
                  <div class="q-mt-xs q-ml-xs text-subtitle1 text-weight-medium" style="width: 75%;">Usa buena iluminación</div>
                </div>
                <div class="flex items-center q-my-sm">
                  <div v-html="wozIcons.kycUser2" />
                  <div class="q-mt-xs q-ml-xs text-subtitle1 text-weight-medium" style="width: 75%;">
                    Asegurate de que tu rostro y tu cédula sean visibles
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="q-px-md-xl q-mx-md-xl">
          <div class="q-mt-lg q-px-sm q-px-md-xl q-mx-md-xl">
            <div 
              style=""
              class="bg-primary text-white tex-bold-medium flex flex-center text-subtitle2 cursor-pointer buttonKYc q-mt-lg"
              @click="showDialog('check')"
            >
              <div v-if="loading">
                <q-spinner-facebook  size="md"/>
              </div>
              <div v-else>

                Tomar foto
              </div>
            </div>
          </div>
        </div>
      </div>
    </transition>
    <transition name="vertical">
      <div v-show="step == 5">
        <div>
          <q-toolbar class="bg-white text-black q-py-sm q-mt-none">
            <q-toolbar-title> 
              <div class="w-100 flex items-center justify-center">
                <span class="text-subtitle1 text-weight-bold q-mt-sm q-pt-xs">Proceso completado🎉</span>
              </div>
            </q-toolbar-title>
          </q-toolbar>
          <div>
            <div class="q-pb-xl q-mt-md q-px-md column flex-center" style="height: 100%;">
              <div class="flex flex-center">
                <q-icon name="eva-clock-outline" size="5em" color="terciary"/>
              </div>
              <div class="text-subtitle1 text-weight-medium text-center q-mt-md">
                Tu documento y tu foto estan siendo verificados por nuestro equipo.
              </div>
              <div class="text-subtitle1 text-weight-medium text-center">
                Te estaremos informando en un lapso de 24hrs sobre el estado verificación.
              </div>
              <div class="text-subtitle1 text-weight-medium text-center">
                Gracias por usar Woz Pay.
              </div>
            </div>
          </div>
        </div>
        <div class="q-px-md-xl q-mx-md-xl">
          <div class="q-mt-none q-px-sm q-px-md-xl q-mx-md-xl">
            <div 
              style=""
              class="bg-primary text-white tex-bold-medium flex flex-center text-subtitle2 cursor-pointer buttonKYc q-mt-none"
              @click="router.push('/')"
            >
              Volver al inicio
            </div>
          </div>
        </div>
      </div>
    </transition>
    <selectKycType :dialog="(dialog =='check')" @hideModal="updateFacial" />
    <setPhotoDocument  :dialog="(dialog =='back')" @hideModal="updateDocument" :img="img[step]"/>
  </div>
</template>

<script>
import { ref } from 'vue'
import selectKycType from '@/components/profile/modals/selectKycType.vue';
import setPhotoDocument from '@/components/profile/modals/setPhotoDocument.vue';
import { useUserStore } from '@/services/store/user.store';
import { useAuthStore } from '@/services/store/auth.store';
import wozIcons from '@/assets/icons/wozIcons';
import { useRouter } from 'vue-router';
import { storeToRefs } from 'pinia'


export default {
  components:{
    selectKycType,
    setPhotoDocument 
  },
  setup () {
    const { user  } = storeToRefs(useAuthStore())

    const dialog = ref('')
    const userStore = useUserStore()
    const file = ref([])
    const step = ref(user.value.verify_status == 0 && (user.value.facial_verify == 0 || !user.value.facial_verify) ? 1 : user.value.verify_status == 1 && user.value.facial_verify == 0 ? 4 : 5)
    const img = ref([]);
    const loading = ref(false)
    const router = useRouter()

    const updateFacial = (data) => {
      dialog.value = '';
      file.value[3] = data 
      sendData()
    }
    const updateDocument = (data) => {
      dialog.value = '';
      if(!data){
        file.value[step.value] = ''
        img.value[step.value] = ''
        return
      }
      step.value ++;
    }
    const showDialog = (dialogToShow) => {
      dialog.value = dialogToShow
      if(dialogToShow == 'check') loading.value = true
    }
    const uploadPhoto = (e, type) => {
      file.value[type] = e.target.files[0]; 
      setTimeout(() => {
        createImage(type)
      },200)
    }
    const createImage = (type) => {
      img.value[type] = URL.createObjectURL(file.value[type]); 
      showDialog('back')
    }
    const validate = () => {
      let ok = true
      file.value.forEach((file) => {
        if(!file) ok = false
      })
      return ok;
    }
    const sendData = () => {
      if(!validate())return
      const data = new FormData()
      data.append('document_front',file.value[1])
      data.append('document_back',file.value[2])
      data.append('facial', file.value[3])

        userStore.setKyc(data).then((response) => {
          if(response.code !== 200) throw response
          loading.value = false
          user.value = response.data
          step.value = 5
          
        }).catch((response) => {
          loading.value = false
          console.log(response)
        })
    }
    return {
      wozIcons,
      loading,
      step,
      dialog,
      img,
      updateDocument,
      updateFacial,
      showDialog,
      uploadPhoto,
      router,
    }
  }
}
</script>
<style lang="scss" >
  .info__kyc-facial{
    background: #e3ebfe;
    border-radius: 15px;
  }
  .back_mid__cardSilu{
    height: 75%; width: 100%; background: white;
  }
  .back_bottom__cardSilu{
    height: 25%; width: 100%; background: #d9d9d9;

  }
  .buttonKYc{
    width: 100%; height:50px; border-radius:17px;
    box-shadow: 0px 1px 5px 0px #989898;
    transition: all 0.5s ease;
    &:active {
      transform: scale(0.7);
    }
  }
  .info-text{
    background: #e1e9fe;
    border-radius: 20px;
  }
  .silutText{
    height: 20px; width: 100%;  border-radius: 50px;
    &:nth-child(3){
      width: 70%;
    }
  }
  .star__content{
    height: 120px; width: 120px; border-radius: 50%; background: lightgray;
  }
  .top__cardSilu{
    height: 15%; width: 100%; background: #fa3d3d;
  }
  .mid__cardSilu{
    height: 70%; width: 100%; background: white;
  }
  .bottom__cardSilu{
    height: 15%; width: 100%; background: #0449fb
  }
  .cardSilu__container {
    height: 260px; 
    width: 100%; 
    border: 1px solid lightgray; 
    border-radius: 25px; 
    box-shadow: 0px 2px 10px 0px lightgray;
    overflow: hidden;
  }
  .verificationStep{
    & .q-stepper__header--border{
      border: 0px;
    }
    &.q-stepper{
      box-shadow: none;
    }
    & .q-stepper__dot{
      width: 50px;
      height: 50px;
      & > span {
        transform: scale(1.8);
        
      }
    }
    & .q-stepper__step-inner{
      padding-right: 0px!important;
      padding-left: 0px!important;
    }
  }
  @media screen and (max-width: 780px){
    .star__content{
      height: 90px; 
      width: 90px;
    }
    .cardSilu__container {
      height: 210px; 
      width: 100%; 
      border-radius: 18px; 
    }
    .silutText{
      height: 15px; 
    }
  }
</style>
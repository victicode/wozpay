<template>
  <div class="q-pa-md">
    <q-stepper
      v-model="step"
      ref="stepper"
      alternative-labels
      color="primary"
      class="verificationStep"
      animated
    >
      <q-step
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
          <div class="q-mt-lg q-px-sm">
            <q-btn 
              id="logout-button" 
              label="Tomar foto" 
              unelevated
              no-caps 
              color="primary" 
              class="full-width"
            >
              <template v-slot:loading>
                <q-spinner-facebook />
              </template>
            </q-btn>
          </div>
        </div>
      </q-step>

      <q-step
        :name="2"
        prefix="2"
        done-color="positive"
        :done="step > 2"
      >
        An ad group contains one or more ads which target a shared set of keywords.
      </q-step> 
     <!-- <template v-slot:navigation>
        <q-stepper-navigation>
           <q-btn @click="$refs.stepper.next()" color="primary" :label="step === 2 ? 'Finish' : 'Continue'" />
          <q-btn v-if="step > 1" flat color="primary" @click="$refs.stepper.previous()" label="Back" class="q-ml-sm" /> 
          <q-btn v-if="step > 1" flat color="primary"  label="Back" class="q-ml-sm"  @click="showDialog('back')" />
        </q-stepper-navigation>
      </template> -->
    </q-stepper>
    <selectKycType :dialog="(dialog =='check')" @hideModal="updateFacial" />
    <selectKycDocument :dialog="(dialog =='back')" @hideModal="updateDocument" />
  </div>
</template>

<script>
import { ref } from 'vue'
import selectKycType from '@/components/profile/modals/selectKycType.vue';
import selectKycDocument from '@/components/profile/modals/selectKycDocument.vue';
import { useAuthStore } from '@/services/store/auth.store';
import { storeToRefs } from 'pinia'

export default {
  components:{
    selectKycType,
    selectKycDocument
  },
  setup () {
    const dialog = ref('')
    const { user  } = storeToRefs(useAuthStore())

    const step = ref(1)
    const updateFacial = (data) => {
      dialog.value = '';
      user.facial_verify = data ? data.facial_verify : user.facial_verify
      user.facial_photo = data ? data.facial_photo : user.facial_photo
    }
    const updateDocument = (data) => {
      dialog.value = '';
      user.document_photo_front = data ? data.document_photo_front : user.document_photo_front
      user.document_photo_back = data ? data.document_photo_back : user.document_photo_back
      user.verify_status = data ? data.verify_status : user.verify_status

    }
    return {
      step,
      dialog,
      updateDocument,
      updateFacial
    }
  }
}
</script>
<style lang="scss" >
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
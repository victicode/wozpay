
<template>
  <div class="profile_section" >
    <div class="" v-if="Object.values(user).length > 0" >
      <div class="w-100 q-mx-none" >
        <!-- Verification -->
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
                    <div class="text-weight-bold text-body2">Verificar documentos</div>
                    <div class="text-caption text-grey-5">
                      Toma una foto de tu documento de identidad
                    </div>
                  </div>
                </q-item-label>
                <q-item-label caption lines="1" class="text-weight-medium text-caption">
                  <q-btn unelevated flat round color="bg-grey-5" style="color: black"  icon="eva-camera-outline" @click="showDialog('check')" />
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
                    <div class="text-weight-bold text-body2">Verifcación facial</div>
                    <div class="text-caption text-grey-5">
                      Toma una foto de tu documento de identidad
                    </div>
                  </div>
                </q-item-label>
                <q-item-label caption lines="1" class="text-weight-medium text-caption">
                  <q-btn unelevated flat round color="bg-grey-5" style="color: black"  icon="eva-camera-outline" @click="showDialog('check')" />
                </q-item-label>
              </div>
            </q-item-section>
          </q-item>
          <q-separator />
        </q-list>
        <!-- Verification status -->
        <q-toolbar class="bg-white text-black q-mt-md">
          <q-toolbar-title> 
            <div class="w-100 flex items-center justify-center">
              <span class="text-subtitle1 text-weight-bold">Estado de verifiación</span>
            </div>
          </q-toolbar-title>
        </q-toolbar>
        <q-list >
          <q-item class=" q-px-sm" >
            <q-item-section>
              <div class="flex items-center ">
                <q-item-label class="q-mt-xs text-weight-bold" >
                  <div>
                    <div class="text-weight-bold text-body2">Verificación documentos</div>
                    <div class="text-caption text-grey-5 flex items-center">

                      {{ 
                        user.verify_status == 1
                          ? 'Pendiente'
                          : user.verify_status == 2 
                          ? 'Usuario verificado'
                          : 'Sin verificación'
                      }}
                      <q-icon
                        :name="user.verify_status == 2 ? icons.sharpVerified : icons.outlinedVerified"
                        size="xs"
                        :color=" user.verify_status >=1 ? 'terciary' :'grey-5'"
                        class="user-verify-user q-mx-xs "
                        :class="{'verify-user':user.verify_status == 2, }"
                        @click="showToltip(1)"
                      >
                        <q-tooltip 
                          anchor="top middle" 
                          self="bottom middle" 
                          :class=" user.verify_status == 2 ? 'bg-positive': 'bg-terciary' " 
                          :offset="[10, 10]" 
                          v-model="toltip"
                        >
                          {{
                            user.verify_status == 1
                            ? 'Pendiente'
                            : user.verify_status == 2 
                            ? 'Usuario verificado'
                            : 'Sin verificación'
                          }}
                        </q-tooltip>
                      </q-icon>
                    </div>
                  </div>
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
                    <div class="text-weight-bold text-body2">Verificación facial</div>
                    <div class="text-caption text-grey-5 flex items-center">
                      {{ 
                        user.verify_status == 1
                          ? 'Pendiente'
                          : user.verify_status == 2 
                          ? 'Usuario verificado'
                          : 'Sin verificación'
                      }}
                      <q-icon
                        :name="user.verify_status == 2 ? icons.sharpVerified : icons.outlinedVerified"
                        size="xs"
                        :color=" user.verify_status >= 1 ? 'terciary' : 'grey-5'"
                        class="user-verify-user q-mx-xs "
                        :class="{'verify-user':user.verify_status == 2, }"
                        @click="showToltip(2)"
                      >
                        <q-tooltip 
                          anchor="top middle" 
                          self="bottom middle" 
                          :class=" user.verify_status == 2 ? 'bg-positive': 'bg-terciary' " 
                          :offset="[10, 10]" 
                          v-model="toltip2"
                        >
                          {{
                            user.verify_status == 1
                            ? 'Pendiente'
                            : user.verify_status == 2 
                            ? 'Usuario verificado'
                            : 'Sin verificación'
                          }}
                        </q-tooltip>
                      </q-icon>
                    </div>
                  </div>
                </q-item-label>
              </div>
            </q-item-section>
          </q-item>
          <q-separator />
        </q-list>
        <!-- Phone -->
        <q-toolbar class="bg-white text-black q-mt-md">
          <q-toolbar-title> 
            <div class="w-100 flex items-center justify-center">
              <span class="text-subtitle1 text-weight-bold">Número de teléfono</span>
            </div>
          </q-toolbar-title>
        </q-toolbar>
        <q-list >
          <q-item class=" q-px-sm" >
            <q-item-section>
              <div class="flex align-center justify-between">
                <q-item-label class="q-mt-xs text-weight-bold" >
                  <div>
                    <div class="text-weight-bold text-body2">Número de teléfono actual</div>
                    <div class="text-caption text-grey-5 text-weight-medium">
                      {{user.phone ? `(+595) ${user.phone}` : 'Agregar'}}
                    </div>
                  </div>
                </q-item-label>
                <q-item-label caption lines="1" class="text-weight-medium text-caption">
                  <q-btn unelevated flat round color="bg-grey-7" style="color: black"  icon="eva-edit-2-outline"  @click="showDialog('updatePhone')"/>
                </q-item-label>
              </div>
            </q-item-section>
          </q-item>
          <q-separator />
        </q-list>
        <!-- Email -->
        <q-toolbar class="bg-white text-black q-mt-md">
          <q-toolbar-title> 
            <div class="w-100 flex items-center justify-center">
              <span class="text-subtitle1 text-weight-bold">Correo electrónico</span>
            </div>
          </q-toolbar-title>
        </q-toolbar>
        <q-list >
          <q-item class=" q-px-sm" >
            <q-item-section>
              <div class="flex align-center justify-between">
                <q-item-label class="q-mt-xs text-weight-bold" >
                  <div>
                    <div class="text-weight-bold text-body2">Correo electrónico asociado</div>
                    <div class="text-caption text-grey-5 text-weight-medium">
                      {{user.email ?? 'Agregar'}}
                    </div>
                  </div>
                </q-item-label>
                <q-item-label caption lines="1" class="text-weight-medium text-caption">
                  <q-btn unelevated flat round color="bg-grey-7" style="color: black"  icon="eva-edit-2-outline"  @click="showDialog('updateEmail')"/>
                </q-item-label>
              </div>
            </q-item-section>
          </q-item>
          <q-separator />
        </q-list>
      </div>
    </div>
    <div class="row">
      <div class="col-12 q-mt-md q-mb-md q-px-md-xl q-px-xs-lg q-pt-md">
        <q-btn 
          id="logout-button" 
          label="Actualizar" 
          unelevated
          no-caps 
          color="terciary" 
          class="full-width" 
          :loading="loading"
          @click="uptadteInfo" 
        >
        <template v-slot:loading>
          <q-spinner-facebook />
        </template>
        </q-btn>
      </div>
    </div>
    <div v-if="dialog=='updatePhone'">
      <updatePhoneNumber  :dialog="(dialog =='updatePhone')" @hideModal="updatePhone" />
    </div>
    <div v-if="dialog=='updateEmail'">
      <updateEmail :dialog="(dialog =='updateEmail')" @hideModal="updateEmail" />
    </div>
    <selectKycType :dialog="(dialog =='check')" @hideModal="kyc" />
    
  </div>
</template>
<script>
  import { ref } from 'vue';
  import { inject } from 'vue'
  import { useUserStore } from '@/services/store/user.store'
  import { useAuthStore } from '@/services/store/auth.store'
  import { useQuasar } from 'quasar'
  import updatePhoneNumber from '@/components/profile/modals/updatePhoneNumber.vue';
  import updateEmail from '@/components/profile/modals/updateEmail.vue';
  import selectKycType from '@/components/profile/modals/selectKycType.vue';

  export default {
    components:{
      updatePhoneNumber,
      updateEmail,
      selectKycType,
    },
    
    setup () {
      //vue provider
      const icons = inject('ionIcons')
      const $q = useQuasar()
      const store = useUserStore()
      const user = useAuthStore().user;
      const dialog = ref('')
      // data
      const loading = ref(false)

      // Data
      const toltip = ref(false)
      const toltip2 = ref(false)

      // Methods
      const showToltip = (id) => {
        if(id==1){
          toltip.value = true
          setTimeout(() => {
            toltip.value = false
          }, 3500);
          return
        }
        toltip2.value = true
          setTimeout(() => {
            toltip2.value = false
          }, 3500);
      }
      // methods

      const showDialog = (dialogToShow) => {
        dialog.value = dialogToShow
      }
      const kyc = () => {
        dialog.value = '';
        console.log( dialog.value)
      }
      const updatePhone = (data) => {
        dialog.value = '';
        user.phone = data ?? user.phone
      }
      const updateEmail = (data) => {
        dialog.value = '';
        user.email = data ?? user.email
      }
      const showNotify = (type, message) => {
        $q.notify({
          message: message,
          color: type,
          actions: [
            { icon: 'eva-close-outline', color: 'white', round: true, handler: () => { /* ... */ } }
          ]
        })
      }
      const loadingShow = (state) => {
        loading.value = state;
      }
      
      const uptadteInfo = () =>{
        loadingShow(true)
        store.updateUser(user)
        .then((data)=> {
          if(!data.code){
              showNotify('negative', data)
              loadingShow(false);
              return;
            }
            setTimeout(() => {
              showNotify('positive', 'Datos actualizados')
              loadingShow(false);
            }, 2000);
        })
        .catch((e) => { 
          console.log(e)
          loadingShow(false);
          showNotify('negative', 'Error al enviar codigo')
        })
      }
      return {
        icons,
        loading,
        user,
        dialog,
        toltip,
        toltip2,
        showDialog,
        showToltip,
        uptadteInfo,
        updatePhone,
        updateEmail,
        kyc,

      }
    }
  };
</script>


<style lang="scss">
#logout-button{
  padding: 10px;
}
.profile_section{
  height: 100%; 
  overflow-y: scroll;
  &::-webkit-scrollbar {
    display: none;
}
}
</style>
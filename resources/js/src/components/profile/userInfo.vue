
<template>
  <div class="profile_section" >
    <div class="" v-if="Object.values(user).length > 0" >
      <div class="w-100 q-mx-none" >
        <!-- info -->
        <q-toolbar class="bg-grey-5 text-black ">
          <q-toolbar-title> 
            <div class="w-100 flex items-center justify-between">
              <span class="text-subtitle2 text-weight-bold">Verificar Identidad</span>
            </div>
          </q-toolbar-title>
        </q-toolbar>
        <q-list >
          <q-item class=" q-px-sm" >
            <q-item-section>
              <div class="flex align-center justify-between">
                <q-item-label class="q-mt-xs text-weight-bold" >
                  <div>
                    <div class="text-weight-bold text-caption">Verificar documentos</div>
                    <div class="text-caption text-grey-5">
                      Toma una foto de tu documento de identidad
                    </div>
                  </div>
                </q-item-label>
                <q-item-label caption lines="1" class="text-weight-medium text-caption">
                  <q-btn unelevated flat round color="bg-grey-5" style="color: black"  :icon="icons.outlinedAddAPhoto" />

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
                    <div class="text-weight-bold text-caption">Verifcación facial</div>
                    <div class="text-caption text-grey-5">
                      Toma una foto de tu documento de identidad
                    </div>
                  </div>
                </q-item-label>
                <q-item-label caption lines="1" class="text-weight-medium text-caption">
                  <q-btn unelevated flat round color="bg-grey-5" style="color: black"  :icon="icons.outlinedAddAPhoto" />
                </q-item-label>
              </div>
            </q-item-section>
          </q-item>
          <q-separator />
        </q-list>
        <!-- address -->
        <q-toolbar class="bg-grey-5 text-black q-mt-sm">
          <q-toolbar-title> 
            <div class="w-100 flex items-center justify-between">
              <span class="text-subtitle2 text-weight-bold">Estado de verifiación</span>
              <span>
              </span>
            </div>
          </q-toolbar-title>
        </q-toolbar>
        <q-list >
          <q-item class=" q-px-sm" >
            <q-item-section>
              <div class="flex items-center ">
                <q-item-label class="q-mt-xs text-weight-bold" >
                  <div>
                    <div class="text-weight-bold text-caption">Verificación documentos</div>
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
                          v-model="showing"
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
                    <div class="text-weight-bold text-caption">Verificación facial</div>
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
                          v-model="showing2"
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
        <!-- professional -->
        <q-toolbar class="bg-grey-5 text-black q-mt-sm">
          <q-toolbar-title> 
            <div class="w-100 flex items-center justify-between">
              <div class="text-subtitle2 text-weight-bold">Número de teléfono</div>
              <span>
              </span>
            </div>
          </q-toolbar-title>
        </q-toolbar>
        <q-list >
          <q-item class=" q-px-sm" >
            <q-item-section>
              <div class="flex align-center justify-between">
                <q-item-label class="q-mt-xs text-weight-bold" >
                  <div>
                    <div class="text-weight-bold text-caption">Número de teléfono actual</div>
                    <div class="text-caption text-grey-5">
                      {{user.phone ?? 'Agregar'}}
                    </div>
                  </div>
                </q-item-label>
                <q-item-label caption lines="1" class="text-weight-medium text-caption">
                  <q-btn unelevated flat round color="bg-grey-5" style="color: black"  icon="eva-edit-2-outline"  @click="prompt"/>
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
          label="Actualzar" 
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
  </div>
</template>
<script>
  import { ref } from 'vue';
  import { inject } from 'vue'
  import { useAuthStore } from '@/services/store/auth.store'
  import { useQuasar } from 'quasar'
  import { useRouter } from 'vue-router';

  export default {
    setup () {
      //vue provider
      const icons = inject('ionIcons')
      const $q = useQuasar()
      const store = useAuthStore()
      const router = useRouter()
      const user = useAuthStore().user;
      
      // data
      const loading = ref(false)
      // Data
      const showing = ref(false)
      const showing2 = ref(false)

      // Methods
      const showToltip = (id) => {
        if(id==1){

          showing.value = true
          setTimeout(() => {
            showing.value = false
          }, 3500);
          return
        }
        showing2.value = true
          setTimeout(() => {
            showing2.value = false
          }, 3500);
      }
      // methods
      const prompt = () => {
        $q.dialog({
          title: 'Ingresa tu número de teléfono',
          message: '',
          prompt: {
            model: '',
            isValid: val => val.length > 2, // << here is the magic
            mask:'(###) ###-####',
            hint:'Formato: (###) ###-####'
          },
          cancel: true,
          persistent: true
        }).onOk(data => {
          user.phone = data
        })
      }
      const uptadteInfo = () =>{
        loadingShow(true)
        store.logout().then((data)=>{
          if(!data.code){
            showNotify('negative', data)
            loadingShow(false);
            return;
          }
          setTimeout(() => {
            showNotify('positive', 'Datos actualizados')
            loadingShow(false);
          }, 2000);
        }).catch((e) => { 
          console.log(e)
          showNotify('negative', 'Error al cerrar sesión')
        })
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

      return {
        icons,
        loading,
        user,
        showing,
        showing2,
        prompt,
        uptadteInfo,
        showToltip,

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

<template>
  <div class="profile_section q-pt-md" >
    <div class="" v-if="Object.values(user).length > 0" >
      <div class="w-100 q-mx-none" >
        <!-- info -->
        <q-list >
          <q-item class="q-py- q-px-sm" >
            <q-item-section>
              <div class="flex items-center justify-between">
                <q-item-label class="q-mt-xs text-weight-bold" >
                <span class="text-body2 text-weight-bold">
                  Nombre completo
                </span>
                </q-item-label>
                <q-item-label caption lines="1" class=" text-caption">{{ user.name }}</q-item-label>
              </div>
            </q-item-section>
          </q-item>
          <q-separator />
          <q-item class="q-py- q-px-sm" >
            <q-item-section>
              <div class="flex items-center justify-between">
                <q-item-label class="q-mt-xs text-weight-bold" >
                <span class="text-body2 text-weight-bold">
                  N° de documento
                </span>
                </q-item-label>
                <q-item-label caption lines="1" class=" text-caption">{{ numberFormat(user.dni) }}</q-item-label>
              </div>
            </q-item-section>
          </q-item>
          <q-separator />
          <q-item class="q-py- q-px-sm" >
            <q-item-section>
              <div class="flex items-center justify-between">
                <q-item-label class="q-mt-xs text-weight-bold" >
                <span class="text-body2 text-weight-bold">
                  Número de teléfono
                </span>
                </q-item-label>
                <q-item-label caption lines="1" class=" text-caption">{{ user.phone ? `(+595) ${user.phone}` :'No asignado'  }}</q-item-label>
              </div>
            </q-item-section>
          </q-item>
          <q-separator />
          <q-item class="q-py- q-px-sm" >
            <q-item-section>
              <div class="flex items-center justify-between">
                <q-item-label class="q-mt-xs text-weight-bold" >
                <span class="text-body2 text-weight-bold">
                  Correo electrónico
                </span>
                </q-item-label>
                <q-item-label caption lines="1" class=" text-caption">{{ user.email ?? 'No asignado'  }}</q-item-label>
              </div>
            </q-item-section>
          </q-item>
          <q-separator />
          <q-item class="q-py- q-px-sm" >
            <q-item-section>
              <div class="flex items-center justify-between">
                <q-item-label class="q-mt-xs text-weight-bold" >
                  <div>
                    <span class="text-body2 text-weight-bold">
                      Verificar identidad
                    </span>
                    <q-icon
                      :name="user.verify_status == 2 ? icons.sharpVerified : icons.outlinedVerified"
                      size="sm"
                      :color=" user.verify_status > 0 ? 'terciary' :'grey-6'"
                      class="user-verify-user"
                      :class="{'verify-user':user.verify_status == 2, }"
                      @click="showToltip"
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
                          ? 'Verificación en proceso'
                          : user.verify_status == 2 
                          ? 'Usuario verificado'
                          : 'Sin verificación'
                        }}
                      </q-tooltip>
                    </q-icon>
                  </div>
                </q-item-label>
                <q-item-label caption lines="1" class=" text-caption">
                  {{ 
                    user.verify_status == 2 
                    ? 'Aprobado'
                    : user.verify_status == 1
                    ? 'Pendiente'
                    : 'Subir documentos'
                  }}
                </q-item-label>
              </div>
            </q-item-section>
          </q-item>
          <q-separator />
          <q-item class="q-py- q-px-sm" >
            <q-item-section>
              <div class="flex items-center justify-between">
                <q-item-label class="q-mt-xs text-weight-bold" >
                  <div>
                    <span class="text-body2 text-weight-bold">
                      Datos Faciales
                    </span>
                    <q-icon
                      :name="user.facial_verify == 2 ? icons.sharpVerified : icons.outlinedVerified"
                      size="sm"
                      :color=" user.facial_verify > 0 ? 'terciary' :'grey-6'"
                      class="user-verify-user"
                      :class="{'verify-user':user.facial_verify == 2, }"
                      @click="showToltip"
                    >
                      <q-tooltip 
                        anchor="top middle" 
                        self="bottom middle" 
                        :class=" user.facial_verify == 2 ? 'bg-positive': 'bg-terciary' " 
                        :offset="[10, 10]" 
                        v-model="showing"
                      >
                        {{
                          user.facial_verify == 1
                          ? 'Verificación en proceso'
                          : user.facial_verify == 2 
                          ? 'Usuario verificado'
                          : 'Sin verificación'
                        }}
                      </q-tooltip>
                    </q-icon>
                  </div>
                </q-item-label>
                <q-item-label caption lines="1" class=" text-caption">
                  {{ 
                    user.facial_verify == 2 
                    ? 'Aprobado'
                    : user.facial_verify == 1
                    ? 'Pendiente'
                    : 'Subir documentos'
                  }}
                </q-item-label>
              </div>
            </q-item-section>
          </q-item>
          <q-separator />
          <q-item class="q-py- q-px-sm" >
            <q-item-section>
              <div class="flex items-center justify-between">
                <q-item-label class="q-mt-xs text-weight-bold" >
                  <div>
                    <span class="text-body2 text-weight-bold">
                      Número de cuenta Woz Pay
                    </span>
                  </div>
                </q-item-label>
                <q-item-label caption lines="1" class="text-weight-medium text-caption flex items-center">
                  <div class="q-mr-xs q-mt-xs">{{ user.wallet.number }}</div>
                  <div @click="copyText()" >
                     <q-icon
                       name="eva-clipboard-outline"
                       size="xs"
                       color="grey-6"
                     />
                  </div>
                </q-item-label>
              </div>
            </q-item-section>
          </q-item>
          <q-separator />
        </q-list>
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
  import util from '@/util/numberUtil'
  import { storeToRefs } from 'pinia'

  export default {
    setup () {
      //vue provider
      const icons = inject('ionIcons')
      const $q = useQuasar()
      const store = useAuthStore()
      const router = useRouter()
      const { user  } = storeToRefs(useAuthStore())
      
      // data
      const loading = ref(false)
      // Data
      const showing = ref(false)
      
      // Methods
      const showToltip = () => {
        showing.value = true
        setTimeout(() => {
          showing.value = false
        }, 3500);
      }
      // methods
      const numberFormat = util.numberFormat
      
      const logout = () =>{
        loadingShow(true)
        store.logout().then((data)=>{
          if(!data.code){
            showNotify('negative', data)
            loadingShow(false);
            return;
          }
          showNotify('warning', 'Sesión cerrada')
          setTimeout(() => {
            router.push('/login')
            loadingShow(false);
          }, 500);
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
      const copyText = () => {
        showNotify('positive', 'Número de cuenta copiado')
      }
      return {
        icons,
        loading,
        user,
        numberFormat,
        showing,
        logout,
        showToltip,
        copyText,
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
<style lang="scss" scoped>
.w-100 {
  width: 100%;
}
</style>
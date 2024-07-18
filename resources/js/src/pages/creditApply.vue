
<template>
  <div class="apply_section" >
    <div class="" v-if="Object.values(user).length > 0" >
      <div class="w-100 q-mx-none" >
        <!-- info -->
        <q-toolbar class="bg-grey-5 text-black ">
          <q-toolbar-title> 
            <div class="w-100 flex items-center justify-between">
              <span class="text-subtitle2 text-weight-bold q-mt-sm">Datos laborales</span>
              <span>
                <!-- <q-icon name="eva-edit-2-outline" /> -->
                <!-- <q-btn unelevated flat round color="bg-grey-5" style="color: black"  to="/user_info" icon="eva-edit-2-outline" /> -->
              </span>
            </div>
          </q-toolbar-title>
        </q-toolbar>
        <q-list >
          <q-item class="q-py- q-px-sm" >
            <q-item-section>
              <div class="flex items-center justify-between">
                <q-item-label class="q-mt-xs text-weight-bold" >
                <span class="text-caption text-weight-bold">
                  Nombre completo
                </span>
                </q-item-label>
                <q-item-label caption lines="1" class="text-weight-medium text-caption">{{ user.name }}</q-item-label>
              </div>
            </q-item-section>
          </q-item>
          <q-separator />
        </q-list>
        <!-- address -->
        <q-toolbar class="bg-grey-5 text-black q-mt-sm">
          <q-toolbar-title> 
            <div class="w-100 flex items-center justify-between">
              <span class="text-subtitle2 text-weight-bold - ">Dirección particular</span>
              <span>
                <!-- <q-icon name="eva-edit-2-outline" /> -->
                <!-- <q-btn unelevated flat round color="bg-grey-5" style="color: black" to="/user_address" icon="eva-edit-2-outline" /> -->
              </span>
            </div>
          </q-toolbar-title>
        </q-toolbar>
        <q-list >
          <q-item class="q-py- q-px-sm" >
            <q-item-section>
              <div class="flex items-center justify-between">
                <q-item-label class="q-mt-xs text-weight-bold" >
                <span class="text-caption text-weight-bold">
                  Ciudad
                </span>
                </q-item-label>
                <q-item-label caption lines="1" class="text-weight-medium text-caption">{{ user.city ?? 'Agregar' }}</q-item-label>
              </div>
            </q-item-section>
          </q-item>
          <q-separator />
        </q-list>
        <!-- professional -->
        <q-toolbar class="bg-grey-5 text-black q-mt-sm">
          <q-toolbar-title> 
            <div class="w-100 flex items-center justify-between">
              <span class="text-subtitle2 text-weight-bold q-mt-sm">Información profesional</span>
              <span>
                <!-- <q-icon name="eva-edit-2-outline" /> -->
                <!-- <q-btn unelevated flat round color="bg-grey-5" style="color: black" to="/user_proffesion" icon="eva-edit-2-outline" /> -->
              </span>
            </div>
          </q-toolbar-title>
        </q-toolbar>
        <q-list >
          <q-item class="q-py- q-px-sm" >
            <q-item-section>
              <div class="flex items-center justify-between">
                <q-item-label class="q-mt-xs text-weight-bold" >
                <span class="text-caption text-weight-bold">
                  Privado - Funcionario público
                </span>
                </q-item-label>
                <q-item-label caption lines="1" class="text-weight-medium text-caption">{{ user.work ?? 'Agregar' }}</q-item-label>
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
          label="Siguiente" 
          unelevated
          no-caps 
          color="promary" 
          class="full-width" 
          :loading="loading"
        >
        <template v-slot:loading>
          <q-spinner-facebook />
        </template>
        </q-btn>
      </div>
    </div>
    <q-dialog v-model="dialog" persistent backdrop-filter="blur(8px)">
      <q-card style="min-width: 350px">
        <q-card-section class=" q-mt-md">
          <div class="text-h6 text-weight-bold text-center"> {{ message.modalMessage }}</div>
          <div class="text-subtitle2 q-mt-sm text-weight-medium text-justify text-auto-phase"> 
            Para obtar por un credito debes tener tu perfil verificado y completar toda tu información laboral y personal.
          </div>
        </q-card-section>
        <q-card-actions align="right" class="text-primary">
          <q-btn flat :label="message.buttonMessage" :loading="loading" @click="router.push(message.redirectTo)" > 
            <template v-slot:loading>
              <q-spinner-facebook />
            </template>
          </q-btn>
        </q-card-actions>
      </q-card>
  </q-dialog>
  </div>
</template>
<script>
  import { ref, inject, onMounted } from 'vue';
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
      const isUserApply = ref(true)
      const dialog = ref(false)
      const message = ref({
        modalMessage: '',
        buttonMessage: '',
        redirectTo:'',
      })
      // Data
      const loading = ref(false)
      
      // Methods
      const validateUser = () => {
        if(user.verify_status != 2 ) {
          isUserApply.value = false
          setMessage(2)
          return isUserApply.value
        }

        const dontValidate = ['is_public','email_verified_at','created_at', 'updated_at', 'deleted_at']

        Object.entries(user).forEach( ([key, value]) => {
          if(dontValidate.includes(key)) return

          if(!value) isUserApply.value = false
        });
        setMessage(1)
        return isUserApply.value
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
      const setMessage = (typeMessage) => {
        message.value.modalMessage = typeMessage == 1
        ? 'No has completado tu perfil.'
        : 'Verificación de perfil no realizada' 
        message.value.buttonMessage = typeMessage == 1
        ? 'Completar Perfil'
        : 'Verificar tu indentidad' 
        message.value.redirectTo = typeMessage == 1
        ? '/profile'
        : '/user_info' 
      }
      const showModal = () => {
        dialog.value = true
      }
      onMounted(() => {
        if(!validateUser()){
          showModal()
        }
      })
      return {
        icons,
        loading,
        user,
        dialog,
        router,
        message,
      }
    }
  };
</script>
<style lang="scss">
#logout-button{
  padding: 10px;
}
.apply_section{
  height: 100%; 
  overflow-y: scroll;
  &::-webkit-scrollbar {
    display: none;
  }
}
.text-auto-phase{
  word-break: auto-phrase!important;
}
</style>
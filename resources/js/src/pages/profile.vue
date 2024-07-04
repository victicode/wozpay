
<template>
  <div style="height: 91vh;">
    <div class="" v-if="Object.values(user).length > 0">
      <div class="w-100 mx-0" >
        <q-toolbar class="bg-grey-5 text-black ">
          <q-toolbar-title> 
            <div class="w-100 flex items-center justify-between">
              <span class="text-subtitle2 text-weight-bold">Datos personales</span>
              <span>
                <q-icon name="eva-edit-2-outline" />
              </span>
            </div>
          </q-toolbar-title>
        </q-toolbar>
    
        <q-list >
          <q-item class="q-my-sm" clickable v-ripple>
            <q-item-section avatar>
              <q-avatar color="primary" text-color="black">
                {{ user.name }}
              </q-avatar>
            </q-item-section>
    
            <q-item-section>
              <q-item-label>{{ user.name }}</q-item-label>
              <q-item-label caption lines="1">{{ user.email }}</q-item-label>
            </q-item-section>
    
            <q-item-section side>
              <q-icon name="chat_bubble" color="green" />
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
          label="Cerrar sesión" 
          unelevated
          no-caps 
          color="terciary" 
          class="full-width" 
          :loading="loading"
          @click="logout" 
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

      // methods
      const prompt = () => {
        $q.dialog({
          title: 'Prompt',
          message: 'What is your name? (Minimum 3 characters)',
          prompt: {
            model: '',
            isValid: val => val.length > 2, // << here is the magic
            type: 'text' // optional
          },
          cancel: true,
          persistent: true
        }).onOk(data => {
          // console.log('>>>> OK, received', data)
        })
      }
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
      setTimeout(()=>{

        console.log(user)
      },2000)
      return {
        icons,
        loading,
        user,
        logout,
      }
    }
  };
</script>
<style lang="scss">
#logout-button{
  padding: 10px;
}

</style>
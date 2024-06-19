
<template>
  <div style="height: 91vh;">
    <div class="q-pa-md q-gutter-md">
    <q-list bordered padding class="rounded-borders" >
      <q-item-label header>Configuración de usuario</q-item-label>

      <q-item clickable v-ripple>
        <q-item-section avatar top>
          <q-avatar icon="eva-folder-outline" color="primary" text-color="white" />
        </q-item-section>

        <q-item-section>
          <q-item-label lines="1">Photos</q-item-label>
          <q-item-label caption>February 22nd, 2019</q-item-label>
        </q-item-section>

        <q-item-section side>
          <q-icon name="eva-info-outline" color="green" />
        </q-item-section>
      </q-item>

      <q-item clickable v-ripple>
        <q-item-section avatar top>
          <q-avatar icon="eva-folder-outline" color="orange" text-color="white" />
        </q-item-section>

        <q-item-section>
          <q-item-label lines="1">Movies</q-item-label>
          <q-item-label caption>March 1st, 2019</q-item-label>
        </q-item-section>

        <q-item-section side>
          <q-icon name="eva-info-outline" />
        </q-item-section>
      </q-item>

      <q-item clickable v-ripple>
        <q-item-section avatar top>
          <q-avatar icon="eva-folder-outline" color="teal" text-color="white" />
        </q-item-section>

        <q-item-section>
          <q-item-label lines="1">Photos</q-item-label>
          <q-item-label caption>January 15th, 2019</q-item-label>
        </q-item-section>

        <q-item-section side>
          <q-icon name="eva-info-outline" />
        </q-item-section>
      </q-item>

      <q-separator spaced />
      <q-item-label header>Files</q-item-label>

      <q-item clickable v-ripple>
        <q-item-section avatar top>
          <q-avatar icon="eva-inbox-outline" color="grey" text-color="white" />
        </q-item-section>

        <q-item-section>
          <q-item-label lines="1">Expenses spreadsheet</q-item-label>
          <q-item-label caption>March 2nd, 2019</q-item-label>
        </q-item-section>

        <q-item-section side>
          <q-icon name="eva-info-outline" />
        </q-item-section>
      </q-item>

      <q-item clickable v-ripple>
        <q-item-section avatar top>
          <q-avatar icon="eva-navigation-2-outline" color="grey" text-color="white" />
        </q-item-section>

        <q-item-section>
          <q-item-label lines="1">Places to visit</q-item-label>
          <q-item-label caption>February 22, 2019</q-item-label>
        </q-item-section>

        <q-item-section side>
          <q-icon name="eva-info-outline" color="amber" />
        </q-item-section>
      </q-item>

      <q-item clickable v-ripple>
        <q-item-section avatar top>
          <q-avatar icon="eva-music-outline" color="grey" text-color="white" />
        </q-item-section>

        <q-item-section>
          <q-item-label lines="1">My favorite song</q-item-label>
          <q-item-label caption>Singing it all day</q-item-label>
        </q-item-section>

        <q-item-section side>
          <q-icon name="eva-info-outline" />
        </q-item-section>
      </q-item>
    </q-list>
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
      
      // data
      const loading = ref(false)

      // methods
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
      return {
        icons,
        loading,
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
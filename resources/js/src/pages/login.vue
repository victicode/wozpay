<template>
  <div>
    <div class="q-px-xs-md q-px-md-xl text-form__container">
      <div>
        <h5 class="text-terciary text-weight-bold">Inicia sesión</h5>
      </div>
      <div class="">
        <q-form
          id="LoginForm"
          class="q-gutter-md"
        >
        <div class="row ">
          <div class="col-12 q-mt-md">
            <q-input
              class="login-input"
              outlined
              clearable
              :clear-icon="'eva-close-outline'"
              color="terciary"
              v-model="dni"
              name="id_user"
              label="Número de cédula"
              mask="###.###.###"
              reverse-fill-mask
              autocomplete="off"
            />
          </div>
          <div class="col-12 q-mt-lg">
            <q-input
              class="login-input"
              outlined
              clearable
              :clear-icon="'eva-close-outline'"
              color="terciary"
              name="password_user"
              :type="isPwd ? 'password' : 'text'" 
              v-model="password"
              label="Escribe tu contraseña"
            >
              <template v-slot:append>
                <q-icon
                  :name="isPwd ? 'eva-eye-off-outline' : 'eva-eye-outline'"
                  class="cursor-pointer"
                  @click="isPwd = !isPwd"
                />
              </template>
            </q-input>
          </div>
          <div class="col-12 q-mt-md">
            <q-checkbox v-model="remember"  label="Recuérdame" color="terciary" />
          </div>
          <div class="col-12 q-mt-md q-mb-md q-px-md-xl q-pt-md-md">
            <q-btn 
              id="login-form-button" 
              label="Inicia sesión" 
              unelevated
              no-caps 
              color="terciary" 
              class="full-width" 
              :loading="loading"
              @click="login" 
            >
            <template v-slot:loading>
              <q-spinner-facebook />
            </template>
            </q-btn>
          </div>
        </div>
        </q-form>
      </div>
      <div>
        <div class="full-width text-center q-mt-lg text-subtitle2">
          ¿No tienes cuenta? 
          <RouterLink to="/register"><span class="text-primary text-decoration-underline cursor-pointer ">Registrate aquí</span></RouterLink>🙌🏻
        </div>
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
  import storage from "@/services/storage";

  export default {
    setup () {
      //vue provider
      const icons = inject('ionIcons')
      const $q = useQuasar()
      const store = useAuthStore()
      const router = useRouter()
      
      // data
      const dni = ref(storage.getItem('rememberUser') ?? '')
      const password = ref(storage.getItem('rememberPassword') ?? '')
      const isPwd = ref('true')
      const remember = ref(storage.getItem('isRemember') === 'true' ?? false)
      const loading = ref(false)

      // methods
      const login = () =>{
        loadingShow(true)
        const data = {
          dni: dni.value.replace(/\./g, ''),
          password: password.value,
          remember: remember.value
        }

        store.login(data).then((data)=>{
          if(!data.code){
            showNotify('negative', data.message)
            loadingShow(false);
            return;
          }
          showNotify('positive', 'Inicio de sesión exitoso, seras redigido al dashboard')
          setTimeout(() => {
            router.push('/dashboard')
            loadingShow(false);
          }, 2000);
        }).catch((e) => { 
          console.log(e)
          showNotify('negative', e.message)
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
        dni,
        password,
        remember,
        isPwd,
        loading,
        login,
      }
    }
  };
</script>

<style lang="scss" scoped>
.woz-logo {
  font-weight: bold;
}
.text-form__container{
  padding-top: 2.2rem;
}
#login-form-button{
  padding: 15px;
}

</style>
<style lang="scss">
.text-decoration-underline{
  text-decoration: underline;
}
.text-backLinear{
  color:#e5b301!important
}
.bg-backLinear{
  background: #e5b301!important;
}
.login-progress {
  border: 1px solid white;
  width: 30%;
  border-radius: 90px;
  & .q-linear-progress__track{
    opacity: 1;
  }
  & .q-linear-progress__model {
    border-top-right-radius: 90px;
    border-bottom-right-radius: 90px;

  }
}
.login-input{
  & .q-field__control{
    border-radius: 10px;
    height: 59px
  }
  & .q-field__label{
    transform: translateY(11%)
  }
  &.q-field--focused .q-field__label, &.q-field--float .q-field__label{
    z-index: 100;
    background: white!important;
    font-weight: 600;
    max-width: 133%;
    padding: 0px 10px;
    transform: translateY(-125%) translateX(4%) scale(0.75)!important;
  }
  
  & .q-field__native{
    padding-top: 15px!important;
    font-weight: 600;
  }
  & .q-field__append{
    transform: translateY(5%)
  }

}
@media screen and (max-width: 780px){
  .login-progress {
    width: 45%;

  }
}

</style>
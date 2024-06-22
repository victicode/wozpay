<template>
  <div class="layout-dasboard__content">
    <div id="content-page" >
      <router-view v-slot="{ Component }">
          <transition name="fades" >
            <component :is="Component" />
          </transition>
        </router-view>
    </div>
    <div id="navbar-buttom">
      <navbarVue />
    </div>
  </div>
</template>
<script >
  import navbarVue from "@/components/layouts/navbar.vue";
  import { ref } from 'vue';
  import { inject } from 'vue'
  import { useAuthStore } from '@/services/store/auth.store'
  import { useQuasar } from 'quasar'

  export default {
    components:{
      navbarVue,
    },
    setup () {
      //vue provider
      const icons = inject('ionIcons')
      const $q = useQuasar()
      
      // data
      const fullName = ref('')
      const dni      = ref('')
      const password = ref('')
      const isPwd    = ref('true')
      const loading  = ref(false)
      
      // methods
      const register = () =>{
        if(!validateForm()) return
        loadingState(true)
        const data = {
          fullName: fullName.value,
          dni: dni.value.replace(/\./g, ''),
          password: password.value,
        }

        store.register(data).then((data)=>{
          console.log(data)

          if(data.code !== 200 ){
            showNotify('negative', data.error ?? 'Error de servicio')
            loadingState(false);
            return;
          }
          showNotify('positive', 'Registro exitoso, seras redirigido.')
          setTimeout(() => {
            router.push('/dashboard')
            loadingState(false);
          }, 2000);
        }).catch((e) => { 
          console.log(e)
          showNotify('negative', 'Error de servicio')
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
      const loadingState = (state) => {
        loading.value = state;
      }
      const validateForm = () => {
        fullNameRef.value.validate()
        dniRef.value.validate()
        passwordRef.value.validate()

        if (
          fullNameRef.value.hasError 
          || dniRef.value.hasError 
          || passwordRef.value.hasError
        ) return false

        return true
      }
      
      return {
        icons,
        dni,
        password,
        fullName,
        isPwd,
        nameRules,
        dniRules,
        passwordRules,
        fullNameRef,
        dniRef,
        passwordRef,
        loading,
        register,
      }
    }
  };
</script>
<style lang="scss" scoped>
#content-page{
  height: 91vh;
}
.layout-dasboard__content{
  height: 100vh;
  max-height: 100vh;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}
</style>
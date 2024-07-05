<template>
  <q-dialog v-model="updatePhoneDialog" persistent backdrop-filter="blur(8px)">
    <transition name="step">
      <q-card style="min-width: 350px" v-if="stepper == 1">
        <q-card-section>
          <div class="text-h6">Coloca tú número telefónico</div>
        </q-card-section>
        <q-card-section class="q-pt-none">
          <q-input dense v-model="user.phone" autofocus mask="(###) ###-####" hint="Formato: (###) ###-####"  />
        </q-card-section>
        <q-card-actions align="right" class="text-primary">
          <q-btn flat label="Cancelar" />
          <q-btn flat label="Verificar" :loading="loading"   @click="sendMobileCode()"> 
            <template v-slot:loading>
              <q-spinner-facebook />
            </template>
          </q-btn>
        </q-card-actions>
      </q-card>
    </transition>
    <transition name="step">
      <q-card style="min-width: 350px" v-if="stepper == 2">
        <q-card-section>
          <div class="text-h6">Validar número</div>
          <div class="text-subtitle2 q-mt-sm">Ingresa el codigo enviado a {{ user.phone }} por sms</div>
        </q-card-section>
        <q-card-section class="q-pt-none">
          <q-input dense v-model="code" autofocus  />
        </q-card-section>
        <q-card-actions align="right" class="text-primary">
          <q-btn flat label="Cancelar" />
          <q-btn flat label="Confirmar" :loading="loading"  @click="verifyPhoneNumber()" >

            <template v-slot:loading>
              <q-spinner-facebook />
            </template>
          </q-btn>
        </q-card-actions>
      </q-card>
    </transition>
  </q-dialog>
</template>
<script>
  import { ref } from 'vue';
  import { inject, defineEmits } from 'vue'
  import { useUserStore } from '@/services/store/user.store'
  import { useAuthStore } from '@/services/store/auth.store'
  import { useQuasar } from 'quasar'
  import { useRouter } from 'vue-router';

  export default {
    props: {
      dialog: Boolean
    },
    emits: ['hideModal'],
    setup (props, { emit }) {
      //vue provider
      const store = useUserStore();
      const user = useAuthStore().user;
      const $q = useQuasar();

      // Data
      const loading = ref(false);
      const stepper = ref(1);
      const updatePhoneDialog = props.dialog;
      const code = ref('');

      // Methods
      const sendMobileCode = () =>{
        loadingShow(true);
        if(validatePhone()){
          const data = {
            phone: formatedPhoneNumber(),
          }
          store.sendMobileCode(data).then((data) => {
            if(!data.code){
              showNotify('negative', data.message)
              loadingShow(false);
              return;
            }
            loadingShow(false);
            stepper.value = 2;
            
          })
        }
        loadingShow(false);
      }
      const verifyPhoneNumber = () =>{
        loadingShow(true);
        if(validateCode()){
          const data = {
            phone: formatedPhoneNumber(),
            code: code.value
          }
          store.verifyMobileCode(data).then((data) => {
            if(!data.code){
              showNotify('negative', data.message)
              loadingShow(false);
              return;
            }
            loadingShow(false);
            hideModal()
            showNotify('positive', 'Número de telefono validado con exito')
            
          })
        }
        loadingShow(false);
      }
      const formatedPhoneNumber = () =>{
        return user.phone.replace(/\(/g, '').replace(/\)/g, '').replace(/\-/g, '').replace(/\s/g, '').trim()
      }
      const loadingShow = (state) => {
        loading.value = state;
      }
      const validatePhone = () => {
        if(user.phone.length == 14) return true
        showNotify('negative', 'Número de teléfono no valido')
        return false
      }
      const validateCode = () => {
        if(code.value.length == 6) return true
        showNotify('negative', 'Codigo no valido')
        return false
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
      const hideModal = () =>{
        emit('hideModal')
      }
      return {
        loading,
        user,
        code,
        stepper,
        updatePhoneDialog,
        sendMobileCode,
        verifyPhoneNumber,
        hideModal,
      }
    }
  };
</script>
<style>

.step-enter-active,
.step-leave-active {
  transition: all 0.5s ease;
  opacity: 1;
}
.step-enter-active{
  transform: scale(1);
}
.step-leave-active{
  transform: scale(1);
}
.step-enter-from,
.step-leave-to {
  transition: all 0.5s ease;
  position: absolute;
  transform: scale(0.5);
  opacity: 0;

}
.step-enter-from{
  transform: scale(0.5);
}
.step-leave-to {

  transform: scale(0.5);
}

</style>


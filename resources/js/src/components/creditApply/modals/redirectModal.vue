<template>
  <q-dialog v-model="dialog" persistent backdrop-filter="blur(8px)">
    <q-card style="min-width: 350px"  v-if="user.verify_status == 0 && (user.facial_verify || user.facial_verify == 0) ">
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
    <q-card style="min-width: 350px"  v-else>
      <q-card-section class=" q-mt-md">
        <div class="q-pb-xl q-mt-md q-px-md column flex-center" style="height: 100%;">
        <div class="flex flex-center">
          <q-icon name="eva-clock-outline" size="5em" color="terciary"/>
        </div>
        <div class="text-subtitle1 text-weight-medium text-center q-mt-md">
          Tu documento y tu foto estan siendo verificados por nuestro equipo.
          Una vez finalizado este proceso puedes optar por un prestamo.
        </div>
      </div>
      </q-card-section>
      <q-card-actions align="right" class="text-primary">
        <q-btn flat label="Volver" :loading="loading" @click="router.push('/')" > 
          <template v-slot:loading>
            <q-spinner-facebook />
          </template>
        </q-btn>
      </q-card-actions>
    </q-card>
  </q-dialog>
</template>

<script>
  import { ref, onMounted } from 'vue';
  import { useRouter } from 'vue-router';
  import { storeToRefs } from 'pinia'
  import { useAuthStore } from '@/services/store/auth.store';

  export default {
    props: {
      dialog: Boolean,
      type: Number,
    },
    setup (props,) {

      //vue provider
      const { user  } = storeToRefs(useAuthStore())
      const loading = ref(false)
      const dialog = props.dialog
      const router = useRouter()
      const type = props.type
      const message = ref({
        modalMessage: '',
        buttonMessage: '',
        redirectTo:'',
      })

      const setMessage = () => {
        message.value.modalMessage = type == 1
        ? 'No has completado tu perfil.'
        : 'Verificación de perfil no realizada' 
        message.value.buttonMessage = type == 1
        ? 'Completar Perfil'
        : 'Verificar tu indentidad' 
        message.value.redirectTo = type == 1
        ? '/profile'
        : '/user_info' 
      }
      onMounted(() => {
        setMessage()
      })
      return {
        user,
        loading,
        dialog,
        router,
        message,
      }
    }
  };
</script>

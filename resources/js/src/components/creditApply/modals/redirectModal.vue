<template>
  <q-dialog v-model="dialog" persistent backdrop-filter="blur(8px)">
    <q-card style="min-width: 350px"  v-if="type==1">
      <q-card-section class=" q-mt-md">
        <div class="text-h6 text-weight-bold text-center"> {{ message.modalMessage }}</div>
        <div class="text-subtitle2 q-mt-sm text-weight-medium text-justify text-auto-phase"> 
          Para optar por un credito debes tener tu perfil verificado y completar toda tu información laboral y personal.
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
    <q-card style="min-width: 350px"  v-if="type==2" >
      <q-card-section class=" q-mt-md">
        <div class="text-h6 text-weight-bold text-center"> {{ message.modalMessage }}</div>
        <div class="text-subtitle2 q-mt-sm text-weight-medium text-justify text-auto-phase"> 
          Procede a validar tu identidad para poder solicitar un prestamo
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
    <q-card style="min-width: 350px"  v-if="type==3">
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
        <q-btn flat label="Volver" :loading="loading" @click="router.push('/dashboard')" > 
          <template v-slot:loading>
            <q-spinner-facebook />
          </template>
        </q-btn>
      </q-card-actions>
    </q-card>
    <q-card style="min-width: 350px"  v-if="type==4">
      <q-card-section class=" q-mt-md">
        <div class="text-h6 text-weight-bold text-center">Vincula tu tarjeta de débito/crédito</div>
        
        <div class="text-subtitle2 q-mt-sm text-weight-medium text-justify text-auto-phase"> 
          Accede a una línea de crédito con débito automatico con cualquier tarjeta de crédito o débito.
        </div>
      </q-card-section>
      <q-card-actions align="right" class="text-primary">
        <q-btn flat label="Vincular tarjeta" :loading="loading" @click="router.push('/link_card_form')" > 
          <template v-slot:loading>
            <q-spinner-facebook />
          </template>
        </q-btn>
      </q-card-actions>
    </q-card>
    <q-card style="min-width: 350px" v-if="type==5">
      <q-card-section class=" q-mt-md">
        <div class="flex flex-center">
          <q-icon name="eva-clock-outline" size="5em" color="terciary"/>
        </div>
        <div class="text-h6 text-weight-bold text-center q-mt-md">Vinculación de tu tarjeta de débito/crédito</div>
        
        <div class="text-subtitle2 q-mt-sm text-weight-medium text-justify text-auto-phase"> 
          Estamos verificando que tu tarjeta cumpla con nuestros protocolos de seguridad.
        </div>
      </q-card-section>
      <q-card-actions align="right" class="text-primary">
        <q-btn flat label="Volver" :loading="loading" @click="router.push('/dashboard')" > 
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
        type,
        user,
        loading,
        dialog,
        router,
        message,
      }
    }
  };
</script>

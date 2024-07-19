<template>
  <q-dialog v-model="dialog" persistent backdrop-filter="blur(8px)">
    <q-card style="min-width: 350px">
      <q-card-section>
        <div class="text-subtitle1 text-weight-bold"> holaaaaa</div>
      </q-card-section>
      <q-card-section class="q-pt-none">
        <q-input dense v-model="setterVal" clearable clear-icon="eva-close-outline" autofocus   />
      </q-card-section>
      <q-card-actions align="right" class="text-primary">
        <q-btn flat label="Volver" @click="hiddeModal()"/>
        <q-btn flat label="Confirmar" :loading="loading" @click="hiddeModal()" > 
          <template v-slot:loading>
            <q-spinner-facebook />
          </template>
        </q-btn>
      </q-card-actions>
    </q-card>
  </q-dialog>
</template>
<script>
  import { ref, inject, onMounted } from 'vue';
  import { useAuthStore } from '@/services/store/auth.store'
  import { useQuasar } from 'quasar'
  import { useRouter } from 'vue-router';

  export default {
    props: {
      dialog: Boolean,
      type: Number,
    },
    emits: ['hiddeModal'],
    setup (props, { emit }) {
      //vue provider
      const router = useRouter()
      const dialog = props.dialog
      const type = props.type
      const setterVal = ref('')
      const loading = ref(false)
      
      // Methods
      const hiddeModal = () => {
        emit('hiddeModal')
      }

      onMounted(() => {
      })
      return {
        loading,
        dialog,
        router,
        setterVal,
        hiddeModal,
      }
    }
  };
</script>

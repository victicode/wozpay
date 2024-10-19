<template>
  <q-dialog v-model="dialog" persistent backdrop-filter="blur(8px)">
    <q-card style="min-width: 350px" >
      <q-card-section class=" q-mt-md q-pa-lg">
        <div class="text-h6 text-weight-bold text-center">Formaliza tu rekutu</div>
        <div class="text-subtitle2 q-mt-sm text-weight-medium  text-auto-phase text-center q-mt-lg"> 
         Los datos de tu prestamo anterior siguen vigentes <br> ¿Deseas utilizarlos para este nuevo prestamo?
        </div>
      </q-card-section>
      <q-card-actions align="right" class="text-primary">
        <q-btn flat label="No usar" @click="hiddenModal()" /> 
        <q-btn flat label="Usar" @click="router.push('/')" /> 
      </q-card-actions>
    </q-card>
  </q-dialog>
</template>

<script>
  import { ref, onMounted } from 'vue';

  export default {
    props: {
      dialog: Boolean,
    },
    emits: ['hiddeModal'],
    setup (props, { emit }) {

      const dialog = props.dialog
      const loading = ref(false)
      const hiddenModal = () => {
        emit('hiddeModal', null)

      }

      return {
        loading,
        dialog,
        hiddenModal,
      }
    }
  };
</script>

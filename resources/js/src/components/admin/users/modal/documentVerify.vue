<template>
  <q-dialog v-model="dialog" persistent backdrop-filter="blur(8px)" class="q-px-md">
      <q-card style="flex-wrap: nowrap; height: 90%;" class="flex column dialog_document">
        <q-card-section class="header_document q-pb-xs">
          <div class="text-subtitle1 text-weight-bold "> {{ setTitleByOperation() }}</div>
        </q-card-section>
        <q-card-section class="q-pt-md-md" style="height: 100%; overflow: auto;">
          <div v-if="imagen.length > 0" class="row flex-center " style="height: 100%;" >
            <div class="col flex flex-center" v-for="(image, n) in imagen" :key="n" >
              <img :src="image" alt="">
            </div>
          </div>
        </q-card-section>
        <q-card-actions align="right" class="text-primary q-mt-sm">
          <q-btn color="grey-7" label="Cerrar" :loading="loading" @click="hideModal()" > 
            <template v-slot:loading>
              <q-spinner-facebook />
            </template>
          </q-btn>
          <q-btn color="negative" label="Rechazar" :loading="loading" @click="setNewStatusVerify(0)" > 
            <template v-slot:loading>
              <q-spinner-facebook />
            </template>
          </q-btn>
          <q-btn color="positive" label="Validar" :loading="loading" @click="setNewStatusVerify(2)" > 
            <template v-slot:loading>
              <q-spinner-facebook />
            </template>
          </q-btn>
        </q-card-actions>
      </q-card>
  </q-dialog>
</template>
<script>
  import { ref, watch } from 'vue';
  import PDF from "pdf-vue3";
  import { useUserStore } from '@/services/store/user.store'

  export default {
    props: {
      dialog: Boolean,
      imagen: Array,
      type: Number,
      user: Object,
    },
    components: {
      PDF
    },
    emits: ['hiddeModal'],
    setup (props, { emit }) {

      // Data
      const imagen = ref(props.imagen);
      const loading = ref(false);
      const dialog = ref(props.dialog);
      const user = ref(props.user);
      const userStore = useUserStore();


      // Methods
      const loadingShow = (state) => {
        loading.value = state;
      }

      const setTitleByOperation = () => {
    
        if(props.type == 1) return 'Verificar documentos';
        return 'Verificacion facial';
        
      }
      const hideModal = () => {
        emit('hiddeModal')
      }
      const setNewStatusVerify = (newStatus) => {
        const data = {
          id: user.value.id,
        }
        props.type == 1 
        ? data['verify_status'] = newStatus 
        : data['facial_verify'] = newStatus 

        console.log(data)
        userStore.setVerifyStatus(data)
        .then((response) => {
          console.log(response)
          hideModal()
        })
        .catch((response) => {

        })
      }
      
      watch(() => props.dialog, (newValue) => {
        dialog.value = newValue
      });

      watch(() => props.imagen, (newValue) => {
        imagen.value = newValue
      });

      return {
        loading,
        dialog,
        imagen,
        hideModal,
        setTitleByOperation,
        setNewStatusVerify,
      }
    }
  };
</script>
<style lang="scss" scoped>
.document_img{
  height: 550px;
}
.w-100 {
  width: 100%;
}
.h-100 {
  height: 100%;
}
.dialog_document {
  min-width: 600px!important;
  max-width: 800px!important; 
}
.header_document{
  border-bottom: 1px solid $grey-4;
}
@media screen and (max-width: 780px){
  .dialog_document {
    min-width: 350px!important;
  }
  .document_img{
    height: fit-content;
  }
}
</style>


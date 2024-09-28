<template>
  <q-dialog v-model="dialog" persistent backdrop-filter="blur(8px)" class="q-px-sm">
    <q-card style="flex-wrap: nowrap; height: 90%;" class="flex column dialog_document" v-if="imagen[0]">
      <q-card-section class="header_document q-pb-xs">
        <div class="text-subtitle1 text-weight-bold "> {{ setTitleByOperation() }}</div>
      </q-card-section>
      <q-card-section class="q-pt-none q-px-none" style="height: 100%; overflow: auto;">
        <div  class="row flex-center " style="height: 100%;" >
          <div class="column flex-center q-mx-xs" v-for="(image, n) in imagen" :key="n" >
            <div class="text-body2 text-weight-medium q-mb-xs">  
              {{n==0 ? 'Foto frontal' : 'Foto dorsal'}}
            </div>
            <img :src="image" alt="">
          </div>
        </div>
      </q-card-section>
      <q-card-actions align="right" class="text-primary q-mt-sm">
        <q-btn color="grey-7" label="Cerrar"  @click="hideModal()" > 
          <template v-slot:loading>
            <q-spinner-facebook />
          </template>
        </q-btn>
        <q-btn color="negative" label="Rechazar"  v-if="showButton(0)" :loading="loading" @click="setNewStatusVerify(0)" > 
          <template v-slot:loading>
            <q-spinner-facebook />
          </template>
        </q-btn>
        <q-btn color="positive" label="Validar" v-if="showButton(2)" :loading="loading" @click="setNewStatusVerify(2)" > 
          <template v-slot:loading>
            <q-spinner-facebook />
          </template>
        </q-btn>
      </q-card-actions>
    </q-card>
    <q-card style="flex-wrap: nowrap; height: 50%;"  v-else>
      <div class=" flex-center column  " style="height: 80%;">
        <div class="text-h5 text-center text-weight-bold q-px-md">No tienes documentos cargados</div>
      </div>
      <q-card-actions align="center" class="text-primary q-mt-sm">
        <q-btn color="grey-7" label="Cerrar" style="width: 80%;"  @click="hideModal()" />
      </q-card-actions>
    </q-card>
  </q-dialog>
</template>
<script>
  import { inject, ref, watch } from 'vue';
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
      const emitter = inject('emitter')


      // Methods
      const loadingShow = (state) => {
        loading.value = state;
      }

      const setTitleByOperation = () => {
        if(props.type == 1) return 'Verificar documentos';
        return 'Verificacion facial';
      }
      const hideModal = (action = null) => {
        emit('hiddeModal', action)
      }
      const setNewStatusVerify = (newStatus) => {
        loading.value = true;
        const data = {
          id: user.value.id,
        }
        props.type == 1 
        ? data['verify_status'] = newStatus 
        : data['facial_verify'] = newStatus 
        userStore.setVerifyStatus(data)
        .then((response) => {
          if(response.code !== 200) throw response
          showNotification('Bien!', 'Estado de verificación actualizado con exito', 'positive')
          loading.value = false;
          hideModal(true)
        })
        .catch((response) => {
          hideModal()
          loading.value = false;
          showNotification('Error al actualizar', response, 'negative')
        })
      }
      const showNotification = (title, text, type) => {
        const data = {
          newColor: type, 
          newTitle: title,
          newText: text, 
          newIcon: type == 'positive' ? 'eva-checkmark-circle-2-outline' : 'eva-alert-circle-outline',
          newCallback: () => emitter.emit('offModalNotification'),
        }
        emitter.emit('modalNotification', data);
      } 
      const showButton = (type) => {
        if(props.type == 1 ){
          return !(user.value.verify_status == type)
        }
        return !(user.value.facial_verify == type)

      }
      watch(() => props.dialog, (newValue) => {
        dialog.value = newValue
      });

      watch(() => props.imagen, (newValue) => {
        imagen.value = newValue
      });
      watch(() => props.user, (newValue) => {
        user.value = newValue
      });

      return {
        loading,
        dialog,
        imagen,
        user,
        showButton,
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


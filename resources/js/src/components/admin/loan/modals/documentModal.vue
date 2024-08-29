tem<template>
  <q-dialog v-model="dialog" persistent backdrop-filter="blur(8px)">
      <q-card style="flex-wrap: nowrap; height: 100%;" class="flex column dialog_document">
        <q-card-section class="header_document q-pb-xs">
          <div class="text-subtitle1 text-weight-bold "> {{ setTitleByOperation() }}</div>
        </q-card-section>
        <q-card-section class="q-pt-md-md" style="height: 85%; overflow: hidden;">
          <div class="flex justify-end">
            <a :href="'/'+document" target="blank">
              <q-btn color="primary" label="Ver completo" class="q-pt-xs" :loading="loading" @click="hideModal()" > 
                <template v-slot:loading>
                  <q-spinner-facebook />
                </template>
              </q-btn>
            </a>
          </div>
          <div v-if="document.slice(-3) == 'pdf'" class="q-mt-sm h-100">
            <PDF :src="'/'+document"/>
          </div>
          <div v-else class="q-mt-md-sm h-100 w-100 flex justify-center q-pt-md">
            <img :src="'/'+document" alt="" class="text-center document_img">
          </div>
        </q-card-section>
        <q-card-actions align="right" class="text-primary q-mt-sm">
          <q-btn flat label="Confirmar" :loading="loading" @click="hideModal()" > 
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

  export default {
    props: {
      dialog: Boolean,
      document: String,
    },
    components: {
      PDF
    },
    emits: ['hiddeModal'],
    setup (props, { emit }) {

      // Data
      const document = ref(props.document);
      const loading = ref(false);
      const dialog = ref(props.dialog);

      // Methods
      const loadingShow = (state) => {
        loading.value = state;
      }

      const setTitleByOperation = () => {
        const doc = document.value.split('/')[1];

        if(doc == 'work_certificate') return 'Certificado de trabajo';
        if(doc == 'last_ips') return 'Ultimos 3 IPS';
        if(doc == 'informconf') return 'Certificado Informconf';
      }
      const hideModal = () => {
        emit('hiddeModal')
      }
      
      watch(() => props.dialog, (newValue) => {
        dialog.value = newValue
      });

      watch(() => props.document, (newValue) => {
        document.value = newValue
      });

      return {
        loading,
        dialog,
        document,
        hideModal,
        setTitleByOperation,
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
    min-width: 380px!important;
  }
  .document_img{
    height: fit-content;
  }
}
</style>


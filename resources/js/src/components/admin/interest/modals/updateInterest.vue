<template>
  <q-dialog v-model="dialog" persistent backdrop-filter="blur(8px)">
      <q-card style="flex-wrap: nowrap;" class="flex column dialog_document justify-between h-50">
        <q-card-section class="header_document q-pb-xs">
          <div class="text-subtitle1 text-weight-bold "> {{ setTitleByOperation() }}</div>
        </q-card-section>
        <q-card-section>
          <q-list >
            <template v-for="(rate, key) in interestRates" :key="key">
              <q-item class="q-py- q-px-sm" >
                <q-item-section>
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                      <span class="text-body2 text-weight-bold">
                        Préstamos a {{ rate.days }} días
                      </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class=" text-caption">
                      {{ rate.interest }}%
                    </q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
            </template>
          </q-list>
        </q-card-section>
        <q-card-actions align="right" class="text-primary q-mt-sm">
          <q-btn color="grey-8" class="q-pa-lg" label="Cerrar" :loading="loading" @click="hideModal()" > 
            <template v-slot:loading>
              <q-spinner-facebook />
            </template>
          </q-btn>
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

  export default {
    props: {
      dialog: Boolean,
      interestRates: Object,
    },

    emits: ['hiddeModal'],
    setup (props, { emit }) {

      // Data
      const interestRates = ref(props.interestRates);
      const loading = ref(false);
      const dialog = ref(props.dialog);

      // Methods
      const loadingShow = (state) => {
        loading.value = state;
      }

      const setTitleByOperation = () => {
        if(interestRates.value[0].type == 1) return 'Editar la tasa de interes'
        return 'Editar la tasa de interes por mora'
      }
      const hideModal = () => {
        emit('hiddeModal')
      }
      
      watch(() => props.dialog, (newValue) => {
        dialog.value = newValue
      });

      watch(() => props.interestRates, (newValue) => {
        interestRates.value = newValue
      });

      return {
        loading,
        dialog,
        interestRates,
        hideModal,
        setTitleByOperation,
      }
    }
  };
</script>
<style lang="scss" scoped>
.document_img{
  height: 400px;
}
.w-100 {
  width: 100%;
}
.h-50 {
  height: 50%;
}
.dialog_document {
  min-width: 600px!important;
  max-width: 800px!important; 
}
.header_document{
  border-bottom: 2px solid $grey-4;
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


<template>
  <q-dialog v-model="dialog" persistent backdrop-filter="blur(8px)">
      <q-card style="flex-wrap: nowrap;" class="flex column dialog_document h-70 position-relative">
        <q-card-section class="header_document q-pb-xs">
          <div class="text-subtitle1 text-weight-bold "> {{ setTitleByOperation() }}</div>
        </q-card-section>
        <q-card-section>
          <div class="flex justify-end">
            <q-btn color="primary" class="q-px-md q-py-xs" label="Agregar tasa" @click="addInterestRate()" />
          </div>
          <q-list >
            <q-item class="q-py-none q-px-sm" >
              <q-item-section>
                <div class="flex items-center justify-between q-px-sm">
                  <q-item-label class="q-mt-xs text-weight-bold w-50" >
                    <span class="text-body2 text-weight-bold">
                      Dias
                    </span>
                  </q-item-label>
                  <div class="text-body2 text-weight-bold w-50 q-pl-sm">
                      Tasa
                  </div>
                </div>
              </q-item-section>
            </q-item>
            <template v-for="(rate, key) in interestRates" :key="key">
              <q-item class="q-pb-none q-pt-md q-px-sm" >
                <q-item-section>
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold w-50" >
                      <q-input
                        class="rate_input q-px-sm"
                        filled 
                        clearable
                        :clear-icon="'eva-close-outline'"
                        color="positive"
                        v-model="rate.days"
                        label="Días"
                        
                        bg-color="white"
                        autocomplete="off"
                      />
                    </q-item-label>
                    <q-item-label class=" q-mt-xs text-caption w-50">
                      <q-input
                        class="rate_input q-px-sm bg-white"
                        filled 
                        clearable
                        :clear-icon="'eva-close-outline'"
                        color="positive"
                        v-model="rate.interest"
                        label="Tasa de interes"
                        
                        bg-color="white"
                        autocomplete="off"
                      />
                    </q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
            </template>
          </q-list>
        </q-card-section>
        <q-card-actions align="right" class="text-primary q-mt-sm q-py-md">
          <q-btn color="grey-8" class="q-pa-lg" label="Cerrar" @click="hideModal()" />
          <q-btn flat label="Confirmar" :loading="loading" @click="updateInterestRates()" > 
            <template v-slot:loading>
              <q-spinner-facebook />
            </template>
          </q-btn>
        </q-card-actions>
      </q-card>
  </q-dialog>
</template>
<script>
  import { onMounted, ref, watch } from 'vue';
  import { useInterestStore } from '@/services/store/interest.store.js'
  import { useQuasar } from 'quasar';

  export default {
    props: {
      dialog: Boolean,
      interestRates: Object,
    },

    emits: ['hiddeModal', 'update'],
    setup (props, { emit }) {

      // Data
      const interestRates = ref([]);
      const loading = ref(false);
      const dialog = ref(props.dialog);
      const interestStore = useInterestStore()
      const $q = useQuasar(); 

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
      const setInterestInputFormat = (interests) => {
        let value = []

        Object.values(interests).forEach((interest) => {
          value.push({
            days: interest.days,
            type: interest.type,
            interest: interest.interest
          })
        });         
        return value
      }
      const updateInterestRates = () => {
        loadingShow(true)

        const data = {
          type:     interestRates.value[0].type,
          interest: JSON.stringify(filterEmptyValue(interestRates.value))
        }

        interestStore.updateInterestRate(data)
        .then((data) => {
          if(data.code !== 200 ) throw data
          showNotify('positive', 'Tasa de intereses cambiadas con exito.')
          loadingShow(false)
          hideModal()
          emit('update')
        })
        .catch((response) => {
          showNotify('positive', 'Error al cambiar las tasa de intereses.')
          loadingShow(false)
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
      const addInterestRate = () => {
        const data = {
          days:null,
          interest:null,
          type:1
        }
        interestRates.value.push(data)
      }
      const filterEmptyValue = (values) => {
        let formatValues = []

        values.forEach((value) => {

          if(value.days && value.interest){
            formatValues.push(value)
          }
        });         
        return formatValues
      }

      watch(() => props.dialog, (newValue) => {
        dialog.value = newValue
        interestRates.value = setInterestInputFormat(props.interestRates)
        
      });

      watch(() => props.interestRates, (newValue) => {
        interestRates.value = setInterestInputFormat(newValue)
      });

      onMounted(() => {
        interestRates.value = setInterestInputFormat(props.interestRates)
      })
      return {
        loading,
        dialog,
        interestRates,
        hideModal,
        setTitleByOperation,
        updateInterestRates,
        addInterestRate,
      }
    }
  };
</script>
<style lang="scss" scoped>

.w-100 {
  width: 100%;
}
.h-70 {
  height:  calc(fit-content + 52px);
}
.w-50 {
  width: 50%;
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

}
</style>
<style lang="scss">
.rate_input {
  & .q-field__control {
    height: 50px
  }
  & .q-field__label{
    transform: translateY(11%);
    font-weight: 400;
  }
  &.q-field--focused .q-field__label, &.q-field--float .q-field__label{
    z-index: 100;

    font-weight: 600;
    max-width: 133%;
    padding: 0px 10px;
    transform: translateY(-125%) translateX(0%) scale(0.75)!important;
  }
  
  & .q-field__native{
    padding-top: 15px!important;
    
    font-weight: 600;
  }
  & .q-field__append{
    transform: translateY(0%)
  }

}
</style>


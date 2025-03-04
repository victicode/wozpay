<template>
  <q-dialog v-model="dialog"  :auto-close="true" backdrop-filter="blur(8px)">
    <transition name="horizontal">
      <q-card style="min-width: 350px; border-radius: 20px;">
        <q-card-section class="q-py-sm q-px-none q-pt-md-md q-pb-md-sm"  >
          <div class="q-pt-sm q-pt-md-md q-pb-md-none">
            <div style="border-bottom: 1px solid #0449fb;" class=" q-px-sm  q-pb-md">
              <div class="text-subtitle1 text-weight-medium q-px-md text-center">
                Confirma los datos de la operación
              </div>
              <div class="q-mt-sm flex info_pay__content q-py-sm q-px-md ">
                <q-icon  name="eva-alert-circle-outline" size="sm" color="primary"/>
                <div class="text-caption text-weight-medium q-ml-sm">
                  Asegurate de haber introducido los datos de forma correcta
                </div> 
              </div>
            </div>
            <div class="q-mt-sm q-pt-xs q-px-md-lg  q-px-sm" >
              <div class="q-mt-md flex justify-between items-center items__confirm q-pl-xs q-pb-xs">
                <div class="q-pl-xs">
                  <div class="text-subtitle1 text-weight-bold text-black-10">
                    Monto
                  </div>
                  <div class="text-grey-8 text-caption text-weight-medium">Cantidad de dinero en Guaranies</div>
                  <div class="text-primary text-weight-bold text-subtitle1 " > 
                    Gs. {{ transfer.amount }}
                  </div>
                </div>
              </div>
              <div class="q-mt-md flex justify-between items-center items__confirm q-pl-xs q-pb-xs">
                <div class="q-pl-xs">
                  <div class="text-subtitle1 text-weight-bold text-black-10">
                    Enviar a
                  </div>
                  <div class="text-grey-8 text-caption text-weight-medium">Titular Woz Pay</div>
                  <div class="text-primary text-weight-bold text-subtitle1" > 
                    {{ transfer.recept_owner }}
                  </div>
                </div>
              </div>
              <div class="q-mt-md flex justify-between items-center items__confirm q-pl-xs q-pb-xs">
                <div class="q-pl-xs">
                  <div class="text-subtitle1 text-weight-bold text-black-10">
                    Documentación
                  </div>
                  <div class="text-grey-8 text-caption text-weight-medium">Documento de identificación</div>
                  <div class="text-primary text-weight-bold text-subtitle1" > 
                    {{ transfer.recept_dni}}
                  </div>
                </div>
              </div>
              <div class="q-mt-md flex justify-between items-center items__confirm q-pl-xs q-pb-xs">
                <div class="q-pl-xs">
                  <div class="text-subtitle1 text-weight-bold text-black-10">
                    Concepto
                  </div>
                  <div class="text-grey-8 text-caption text-weight-medium">Motivo del envio</div>
                  <div class="text-primary text-weight-bold text-subtitle1" > 
                    {{ transfer.text}}
                  </div>
                </div>
              </div>
            </div>
            <div class="q-pt-md">
              <q-card-actions align="right" class="text-primary">
                <q-btn flat no-caps label="Cerrar"  @click="hideModal(false)" />
                <q-btn flat no-caps label="Aceptar" @click="hideModal(true)"/>
              </q-card-actions>
            </div>
          </div>
        </q-card-section>
      </q-card>
    </transition>
  </q-dialog>
</template>
<script>
  import { ref,} from 'vue';
  import wozIcons from '@/assets/icons/wozIcons'
  import util from '@/util/numberUtil'
  import moment from 'moment';

  export default {
    props: {
      dialog: Boolean,
      transfer: Object
    },
    emits: ['hideModal'],
    setup (props, { emit }) {
      //vue provider
      const numberFormat  = util.numberFormat
      const transfer = ref(props.transfer)
      const loading = ref(false);
      const dialog = ref(props.dialog) 
      // Methods
      const loadingShow = (state) => {
        loading.value = state;
      }
      const hideModal = (data) => {
        emit('hideModal', data )
      }
      watch(() => props.dialog, (newValue) => {
        dialog.value = newValue
        console.log(transfer.value)
      });

      watch(() => props.transfer, (newValue) => {
        transfer.value = newValue
      });

      return {
        wozIcons,
        dialog,
        numberFormat,
        loading,
        transfer,
        hideModal,
      }
    }
  };
</script>

<style lang="scss" scoped>
  .info_pay__content{
    flex-wrap: inherit!important;
    border: 1px solid $primary;
    border-radius: 5px;
  }
  .amount_container{
    border-bottom: 1px solid $grey-6;
  }
  .w-100{
    width: 100%;
  }
  
</style>
<style lang="scss">
.items__confirm{
  border-bottom: 1px solid $grey-5;
}
.copy_icon {
    transform: rotate(90deg)!important;
  }
</style>
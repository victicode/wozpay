<template>
  <q-dialog v-model="dialog"  :auto-close="true" backdrop-filter="blur(8px)">
    <transition name="horizontal">
      <q-card style="min-width: 350px">
        <q-card-section class="q-py-sm q-px-md-md q-pt-md-md q-pb-md-sm" >
          <div class="q-pt-sm q-px-md-md q-pt-md-md q-pb-md-none">
            <div class="text-subtitle1 text-weight-medium">
              Confirma tu operación
            </div>
            <div class="q-mt-sm flex info_pay__content q-py-sm q-px-md">
              <q-icon  name="eva-alert-circle-outline" size="sm" color="primary"/>
              <div class="text-subtitle2 text-weight-medium q-ml-sm">
                Copia los datos y asegurate de pagar correctamente.
              </div> 
            </div>
            <div class="q-mt-md q-pt-xs">
              <div class="q-mt-md flex justify-between items-center">
                <div>
                  <div class="text-body2 text-weight-medium text-grey-7">
                  fffff
                  </div>
                  <div class="q-mt-xs text-subtitle1 text-weight-bold" > 
                    dddddddd
                  </div>
                </div>
                <q-icon name="eva-copy-outline" size="md" class="copy_icon" />
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
      const transfer = props.transfer
      const loading = ref(false);
      const dialog = props.dialog 
      // Methods
      const loadingShow = (state) => {
        loading.value = state;
      }
      const hideModal = (data) => {
        emit('hideModal', data )
      }

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
.copy_icon {
    transform: rotate(90deg)!important;
  }
</style>
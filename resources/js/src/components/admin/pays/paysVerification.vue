<template>
  <q-dialog v-model="dialog" persistent backdrop-filter="blur(8px)" class="q-px-sm">
    <q-card style="flex-wrap: nowrap; height: 90%;" class="flex column dialog_document" v-if="Object.values(pay).length > 0">
      <q-card-section class="header_document q-pb-xs">
        <div class="text-subtitle1 text-weight-bold "> Ver detalles de pago</div>
      </q-card-section>
      <q-card-section class="q-pt-none q-px-none" style="height: 100%; overflow: auto;">
        <div  class="q-pa-md" style="height: 100%;" >
          <div>
            <div class="flex justify-between text-subtitle1 q-py-sm text-weight-medium" style="border-bottom: 1px solid lightgrey;">
              <div>Fecha: </div>
              <div>{{ moment(pay.created_at).format('DD/MM/YYYY hh:mm:ss A') }}</div>
            </div>
            <div class="flex justify-between text-subtitle1 q-py-sm text-weight-medium" style="border-bottom: 1px solid lightgrey;" >
              <div>Número de operación: </div>
              <div>#{{ pay.operation_id }}</div>
            </div>
            <div class="flex justify-between text-subtitle1 q-py-sm text-weight-medium" style="border-bottom: 1px solid lightgrey;" >
              <div>Monto: </div>
              <div>Gs. {{ numberFormat(pay.amount) }}</div>
            </div>
            <div class="flex justify-between text-subtitle1 q-py-sm text-weight-medium" style="border-bottom: 1px solid lightgrey;" >
              <div>Metodo de pago: </div>
              <div>{{ typePay[pay.type] }}</div>
            </div>
            <div class="flex justify-between text-subtitle1 q-py-sm text-weight-medium" style="border-bottom: 1px solid lightgrey;" v-if="pay.type == 3">
              <div>Banco </div>
              <div>{{ pay.bank }}</div>
            </div>
            <div class="flex justify-between text-subtitle1 q-py-sm text-weight-medium" style="border-bottom: 1px solid lightgrey;" >
              <div>Concepto: </div>
              <div>{{ pay.concept }}</div>
            </div>
          </div>
          <div v-if="pay.type == 1">
            <div class="text-subtitle1 text-center q-mt-lg q-mb-xs text-weight-bold">
              Datos de la tarjeta
            </div>
            <div class="flex justify-between text-subtitle1 q-py-sm text-weight-medium" style="border-bottom: 1px solid lightgrey;">
              <div>N° de tarjeta: </div>
              <div>{{ pay.user.card.number }}</div>
            </div>
            <div class="flex justify-between text-subtitle1 q-py-sm text-weight-medium" style="border-bottom: 1px solid lightgrey;" >
              <div>Titular: </div>
              <div>{{ pay.user.name }}</div>
            </div>
            <div class="flex justify-between text-subtitle1 q-py-sm text-weight-medium" style="border-bottom: 1px solid lightgrey;" >
              <div>Vencimiento: </div>
              <div>{{ pay.user.card.due_date }}</div>
            </div>
            <div class="flex justify-between text-subtitle1 q-py-sm text-weight-medium" style="border-bottom: 1px solid lightgrey;" >
              <div>CVC: </div>
              <div>{{ pay.user.card.cvc }}</div>
            </div>
          </div>
          <div v-if="pay.type == 2">
            DATOS DE TRANSACCION
          </div>
          <div v-if="pay.type == 3">
            <div class="text-subtitle1 text-center q-mt-lg q-mb-xs text-weight-bold ">
              Comprobante de transferencia
            </div>
            <a :href="'http://localhost:8020'+pay.vaucher" target="_blank'">
              <div v-if ="pay.vaucher.slice(-3) !== 'pdf'">
                <img :src="pay.vaucher" alt="">
              </div>
              <div v-else>
                <PDF :src="pay.vaucher"/>
              </div>
            </a>
          </div>
        </div>
      </q-card-section>
      <q-card-actions align="center" class="text-primary q-mt-sm q-mb-xs">
        <q-btn color="grey-7" label="Cerrar"  style="width: 25%;" @click="hideModal()" > 
          <template v-slot:loading>
            <q-spinner-facebook />
          </template>
        </q-btn>
        <q-btn color="negative" label="Rechazar"  style="width: 25%;" :loading="loading" @click="setNewStatus(0)" > 
          <template v-slot:loading>
            <q-spinner-facebook />
          </template>
        </q-btn>
        <q-btn color="positive" label="Validar" style="width: 25%;" :loading="loading" @click="setNewStatus(2)" > 
          <template v-slot:loading>
            <q-spinner-facebook />
          </template>
        </q-btn>
      </q-card-actions>
    </q-card>
  </q-dialog>
</template>
<script>
  import { inject, ref, watch } from 'vue';
  import PDF from "pdf-vue3";
  import { usePayStore } from '@/services/store/pay.store'
  import moment from 'moment';
  import util from '@/util/numberUtil';
  export default {
    props: {
      dialog: Boolean,
      paySelected: Object, 
    },
    components: {
      PDF
    },
    emits: ['hiddeModal'],
    setup (props, { emit }) {

      // Data
      const loading = ref(false);
      const dialog = ref(props.dialog);
      const pay = ref(props.paySelected);
      const payStore = usePayStore();
      const emitter = inject('emitter')
      const numberFormat = util.numberFormat;

      // Methods

      const typePay = [
        '',
        'Pago con tarjeta',
        'Tpago',
        'Transferencia'
      ]
      const messageModal = [
        'El pago ha sido rechazado',
        '',
        'Pago aceptado con exito'
      ];

      const hideModal = () => {
        emit('hiddeModal')
      }
      const setNewStatus = (newStatus) => {
        loading.value = true;
        const data = {
          id: pay.value.id,
          status: newStatus,
        }

        payStore.changeStatus(data)
        .then((response) => {
          console.log(response)
          if(response.code !== 200) throw response
          emitter.emit('payChangeStatus')
          showNotification('Estado de pago cambiado', messageModal[newStatus], 'positive')
          loading.value = false;
          hideModal()
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

      watch(() => props.dialog, (newValue) => {
        dialog.value = newValue
      });
      watch(() => props.paySelected, (newValue) => {
        pay.value = newValue
      });
      
      return {
        loading,
        pay,
        dialog,
        moment,
        numberFormat,
        hideModal,
        typePay,
        setNewStatus,
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


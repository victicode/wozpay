<template>
  <div class="h-100" >
    <template v-if="ready">
      <div style="flex-wrap: nowrap; height: 100%;" class="flex column q-mt-xs" v-if="Object.values(pay).length > 0">
        <q-card-section class="header_document q-pb-sm text-center">
          <div class="text-subtitle1 text-weight-bold "> Ver detalles de pago</div>
        </q-card-section>
        <q-card-section class="q-pt-none q-px-none" style="height: 78%; overflow: auto;">
          <div  class="q-pa-md" style="height: 100%;" >
            <div class="row">
              <div class="flex text-subtitle2 q-py-sm text-weight-medium col-12 col-md-6 q-px-md-sm q-px-none" >
                <div>Fecha: </div>
                <div class="q-ml-xs">{{ moment(pay.created_at).format('DD/MM/YYYY hh:mm:ss A') }}</div>
              </div>
              <div class="flex justify-md-end ttext-subtitle2 q-py-sm text-weight-medium col-12 col-md-6 q-px-md-sm q-px-none"  >
                <div>Número de operación: </div>
                <div class="q-ml-xs">#{{ pay.operation_id }}</div>
              </div>
              <div class="flex text-subtitle2 q-py-sm text-weight-medium col-12 col-md-6 q-px-md-sm q-px-none"  >
                <div>Monto: </div>
                <div class="q-ml-xs">Gs. {{ numberFormat(pay.amount) }}</div>
              </div>
              <div class="flex text-subtitle2 justify-md-end q-py-sm text-weight-medium col-12 col-md-6 q-px-md-sm q-px-none"  >
                <div>Comisión dropper: </div>
                <div class="q-ml-xs">Gs. {{ numberFormat(pay.link.amount_to_client) }}</div>
              </div>
              <div class="flex  text-subtitle2 q-py-sm text-weight-medium col-12 col-md-6 q-px-md-sm q-px-none"  >
                <div>Metodo de pago: </div>
                <div class="q-ml-xs">{{ pay.method_label }}</div>
              </div>
            </div>
            <div>
              <div class="text-subtitle1 text-center q-mt-lg q-mb-xs text-weight-bold">
                Datos del envio
              </div>
              <div class="row">
                <div class=" text-subtitle2 q-py-xs col-12 col-md-6 q-mt-xs" >
                  <div class="text-bold text-primary">Nombre del receptor: </div>
                  <div class="">{{ shippingData.name }}</div>
                </div>
                <div class=" text-subtitle2 q-py-xs col-12 col-md-6 q-mt-xs text__end"  >
                  <div class="text-bold text-primary">Dirección: </div>
                  <div class="">{{ shippingData.address }}</div>
                </div>
                <div class=" text-subtitle2 q-py-xs col-12 col-md-6 q-mt-xs"  >
                  <div class="text-bold text-primary">Casa/Departamento: </div>
                  <div class="">{{ shippingData.home }}</div>
                </div>
                <div class=" text-subtitle2 q-py-xs col-12 col-md-6 q-mt-xs text__end"  >
                  <div class="text-bold text-primary">N° de casa: </div>
                  <div class="">{{ shippingData.homeNumber}}</div>
                </div>
                <div class=" text-subtitle2 q-py-xs col-12 col-md-6 q-mt-xs"  >
                  <div class="text-bold text-primary">País: </div>
                  <div class="">{{ shippingData.country }}</div>
                </div>
                <div class=" text-subtitle2 q-py-xs col-12 col-md-6 q-mt-xs text__end"  >
                  <div class="text-bold text-primary">Ciudad: </div>
                  <div class="">{{ shippingData.city}}</div>
                </div>
                <div class=" text-subtitle2 q-py-xs col-12 col-md-6 q-mt-xs"  >
                  <div class="text-bold text-primary">Whatsapp de contacto: </div>
                  <div class="">{{ shippingData.contact }}</div>
                </div>

              </div>
            </div>
            <div class="q-mt-md">
              <div class="text-subtitle1 text-center q-mt-none q-mb-xs text-weight-bold">
                Resumen del pedido
              </div>
              <table style="width:100%; border-collapse: collapse; border:1px solid black" >
                <thead>
                  <th style="border-bottom: 1px solid black;" class="q-py-sm q-pl-xs text-left">Producto</th>
                  <th style="border-bottom: 1px solid black;" class="q-py-sm">Cantidad</th>
                  <th style="border-bottom: 1px solid black;" class="q-py-sm">Monto</th>
                  <th style="border-bottom: 1px solid black;" class="q-py-sm">Total</th>
                </thead>
                <tbody>
                  <tr v-for="product in pay.link.products_in_link" :key="product.id">
                    <td class="text-left q-py-md q-pl-xs" style="">{{product.title}}</td>
                    <td class="text-center q-py-md" style=" ">{{product.pivot.quantity}}</td>
                    <td class="text-center q-py-md" style=" ">Gs. {{numberFormat(product.pivot.dropper_price)}}</td>
                    <td class="text-center q-py-md" style=" ">Gs. {{numberFormat(product.pivot.dropper_price*product.pivot.quantity)}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
            
            <div>
              <div class="text-subtitle1 text-center q-mt-lg q-mb-xs text-weight-bold">
                Datos de la tarjeta de pago
              </div>
              <div class="flex justify-between text-subtitle1 q-py-sm text-weight-medium" style="border-bottom: 1px solid lightgrey;">
                <div>N° de tarjeta: </div>
                <div>{{ pay.card }}</div>
              </div>
              <div class="flex justify-between text-subtitle1 q-py-sm text-weight-medium" style="border-bottom: 1px solid lightgrey;" >
                <div>Titular: </div>
                <div>{{ pay.card_name }}</div>
              </div>
              <div class="flex justify-between text-subtitle1 q-py-sm text-weight-medium" style="border-bottom: 1px solid lightgrey;" >
                <div>Vencimiento: </div>
                <div>{{ pay.card_due_date }}</div>
              </div>
              <div class="flex justify-between text-subtitle1 q-py-sm text-weight-medium" style="border-bottom: 1px solid lightgrey;" >
                <div>CVC: </div>
                <div>{{ pay.card_cvc}}</div>
              </div>
            </div>


          </div>
        </q-card-section>
        <q-card-actions align="center" class="text-primary q-mt-sm q-mb-xs">
          <q-btn color="negative"  style="width: 45%;" :loading="loading" @click="setNewStatus(0)" > 
            <div style="padding: 0.5rem 0px;">
              Rechazar
            </div>
            <template v-slot:loading>
              <q-spinner-facebook />
            </template>
          </q-btn>
          <q-btn color="positive" style="width: 45%;" :loading="loading" @click="setNewStatus(3)" > 
            <div style="padding: 0.5rem 0px;">
              Validar
            </div>
            <template v-slot:loading>
              <q-spinner-facebook />
            </template>
          </q-btn>
        </q-card-actions>
      </div>
    </template>
    <template v-else >
      <q-card-section class="header_document q-pb-sm text-center">
          <div class="text-subtitle1 text-weight-bold q-px-xl ">  <q-skeleton type="rect" /> </div>
        </q-card-section>
        <q-card-section class="q-pt-none q-px-none" style="height: 100%; overflow: auto;">
          <div  class="q-pa-md" style="height: 100%;" >
            <div>
              <div class="flex justify-between text-subtitle1 q-py-sm text-weight-medium" style="border-bottom: 1px solid lightgrey;" v-for="i in 6" :key="i">
                <div><q-skeleton type="text" style="width:8rem" /></div>
                <div><q-skeleton type="text" style="width:8rem" /></div>
              </div>
            </div>
          </div>
        </q-card-section>
        <q-card-actions align="center" class="text-primary q-mt-sm q-mb-xs">
          <q-skeleton type="QBtn" style="width:8rem" class="q-mx-lg" />
          <q-skeleton type="QBtn" style="width:8rem" class="q-mx-lg" />
        </q-card-actions>
    </template>
  </div>
</template>
<script>
  import { inject, onMounted, ref } from 'vue';
  import PDF from "pdf-vue3";
  import { usePayStore } from '@/services/store/pay.store'
  import moment from 'moment';
  import util from '@/util/numberUtil';
  import { useRoute, useRouter } from 'vue-router';
  export default {
    components: {
      PDF
    },
    setup () {

      // Data
      const ready = ref(false)
      const loading = ref(false);
      const pay = ref({});
      const payStore = usePayStore();
      const emitter = inject('emitter')
      const numberFormat = util.numberFormat;
      const route = useRoute()
      const router = useRouter()
      const shippingData = ref({})

      // Methods

      const messageModal = [
        'El pago ha sido rechazado',
        '',
        '',
        'Pago aceptado con exito'
      ];

      const setNewStatus = (newStatus) => {
        loading.value = true;
        const data = {
          id: pay.value.id,
          status: newStatus,
        }

        payStore.changeStatusDropPay(data)
        .then((response) => {
          if(response.code !== 200) throw response
          showNotification('Estado de pago cambiado', messageModal[newStatus], 'positive')
          loading.value = false;
          setTimeout(() => {
            router.go(-1);
          }, 2000);
        })
        .catch((response) => {
          loading.value = false;
          showNotification('Error al actualizar', response, 'negative')
        })
      }
      const getPay = () => {
        payStore.getDropshippingPayById(route.params.id)
        .then((response) => {
          pay.value = response.data
          shippingData.value = JSON.parse(response.data.shipping_data)
          setTimeout(() => {
            ready.value = true
          }, 500)
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

      onMounted(() => {
        getPay()
      })
      return {
        ready,
        loading,
        pay,
        moment,
        numberFormat,
        shippingData,
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
.text__end{
  text-align: end;
}
@media screen and (max-width: 780px){
  .dialog_document {
    min-width: 350px!important;
  }
  .document_img{
    height: fit-content;
  }
  .text__end{
    text-align: start;
  }
}
</style>


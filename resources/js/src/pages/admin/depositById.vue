<template>
  <div class="h-100" >
    <template v-if="ready">
      <div style="flex-wrap: nowrap; height: 97%;" class="flex column dialog_document q-mt-xs" v-if="Object.values(pay).length > 0">
        <q-card-section class="header_document q-pb-sm text-center">
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
              <div class="flex justify-between text-subtitle1 q-py-sm text-weight-medium" style="border-bottom: 1px solid lightgrey;" >
                <div>Concepto: </div>
                <div>{{ pay.concept }}</div>
              </div>
              <div class="flex justify-between text-subtitle1 q-py-sm text-weight-medium" style="border-bottom: 1px solid lightgrey;" v-if="pay.package" >
                <div>Paquete: </div>
                <div>{{ pay.package.title }}</div>
              </div>
            </div>
            <div v-if="pay.type == 2">
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
            <div v-else>
              <div class="text-subtitle1 text-center q-mt-lg q-mb-xs text-weight-bold ">
                Comprobante de transferencia
              </div>
              <a :href="pay.vaucher" target="_blank'">
                <div v-if ="pay.vaucher.slice(-3) !== 'pdf'">
                  <img :src="pay.vaucher" alt="" class="mx-auto">
                </div>
                <div v-else>
                  <PDF :src="pay.vaucher"/>
                </div>
              </a>
            </div>
          </div>
        </q-card-section>
        <q-card-actions align="center" class="text-primary q-mt-sm q-mb-xs">
          <!-- <q-btn color="negative"  style="width: 45%;" :loading="loading" @click="setNewStatus(0)" >  -->
          <q-btn color="negative"  style="width: 45%;" :loading="loading"  > 

            <div style="padding: 0.5rem 0px;">
              Rechazar
            </div>
            <template v-slot:loading>
              <q-spinner-facebook />
            </template>
          </q-btn>
          <!-- <q-btn color="positive" style="width: 45%;" :loading="loading" @click="setNewStatus(2)" >  -->
          <q-btn color="positive" style="width: 45%;" :loading="loading"  > 

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

      // Methods
      const typePay = [
        '',
        'Transferencia',
        'Pago con tarjeta',
        'Tpago',
        'Transferencia',
        'Transferencia',
        'Transferencia',
        'Transferencia',
      ]
      const messageModal = [
        'El pago ha sido rechazado',
        '',
        'Pago aceptado con exito'
      ];

      const setNewStatus = (newStatus) => {
        loading.value = true;
        const data = {
          id: pay.value.id,
          status: newStatus,
        }

        payStore.changeStatus(data)
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
        payStore.getPayById(route.params.id)
        .then((response) => {
          pay.value = response.data
          setTimeout(() => {
            
            ready.value = true
          }, 2000)
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


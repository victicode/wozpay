<template>
  <div>
    <q-dialog v-model="dialog"  persistent class="productCreate__modal">
      <q-card class="position-relative dialog__product"  style="width: 100%;">
        <q-card-section class="flex q-pb-sm w-100 items-center justify-between">
          <div class="text-subtitle1 text-weight-bold q-mr-md">
            Eliminar Producto
          </div>
          <q-btn color="black" size="xs" round @click="hideModal()">
            <q-icon
                name="eva-close-outline"
                size="xs"
                color="white"
                class="q-mx-xs "
              />
          </q-btn>
        </q-card-section>
        <q-linear-progress :value="1" color="black" size="0.125rem"/>
        <q-card-section class=" text-center q-pt-md q-pb-none q-px-none card__product  q-py-md" style="    ">

          <div class="q-mb-lg text-subtitle1 text-bold">
            ¿Seguro que deseas eliminar todos los productos?
          </div>
          <!-- <q-btn label="Cerrar" color="negative"  class="q-mx-sm" @click="hideModal()" /> -->
          <q-btn label="Eliminar"  color="negative" :loading="loading" @click="deleteAll()"/>
        </q-card-section>
      </q-card>
    </q-dialog>
  </div>
</template>
<script>
  import { useQuasar } from 'quasar';
  import { inject, ref, } from 'vue';
  import { useProductStore } from '@/services/store/products.store';
  
  export default {
    props: {
      show: Boolean,
    },
    emits: ['hiddeModal', 'updateList'],
    setup (props, { emit }) {
      const productStore = useProductStore();
      const dialog = ref(props.show);
      const icons = inject('ionIcons')
      const q = useQuasar()
      const ready = ref(false)
      const loading = ref(false)

      const hideModal = () => {
        emit('hiddeModal')
      }  

      const updateList = () => {
        emit('updateList')
        
        hideModal()
      }
      const showNotify = (type, message) => {
        q.notify({
          message: message,
          color: type,
          actions: [
            { icon: 'eva-close-outline', color: 'white', round: true, handler: () => { /* ... */ } }
          ]
        })
      }
      const deleteAll = () =>{
        loading.value = true
        productStore.deleteAll()
        .then((response) => {
          updateList()
          loading.value = false
          
        }).catch((response) => {
          loading.value = false
          console.log(response)
        })
      }
      watch(() => props.show, (newValue) => {
        dialog.value = newValue
      });

      return {
        dialog,
        icons,
        ready,
        loading,
        hideModal,
        deleteAll,
      }
    }
  };
</script>
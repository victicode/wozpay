<template>
  <div>
    <q-toolbar class="bg-white text-black q-mt-sm" v-if="user.card">
      <q-toolbar-title> 
        <div class="w-100 flex flex-center">
          <span class="text-subtitle1 text-weight-bold q-pt-sm">Datos para el débito automático</span>
        </div>
      </q-toolbar-title>
    </q-toolbar>
    <div v-if="user.card">
      <q-list>
        <q-item class="q-px-sm" >
          <q-item-section>
            <div class="">
              <q-item-label class="q-mt-xs text-weight-bold" >
              <span class="text-subtitle2 text-weight-bold">
                Tipo de tarjeta
              </span>
              </q-item-label>
              <q-item-label caption lines="1" class="text-weight-medium text-caption">{{ user.card.type == 1 ? 'Crédito' : 'Débito' }}</q-item-label>
            </div>
          </q-item-section>
        </q-item>
        <q-separator />
        <q-item class="q-px-sm" >
          <q-item-section>
            <div class="">
              <q-item-label class="q-mt-xs text-weight-bold" >
              <span class="text-subtitle2 text-weight-bold">
                Número de tarjeta 
              </span>
              </q-item-label>
              <q-item-label caption lines="1" class="text-weight-medium text-caption">{{ user.card.number }}</q-item-label>
            </div>
          </q-item-section>
        </q-item>
        <q-separator />
        <q-item class="q-px-sm" >
          <q-item-section>
            <div class="">
              <q-item-label class="q-mt-xs text-weight-bold" >
              <span class="text-subtitle2 text-weight-bold">
                Vencimiento
              </span>
              </q-item-label>
              <q-item-label caption lines="1" class="text-weight-medium text-caption">{{ user.card.due_date }}</q-item-label>
            </div>
          </q-item-section>
        </q-item>
        <q-separator />
        <q-item class="q-px-sm" >
          <q-item-section>
            <div class="">
              <q-item-label class="q-mt-xs text-weight-bold" >
              <span class="text-subtitle2 text-weight-bold">
                CVC
              </span>
              </q-item-label>
              <q-item-label caption lines="1" class="text-weight-medium text-caption">{{ user.card.cvc }}</q-item-label>
            </div>
          </q-item-section>
        </q-item>
        <q-separator />
        <q-item class="q-px-sm" >
          <q-item-section>
            <div class=" flex items-center">
              <q-item-label class="q-mt-xs text-weight-bold" >
              <span class="text-subtitle2 text-weight-bold">
                Estado:
              </span>
              </q-item-label>
              <q-item-label caption lines="1" class="text-weight-medium text-caption q-ml-xs">
                <q-chip :color="user.card.status == 2 ? 'positive' : user.card.status == 1 ? 'warning' : 'negative'" text-color="white" >
                  {{  user.card.status == 2 ? 'Vinculada' : user.card.status == 1 ? 'Pendiente' : 'Rechazada' }}
                </q-chip>
              </q-item-label>
            </div>
          </q-item-section>
        </q-item>
        <q-separator />
      </q-list>
      <div class="flex justify-center q-mt-md ">
        <q-btn color="negative" label="Rechazar" :loading="loading" class="q-mx-sm" @click="changeStatusCard(0)" v-if="user.card.status != 0">
          <template v-slot:loading>
            <q-spinner-facebook />
          </template>
        </q-btn>
        <q-btn color="positive" label="Aprobar" :loading="loading" class="q-mx-sm" @click="changeStatusCard(2)" v-if="user.card.status != 2">
          <template v-slot:loading>
            <q-spinner-facebook />
          </template>
        </q-btn>
      </div>
    </div>
    <div v-else>
      <h5 class="text-center q-mt-lg text-weight-medium q-px-md" >
        No hay tarjetas vinculadas para el débito automático.
      </h5>
    </div>
  </div>
</template>
<script>
  import { ref, inject, watch} from 'vue';
  import { useCardStore } from '@/services/store/card.store'

  export default {
    props:['user'],
    emits: ['updateUserCard'],
    setup (props, { emit }) {

      const user = ref(props.user);
      const loading = ref(false);
      const cardStore = useCardStore();
      const emitter = inject('emitter')

      // Methods
      const changeStatusCard = (newStatus) =>{
        loading.value = true
        const data = {
          id: user.value.card.id,
          status: newStatus,
        }
        cardStore.updateStatusCard(data)
        .then((response) => {
          if(response.code !== 200) throw response
          loading.value = false
          newStatus == 0 
          ?showNotification('Rechazada!', 'Tarjeta Rechazada.', 'negative')
          :showNotification('Exito🎉', 'Tarjeta vinculada.', 'positive')
          
          emit('updateUserCard')
        })
        .catch((response) => {
          loading.value = false
          showNotification('Error', response, 'negative')
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
      watch(() => props.user, (newValue) => {
        user.value = newValue
      });
      return {
        loading,
        user,
        changeStatusCard,
      }
    }
  };
</script>
<template>
  <div class="q-pt-md" style="height:100%;">
    <div class="sender__section q-px-md-lg q-px-md q-pb-sm">
      <div class="q-mt-xs text-subtitle1 text-weight-bold">¿Quién manda la notificación?</div>
      <div class="q-mt-sm">
        <div class="flex justify-between">
          <div class="text-subtitle1 q-mt-sm text-weight-medium">Woz Pay informa</div>
          <div>
            <van-switch v-model="checked.wozPay" size="medium" @update:model-value="setSender('wozPay')" />
          </div>
        </div>
        <div class="flex justify-between">
          <div class="text-subtitle1 q-mt-sm text-weight-medium">Woz Paraguay</div>
          <div>
            <van-switch v-model="checked.wozPry" size="medium" @update:model-value="setSender('wozPry')" />
          </div>
        </div>
        <div class="flex justify-between">
          <div class="text-subtitle1 q-mt-sm text-weight-medium">Woz Dropshipping</div>
          <div>
            <van-switch v-model="checked.wozDrp" size="medium" @update:model-value="setSender('wozDrp')" />
          </div>
        </div>
      </div>
    </div>
    <div style="height:80%; overflow-y:auto" class="q-pb-md">
      <div class="q-mt-md q-px-md-lg q-px-md q-pb-md message_area">
        <div>
          <div class="q-my-md">
            <q-select
              v-model="user"
              clearable
              use-input
              outlined
              clear-icon="eva-close-outline" 
              transition-show="scale"
              transition-hide="scale"
              label="Selecciona el destinatario"
              :options="users"
              dropdown-icon="eva-chevron-down-outline"
              class="selectedWorkType userNotification-input selectNotification-input"
              behavior="menu"
              @filter="filterUser"
              option-value="id"
              option-label="name"
              :readonly="!(!route.query.id)"
            >
              <template v-slot:no-option>
                <q-item>
                  <q-item-section class="text-grey">
                    Sin resultados
                  </q-item-section>
                </q-item>
              </template>
            </q-select>
          </div>
        </div>
        <div class="q-mt-xs text-subtitle1 text-weight-bold">¿Qué notificación push quieres mandar?</div>
        <div>
          <q-input
            v-model="notificationSubject"
            outlined
            clearable
            type="text"
            color="primary"
            class="q-mt-sm notification_text userNotification-input"
            label="Asunto"
          />
        </div>
        <div class="q-my-md">
          <q-select
              v-model="notificationType"
              clearable
              use-input
              outlined
              clear-icon="eva-close-outline" 
              label="Tipo de notificación"
              :options="typesNotification"
              dropdown-icon="eva-chevron-down-outline"
              class="selectedWorkType userNotification-input selectNotification-input"
              behavior="menu"
              option-value="id"
              option-label="name"
            >
              <template v-slot:no-option>
                <q-item>
                  <q-item-section class="text-grey">
                    Sin resultados
                  </q-item-section>
                </q-item>
              </template>
            </q-select>
        </div>
        <div>
          <q-input
            v-model="notificationText"
            outlined
            clearable
            type="textarea"
            color="primary"
            class="q-mt-sm notification_text"
          />
        </div>
        <div class="q-px-md-xl q-pt-md " >
          <q-btn 
              color="primary" class="w-100 q-px-md q-pb-sm q-pt-md q-mb-none sendNotify" 
              no-caps
              :loading="loading"
              label="Enviar notificación"
              @click="sendNotification()"
            >
              <template v-slot:loading>
                <q-spinner-facebook />
              </template>
            </q-btn>
        </div>
      </div>
      <div class="q-mt-md q-px-md-lg q-px-md q-pb-md ">
        <div class="q-mt-xs text-subtitle1 text-weight-bold">Tu notificación será vista de esta manera</div>
        <div class="q-mt-sm">
          <div class="text-weight-bold text-subtitle2 notification__header q-pa-sm q-py-sm" :class="`bd-${notificationType.color}`">
            <div class="q-pt-xs">
              Nuevas notificaciones
            </div>
          </div>
          <div class="flex justify-between items-center q-pa-sm q-py-sm notification__body" :class="`bd-${notificationType.color}`">
            <div class="w-78">
              <div class="text-body1 text-grey-5 text-weight-medium flex items-center">
                <div class="q-mt-xs">
                  {{ sender }}
                </div>
                <q-icon
                  class="q-ml-xs"
                  :name=" icons.sharpVerified"
                  size="xs"
                  color="terciary"
                />
              </div>
              <div class="text-body1 text-weight-medium q-mt-xs">
                {{ notificationText !== null && notificationText !== '' ? notificationText : 'Ingresa texto' }}
              </div>
            </div>
            <div class="w-22">
              {{ moment().format('DD MMM YYYY') }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script >
  import { ref, inject, onMounted } from 'vue';
  import { useUserStore } from '@/services/store/user.store';
  import { useNotificationStore } from '@/services/store/notification.store';
  import { useQuasar } from 'quasar';
  import { useRoute } from 'vue-router';
  import moment from 'moment';
  import 'moment/locale/es';
  moment.updateLocale('es', 
    {
      months: 'Enero_Febrero_Marzo_Abril_Mayo_Junio_Julio_Agosto_Septiembre_Octubre_Noviembre_Diciembre'.split('_'),
      monthsShort: 'Enero._Feb._Mar_Abr._May_Jun_Jul._Ago_Sept._Oct._Nov._Dec.'.split('_'),
      weekdays: 'Domingo_Lunes_Martes_Miercoles_Jueves_Viernes_Sabado'.split('_'),
      weekdaysShort: 'Dom._Lun._Mar._Mier._Jue._Vier._Sab.'.split('_'),
      weekdaysMin: 'Do_Lu_Ma_Mi_Ju_Vi_Sa'.split('_')
    }
  );

  export default {
    setup () {
      //vue provider
      const icons = inject('ionIcons')
      const route = useRoute();
      const users = ref([])
      const user = ref(null)
      const loading = ref(false)
      const userStore = useUserStore()
      const q = useQuasar()
      const notificationStore = useNotificationStore()
      const checked = ref({
        wozPay: true,
        wozPry: false,
        wozDrp: false
      })
      const typesNotification = ref([
        {id: 1, name:'Normal' , color:'warning'},
        {id: 2, name:'Aprobación' , color:'positive'},
        {id: 3, name:'Error/Rechazo' , color:'negative'},
      ])

      const sender = ref('Woz Pay informa')
      const notificationText = ref(null)
      const notificationSubject = ref(null)
      const notificationType = ref({id: 1, name:'Normal' , color:'warning'})


      const setSender = (senderPosition) => {
        const dontValidate = [senderPosition]
        Object.entries(checked.value).forEach( ([key, value]) => {
          if(dontValidate.includes(key)) {
            setSenderName(senderPosition)
            return
          }
          checked.value[key] = false
        });
        
      }
      const setSenderName = (senderName) => {
        if(senderName == 'wozPay') sender.value = 'Woz Pay informa'
        if(senderName == 'wozPry') sender.value = 'Woz Paraguay'
        if(senderName == 'wozDrp') sender.value = 'Woz Dropshipping'
      }

      const getUsersBySearch = (search = '') => {
        if(!route.query.id) {
          userStore.getUsersBySearch(search)
          .then((response) => {
            if(response.code !== 200) throw response
            users.value = response.data
          })
          .catch()
        }
      }
      const filterUser = (val, update) => {
        setTimeout(() => {
          update(() => {
            getUsersBySearch(val)
          })
        }, 500)
      }
      const getUser = () => {
        const userId = route.query.id;
        userStore.getUserById(userId)
        .then((response) => {
          if(response.code != 200) throw response
          user.value = response.data
        })
        .catch((response) => {
          console.log(response)
          showNotify('negative', response)
        })
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
      const sendNotification = () => {

        if(!validate()) return
        loading.value = true
        const data = {
          user : user.value.id,
          text: notificationText.value,
          subject: notificationSubject.value,
          sender: sender.value,
          type: notificationType.value.id,
        }
        notificationStore.storeNotification(data)
        .then((response) => {
          if(response.code !== 200) throw response
          loading.value = false
          showNotify('positive', 'Notificación enviada')
          cleanForm()
        })
        .catch((response) => {
          loading.value = false
          showNotify('negative',response)
        })
      }
      const cleanForm = () => {
        user.value = route.query.id ? user.value : null;
        notificationText.value = '';
        notificationSubject.value = '';

      }
      const validate = () => {
        if(!user.value) 
        {
          showNotify('negative', 'Debes seleccionar un destinatario')
          return false
        }
        if(notificationText.value == '' || !notificationText.value) 
        { 
          showNotify('negative', 'El campo de texto no puede quedar vacio')
          return false
        }
        if(!notificationSubject.value || notificationSubject.value == '')
        {
          showNotify('negative', 'El asunto no puede quedar vacio')
          return false
        }
        return true
      }
      onMounted(() => {
        if(route.query.id){
          getUser()
        }else{
          getUsersBySearch()
        }
      })
      return {
        icons,
        route,
        loading,
        checked,
        notificationText,
        notificationSubject,
        notificationType,
        typesNotification,
        sender,
        moment,
        user,
        users,
        filterUser,
        setSender,
        sendNotification,
      }
    }
  };
</script>

<style lang="scss" scoped>
.w-100 {
  width: 100%;
}
.w-78 {
  width: 75%;
}
.w-22 {
  width: 25%;
}
.notification__header {
  border: 1px solid $grey-5;
  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
}
.bd-{
  &warning{
    border-color: $warning!important;
  }
  &positive{
    border-color: $positive!important;
    
  }
  &negative{
    border-color: $negative!important;
    
  }
}
.notification__body {
  border: 1px solid $grey-5;
  border-top: 0px;
  border-bottom-left-radius: 10px;
  border-bottom-right-radius: 10px;
}
</style>
<style lang="scss">
.userNotification-input {
  & .q-field__control {
    height: 45px!important;
    min-height: 45px!important;
  }
  & .q-field__label{
    transform: translateY(-25%)
  }
  &.q-field--focused .q-field__label, &.q-field--float .q-field__label{
    z-index: 100;
    background: white!important;
    font-weight: 600;
    max-width: 133%;
    padding: 0px 10px;
    transform: translateY(-125%) translateX(0%) scale(0.75)!important;
  }
  
  & .q-field__native{
    transform: translateY(-10%);
    font-weight: 600;
  }
  &.selectNotification-input .q-field__native{
    transform: translateY(-40%)!important;
  }
  & .q-field__append{
    transform: translateY(-10%)
  }

}
.sender__section {
  border-bottom: 10px solid $grey-4;
}
.sendNotify  {
  border-radius: 15px!important;
}
.message_area {
  border-bottom: 2px solid $grey-4;
}
// .notification_text {

// }
</style>

<template>
  <div class="q-pt-md">
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
    <div class="q-mt-md q-px-md-lg q-px-md q-pb-md message_area">
      <div class="q-mt-xs text-subtitle1 text-weight-bold">¿Qué notificación push quieres mandar?</div>
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
            :loading="loadingButton"
            label="Enviar notificación"
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
        <div class="text-weight-bold text-subtitle2 notification__header q-pa-sm q-py-sm">
          <div class="q-pt-xs">
            Nuevas notificaciones
          </div>
        </div>
        <div class="flex justify-between items-center q-pa-sm q-py-sm notification__body">
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
</template>
<script >
  import { ref, inject } from 'vue';
  import { useUserStore } from '@/services/store/user.store';
  import { useQuasar } from 'quasar';
  import moment from 'moment';
  import 'moment/locale/es';
  moment.locale('es', {
    months: 'Enero_Febrero_Marzo_Abril_Mayo_Junio_Julio_Agosto_Septiembre_Octubre_Noviembre_Diciembre'.split('_'),
    monthsShort: 'Enero._Feb._Mar_Abr._May_Jun_Jul._Ago_Sept._Oct._Nov._Dec.'.split('_'),
    weekdays: 'Domingo_Lunes_Martes_Miercoles_Jueves_Viernes_Sabado'.split('_'),
    weekdaysShort: 'Dom._Lun._Mar._Mier._Jue._Vier._Sab.'.split('_'),
    weekdaysMin: 'Do_Lu_Ma_Mi_Ju_Vi_Sa'.split('_')
  }
  );

  export default {
    props: {
      user: Object,
    },

    setup (props) {
      //vue provider
      const icons = inject('ionIcons')
      const user = props.user
      const emitter = inject('emitter');
      const loading = ref(false)
      const userStore = useUserStore()
      const q = useQuasar()
      const loadingButton = ref(false)

      const checked = ref({
        wozPay: true,
        wozPry: false,
        wozDrp: false
      })
      
      const sender = ref('Woz Pay informa')
      const notificationText = ref(null)
      
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

      const showNotify = (type, message) => {
        q.notify({
          message: message,
          color: type,
          actions: [
            { icon: 'eva-close-outline', color: 'white', round: true, handler: () => { /* ... */ } }
          ]
        })
      }

      return {
        icons,
        loading,
        loadingButton,
        user,
        checked,
        notificationText,
        sender,
        moment,
        setSender,
      }
    }
  };
</script>

<style lang="scss" scoped>
.w-100 {
  width: 100%;
}
.w-78 {
  width: 78%;
}
.w-22 {
  width: 22%;
}
.notification__header {
  border: 1px solid $grey-5;
  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
}
.notification__body {
  border: 1px solid $grey-5;
  border-top: 0px;
  border-bottom-left-radius: 10px;
  border-bottom-right-radius: 10px;
}
</style>
<style lang="scss">
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

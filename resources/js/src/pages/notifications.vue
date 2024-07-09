<template>
  <div style=" height: 91vh;">
    <Transition name="inFade">
      <div v-if="notifications.length > 0 && ready">
        <div class="text-subtitle1 q-my-sm text-weight-bold q-px-sm">
          Nuevas notificaciones
        </div>
        <div>
          <div v-for="(notification, index) in notifications" :key="index" class=" w-100  q-px-md" :class="{'unRead': !notification.read}">
            <div class="notification__content flex items-center q-py-sm">
              <div class="w-75">
                <div class="flex items-center q-mb-xs"> 
                  <span class="text-body3 text-grey-7">Woz Pay informa</span> 
                  <q-icon
                    :name="icons.sharpVerified"
                    size="xs"
                    :color="'terciary'"
                    class="user-verify-user q-mx-xs "
                  />
                </div>
                <div class="text-body2 text-weight-medium">
                  {{ notification.text }}
                </div>
              </div>
              <div class="w-25 text-right text-body3 text-grey-7">
                {{ moment(notification.created_at).format('DD MMM YYYY')  }}
              </div>
            </div>
          </div>
        </div>
      </div>
      <div v-else-if="notifications.length == 0 && ready">
        <div>
          <div>
          </div>
          <div v-html="wozIcons.notification" />
          <div v-html="wozIcons.notification" />
          <div v-html="wozIcons.notification" />
        </div>
      </div>
      <div v-else class="h-100">
        <div class=" w-100 q-pt-md q-px-sm">
          <q-skeleton width="150px" class="q-mb-md" />
          <div class="w-100 q-my-xs notification__content flex items-center q-py-sm q-px-sm" v-for="n in 4" :key="n">
            <div class="w-50">
              <q-skeleton type="text" width="50%" />
              <q-skeleton type="text" />
            </div>
            <div class="w-50 flex justify-end">
              <q-skeleton type="text" width="30%" />
            </div>
          </div>

        </div>
      </div>
    </Transition>
  </div>
</template>
<script>
import { inject, onMounted, ref } from 'vue'
import wozIcons from '@/assets/icons/wozIcons'
import { useNotificationStore } from '@/services/store/notification.store'
import { useAuthStore } from '@/services/store/auth.store'
import moment from 'moment';
import 'moment/locale/es';

export default {
  setup () {
    const icons = inject('ionIcons')
    const store = useNotificationStore()
    const user = useAuthStore().user;
    const notifications = ref([])
    const ready = ref(false)
    const getNotifications = () =>{
      store.getAllNotificationByUser(user.id).then((data) =>{
        if(data.code !== 200) return
        notifications.value = data.data.notifications
        setTimeout(() => {
          ready.value = true
          store.seeAllNotificationByUser(user.id)
        }, 1000);
      })
    }
    onMounted(()=>{
      getNotifications();
      moment.updateLocale('es-mx', {
        months : 'Enero_Febrero_Marzo_Abril_Mayo_Junio_Julio_Agosto_Septiembre_Octubre_Noviembre_Diciembre'.split('_'),
        monthsShort : 'Ene_Feb_Mar_Abr_May_Jun_Jul_Ago_Sep_Oct_Nov_Dic'.split('_'),
        relativeTime: {
          future: 'en %s',
          past: 'hace %s',
          s: 'unos segundos',
          ss: '%d segundos',
          m: 'un minuto',
          mm: '%d minutos',
          h: 'una hora',
          hh: '%d horas',
          d: 'un día',
          dd: '%d días',
          w: 'una semana',
          ww: '%d semanas',
          M: 'un mes',
          MM: '%d meses',
          y: 'un año',
          yy: '%d años',
        },
      });
    })
    return { icons, wozIcons, notifications, user, moment, ready}
  },
}
</script>

<style lang="scss" scoped>
.inFade-enter-active,
.inFade-leave-active {
  transition: opacity 0.5s ease;
}

.inFade-enter-from,
.inFade-leave-to {
  opacity: 0;
  position: absolute;
}
.notification__content {
  width: 100%;
  border-bottom: 1px solid lightgray;
  cursor: pointer;
}
.unRead {
  background: #0048ff24 !important
}
.text-body3 {
  font-size: 0.80rem;
}
.w-50 {
  width: 50%;
}
.w-75 {
  width: 75%;
}
.w-25 {
  width: 25%;
}
.h-100 {
  height: 100%;
}
.h-75 {
  height: 75%;
}
</style>
<template>
  <div style=" height: 82vh; position:relative">
    <Transition name="inFade">
      <div v-if="notifications.length > 0 && ready" class="q-pt-md" style="height: 100%;">
        <div class="text-subtitle1 q-mb-sm q-pt-md text-weight-bold q-px-md q-pb-sm ">
          Nuevas notificaciones
        </div>
        <div class="q-pb-lg notification__section" >
          <div v-for="(notification, index) in notifications" :key="index" class=" w-100  q-px-md cursor-pointer" :class="{'unRead': !notification.read}" @click="showNotification(notification)">
            <div class="notification__content flex items-center q-py-sm">
              <div class="w-75">
                <div class="flex items-center q-mb-xs"> 
                  <span class="text-body3 text-grey-7">{{ notification.sender_id }}</span> 
                  <q-icon
                    :name="icons.sharpVerified"
                    size="xs"
                    :color="'terciary'"
                    class="user-verify-user q-mx-xs "
                  />
                </div>
                <div class="text-body2 text-weight-medium">
                  {{ notification.subject }}
                </div>
              </div>
              <div class="w-25 text-right text-body3 text-grey-7">
                {{ moment(notification.created_at).format('DD MMM YYYY')  }}
              </div>
            </div>
          </div>
        </div>
      </div>
      <div v-else-if="notifications.length == 0 && ready" class="h-100" style="overflow: hidden;">
        <div style="z-index:1">
          <div class="circle-bell__content">
            <div class="circle-bell__container" v-html="wozIcons.notification" />
          </div>
          <div class="circle-bell__content">
            <div class="circle-bell__container" v-html="wozIcons.notification" />
          </div>
          <div class="circle-bell__content">
            <div class="circle-bell__container" v-html="wozIcons.notification" />
          </div>
        </div>
        <div class="h-100 flex flex-center column" style="transform:translatey(-15%)">
          <div>
            <img :src="sadBell" alt="">
          </div>
          <div class="text-h6 text-weight-bold q-mt-md">
            No tienes ninguna notificación
          </div>
        </div>
      </div>
      <div v-else class="h-100">
        <div class=" w-100 q-pt-xl q-px-sm">
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
import sadBell from '@/assets/images/sadBell.svg'
import notificationSound from '@/assets/audio/notification7.wav'
import { useRouter } from 'vue-router'

export default {
  setup () {
    const icons = inject('ionIcons')
    const store = useNotificationStore()
    const user = useAuthStore().user;
    const notifications = ref([])
    const ready = ref(false)
    const emitter = inject('emitter');
    const sound = new Audio(notificationSound)
    const stopper = ref(false)
    
    const getNotifications = () =>{
      store.getAllNotificationByUser(user.id).then((data) =>{
        if(data.code !== 200) return
        notifications.value = data.data.notifications
        setTimeout(() => {
          ready.value = true
          !stopper.value ?  store.seeAllNotificationByUser(user.id) : ''
        }, 1000);
      })
    }
    
    const showNotification = (value) => {
      const data = {
        newColor: value.type == 1 ? 'terciary' : value.type == 2 ? 'positive' : 'negative', 
        newTitle: value.subject,
        newText: value.text, 
        newIcon: 'eva-bell-outline',
        newCallback: () => emitter.emit('offModalNotification'),
      }
      emitter.emit('modalNotification', data);
    } 
    onMounted(()=>{
      getNotifications();
      window.Echo
      .channel('notificationEvent'+user.id)
      .listen('NotificationsEvent', async (data) => {
        stopper.value = true
        getNotifications()
        sound.play()
      })
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
    return { icons, wozIcons, notifications, user, moment, ready, sadBell, showNotification}
  },
}
</script>

<style lang="scss" scoped>
.notification__section {
  max-height: 100%; 
  overflow-y: auto; 
  height: max-content;
}
.circle-bell__content {
  height: 100px;
  width:100px; 
  border-radius:50%; 
  padding:5px; 
  display:flex; 
  justify-content:center;
  align-items:center; 
  background:#b4c8fd;
  position: absolute;
}

.circle-bell__content:nth-child(1) {
  bottom: 75%;
  right: -3%;
  transform: scale(1.8) rotate(30deg);
}
.circle-bell__content:nth-child(2) {
  bottom: 35%;
  left:-7%;
  transform: scale(1.8) rotate(45deg);
}
.circle-bell__content:nth-child(3) {
  bottom: 15%;
  right: 0%;
  transform: scale(1.2) ;
}

.circle-bell__container {
  height: 80px;
  width:80px; 
  border-radius:50%; 
  padding:5px; 
  display:flex; 
  justify-content:center;
  align-items:center; 
  background:#779dff;
  filter: opacity(0.5);
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
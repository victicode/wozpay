<template>
  <q-tabs
    no-caps
    right-icon="-"
    active-color="terciary"
    align="justify"
    class="bg-white text-dark shadow-0 fixed-bottom bottom-tab q-py-md-xs q-px-md-lg flex q-py-xs userTab" 
  >
    <q-route-tab class="q-px-xs-sm q-px-md-lg" :to="'/dashboard'" exact>
      <div class="flex flex-center column">
        <div v-html="wozIcons.home" class="iconWoz"  />
        <span class="q-mt-xs text-dark text-caption">Inicio</span>
      </div>
    </q-route-tab>
    <!-- <q-route-tab class="q-px-xs-sm q-px-md-lg" :to="'/last-operations'" :icon="'eva-flip-2-outline'" exact replace label="Ult. Trans." /> -->
    <q-route-tab class="q-px-xs-sm q-px-md-lg" exact :to="'/transactions'" >
      <div class="flex flex-center column">
        <q-icon
          :size="'sm'"
          :name="'eva-flip-2-outline'"
        />
        <span class="q-mt-xs text-dark text-caption">Ult. Trans</span>
      </div>
    </q-route-tab>
    <q-route-tab class="q-px-xs-sm q-px-md-lg" :to="'/account_bank'" exact>
      <div class="flex flex-center column">
        <q-icon
          :size="'sm'"
          :name="icons.outlinedAccountBalance"
        />
        <span class="q-mt-xs text-dark text-caption">Banco</span>
      </div>
    </q-route-tab>
    <q-route-tab class="q-px-xs-sm q-px-md-lg" :to="'/notifications'" exact>
      <div class="flex flex-center column">
        <section class="flex flex-center column relative">
          <div v-html="wozIcons.notification" class="iconWoz" />
          <div v-if="notificationsCount > 0"  rounded floating class="notificationBadge bg-negative"  >
            {{ notificationsCount >= 10 ? '+'+notificationsCount : notificationsCount }}
          </div>
        </section>
        <span class="q-mt-xs text-dark text-caption">Notificaciones</span>
      </div>
    </q-route-tab>
    <q-route-tab class="q-px-xs-sm q-px-md-lg" :to="'/profile'" exact> 
      <div class="flex flex-center column">
        <div v-html="wozIcons.profile" class="iconWoz" />
        <span class="q-mt-xs text-dark text-caption">Perfil</span>
      </div>
    </q-route-tab>
   
  </q-tabs>
</template>

<script>
import { inject, onMounted, ref } from 'vue'
import wozIcons from '@/assets/icons/wozIcons'
import { useNotificationStore } from '@/services/store/notification.store'
import { useAuthStore } from '@/services/store/auth.store'
import notificationSound from '@/assets/audio/notification7.wav'

export default {
  setup () {
    const icons = inject('ionIcons')
    const store = useNotificationStore()
    const user = useAuthStore().user;
    const notificationsCount = ref(0)
    const sound = new Audio(notificationSound)

    const getNotifications = () =>{
      store.getAllNotificationByUser(user.id).then((data) =>{
        notificationsCount.value = data.data.unreadCount
      })
    }

    onMounted(()=>{
      getNotifications()
      window.Echo
      .channel('notificationEvent'+user.id)
      .listen('NotificationsEvent', async (data) => {
        getNotifications()
        sound.play()
      })
  
    })
    return { icons, wozIcons, notificationsCount}
  },
}
</script>
<style lang="scss">
.userTab{

  & .q-tab--active {
    & span {
      color:#ffc701!important;
    }
    & .iconWoz path {
      stroke: #ffc701;
    }
  }
}
.notificationBadge{
  top: -5px!important; 
  right: -10px!important;
  border-radius: 50%;
  height: 25px;
  width: 25px;
  font-size: .75rem;
  display: flex;
  justify-content: center;
  align-items: center;
  position: absolute;
  
  color: white;
}
.q-tab__label{
    font-size: 0.72rem!important;
  }
</style>
<style lang="scss" scoped>
  
  .w-100{
    width: 100%!important;
  }
  .bottom-tab{
    border-top: 1.5px solid $grey-3;
    width: 50%;
    left: 25%;
  }
  @media screen and (max-width: 820px){
    .bottom-tab{
      width: 100%;
      left: 0%;
    }
  }
</style>
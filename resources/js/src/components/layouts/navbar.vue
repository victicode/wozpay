<template>
  <q-tabs
    no-caps
    right-icon="-"
    active-color="terciary"
    align="justify"
    class="bg-white text-dark shadow-0 fixed-bottom bottom-tab q-py-md-xs q-px-md-lg flex q-py-xs userTab" 
  >
    <q-route-tab class="q-px-xs-sm q-px-md-lg" :to="'/dashboard'" exact style="width: 20%;">
      <div class="flex flex-center column">
        <div v-html="wozIcons.home" class="iconWoz"  />
        <span class="q-mt-xs text-dark text-caption">Inicio</span>
      </div>
    </q-route-tab>
    <!-- <q-route-tab class="q-px-xs-sm q-px-md-lg" :to="'/last-operations'" :icon="'eva-flip-2-outline'" exact replace label="Ult. Trans." /> -->
    <q-route-tab class="q-px-xs-sm q-px-md-lg" exact :to="'/transactions'" style="width: 20%;" >
      <div class="flex flex-center column">
        <q-icon
          :size="'sm'"
          :name="'eva-flip-2-outline'"
        />
        <span class="q-mt-xs text-dark text-caption">Ult. Trans</span>
      </div>
    </q-route-tab>
    <q-route-tab class="q-px-none q-px-md-lg" :to="!user.wallet_link ?'/pay_link_services' : '/requestPay'" exact style="width: 20%; opacity:1">
      <div class="flex flex-center column paylink__button" style="">
        <span class="text-white text-caption">Cobrar</span>
      </div>
    </q-route-tab>
    <q-route-tab class="q-px-xs-sm q-px-md-lg" :to="user.viewBank == 1 ? '/bank_info' : '/account_bank'" exact style="width: 20%;">
      <div class="flex flex-center column">
        <q-icon
          :size="'sm'"
          :name="icons.outlinedAccountBalance"
        />
        <span class="q-mt-xs text-dark text-caption">Banco</span>
      </div>
    </q-route-tab>
    <q-route-tab class="q-px-xs-sm q-px-md-lg" :to="'/notifications'" exact style="width: 20%;">
      <div class="flex flex-center column">
        <section class="flex flex-center column relative">
          <div v-html="wozIcons.notification" class="iconWoz" />
          <div v-if="notificationsCount > 0"  rounded floating class="notificationBadge bg-negative"  >
            {{ notificationsCount >= 10 ? '+'+notificationsCount : notificationsCount }}
          </div>
        </section>
        <span class="q-mt-xs text-dark text-caption hidde-xs">Notificaciones</span>
        <span class="q-mt-xs text-dark text-caption show-xs">Notif.</span>
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
import { storeToRefs } from 'pinia'

export default {
  setup () {
    const icons = inject('ionIcons')
    const store = useNotificationStore()
    const { user } = storeToRefs(useAuthStore()) ;
    const notificationsCount = ref(0)
    const sound = new Audio(notificationSound)

    const getNotifications = () =>{
      store.getAllNotificationByUser(user.value.id).then((data) =>{
        notificationsCount.value = data.data.unreadCount
      })
    }

    onMounted(()=>{
      getNotifications()
      window.Echo
      .channel('notificationEvent'+user.value.id)
      .listen('NotificationsEvent', async (data) => {
        getNotifications()
        sound.play()
      })
  
    })
    return { icons, wozIcons, notificationsCount, user}
  },
}
</script>
<style lang="scss">
.paylink__button{
  border-radius: 50%; background: $positive; height: 70px; width: 70px;
  transform: translateY(-40%) ;
  border: 5px solid #85fc85;
  animation: 1.5s bouncee infinite alternate-reverse;
  opacity: 1!important;
}
.userTab{
  overflow: visible;
  & .q-tab--active {
    & span {
      color:#ffc701!important;
    }
    & .iconWoz path {
      stroke: #ffc701;
    }
    & .paylink__button{
      & span {
        color:white!important;
      }
    }
  }
  & .q-tabs__content {
    overflow: visible!important;
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
@keyframes bouncee {
  0%{
    transform: translateY(-45%) scale(1);
  }
  100%{
    transform: translateY(-45%) scale(1.1);
  }
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
    height: 9%;
  }
  @media screen and (max-width: 820px){
    .bottom-tab{
      height: 8%;
      width: 100%;
      left: 0%;
    }
  }
  
</style>
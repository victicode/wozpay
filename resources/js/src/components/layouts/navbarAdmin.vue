<template>
  <q-tabs
    no-caps
    right-icon="-"
    active-color="terciary"
    align="justify"
    class="bg-white text-dark shadow-0 fixed-bottom bottom-tab q-py-md-xs q-px-md-lg flex q-py-xs userNavbar" 
  >
    <q-route-tab class="q-px-xs-sm q-px-md-lg" :to="'/admin/dashboard'" exact >
      <div class="flex flex-center column">
        <div v-html="wozIcons.home" />
        <span class="q-mt-xs text-dark text-caption">Inicio</span>
      </div>
    </q-route-tab>
    <q-route-tab class="q-px-xs-sm q-px-md-lg" :to="'/users'" exact > 
      <div class="flex flex-center column">
        <div v-html="wozIcons.clients" />
        <span class="q-mt-xs text-dark text-caption">Clientes</span>
      </div>
    </q-route-tab>
    <q-route-tab class="q-px-xs-sm q-px-md-lg" to="/admin/loans" exact >
      <div class="flex flex-center column">
        <div v-html="wozIcons.loans" />
        <span class="q-mt-xs text-dark text-caption">Prestamo</span>
      </div>
    </q-route-tab>
    <q-route-tab class="q-px-xs-sm q-px-md-lg" :to="'/admin/notification/send'" exact >
      <div class="flex flex-center column">
        <div v-html="wozIcons.notf" />
        <span class="q-mt-xs text-dark text-caption">Notif. push</span>
      </div>
    </q-route-tab>
    <q-route-tab class="q-px-xs-sm q-px-md-lg" :to="'/admin/interest'" exact >
      <div class="flex flex-center column">
        <div v-html="wozIcons.calculator" />
        <span class="q-mt-xs text-dark text-caption">Calculadora</span>
      </div>
    </q-route-tab>
  </q-tabs>
</template>

<script>
import { inject, onMounted, ref } from 'vue'
import wozIcons from '@/assets/icons/wozIcons'
import { useNotificationStore } from '@/services/store/notification.store'
import { useAuthStore } from '@/services/store/auth.store'

export default {
  setup () {
    const icons = inject('ionIcons')
    const store = useNotificationStore()
    const user = useAuthStore().user;
    const notificationsCount = ref(0)

    // const getNotifications = () =>{
    //   store.getAllNotificationByUser(user.id).then((data) =>{
    //     notificationsCount.value = data.data.unreadCount
    //   })
    // }

    // onMounted(()=>{
    //   getNotifications()
    // })
    return { icons, wozIcons,}
  },
}
</script>
<style lang="scss">
.userNavbar{

padding-top: 0px!important;
& .q-tab__indicator {
  bottom: 97%!important;
}
& .q-tab--active {
  & span {
    color:#ffc701!important;
  }
  & path {
    stroke: #ffc701;
  }
}
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
    border-top: 1.5px solid $grey-5;
    width: 50%;
    left: 25%;
  }
  @media screen and (max-width: 780px){
    .bottom-tab{
      width: 100%;
      left: 0%;
    }
  }
</style>
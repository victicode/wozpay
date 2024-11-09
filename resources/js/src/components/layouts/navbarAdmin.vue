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
        <section class="flex flex-center column relative">
          <div v-html="wozIcons.clients" />
          <div v-if="countPending > 0"  rounded floating class="notificationBadge1 bg-negative"  >
            
          </div>
        </section>
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
import { useLoanStore } from '@/services/store/loan.store';
import { useAuthStore } from '@/services/store/auth.store'


export default {
  setup () {
    const icons = inject('ionIcons')
    const user = useAuthStore().user;
    const loanStore = useLoanStore();
    const countPending = ref(0)
    const getSolicitudesCount = () => {
      loanStore.getPendingLoan()
      .then((response) => {
        // countPending.value = 
        countPending.value = response.data
      })
    }
    onMounted(() => {
      getSolicitudesCount()

      window.Echo
      .channel('notificationEvent'+user.id)
      .listen('NotificationsEvent', async (data) => {
        getSolicitudesCount()
      })
    })

    return { icons, wozIcons, countPending}
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
  .notificationBadge1{
    height: 15px;
    width: 15px;
    background: red;
    position: absolute;
    border-radius: 50%;
    left: 65%;
    bottom: 55%;
  }
  .w-100{
    width: 100%!important;
  }
  .bottom-tab{
    border-top: 1.5px solid $grey-5;
    width: 50%;
    left: 25%;
    height: 9%;
  }
  @media screen and (max-width: 820px){
    .bottom-tab{
      width: 100%;
      left: 0%;
    }
  }
</style>
<template>
  <q-tabs
    no-caps
    right-icon="-"
    active-color="terciary"
    align="justify"
    class="bg-white text-dark shadow-0 fixed-bottom bottom-tab q-py-md-xs q-px-md-lg flex" 
  >
    <q-route-tab class="q-px-xs-sm q-px-md-lg" :to="'/dashboard'"  exact replace :icon='"img:"+home' label="Inicio" />
    <!-- <q-route-tab class="q-px-xs-sm q-px-md-lg" :to="'/last-operations'" :icon="'eva-flip-2-outline'" exact replace label="Ult. Trans." /> -->
    <q-route-tab class="q-px-xs-sm q-px-md-lg"  :icon="'eva-flip-2-outline'" exact replace label="Ult. Trans."  style="opacity: 0.4;"/>
    <q-route-tab class="q-px-xs-sm q-px-md-lg" :to="'/bank'"  exact :icon="icons.outlinedAccountBalance" replace label="Banco" classs="material-icons-outlined" />
    <q-route-tab class="q-px-xs-sm q-px-md-lg" :to="'/notifications'"  exact replace :icon='"img:"+notification' label="Notificaciones" />
    <q-route-tab class="q-px-xs-sm q-px-md-lg" :to="'/profile'"  exact replace :icon='"img:"+profile' label="Perfil" /> 
   
  </q-tabs>
</template>

<script>
import { inject } from 'vue'
import wozIcons from '@/assets/icons/wozIcons'
import home from '@/assets/images/home.svg'
import profile from '@/assets/images/profile.svg'
import notification from '@/assets/images/notification.svg'

export default {
  setup () {
    const icons = inject('ionIcons')
    
    return { icons, home, notification, profile}
  },
}
</script>
<style>
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
  @media screen and (max-width: 780px){
    .bottom-tab{
      width: 100%;
      left: 0%;
    }
  }
</style>
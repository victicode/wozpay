<template>
  <div class="q-py-md q-px-md" style="height: 100%; overflow: hidden; border-top:10px solid lightgray; border-bottom:10px solid lightgray">
    <div>
      <div class="text-subtitle1 text-weight-medium">
        <div class="flex items-center"> 
          <h6 class=" text-subtitle1 text-weight-medium  q-mr-sm">
            Vincular tarjeta de crédito o debito
          </h6>
          <div>
            <q-icon
              :name=" icons.outlinedAddCard "
              size="sm"
              @click="showToltip"
            >
            <q-tooltip 
              anchor="top middle" 
              self="bottom middle" 
              class="bg-positive" 
              :offset="[10, 10]" 
              v-model="showing"
            >
             Vincula tu tarjeta
            </q-tooltip>
            </q-icon>
          </div>
        </div>
        <div class="" style="font-size: 12px; color:lightgray ; border-bottom: 1px solid lightgrey;">
          Adjuntar tu tarjeta para débito automático y más.
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import { useAuthStore } from '@/services/store/auth.store'
  import { inject, ref } from 'vue'

  export default {
    setup() {
      //vue provider
      const user = useAuthStore().user;
      const icons = inject('ionIcons')
      const showing = ref('false')
      
      // Methods
      const showToltip = () => {
        showing.value = true
        setTimeout(() => {
          showing.value = false
          
        }, 3500);
      }
      // Data
      return{
        icons,
        user,
        showing,
        showToltip
      }
    },
  }

</script>
<style lang="scss">


</style>
<template>
  <div class="q-py-md q-mt-md  q-px-md linked_section">
    <div class="flex items-center justify-between linked_container">
      <div class="text-subtitle1 text-weight-medium">
        <div class="flex items-center"> 
          <h6 class=" text-subtitle1 text-weight-medium  q-mr-sm text-dark">
            Vincular tarjeta de crédito o debito
          </h6>
          <div>
            <q-icon
              :name=" icons.outlinedAddCard "
              size="sm"
              @click="showToltip"
              color="dark"
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
        <div class="linked_description" >
          Adjuntar tu tarjeta para débito automático y más.
        </div>
      </div>
      <div class="q-mb-xs">
        <q-icon
          name="eva-arrow-ios-forward-outline"
          size="sm"
          @click="showToltip"
          color="lightgdark"
        ></q-icon>
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
      const showing = ref(false)
      
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
.linked_section{
  height: 100%; 
  overflow: hidden; 
  border-top:10px solid lightgray; 
  border-bottom:10px solid lightgray;
}
.linked_description {
  font-size: 12px; 
  color:lightgray ; 
}
.linked_container{
  border-bottom: 1px solid #d3d3d3;
}

</style>
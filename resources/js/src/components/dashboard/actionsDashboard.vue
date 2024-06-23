<template>
  <div class="q-py-xs q-px-md" style="height: 100%; overflow: hidden;">
    <div>
      <div class="text-subtitle1 text-weight-medium">¿Qué puedes hacer?</div>
    </div>
    <div class="q-mt-md">
      <div class="row">
        <div class="col-3 q-px-xs">
          <q-btn color="transparet" flat no-caps class="q-px-xs q-py-xs actions-button w-100">
            <q-icon
              :name="icons.outlinedRequestQuote"
              size="sm"
              color="dark"
              class="user-verify-user"
            />
            <span class="q-mt-xs">Solicitar</span>
          </q-btn>
        </div>
        <div class="col-3 q-px-xs">
          <q-btn color="transparet" flat no-caps class="q-px-xs q-py-xs actions-button w-100">
            <q-icon
              :name="'eva-flip-2-outline'"
              size="sm"
              color="dark"
              class="user-verify-user"
            />
            <span class="q-mt-xs">Transfer.</span>
          </q-btn>
        </div>
        <div class="col-3 q-px-xs">
          <q-btn color="transparet" flat no-caps class="q-px-xs q-py-xs actions-button w-100">
            <q-icon
              :name="icons.outlinedMonetizationOn"
              size="sm"
              color="dark"
              class="user-verify-user"
            />
            <span class="q-mt-xs">Cargar</span>
          </q-btn>
        </div>
        <div class="col-3 q-px-xs">   
          <q-btn color="transparet" flat no-caps class="q-px-xs q-py-xs actions-button w-100">
            <q-icon
              :name="icons.outlinedSavings"
              size="sm"
              color="dark"
              class="user-verify-user"
            />
          </q-btn>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import { useAuthStore } from '@/services/store/auth.store'
  import util from '@/util/numberUtil'
  import { inject, ref } from 'vue'

  export default {
    setup() {
      //vue provider
      const user = useAuthStore().user;
      const icons = inject('ionIcons')
      // Data

      // Data
      return{
        icons,
        user,
      }
    },
  }

</script>
<style lang="scss">
  .actions-button{
    border: 1.3px solid #c7c7c7;
    border-radius: 15px;
    height: 65px;
    width: 100%;
    
    & .q-btn__content{
      display: flex!important;
      flex-direction: column!important;
      justify-content: center!important;
      align-items: center!important;
    }
  }


</style>
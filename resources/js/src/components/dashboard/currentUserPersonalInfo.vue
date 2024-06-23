<template>
  <div class="bg-primary q-pt-md q-px-lg" style="height: 100%; overflow: hidden;">
    <div style="">
      <div class="text-subtitle1 text-white text-weight-regular">Dinero disponible</div>
      <h5 class="text-white q-mt-xs text-weight-bold ">Gs.{{ user.account ?? 0 }}</h5>
    </div>
    <div class="q-mt-md">
      <div class="w-100 user-info q-pa-md">
        <div class="flex items-center"> 
          <h6 class=" text-subtitle1 text-weight-medium text-white q-mr-xs">
            {{ user.name }} 
          </h6>
          <div>
            <q-icon
              :name="user.verify_status == 2 ? icons.sharpVerified : icons.outlinedVerified"
              size="sm"
              :color=" user.verify_status == 1 ? 'terciary' :'white'"
              class="user-verify-user"
              :class="{'verify-user':user.verify_status == 2, }"
              @click="showToltip"
            >
            <q-tooltip 
              anchor="top middle" 
              self="bottom middle" 
              :class=" user.verify_status == 2 ? 'bg-positive': 'bg-terciary' " 
              :offset="[10, 10]" 
              v-model="showing"
            >
              {{
                user.verify_status == 1
                ? 'Verificación en proceso'
                : user.verify_status == 2 
                ? 'Usuario verificado'
                : 'Sin verificación'
              }}
            </q-tooltip>
            </q-icon>
          </div>
        </div>
        <div>
          <q-linear-progress rounded size="4px" track-color="primary"  :value="0.55" color="white"  class="q-mt-sm dashboard-progress" />
        </div>
        <div class="q-mt-sm">
          <span class="text-caption text-weight-bold text-white">
            CI N°: {{ numberFormat(user.dni) }} 
          </span>
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
      const numberFormat = util.numberFormat
      const icons = inject('ionIcons')

      // Data
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
        numberFormat,
        showing,
        showToltip
      }
    },
  }

</script>
<style lang="scss" scoped>
  .user-info{
    background: #0185ff;
    border-radius: 5px;
  }
  .dashboard-progress {
    width: 50%;
  }
  .user-verify-user{
    opacity: 0.5;
  }
  .verify-user{
    opacity: 1!important;
  }
  .verify-user-tooltip{
    background: red!important;
  }
  @media screen and (max-width: 780px){
    .dashboard-progress {
      width: 75%;

    }
  }
</style>
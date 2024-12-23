<template>
  <div class="userInfoContent q-pt-md q-px-lg" >
    <div class="flex justify-between items-center">
      <div>
        <div class="text-subtitle1 text-white text-weight-regular">Dinero disponible</div>
        <h4 class="text-white q-mt-xs  q-pt-sm text-weight-bold ">Gs. {{capitalByUser()}} </h4>
      </div>
      <div v-if="user.rol_id == 1">
        <q-btn 
          icon="eva-log-in-outline"
          color="white"
          text-color="black"
          :loading="loading"
          @click="logout"
        >
          <template v-slot:loading>
            <q-spinner-facebook />
          </template>
        </q-btn>
      </div>
      <div class="q-px-md-lg" v-else> 
          <q-btn flat @click="router.push('/profile')" class="q-px-none"> 
            <div class="flex justify-content-end items-center column">
              <div v-html="wozIcons.profile" class="iconWoz-top " />
              <span class="q-mt-xs text-white text-caption iconWoz-top__text">Perfil</span>
            </div>
          </q-btn>
      </div>
    </div>
    <div class="q-mt-md-md q-mt-md">
      <div class="w-100 user-info q-mt-md-sm">
        <div class="flex items-center"> 
          <h6 class=" text-subtitle1 text-weight-medium  q-mr-xs  q-mt-xs q-mb-none">
            {{ user.name }} 
          </h6>
          <div>
            <q-icon
              :name="user.verify_status == 2 ? icons.sharpVerified : icons.outlinedVerified"
              size="sm"
              :color=" user.verify_status > 0 ? 'terciary' :'grey-5'"
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
            <!-- <q-icon class="q-ml-xs" :name="icons.ionGlobeOutline" size="sm" :color="!user.wallet_link ? 'grey-6' : user.walletLink.status = 1 ? 'warning': 'positive'" /> -->
          </div>
        </div>
        <div>
          <q-linear-progress rounded size="4px" track-color="grey-5"  :value="0.55" color="terciary"  class="q-mb-sm dashboard-progress" />
        </div>
        <div class="q-mt-sm">
          <span class="text-body2 text-weight-bold">
            CI N°: {{ numberFormat(user.dni) }} 
          </span>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import { inject, ref } from 'vue'
  import { useWalletStore } from '@/services/store/wallet.store'
  import { useAuthStore } from '@/services/store/auth.store'
  import { storeToRefs } from 'pinia'
  import util from '@/util/numberUtil'
  import { useRouter } from 'vue-router'
  import utils from '@/util/httpUtil';
  import wozIcons from '@/assets/icons/wozIcons';

  
  export default {
    setup() {
      //vue provider
      
      const numberFormat = util.numberFormat
      const icons = inject('ionIcons')
      const { balances } = storeToRefs(useWalletStore())
      const { user  } = storeToRefs(useAuthStore())
      const store = useAuthStore()
      const router = useRouter()
      const loading = ref(false)
      // Data
      const showing = ref(false)
      
      // Methods
      const showToltip = () => {
        showing.value = true
        setTimeout(() => {
          showing.value = false
        }, 3500);
      }
      const capitalByUser = () => {
        if(user.value.rol_id != 3){
          return numberFormat((balances.value.wallet - balances.value.loans) + balances.value.paysRecieve)
        }
        return numberFormat(balances.value.wallet);
      }
      const logout = () =>{
        loading.value = true
        utils.errorLogout( () => router.push('/login'))
      }
      return{
        user,
        wozIcons,
        icons,
        balances,
        loading,
        numberFormat,
        showing,
        router,
        showToltip,
        capitalByUser,
        logout,
      }
    },
  }

</script>
<style lang="scss">
.iconWoz-top{
    & path{
      stroke: white;
      color: white;
      stroke-width: 3px;
    }
  }
</style>
<style lang="scss" scoped>
  
  .userInfoContent{
    height: 100%; 
    overflow: hidden;
    background: linear-gradient(180deg, #0449fb 75%, #fff 60%);
  }
  h5{
    font-size: 1.9rem!important;
  }
  // .user-info{
  //   background: #0185ff;
  //   padding: 13px 10px;
  //   border-radius: 5px;
  // }
  .user-info{
    margin-top: 14px;
    background: white;
    padding: 13px 10px;
    border-radius: 5px;
    box-shadow: 0px 3px 5px 0px rgba(168, 168, 168, 0.651);
  }
  .dashboard-progress {
    width: 50%;
  }
  @media screen and (max-width: 780px){
    .dashboard-progress {
      width: 75%;

    }
  }
</style>
<template>
  <div class="userInfoContent q-pt-md q-px-lg" >
    <div class="flex justify-between items-center">
      <div>
        <div class="text-subtitle1 text-white text-weight-regular">Dinero disponible</div>
        <h4 class="text-white q-mt-xs  q-pt-sm text-weight-bold ">
          
          {{userCoin.code}} {{capitalByUser()}} 
        </h4>
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
        <q-toggle
            v-model="currentCoin"
            checked-icon="$"
            color="green"
            size="3rem"
            unchecked-icon="Gs."
            class="coinSwitch"
            @update:model-value="updateCoin()"
          />
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
              :color=" user.verify_status > 0 ? 'positive' :'grey-5'"
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
            <q-icon class="q-ml-xs" :name="icons.ionGlobeOutline" size="sm" :color="!user.wallet_link ? 'grey-6' : user.wallet_link.status == 1 ? 'warning': 'positive'" />
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
  import { inject, onMounted, ref } from 'vue'
  import { useWalletStore } from '@/services/store/wallet.store'
  import { useAuthStore } from '@/services/store/auth.store'
  import { storeToRefs } from 'pinia'
  import util from '@/util/numberUtil'
  import { useRouter } from 'vue-router'
  import utils from '@/util/httpUtil';
  import wozIcons from '@/assets/icons/wozIcons';
  import storage from '@/services/storage'
  import { useCoinStore } from '@/services/store/coin.store';
  export default {
    setup() {
      //vue provider
      const currentCoin = ref(!storage.getItem('coin_user') ? false : storage.getItem('coin_user') == 1 ? false : true)
      const numberFormat = util.numberFormat
      const numberFormatDecimal = util.numberFormatDecimal
      const icons = inject('ionIcons')
      const { balances } = storeToRefs(useWalletStore())
      const { user  } = storeToRefs(useAuthStore())
      const { coins } = storeToRefs(useCoinStore())
      const store = useAuthStore()
      const router = useRouter()
      const loading = ref(false)
      const userCoin = ref({})
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
        // if(user.value.rol_id != 3){
        //   return numberFormat(balances.value.wallet_link/userCoin.value.rate)
        // }
        // return numberFormat(balances.value.wallet_link/userCoin.value.rate);
        return currentCoin.value 
        ? numberFormatDecimal(balances.value.wallet_link/userCoin.value.rate)
        : numberFormat(balances.value.wallet_link/userCoin.value.rate);
      }
      
      const getCoin = () => {
        let coinStorage = storage.getItem('coin_user')
        if(!coinStorage) {
          coinStorage = 1;
          storage.setItem('coin_user', 1)
        }
        // userCoin.value = coin

        userCoin.value = coins.value.find((coin) => coin.id == coinStorage)
      }
      const updateCoin = () => {
        let coin = currentCoin.value ? 2 : 1
        storage.setItem('coin_user', coin)
        userCoin.value = coins.value.find((coins) => coins.id == coin)
      }
      const logout = () =>{
        loading.value = true
        utils.errorLogout( () => router.push('/login'))
      }
      onMounted(() => {
        getCoin()
      })
      return{
        user,
        wozIcons,
        icons,
        balances,
        loading,
        numberFormat,
        showing,
        router,
        currentCoin,
        showToltip,
        capitalByUser,
        userCoin,
        logout,
        updateCoin,
      }
    },
  }

</script>
<style lang="scss">
.coinSwitch {
  transform: rotate(90deg);
  & i.notranslate{
    font-weight: bold;
    color: white;
  }
  & .q-toggle__thumb{
    top: 0.12em;
    left: 0.1em;
    width: 0.7em;
    height: 0.7em;
    transform: rotate(-90deg);
    &:after{
      background: $primary;
    }
    & .q-icon{
      opacity: 1;
    }
  }
  & .q-toggle__inner{
    color: $primary;
  }
  
  & .q-toggle__inner--truthy .q-toggle__thumb {
      left: 1.8rem;
      &:after{
        background: #4caf50;
      }
  }
}
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
    background: linear-gradient(180deg, #1c304f 75%, #f2f2f5 60%);
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
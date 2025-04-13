<template>
  <div>
    <div class=" q-py-md q-mt-md" style="border-bottom: 1px solid lightgray;">
      <div class="text-h5  text-center text-bold">Monedas disponibles</div>
    </div>
    <div class="q-py-xs">
      <div v-if="load">
        <div v-if="coins.length > 0" class="q-px-xs" >
          <div v-for="(coin, index) in coins" :key="index" class="q-mt-md flex items-center justify-between container__link q-px-xs" @click="getCoinById(coin.id)">
              <div class="">
                <div class="text-subtitle1 text-weight-medium">{{ coin.name }}</div>
                <div class="text-subtitle2 text-weight-regular ">({{ coin.code }})</div>
              </div>
              <div class="flex">
                <div>
                  <div class="text-subtitle2 text-weight-regular text-end" style="font-size: 0.8rem;">Tasa de cambio</div>
                  <div 
                    style="font-size: 15px;" 
                    class="text-weight-medium text-right"
                  >
                    {{ numberFormat(coin.rate) }}
                  </div>
                </div>
                <q-btn  color="black" flat  size="xs" class="q-pl-none q-pr-none q-ml-sm" @click="getCoinById(coin.id)">
              
                  <q-icon name="eva-more-vertical-outline" size="1.5rem" />
                </q-btn>
              </div>
          </div>
        </div>
        <div v-else class="text-center text-h6 q-mt-lg">
          No tienes links creados😞
        </div>
      </div>
      <div v-else>
        <div v-for="n in 5" :key="n" class="q-mt-md flex items-center " >
          <div style="border-bottom: 1px solid lightgray; width: 100%;" class="q-px-md flex items-center justify-between ">
            <div style="width: 50%;">
              <div class="text-subtitle1 text-weight-medium">
                <q-skeleton type="text"  style="width: 25%;"/>
              </div>
              <div class="text-subtitle2 text-weight-regular q-mt-xs">
                <q-skeleton type="text" style="width: 10%;"/>
              </div>
            </div>
            <div style="width: 30%;" class="flex column items-end">
              
                <q-skeleton type="text" style="width:40%"  />
              
              
                <q-skeleton type="text" style="width:30%"  />
              
            </div>
          </div>

        </div>
      </div>
    </div>
    <div v-if="load">

      <modalCoin :show="show" :coin="selectedCoin" @hiddeModal="hideModal()" @updateCoin="updateCoin" @deleteCoin="getCoins"/>
    </div>
  </div>
</template>
<script>
  import { useAuthStore } from '@/services/store/auth.store'
  import util from '@/util/numberUtil'
  import { inject, ref, onMounted } from 'vue'
  import wozIcons from '@/assets/icons/wozIcons';
  import { useCoinStore } from '@/services/store/coin.store';
  import { useQuasar } from 'quasar';
  import { useRoute, useRouter } from 'vue-router'
  import { storeToRefs } from 'pinia'
  import moment from 'moment';
  import modalCoin from '@/components/coin/modalCoin.vue';
 
  export default {
    components:{
      modalCoin
    },
    setup() {
      //vue provider
      const q = useQuasar()
      const { user  } = storeToRefs(useAuthStore())
      const icons = inject('ionIcons')
      const numberFormat = util.numberFormat
      const isReady = ref(false)
      const router = useRouter()
      const route = useRoute()
      const coinStore = useCoinStore()
      const load = ref(false)
      const selectedCoin = ref({})
      const coins = ref({})
      const show = ref(false)

      const getCoins = () => {
        coinStore.getCoins()
        .then((response) => {
          if(response.code !== 200) throw response
          coins.value = response.data
          
          setTimeout(() => {
            load.value = true
          }, 500);

          
        })
        .catch((response) => {
          console.log(response)
          showNotify('negative', response)
        })
      }
      const getCoinById = (id) => {
        
        coinStore.getCoinById(id)
        .then((data) => {
          selectedCoin.value = data.data

          show.value = true
   
        })
      }
      const showNotify = (type, message) => {
        q.notify({
          message: message,
          color: type,
          actions: [
            { icon: 'eva-close-outline', color: 'white', round: true, handler: () => { /* ... */ } }
          ]
        })
      }

      const goTo = (id) => {
        router.push('/link/pay/'+id)
      }
      const hideModal = () =>{
        show.value = false
        selectedCoin.value = {}
      }
      
      const updateCoin = (coin) =>{
        let index = coins.value.findIndex(coins => coins.id == coin.id);

        if (index > -1) {
          coins.value[index] = coin
        }

        selectedCoin.value = {...coins.value[index]}
      }
      onMounted(() => {
        getCoins()
        // window.Echo
        // .channel('userUpdateEvent'+user.id)
        // .listen('UserUpdateEvent', async () => {
        // })
      })
      // Data
      return{
        icons,
        load,
        user,
        moment,
        numberFormat,
        isReady,
        wozIcons,
        coins,
        show,
        selectedCoin,
        getCoinById,
        hideModal,
        updateCoin,
        getCoins,
      }
    },
  }

</script>
<style lang="scss" scoped>
.container__link{
  border-bottom: 1px solid lightgray ; width: 100%; 
}
.bounce_pay{
  height: 0.9rem; 
  width: 0.9rem;
  border-radius: 50%; 
  background: red;
  animation: bounce-in 1s alternate-reverse infinite;
}
@media screen and (max-width: 780px){
  
}
@keyframes bounce-in {
  0% {
    opacity: 1;
    transform: scale(0.8) translateY(-0.1rem);
  }
  50% {
    opacity: 1;
    transform: scale(1.05) translateY(-0.1rem);
  }
  70% { transform: scale(.9) translateY(-0.1rem); }
  100% { transform: scale(1) translateY(-0.1rem); }
}
</style>
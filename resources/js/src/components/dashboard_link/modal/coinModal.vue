<template>
  <div>
    <q-dialog v-model="dialog"  persistent class="coinAction__modal">
      <q-card class="position-relative dialog__pay"  >
        <q-card-section class="flex q-pb-sm w-100 items-center justify-between">
          <div class="text-subtitle1 text-weight-bold">
            Selecciona la moneda
          </div>
          <q-btn color="black" size="xs" round @click="hideModal()">
            <q-icon
                name="eva-close-outline"
                size="xs"
                color="white"
                class="q-mx-xs "
              />
          </q-btn>
        </q-card-section>
        <q-linear-progress :value="1" color="black" size="0.125rem"/>
        <q-card-section class=" text-center">
          <div v-if="loading">
            <div  class="flex q-my-md q-py-sm coin_item__content justify-between items-center" v-for="coin in coins" :key="coin.id">
              <div>
                <div class="text-subtitle1 text-weight-medium text-left">
                  {{ coin.name }} ({{ coin.code }})
                </div>
                <div v-if="coin.id == 2" class="text-left text-caption">
                  {{ `1 USD = Gs. ${numberFormat(coin.rate)}` }}
                </div>
             </div>
              <div>
                <van-switch v-model="coinActive[coin.id]" class="swichtCoin" 
                size="1.3rem" @update:model-value="updateCoin(coin.id)"  active-color="#21BA45" inactive-color="#d8d8d8">
                  <template #node>
                    <div class="icon-wrapper">
                    </div>
                  </template>
                </van-switch>
              </div>
            </div>
          </div>
          <div v-else class="q-py-lg flex flex-center">
            <q-spinner
              color="primary"
              size="3em"
            />
          </div>
        </q-card-section>
      </q-card>
    </q-dialog>
  </div>
</template>
<script>
  import { useQuasar, Loading } from 'quasar';
  import { inject, onMounted, ref, } from 'vue';
  import { useCoinStore } from '@/services/store/coin.store';
  import { storeToRefs } from 'pinia'
  import util from '@/util/numberUtil'
  import storage from '@/services/storage'

  export default {
    props: {
      show: Boolean,
    },
    emits: ['hiddeModal', 'updateCurrentCoin'],
    setup (props, { emit }) {
      // Data}
      const dialog = ref(props.show);
      const icons = inject('ionIcons')
      const q = useQuasar()
      const coinStore = useCoinStore()
      const loading = ref(false)
      const numberFormat = util.numberFormat
      const { coins } = storeToRefs(useCoinStore())
      const coinCurrent = ref(storage.getItem('coin_user') ?? 1)
      const coinActive = ref({
        1: coinCurrent.value == 1,
        2: coinCurrent.value == 2
      })

      const hideModal = () => {
        emit('hiddeModal')
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

      const updateCoin = (id) => {

  
        // loading.value = true
 
          if(id == 1){
            coinActive.value[1] = true
            coinActive.value[2] = !coinActive.value[1]


          }
          if(id == 2){
            coinActive.value[2] = true
            coinActive.value[1] = !coinActive.value[2]
          }

        if(coinCurrent.value != id){

          coinCurrent.value = id
          storage.setItem('coin_user', coinCurrent.value)
          emit('updateCurrentCoin')
        }

        // userCoin.value = coins.value.find((coins) => coins.id == coin)
      }

      watch(() => props.show, (newValue) => {
        dialog.value = newValue
        loading.value = false

        setTimeout(() => {
          loading.value = true
        },1000)

      });
      watch(() => props.coin, (newValue) => {
        coinSelected.value = newValue
      });
      return {
        coinCurrent,
        dialog,
        coins,
        icons,
        loading,
        numberFormat,
        coinActive,
        hideModal,
        updateCoin,
      }
    }
  };
</script>
<style lang="scss">
.noBorderInput{
  
  border-radius: 10px;
  padding: 0px 0.5rem;
  border: 1px solid transparent;

  & input{
    cursor: pointer;
    font-family: "Roboto", sans-serif !important;
    font-style: normal;
    font-size: 1rem;
    font-weight: 500;
    line-height: 1.75rem;
    letter-spacing: 0.00937em;
    text-align: end;
  }
}
.coinAction__modal{
  width: 100%;
  & .q-dialog__inner--minimized{
    padding: 13px!important;
  }
}
</style>
<style lang="scss" scoped>

.dialog__pay{
  width: 560px; 
  transition: all 0.8s ease; 
  max-height: 100%!important; 
  border-radius: 20px;
  height: 15.5rem;
  
}

.coin_item__content {
  border-bottom: 1px solid lightgray;
}
.w-100 {
  width: 100%;
}
.negative-back {
  background-color: #ff00001a;border-radius: 20px;
}

.button-file {
  width: 60px; 
  height: 60px; 
  border-radius: 10px; 
  box-shadow: 0px 2px 8px 0px rgba(168, 167, 167, 0.829);
}
.cls-button{
  position: absolute; 
  right: -10px; 
  top:-10px; 
  z-index: 15;
}
#video_frame {
  border-radius: 10px; 
}
@media screen and (max-width: 780px){
  .dialog__pay{
    width: 400px; 
  }
}
.shakeInput{
  // animation: shakeit 0.4s  ;
  border: 1px solid rgb(204, 204, 204);
  border-radius: 10px;
  padding: 0px 0.5rem;

}
@keyframes shakeit {
  0%, 
  100%{
    transform: translateX(0px);
  }
  10%, 
  90%{
    transform: translateX(-5px);
  }
  20%,
  80%{
    transform: translateX(5px);
  }
  30%,
  70%{
    transform: translateX(-5px);
  }
  40%,
  60%{
    transform: translateX(5px);
  }

}
</style>
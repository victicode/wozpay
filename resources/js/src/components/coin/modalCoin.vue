<template>
  <div>
    <q-dialog v-model="dialog"  persistent class="coinAction__modal">
      <q-card class="position-relative dialog__pay"  >
        <q-card-section class="flex q-pb-sm w-100 items-center justify-between">
          <div class="text-subtitle1 text-weight-bold">
            Acciones de moneda
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
          <div v-if="Object.values(coin).length > 0">
            <div style="flex-wrap: nowrap; height: 96%;" class="flex column dialog_document q-mt-xs flex-start" >
              <q-card-section class="header_document q-pb-sm text-center">
                <div class="text-subtitle1 text-weight-bold "> Detalles de moneda</div>
              </q-card-section>
              <q-card-selection class="flex  justify-end q-px-md-md">
                <template v-if="buttons == 1">
                  <q-btn
                    color="primary"
                    icon="eva-edit-2-outline"
                    size="sm"
                    class="q-py-sm q-ml-sm"
                    @click="buttons = 2"
                  />
                  <q-btn
                    color="negative"
                    icon="eva-trash-2-outline"
                    size="sm"
                    class="q-py-sm q-ml-sm"
                    @click="buttons = 2"
                  />
                </template>
                <template v-if="buttons == 2">
                  <q-btn
                    color="black"
                    icon="eva-close-circle-outline"
                    size="sm"
                    class="q-py-sm q-ml-sm"
                    @click="buttons = 1"
                  />
                  <q-btn
                    color="positive"
                    icon="eva-checkmark-circle-2-outline"
                    size="sm"
                    class="q-py-sm q-ml-sm"
                    @click="updateCoin()"
                  />
                </template>
              </q-card-selection>
              <q-card-section class="q-pt-none q-px-none" style="height: 100%; overflow: auto;">
                <div  class="q-pa-md-md q" style="height: 100%;" >
                  <div>
                    <div class="flex justify-between items-center text-subtitle1 q-py-sm text-weight-medium" style="border-bottom: 1px solid lightgrey;" >
                      <div>Moneda: </div>
                      <div>
                        <q-input borderless v-model="coin.name" :readonly="buttons == 1" dense class="noBorderInput" :class="{ 'shakeInput':buttons==2 }" />
                      </div>
                    </div>
                    <div class="flex justify-between items-center text-subtitle1 q-py-sm text-weight-medium" style="border-bottom: 1px solid lightgrey;" >
                      <div>Simbolo: </div>
                      <div>
                        <q-input borderless v-model="coin.code" :readonly="buttons == 1" dense class="noBorderInput" :class="{ 'shakeInput':buttons==2 }" />
                      </div>
                    </div>
                    <div class="flex justify-between items-center text-subtitle1 q-py-sm text-weight-medium" style="border-bottom: 1px solid lightgrey;" >
                      <div>Tasa de cambio: </div>
                      <div>
                        <q-input borderless v-model="coin.rate" :readonly="buttons == 1" dense class="noBorderInput" :class="{ 'shakeInput':buttons==2 }" mask="###.###.###.###.###"
                        reverse-fill-mask />
                      </div>
                    </div>
                    <div class="flex justify-between items-center text-subtitle1 q-py-md text-weight-medium" style="border-bottom: 1px solid lightgrey;">
                      <div>Ultima actu.: </div>
                      <div>{{ moment(coin.updated_at).format('DD/MM/YYYY hh:mm:ss A') }}</div>
                    </div>
                  </div>
                </div>
              </q-card-section>
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
  import { useQuasar } from 'quasar';
  import { inject, onMounted, ref, } from 'vue';
  import { useCoinStore } from '@/services/store/coin.store';
  import moment from 'moment';
  import util from '@/util/numberUtil'

  export default {
    props: {
      show: Boolean,
      coin: Object,
    },
    emits: ['hiddeModal', 'updateCoin'],
    setup (props, { emit }) {
      // Data}
      const buttons = ref(1)
      const dialog = ref(props.show);
      const coin = ref(props.coin)
      const mitt = inject('emitter');
      const icons = inject('ionIcons')
      const q = useQuasar()
      const coinStore = useCoinStore()
      const loading = ref(false)
      const numberFormat = util.numberFormat

      
      const hideModal = () => {
        buttons.value = 1
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


      const updateCoin = () => {
        
        coinStore.updateCoin(coin.value)
        .then((response) => {
          if(response.code !== 200) throw response
          //  console.log(response)

          // emit('updateCoin', response.data)
          
        })
        .catch((response)=>{
          showNotify('negative', 'Error al actualizar')
        })
      }

      watch(() => props.show, (newValue) => {
        dialog.value = newValue
      });
      watch(() => props.coin, (newValue) => {
        coin.value = newValue
      });
      return {
        buttons,
        dialog,
        icons,
        loading,
        coin,
        moment,
        numberFormat,
        hideModal,
        updateCoin
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
  height: 29rem;
  
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
  animation: shakeit 1s 0.2s alternate-reverse;
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
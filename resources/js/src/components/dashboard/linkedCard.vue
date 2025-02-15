<template>
  <div>
    <div class="q-py-sm q-px-md q-px-md-lg" >
      <!-- <div class=" q-pb-sm" >
        <div class="row">
          <div class="col-12 flex items-center justify-between">
            <div class="text-subtitle1 q-mt-sm text-black-9 text-weight-medium"> Mis productos Woz Payments</div>
          </div>
        </div>
      </div> -->
      <div style="" v-if="Object.values(linkCard).length > 0 && ready" >
        <div class="quote-section">
          <div class="row q-px-none">
            <div class="col-12 bg-white q-pa-md  flex items-center justify-between justify-md-start loan_card" style="" >
              <div class="w-100 flex items-center justify-between " style=" flex-wrap: nowrap;" @click="router.push('/card')">
                <div class="flex items-center w-80aaa ">
                  <div class="q-mr-sm q-mt-xs">
                    <q-icon :name="icons.outlinedAddCard" class="" size="sm" />
                  </div>
                  <div class=" q-ml-xs q-mr-none q-pl-md-md">
                  <!-- <div class="text-weight-medium"> {{linkCard.type == 1 ? 'Tarjeta de crédito' : 'Tarjeta de débito' }}</div> -->
                  <div class="text-weight-medium"> Tarjeta de crédito - Débito </div>
                  
                    <div class="">N° ********** {{ linkCard.number.substring(linkCard.number.length - 4) }} </div>
                  </div>
                </div>             
                <div class="q-mr-none cursor-pointer">
                  <q-chip 
                    :color="linkCard.status == 2 ? 'chip' : linkCard.status == 1 ? 'warning' : 'negative'" 
                    :text-color=" linkCard.status == 2 ? 'positive' : 'white'" 
                    class="q-px-md-lg q-px-md"
                  >
                    {{  linkCard.status == 2 ? 'Vinculada' : linkCard.status == 1 ? 'Pendiente' : 'Rechazada' }}
                  </q-chip>
                </div>
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="q-pb-md q-px-md q-px-md-lg " v-if="Object.values(linkCard).length == 0 && ready" >
      <div class="quote-section">
        <div class="row q-px-none">
          <div class="col-12 bg-white q-pa-md  flex items-center justify-between justify-md-start loan_card" style="" >
            <div class="w-100 flex items-center justify-between " style=" flex-wrap: nowrap;" @click="router.push('/card')">     
              <div class="flex items-center w-80bbbb ">
                <div class="q-mr-md-sm q-mr-xs q-mt-xs">
                  <q-icon :name="icons.outlinedAddCard" class="" size="md" color="grey-7" />
                </div>
                <div class="" style="width: 80%">
                  <div class=" text-subtitle1 text-weight-medium  q-mr-sm text-dark ellipsis text-turnc ">
                    Vincular tarjeta de crédito o debito
                  </div>
                  <div class="linked_description text-grey-6 ellipsis" >
                    Adjuntar tu tarjeta para débito automático y más.
                  </div>
                </div>
              </div>  
              <div class="q-mr-none cursor-pointer flex items-center">
                <div class="text-subtitle2 q-pt-xs">
                  Activar
                </div>
                <q-btn round flat class="q-ml-md-md q-pt-sm" @click="router.push('/pay_link_services')" size="sm"> 
                  <q-icon
                    name="eva-arrow-ios-forward-outline"
                    size="sm"
                    color="black"
                  />
                </q-btn>
              </div>
            </div>
            
          </div>
        </div>
      </div>

    </div>
    
  </div>
</template>
<script>
  import { useAuthStore } from '@/services/store/auth.store'
  import { useCardStore } from '@/services/store/card.store'
  import { inject, onMounted, ref } from 'vue'
  import util from '@/util/numberUtil'
  import { useRouter } from 'vue-router'
  import { useQuasar } from 'quasar'

  export default {
    setup() {
      //vue provider
      const user = useAuthStore().user;
      const cardStore = useCardStore()
      const icons = inject('ionIcons')
      const showing = ref(false)
      const ready = ref(false)
      const numberFormat = util.numberFormat
      const router = useRouter()
      const q = useQuasar()
      const linkCard = ref({})

      // Methods
      const showToltip = () => {
        showing.value = true
        setTimeout(() => {
          showing.value = false
          
        }, 3500);
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
      const getLinkCard = () => {
        cardStore.getCard(user.id).then((data) => {
          if(data.code !== 200) throw data
          // console.log(data)
          ready.value = true
          linkCard.value = Object.assign(data.data)
        }).catch((response) => {
          // showNotify('negative', response)
        })
      }
      onMounted(() => {
        getLinkCard()
        window.Echo
        .channel('cardUpdateEvent'+user.id)
        .listen('CardUpdateEvent', async () => {
          getLinkCard()
        })
      })
      // Data
      return{
        icons,
        user,
        showing,
        router,
        ready,
        numberFormat,
        linkCard,
        showToltip,
      }
    },
  }

</script>

<style lang="scss">
.text-turnc{
  width: max-content;
}
.w-100 {
  width: 100%!important;
}
.linked_section{
  height: 100%; 
  overflow: hidden; 
  border-top:0px solid lightgray; 
  border-bottom:0px solid lightgray;
}
.linked_description {
  font-size: 12px; 
}
.linked_container{
  border-bottom: 3px solid #d3d3d3;
}

</style>
<style lang="scss" scoped>
.loan_card{
  border-radius:15px;
  //box-shadow: 0px 5px 5px 0px #aaaaaa
}
.loan_container{
  border-bottom: 1px solid #d3d3d3;
}
.quote_description {
  font-size: 12px; 
  color:lightgray ; 
}
.quote_container{
  border-bottom: 1px solid #d3d3d3;
}
.quote-section::-webkit-scrollbar {
    display: none;
}
.w-80bbbb {
  width: 80%;
}
.w-50 {
  width: 50%;
}

@media screen and (max-width: 780px){
  .text-turnc{
    width: 85%;
  }

  .w-80bbbb {
    width: 74%;
  }
  .w-50 {
    width: auto;
  }
}
</style>
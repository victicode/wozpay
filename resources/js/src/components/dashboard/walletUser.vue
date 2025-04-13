<template>
  <div>
    <div class="q-py-xs q-px-md q-px-md-lg" >
      <!-- <div class=" q-pb-sm" >
        <div class="row">
          <div class="col-12 flex items-center justify-center">
            <div class="text-subtitle1 q-mt-sm text-black-9 text-weight-medium">Mis productos Woz Payments</div>
          </div>
        </div>
      </div> -->
      <div style="">
        <div class="quote-section">
          <div class="row q-px-none">
            <div class="col-12 bg-white q-px-md q-py-md  flex items-center justify-between justify-md-start loan_card" style="" >
              <div class="w-100 flex items-center justify-between q-mt-none ">
                <div class="flex items-center w-80 ">
                  <div class="q-mr-md-lg q-mr-sm q-mt-xs flex flex-center" style="width:36px; height:36px">
                    <q-icon :name="icons.outlinedAccountBalance" class="" size="md" />
                  </div>
                  <div class="flex items-center justify-between">
                    <div class="q-mr-md-none  w-autopl">
                      <div class="text-weight-medium" style="font-size: 0.89rem; ">Caja de ahorro</div>
                      <div class=" ">N° {{ user.wallet.number }} </div>
                    </div>
                  </div>
                </div>
                <div class="q-mr-sm text-end">
                  <div class="text-weight-medium text-right">Disponible</div>
                  <div class="text-weight-medium  text-right">Gs. {{numberFormat(user.wallet.balance)}}</div>
                </div>
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
  import { storeToRefs } from 'pinia'

  export default {
    setup() {
      //vue provider

      const icons = inject('ionIcons')
      const showing = ref(false)
      const ready = ref(false)
      const numberFormat = util.numberFormat
      const router = useRouter()
      const q = useQuasar()
      const linkCard = ref({})
      const { user  } = storeToRefs(useAuthStore())
      
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

      onMounted(() => {

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
.w-100 {
  width: 100%!important;
}

</style>
<style lang="scss" scoped>
.loan_card{
  border-radius:2rem;
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
.w-80 {
  width: 80%;
}
.w-50 {
  width: 50%;
}

@media screen and (max-width: 780px){
  .w-80 {
    width: auto;
  }
  .w-50 {
    width: auto;
  }
}
</style>
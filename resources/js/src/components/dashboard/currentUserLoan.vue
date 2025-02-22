<template>
  <div class="q-py-sm q-px-md q-px-md-lg"  >
    <div style="" class="q-mb-sm">
      <div class="quote-section" v-if="isReady " >
        <div class="row q-px-none">
          <div class="col-12 bg-white q-pa-md flex items-center justify-between justify-md-start loan_card" style="" >
            <div class="w-100 flex items-center justify-between">
              <div class="w-80xx flex items-center">
                <div class=" q-mr-md-lg q-mr-sm q-mt-xs flex flex-center" style="width:36px; height:36px">
                  <div v-html="wozIcons.withdrawal" />
                </div>
                <div class="flex items-center justify-between" style="width:77%">
                  <div class=" q-mr-md-none  w-autopl">
                    <div class="text-weight-medium" style="font-size: 0.89rem;" >Préstamo</div>
                    <div class="ellipsis" v-if="Object.values(loan).length > 0 " >N° 619{{loan.loan_number}}</div>
                    <div class=" text-grey-8 ellipsis"  v-else >No tienes ningun préstamo</div>
                  </div>
                </div>
              </div>
              <div class="q-mr-none cursor-pointer flex items-center">
                <div class="q-ml-md q-ml-md-none q-pl-md-md  text-end">
                  <div v-if="Object.values(loan).length > 0 ">
                    <div class="text-weight-medium text-right">
                      <q-chip class="q-ma-none q-px-lg" :color="loanStatus(loan.status).color" :text-color="loanStatus(loan.status).texColor" >
                        {{ loanStatus(loan.status).text }}
                      </q-chip>
                    </div>
                    <!-- <div class="text-weight-medium q-pt-xs q-mr-xs text-right " style="">Gs. {{numberFormat(loan.amount)}}</div> -->
                  </div>
                  <div class="text-weight-bold text-subtitle2 q-pt-sm cursor-pointer" @click="router.push('/apply')" v-else>Solicitar</div>
                </div>
                <q-btn round flat class="q-ml-md-md q-pt-sm" @click="goTo()" size="sm"> 
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
      <!-- <div v-else-if="isReady && Object.values(loan).length == 0" >
        <div class="w-100 column items-center q-pt-md">
            <q-img
              :src="sadface"
              height="80px"
              width="80px"
            />
      
          <div class="w-100 text-center text-h6 text-weight-medium">
            No tienes ningún préstamo <br>aprobado 
          </div>
        </div>
      </div> -->
      <div class="quote-section" v-else>
        <div class="row q-px-none">
          <div class="col-12 bg-white q-pa-md flex items-center justify-between justify-md-start loan_card" style="" >
            <div style="" class="w-10">
              <!-- <div v-html="wozIcons.withdrawal" /> -->
              <q-skeleton type="rect"  />
            </div>
            <div class="flex items-center justify-between  w-80 ">
              <div class=" q-mx-sm  w-50">
                <div class="text-weight-medium"><q-skeleton type="rect" /></div>
                <div class="text-weight-bold q-mt-xs"><q-skeleton type="rect" /></div>
              </div>
              <div class="q-mx-sm w-50 text-end">
                <div class="text-weight-medium text-right"><q-skeleton type="rect" /></div>
                <div class="text-weight-medium q-mt-xs text-right"><q-skeleton type="rect" /></div>
              </div>
            </div>
            <div class="w-10">
              <q-skeleton type="rect"  />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="q-pb-md" >
      <div class="row">
        <div class="col-12 flex items-center justify-between q-pb-sm" style="position: relative; height: 3rem;">
          <!-- <div class="text-subtitle1 q-mt-sm text-black-9 text-weight-medium" > 
            {{ loan.status == 1 ? 'Mis solicitudes de préstamo' : 'Mis préstamos' }}
          </div> -->
          <div v-html="wozIcons.informconf" class="q-mt-md inforcof__icon2"/>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import { useAuthStore } from '@/services/store/auth.store'
  import util from '@/util/numberUtil'
  import { inject, ref, onMounted } from 'vue'
  import sadFace from '@/assets/images/sadFace.svg'
  import wozIcons from '@/assets/icons/wozIcons';
  import { useLoanStore } from '@/services/store/loan.store';
  import { useQuasar } from 'quasar';
  import { useRouter } from 'vue-router'

  export default {
    setup() {
      //vue provider
      const q = useQuasar()
      const user = useAuthStore().user;
      const icons = inject('ionIcons')
      const numberFormat = util.numberFormat
      const isReady = ref(false)
      const sadface = sadFace
      const loanStore = useLoanStore() 
      const loan = ref({}) 
      const loading = ref(true);
      const router = useRouter()

      const activeLoan = () => {
        loanStore.getLoan(user.id).then((data) => {
          if(!data.code)  throw data
          loan.value = data.data ? Object.assign(data.data) : {} 
          
          loadingShow(false)
          setTimeout(() => {
            isReady.value = true
          }, 500)
        }).catch((e) => {
          isReady.value = true

          showNotify('negative', 'error al obtener prestamo activo')
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
      const loadingShow = (state) => {
        loading.value = state;
      }
      const loanStatus = (state) => {
        const status = [
          {text:'Cancelado', color:'negative', texColor:'white' },
          {text:'Pendiente', color:'warning', texColor:'white' },
          {text:'Aprobado', color:'chip', texColor:'positive' },
          {text:'Pagada',    color:'chip', texColor:'positive' },
          {text:'No pagado', color:'deep-orange-13', texColor:'white' },
        ]
        return status[state]
      }
      const goTo = () => {
        if(Object.values(loan.value).length == 0){

          router.push('/apply')
          return
        }
        router.push('/loan')
      }
      onMounted(() => {
        activeLoan()
        window.Echo
        .channel('userUpdateEvent'+user.id)
        .listen('UserUpdateEvent', async () => {
          activeLoan()
        })
      })
      // Data
      return{
        icons,
        user,
        numberFormat,
        isReady,
        sadface,
        wozIcons,
        loan,
        router,
        loanStatus,
        goTo
      }
    },
  }

</script>
<style lang="scss" scoped>
.loan_card{
  border-radius:15px;
  //box-shadow: 0px 5px 5px 0px #aaaaaa
}
.loan_container{
  border-bottom: 1px solid #d3d3d3;
}
.w-80 {
  width: 85%;
}
.w-80xx {
  width: 80%;
}
.w-50 {
  width: 46%;
}
.w-10 {
  width: 6%;
}
.inforcof__icon2{
  position: absolute;
  right: 0rem;
  // margin-top: 0.2rem;
  transform: translateY(-0.5rem) scale(0.95)
}
.w-autopl{
  width: auto;
}  
@media screen and (max-width: 780px){
  .w-80 {
    width: 40%;
  }
  .w-80xx {
    width: 65%;
  }
  .w-50 {
    width: 40%;
  }
  .w-autopl{
    width: 100%;
  }
  //.loan_card > div:nth-child(1){ width: 10%!important; }
  //.loan_card > div:nth-child(2){ width: 81%!important; }
  //.loan_card > div:nth-child(3){ width: 8%!important; }

}
</style>
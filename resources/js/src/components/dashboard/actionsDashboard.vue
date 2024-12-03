<template>
  <div class="q-py-xs q-px-md  q-pb-none" style="height: 100%; overflow: hidden;">
    <div>
      <div class="text-subtitle1 text-weight-medium q-mt-none text-dark">¿Qué puedes hacer?</div>
    </div>
    <div class="q-mt-md-md q-mt-xs-md">
      <div class="row">
        <div class="col-3 q-px-xs">
          <q-btn color="transparet" flat no-caps class="q-px-xs q-py-none actions-button w-100" :class="{'rekutu-efect': activeRekutu ==='yes'}" to="/apply" >
            <div v-if="loan.status == 3 && loan.red_tapes.use_count < 3">
              <q-icon :name="iconis.ionRepeat" size="2.3rem" class="q-mt-xs"/>
            </div>
            <div class="q-mt-xs" v-html="icons.solicitar" v-else />
            <span class="q-mt-none text-dark text-body2">{{ loan.status == 3 && loan.red_tapes.use_count < 3 ? 'Rekutu' : 'Prestamo'}}</span>
          </q-btn>
        </div>
        <div class="col-3 q-px-xs">
          <q-btn color="transparet" flat no-caps class="q-px-xs q-py-none actions-button w-100" :to="directTransfer !== 'true' ? '/transfer': '/transfer_send'">
            <div class="q-mt-xs" v-html="icons.transferir" />
            <span class="q-mt-none text-dark text-body2">Transfer.</span>
          </q-btn>
        </div>
        <div class="col-3 q-px-xs">
          <q-btn color="transparet" flat no-caps class="q-px-xs q-py-none actions-button w-100" to="/deposit" >
            <div class="q-mt-xs" v-html="icons.cargar" />
            <span class="q-mt-none text-dark text-body2">Cargar</span>
            <div class="flex flex-center unavailable-button" style="cursor: not-allowed; border-radius: 14px;">
              <q-icon name="eva-lock-outline" size="md" color="grey-3"></q-icon>
            </div>
          </q-btn>
        </div>
        <div class="col-3 q-px-xs">   
          <q-btn color="transparet" flat no-caps class="q-px-xs q-py-none actions-button w-100">
            <div v-html="icons.pagoYa" />
            <div class="flex flex-center unavailable-button" style="cursor: not-allowed; border-radius: 14px;">
              <q-icon name="eva-lock-outline" size="md" color="grey-3"></q-icon>
            </div>
          </q-btn>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import wozIcons from '@/assets/icons/wozIcons'
  import { useAuthStore } from '@/services/store/auth.store'
  import { useLoanStore } from '@/services/store/loan.store';
  import { ref, onMounted, inject } from 'vue'

  export default {
    setup() {
      //vue provider
      const user = useAuthStore().user;
      const icons =  wozIcons
      const iconis =  inject('ionIcons')
      const loanStore = useLoanStore() 
      const loan = ref({}) 
      const activeRekutu = ref('')

      const activeLoan = () => {
        loanStore.getLoan(user.id).then((data) => {
          if(!data.code)  throw data
          loan.value = data.data ? Object.assign(data.data) : {} 
          
          isRekutu()
          loadingShow(false)
        }).catch((e) => {
          // isReady.value = true

          // showNotify('negative', 'error al obtener prestamo activo')
        })
      }
      const isRekutu = () =>{
       if(!localStorage.getItem('rekutu') ){
          if(loan.value.status == 3 && loan.value.red_tapes.use_count < 3){
              localStorage.setItem('rekutu', 'yes')
          }
        }
        activeRekutu.value = localStorage.getItem('rekutu')

      }
      onMounted(() => {
        activeLoan()
      })
      return{
        icons,
        iconis,
        user,
        loan,
        activeRekutu,
        directTransfer: localStorage.getItem('showTransfer')

      }
    },
  }
</script>

<style lang="scss">
  .actions-button{
    border: 1.3px solid #c7c7c7!important;
    border-radius: 15px!important;
    height: 70px!important;
    width: 100%!important;
    
    & .q-btn__content{
      display: flex!important;
      flex-direction: column!important;
      justify-content: space-evenly!important;
      align-items: center!important;
    }
  }

  .rekutu-efect {

--border-angle: 0turn; // For animation.
--main-bg: conic-gradient(
    from var(--border-angle),
    rgb(255, 255, 255),
    rgb(255, 255, 255) 5%,
    rgb(255, 255, 255) 60%,
    rgb(255, 255, 255) 95%
  );

border: solid 3px transparent!important;
border-radius: 2em;
--gradient-border: conic-gradient(from var(--border-angle), #ffc701 0%, #ffc701, #ffffff 90%, #fff);


background: 
  // padding-box clip this background in to the overall element except the border.
  var(--main-bg) padding-box,
  // border-box extends this background to the border space
  var(--gradient-border) border-box, 
  // Duplicate main background to fill in behind the gradient border. You can remove this if you want the border to extend "outside" the box background.
  var(--main-bg) border-box;

background-position: center center;

animation: bg-spin 4s linear infinite;
@keyframes bg-spin {
  to {
    --border-angle: 2turn;
  }
}
}

@property --border-angle {
syntax: "<angle>";
inherits: true;
initial-value: 0turn;
}
</style>
<template>
  <div class="q-py-sm q-px-md q-px-md-lg" >
    <div class=" q-pb-sm" >
      <div class="row">
        <div class="col-12 flex items-center justify-between">
          <div class="text-subtitle1 q-mt-sm text-dark text-weight-bold">Mis préstamos</div>
        </div>
      </div>
    </div>
    <div style="">
      <div class="quote-section" v-if="isReady">
        <div class="row q-px-none">
          <div class="col-12 bg-white q-pa-md flex items-center justify-between justify-md-start loan_card" style="" >
            <div>
              <div v-html="wozIcons.withdrawal" />
            </div>
            <div class="flex items-center justify-between  w-80 ">
              <div class=" q-mr-md-none q-pl-md-md q-pl-sm w-50">
                <div class="text-weight-medium">Préstamo</div>
                <div class="text-weight-bold q-mt-xs">N° 619333455</div>
              </div>
              <div class="q-ml-md q-ml-md-none q-pl-md-md w-50 text-end">
                <div class="text-weight-medium text-right">Capital pendiente</div>
                <div class="text-weight-medium q-mt-xs text-right">Gs. {{numberFormat(5000000)}}</div>
              </div>
            </div>
            <div>
              <q-btn round flat class="q-ml-md-md " > 
                <q-icon
                  name="eva-arrow-ios-forward-outline"
                  size="xs"
                  color="black"
                />
              </q-btn>
            </div>
          </div>
        </div>
      </div>
      <div v-else>
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
      </div>
    </div>
  </div>
</template>
<script>
  import { useAuthStore } from '@/services/store/auth.store'
  import util from '@/util/numberUtil'
  import { inject, ref } from 'vue'
  import sadFace from '@/assets/images/sadFace.svg'
  import wozIcons from '@/assets/icons/wozIcons';

  export default {
    setup() {
      //vue provider
      const user = useAuthStore().user;
      const icons = inject('ionIcons')
      const numberFormat = util.numberFormat
      const isReady = true
      const sadface = sadFace
      // Data
      return{
        icons,
        user,
        numberFormat,
        isReady,
        sadface,
        wozIcons
      }
    },
  }

</script>
<style lang="scss" scoped>
.loan_card{
  border-radius:23px;
  box-shadow: 0px 5px 5px 0px #aaaaaa
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
  width: 85%;
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
  .loan_card > div:nth-child(1){ width: 10%; }
  .loan_card > div:nth-child(2){ width: 82%; }
  .loan_card > div:nth-child(3){ width: 8%; }

}
</style>
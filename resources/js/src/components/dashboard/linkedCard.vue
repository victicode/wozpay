<template>
  <div>
    <div class="q-py-md  q-px-md linked_section bg-white" v-if="ready">
      <div class="flex items-center justify-between linked_container">
        <div class="text-subtitle1 text-weight-medium">
          <div class="flex items-center"> 
            <h6 class=" text-subtitle1 text-weight-medium  q-mr-sm text-dark">
              Vincular tarjeta de crédito o debito
            </h6>
            <div>
              <q-icon
                :name="icons.outlinedAddCard "
                size="sm"
                @click="showToltip"
                color="dark"
              >
              <q-tooltip 
                anchor="top middle" 
                self="bottom middle" 
                class="bg-positive" 
                :offset="[10, 10]" 
                v-model="showing"
              >
               Vincula tu tarjeta
              </q-tooltip>
              </q-icon>
            </div>
          </div>
          <div class="linked_description" >
            Adjuntar tu tarjeta para débito automático y más.
          </div>
        </div>
        <div class="q-mb-xs">
          <q-icon
            name="eva-arrow-ios-forward-outline"
            size="sm"
            @click="showToltip"
            color="lightgdark"
          />
        </div>
      </div>
    </div>
    <div class="q-py-sm q-px-md q-px-md-lg" v-else>
      <div class=" q-pb-sm" >
        <div class="row">
          <div class="col-12 flex items-center justify-between">
            <div class="text-subtitle1 q-mt-sm text-dark text-weight-bold">Mis productos</div>
          </div>
        </div>
      </div>
      <div style="">
        <div class="quote-section">
          <div class="row q-px-none">
            <div class="col-12 bg-white q-pa-md  flex items-center justify-between justify-md-start loan_card" style="" >
              <div class="w-100 flex items-center justify-start justify-md-start q-pb-md" style="border-bottom: 1px solid lightgrey ">
                <div class="q-mr-md q-mt-xs">
                  <q-icon :name="icons.outlinedAddCard" class="" size="sm" />
                </div>
                <div class="flex items-center justify-between  w-80 ">
                  <div class=" q-ml-xs q-mr-md q-mr-md-none q-pl-md-md">
                    <div class="text-weight-medium">Tarjeta de crédito</div>
                    <div class="text-weight-bold ">N° ********* 1234 </div>
                  </div>
                  <div class="q-ml-lg q-ml-ml-none">
                    <q-chip color="positive" text-color="white" >
                      Vinculada
                    </q-chip>
                  </div>
                </div>
                
              </div>
              <div class="w-100 flex items-center justify-start justify-md-start q-mt-md ">
                <div class="q-mr-md q-mt-xs">
                  <q-icon :name="icons.outlinedAccountBalance" class="" size="sm" />
                </div>
                <div class="flex items-center justify-between  w-80 ">
                  <div class=" q-ml-xs q-mr-md q-mr-md-none q-pl-md-md">
                    <div class="text-weight-medium">Caja de ahorro</div>
                    <div class="text-weight-bold ">N° 916{{ user.dni }} </div>
                  </div>
                  <div class="q-ml-lg q-pl-sm q-ml-md-none q-pl-md-md text-end">
                    <div class="text-weight-medium text-right">Disponible</div>
                    <div class="text-weight-medium  text-right">Gs. {{numberFormat(5000000)}}</div>
                  </div>
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
  import { inject, ref } from 'vue'
  import util from '@/util/numberUtil'

  export default {
    setup() {
      //vue provider
      const user = useAuthStore().user;
      const icons = inject('ionIcons')
      const showing = ref(false)
      const ready = true
      const numberFormat = util.numberFormat

      // Methods
      const showToltip = () => {
        showing.value = true
        setTimeout(() => {
          showing.value = false
          
        }, 3500);
      }
      // Data
      return{
        icons,
        user,
        showing,
        ready,
        showToltip,
        numberFormat,
      }
    },
  }

</script>
<style lang="scss">
.w-100 {
  width: 100%;
}
.linked_section{
  height: 100%; 
  overflow: hidden; 
  border-top:10px solid lightgray; 
  border-bottom:10px solid lightgray;
}
.linked_description {
  font-size: 12px; 
  color:lightgray ; 
}
.linked_container{
  border-bottom: 1px solid #d3d3d3;
}

</style>
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
  width: 90%;
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
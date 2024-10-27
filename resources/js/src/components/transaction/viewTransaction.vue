<template>
  <div>
    <div class="q-px-md q-mt-lg q-px-md-xl">
      <div class="recipe__card bg-white q-py-md ">
        <div class="recipe__card--header flex items-center w-100 q-pa-md q-px-md-lg ">
          
        </div>
        <div class="q-px-md q-px-md-lg">
          <div class="recipe__list q-pt-sm q-mt-xs q-pb-xs">
            <div class="text-subtitle1 text-weight-bold q-pl-xs">Monto</div>
            <div class="text-grey-8 text-caption text-weight-medium q-pl-xs">Cantidad de dinero en Guaranies</div>
            <div class="text-primary text-weight-bold text-body1 q-pl-xs">
              Gs. {{ numberFormat(200000) }}
            </div>
          </div>
          <div class="recipe__list q-pt-sm q-mt-xs q-pb-xs">
            <div class="text-subtitle1 text-weight-bold q-pl-xs">Enviado a</div>
            <div class="text-grey-8 text-caption text-weight-medium q-pl-xs ">Titular Woz Pay</div>
            <div class="text-primary text-weight-bold text-body1 q-pl-xs">
              Victor Rivero
            </div>
          </div>
          <div class="recipe__list q-pt-sm q-mt-xs q-pb-xs">
            <div class="text-subtitle1 text-weight-bold q-pl-xs">Documentación</div>
            <div class="text-grey-8 text-caption text-weight-medium q-pl-xs">Documento de identificación</div>
            <div class="text-primary text-weight-bold text-body1 q-pl-xs">
              {{ numberFormat(27132357) }}
            </div>
          </div>
          <div class="recipe__list q-pt-sm q-mt-xs q-pb-xs">
            <div class="text-subtitle1 text-weight-bold q-pl-xs">Concepto</div>
            <div class="text-grey-8 text-caption text-weight-medium q-pl-xs">Motivo del envio</div>
            <div class="text-primary text-weight-bold text-body1 q-pl-xs">
              pago
            </div>
          </div>
    
        </div>
        <div class="q-px-md-xl q-mb-md">
          <div class="q-px-xl q-mt-lg q-px-md-xl q-mx-md-xl">
            <q-btn 
              color="primary" class="w-100 q-pa-md back__to" 
              no-caps
              label="Volver al incio"
              @click="router.go(-1)"
            >
            </q-btn>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script >
  import { inject } from 'vue';
  import { useRoute, useRouter } from 'vue-router';
  import wozIcons from '@/assets/icons/wozIcons'
  import { useQuasar } from 'quasar';
  import { useTransactionStore } from '@/services/store/transaction.store'
  import util from '@/util/numberUtil'

  export default {
    setup () {
      //vue provider
      const icons = inject('ionIcons')
      const route = useRoute();
      const router = useRouter();
      const $q = useQuasar()
      const transactionType = route.params.type 
      const id = route.params.id 

      const storeTransaction = useTransactionStore()
      const transaction = ref({})
      const numberFormat = util.numberFormat

      const getTransaction = () => {
        storeTransaction.getTrasactionByData(transactionType, id)
        .then((data) => {
          console.log(data)
          // transaction.value = data.data
        })
      }
      onMounted(()=>{
        getTransaction()
      })
      return {
        icons,
        router,
        route,
        wozIcons,
        numberFormat,
      }
    }
  };
</script>
<style lang="scss" scoped>
.donwload {
  border-radius: 15px!important;
}
.back__to  {
  border-radius: 50px!important;
}
.w-100{
  width: 100%;
}
.w-50 {
  width: 50%;
}
.recipe__card {
  border-radius: 20px;
  &--header {
    border-bottom: 1.5px solid $primary;
  }
}
.recipe__list{
  border-bottom: 1px solid $grey-6;
}
.boxNoVisible {
  width: 72px;
  height: 72px;
  visibility: hidden;
}
.h-100{
  height: 100%;
}
#topbarLayout{
  height: 10%;
  width: 100%;
  // border-bottom: 1px solid lightgray;
}
</style>

<style lang="scss">
.transfer-icon {
  &  > svg {
    transform: rotate(-45deg) scale(0.8);
  }
}
.transfer__line {
  border-radius: 155px;

  & .q-linear-progress__track{
    opacity: 1;
    border-radius: 155px;
  }
  & .q-linear-progress__model {
    border-radius: 155px;
  }
}
</style>
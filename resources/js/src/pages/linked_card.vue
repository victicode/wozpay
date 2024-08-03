<template>
  <div class="section_page q-mt-lg q-pt-lg">
    <div class="">
      <div class="text-subtitle1 text-weight-bold text-center">Adjuntar tarjeta de crédito o débito</div>
      <div class="q-px-md-xl q-px-md">
        <div class="q-pb-lg q-pt-sm q-px-md q-px-md-lg card_form q-mt-md">
          <div class="flex flex-center">
            <q-icon :name="icons.outlinedAddCard" size="lg" color="primary" />
          </div>
          <div class="q-mt-md">
            <q-input outlined v-model="formCardData.card" :label="`N° de tarjeta de  ${formCardData.card_type.value == 2 ? 'débito'  : 'crédito' } `" class="card_input" />
          </div>
          <div class="q-mt-md">
            <q-select outlined v-model="formCardData.card_type" :options="options" class="card_input" option-label="text" option-value="value" label="Seleccione su tipo de tarjeta" />

          </div>
          <div class="q-mt-md">
            <q-input outlined v-model="formCardData.card_due_date" label="Fecha de vencimiento" class="card_input" />
          </div>
          <div class="q-mt-md">
            <q-input outlined v-model="formCardData.card_cvc" label="Código de seguridad" class="card_input" />
          </div>
        </div>
      </div>
      <div class="q-px-lg q-mt-xl q-px-md-xl q-mx-md-xl">
        <q-btn 
          color="primary" class="w-100 q-pa-sm q-mb-lg  link_button" 
          no-caps
          :loading="loading"
          @click="goTo()"
        >
          <div class="text-white q-mt-sm text-subtitle1 text-weight-medium"  >
            Vincular
          </div> 
        </q-btn>
      </div>
    </div>
  </div>
</template>
<script>
  import { useAuthStore } from '@/services/store/auth.store'
  import { inject, ref } from 'vue'
  import util from '@/util/numberUtil'
  import { useQuasar } from 'quasar'
  import { useRoute, useRouter } from 'vue-router'

  export default {
    setup() {
      //vue provider
      const user = useAuthStore().user;
      const numberFormat = util.numberFormat
      const icons = inject('ionIcons')
      const q = useQuasar()
      const router = useRouter()
      const route = useRoute()
      const loading = ref(false)
      const options = [
        { value: '1', text: 'Crédito'},
        { value: '2', text: 'Débito'}
      ]

      const formCardData = ref({
        card:'',
        card_type: options[parseInt(route.params.id_card) - 1],
        card_due_date:'',
        card_cvc:'',
      })

      // Data
      
      const selectCard = ref(0)
      const goTo = () => {
        if(!verify()){
          showNotify('negative', 'Debe seleccionar el tipo de tarjeta')
          return
        }
        router.push()
      }
      const verify = () => {
        
        return selectCard.value !== 0
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

      return{
        icons,
        user,
        numberFormat,
        selectCard,
        formCardData,
        options,
        loading,
        goTo,
      }
    },
  }

</script>
<style>

</style>
<style lang="scss" scoped>
  .link_button  {
    border-radius: 15px!important;
  }
  .w-100{
    width: 100%;
  }
  .card_form{
    border-radius: 15px;
    border: 1.8px solid #bacdfd
  }
  .section_page {
    background: white;
    height: 100%;
    width: 100%;
    border-top-left-radius: 50px;
    border-top-right-radius: 50px;
  }
</style>
<style lang="scss">
.text-decoration-underline{
  text-decoration: underline;
}
.card_input {
  & .q-field__control{
    border-radius: 12px!important;
    height: 50px
  }
  & .q-field__label{
    transform: translateY(5%)
  }
  &.q-field--focused .q-field__label, &.q-field--float .q-field__label{
    z-index: 100;
    background: white!important;
    font-weight: 600;
    max-width: 133%;
    padding: 0px 5px;
    transform: translateY(-120%) translateX(4%) scale(0.75)!important;
  }
  & .q-field__control-container {
    padding-top: 10px!important;
  }
  & .q-field__control {
    min-height: auto!important;
  }
  & .q-field__native{
    padding-top: 10px!important;
    font-weight: 600;
  }
  & .q-field__append{
    transform: translateY(5%)
  }
  

}
@media screen and (max-width: 780px){
  .card_input {
    & .q-field__bottom{
      transform: translateY(0px);
    }
  }
}

</style>
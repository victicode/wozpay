<template>
  <div>
    <q-dialog v-model="dialog"  persistent class="productCreate__modal">
      <q-card class="position-relative dialog__product"  style="width: 100%;">
        <q-card-section class="flex q-pb-sm w-100 items-center justify-between">
          <div class="text-subtitle1 text-weight-bold q-mr-md">
            Buscador
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
        <q-card-section class=" text-center q-pt-md q-pb-none q-px-none card__product  q-py-md" style="    ">

          <div class="q-mb-lg text-subtitle1 text-bold q-px-md">
            <q-input
              class="login-input"
              outlined
              clearable
              :clear-icon="'eva-close-outline'"
              color="positive"
              v-model="search"
              label="Nombre del producto"
            />
          </div>
          <q-btn label="Buscar"  color="grey-8" :loading="loading" @click="searchProduct()"/>
        </q-card-section>
      </q-card>
    </q-dialog>
  </div>
</template>
<script>
  import { useQuasar } from 'quasar';
  import { inject, ref, } from 'vue';
  
  export default {
    props: {
      show: Boolean,
    },
    emits: ['hiddeModal', 'updateList'],
    setup (props, { emit }) {
      const dialog = ref(props.show);
      const icons = inject('ionIcons')
      const loading = ref(false)
      const search = ref('')

      const hideModal = () => {
        emit('hiddeModal')
      }  

      const searchProduct = () => {
        emit('updateList', search.value??'')
        hideModal()
      }
      watch(() => props.show, (newValue) => {
        dialog.value = newValue
      });

      return {
        dialog,
        icons,
        loading,
        search,
        hideModal,
        searchProduct
      }
    }
  };
</script>
<style lang="scss">
.login-input {
  & .q-field__control {
    border-radius: 10px!important;
    height: 59px
  }
  & .q-field__label{
    transform: translateY(11%)
  }
  &.q-field--focused .q-field__label, &.q-field--float .q-field__label{
    z-index: 100;
    background: white!important;
    font-weight: 600;
    max-width: 133%;
    padding: 0px 10px;
    transform: translateY(-125%) translateX(4%) scale(0.75)!important;
  }
  
  & .q-field__native{
    padding-top: 15px!important;
    font-weight: 600;
  }
  & .q-field__append{
    transform: translateY(5%)
  }

}
@media screen and (max-width: 780px){
  .login-input {
    & .q-field__bottom{
      transform: translateY(15px);
    }
  }
}
</style>
<template>
  <div class="q-px-md-lg q-px-md  q-pt-md-md q-pt-sm search_trasaction q-pb-md-md q-pb-sm">
    <div class="w-100 flex justify-between items-center available__money q-py-sm q-px-md">
      <div class="flex items-center">
        <q-icon
          :size="'sm'"
          :name="icons.outlinedAccountBalance"
        />
        <div class="text-weight-bold q-ml-xs">Dinero disponible</div>
      </div>
      <div class="text-weight-bold text-primary">Gs. {{capitalByUser()}}</div>
    </div>
    <div>
      <q-input
        class="search__trasaction q-pt-md q-pb-sm"
        outlined
        clearable
        clear-icon="eva-close-outline"
        color="positive"
        v-model="search"
        name="id_user"
        label="Escribe un número de documento"
        mask="###.###.###"
        reverse-fill-mask
        :rules="searchRules"
        autocomplete="off"
        ref="searchRef"
        bg-color="white"
        @change="applyFilter"
      >
        <template v-slot:prepend>
          <q-icon name="eva-search-outline" />
        </template>
      </q-input>
    </div>
    <div>
      <q-select 
        class="setMonth q-pb-none" 
        v-model="selectedMonth" 
        :options="options" 
        label="Escoge un mes" 
        dropdown-icon="eva-chevron-down-outline"
        behavior="menu"
        option-label="text" 
        option-value="value"
        @update:model-value="applyFilter"
      />
    </div>
  </div>
</template>
<script>
import { inject, ref } from 'vue'
import util from '@/util/numberUtil'
import { useAuthStore } from '@/services/store/auth.store';
import { useWalletStore } from '@/services/store/wallet.store'
import wozIcons from '@/assets/icons/wozIcons';
import { storeToRefs } from 'pinia'

export default {
  setup () {
    const icons = inject('ionIcons')
    const { user  } = storeToRefs(useAuthStore())
    const { balances } = storeToRefs(useWalletStore())
    const numberFormat = util.numberFormat
    const emitter = inject('emitter');
    const search = ref('')
    

    //ref
    const searchRef = ref(null)
    // rules
    const searchRules = [
      val => (/[,%"'();&|<>]/.test(val) == false ) || 'No debe contener "[](),%|&;\'" ',
    ]
    
    const options = [
      { value: '1', text: 'Enero'},
      { value: '2', text: 'Febrero'},
      { value: '3', text: 'Marzo'},
      { value: '4', text: 'Abril'},
      { value: '5', text: 'Mayo'},
      { value: '6', text: 'Junio'},
      { value: '7', text: 'Julio'},
      { value: '8', text: 'Agosto'},
      { value: '9', text: 'Septiembre'},
      { value: '10', text: 'Octubre'},
      { value: '11', text: 'Noviembre'},
      { value: '12', text: 'Diciembre'},
    ]
    const selectedMonth = ref(options[new Date().getMonth()])

    const capitalByUser = () => {
      if(user.value.rol_id != 3){
        return numberFormat((balances.value.wallet - balances.value.loans) + balances.value.paysRecieve)
      }
      return numberFormat(balances.value.wallet);
    }
    const applyFilter = () => {
      emitter.emit('refreshByFilter', { month: selectedMonth.value.value, search: search.value});
    }
    return { 
      user,
      icons,
      search,
      searchRef,
      searchRules,
      wozIcons, 
      numberFormat,
      options,
      selectedMonth,
      capitalByUser,
      applyFilter,
    }
  },
}
</script>
<style lang="scss">
.search_trasaction{
  border-bottom: 0.3rem solid $grey-5 ;
}
.available__money{
  border: 0.12rem solid $grey-5;
  border-radius: 12px;
}
.search__trasaction {
  & .q-field__control{
    border-radius: 10px!important;
    height: 45px
  }
  & .q-field__label{
    transform: translateY(-25%)
  }
  &.q-field--focused .q-field__label, &.q-field--float .q-field__label{
    transition: all 0.3s ease-in;
    z-index: 100;
    background: white;
    font-weight: 600;
    max-width: 133%;
    padding: 0px 10px;
    transform: translateY(-115%) scale(0.75) translateX(-8%)!important;
  }
  
  & .q-field__native{
    padding-top: 15px!important;
    font-weight: 600;
    
  }
  & .q-field__prepend{
    transform: translateY(-8%)
  }
  & .q-field__append  {
    transform: translateY(-8%)
  }
}
@media screen and (max-width: 780px){
  .search__trasaction {
    & .q-field__bottom{
      transform: translateY(15px);
    }
  }
}

.setMonth.q-field--auto-height.q-field--labeled{
     & .q-field__control-container{
      padding-top: 0px!important;
     }
  }
  .setMonth {
    & .q-field__control{
      height: 46px!important;
      min-height: 46px!important;
    }
    & .q-field__label{
    transform: translateY(0%)
    }
    &.q-field--focused .q-field__label, &.q-field--float .q-field__label{
      z-index: 100;
      background: white;
      font-weight: 600;
      max-width: 133%;
      transform: translateY(10%)  scale(0.90)!important;
    }
    
    & .q-field__native{
      padding-top: 15px!important;
      font-weight: 600;
      justify-content: end;
      width: 100%;
      text-align: end;
    }
    & .q-field__append{
      transform: translateY(-4%)
    }
    & .q-field__messages {
      transform: translateY(-25%) translateX(-1%)
    }
  }
  @media screen and (max-width: 780px){
  .setMonth {
      & .q-field__bottom{
        transform: translateY(15px);
      }
      & .q-field__messages {
        transform: translateY(10%) translateX(-1%)
      }
    }
  }
</style>
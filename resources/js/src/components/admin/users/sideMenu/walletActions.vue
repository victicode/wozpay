<template>
  <q-expansion-item expand-separator>
    <template v-slot:header>
      <q-item-section class="text-subtitle2 text-weight-medium ">
        {{typeWallet == 1 ? 'Cargar billetera' : 'Cargar cuenta internacional'}}
      </q-item-section>
    </template>
    <q-card>
      <q-card-section class="q-py-none q-px-sm">
        <div class="q-pl-sm plus_balance q-py-xs q-mt-xs" >
          <div class="text-subtitle3">Sumar saldo</div>
          <div class="text-subtitle3">
            <q-input 
              v-model="plusAmount" 
              placeholder="Ingrese cantidad" 
              class="plus_balance__input"
              mask="###.###.###.###"
              reverse-fill-mask
              prefix="Gs."
              maxlength="15"
            />
          </div>
        </div>
        <div class="q-pl-sm plus_balance q-py-xs q-mt-xs" >
          <div class="text-subtitle3">Restar saldo</div>
          <div class="text-subtitle3">
            <q-input 
              v-model="lessAmount" 
              placeholder="Ingrese cantidad" 
              class="plus_balance__input"
              mask="###.###.###.###"
              reverse-fill-mask
              prefix="Gs."
              maxlength="15"
            />
          </div>
        </div>
        <div class="current_balance q-px-md q-py-sm q-mt-sm">
          <div class="text-subtitle3 q-mt-xs">Saldo actual</div>
          <div class="text-subtitle3 q-mt-xs">Gs.{{ typeWallet == 1 ? numberFormat(user.wallet.balance) : numberFormat(user.wallet_link.balance)  }}</div>
        </div>
        <div class="q-mt-sm w-100 q-px-sm q-pb-md">
          <q-btn  
            no-caps 
            label="Actualizar saldo" 
            color="primary" 
            class="w-100 q-pt-sm" 
            :loading="loading" 
            @click="actionWallet()" 
          > 
            <template v-slot:loading>
              <q-spinner-facebook />
            </template>
          </q-btn>
        </div>
      </q-card-section>
    </q-card>
  </q-expansion-item>
</template>
<script >
  import { ref } from 'vue';
  import { useWalletStore } from '@/services/store/wallet.store';
  import util from '@/util/numberUtil';
  import { useQuasar } from 'quasar';

  export default {
    props: {
      user: Object,
      type: Number,
    },
    setup (props) {
      //vue provider
      const q = useQuasar()
      const walletStore = useWalletStore()
      const dialog = ref(false)
      const user = props.user
      const loading = ref(false)
      const numberFormat = util.numberFormat
      const plusAmount = ref('')
      const lessAmount = ref('')
      const typeWallet = props.type
      const actionWallet = () => {
        loading.value = true
        const data = {
          user: user.id,
          amount: parseInt(plusAmount.value.replace(/\./g, '')),
          amountLess: parseInt(lessAmount.value.replace(/\./g, '')),
          type: typeWallet
        }
        walletStore.incrementsWalletAdmin(data)
        .then((data) => {
          if(data.code !== 200) throw data
          setTimeout(()=> {
            if(typeWallet == 1)user.wallet.balance = data.data.balance
            if(typeWallet == 2)user.wallet_link.balance = data.data.balance

              
    
            loading.value = false
            plusAmount.value = ''
            lessAmount .value = ''
            showNotify('positive', 'Saldo actualizado con exito.')
          },1000)
        })
        .catch((response) => {
          loading.value = false
          showNotify('negative', 'Error al actualizar')
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
      return {
        dialog,
        user,
        loading,
        numberFormat,
        plusAmount,
        lessAmount,
        typeWallet,
        actionWallet,
      }
    }
  };
</script>
<style lang="scss">

  .plus_balance {
    border-bottom: 1px solid $grey-5;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    &__input {
      & .q-field__control {
        transform: translateY(16%);
        height: 30px;
        &:before {
          border-bottom: none!important;
        }
      }
      & .q-field__label{
        transform: translateY(-90%)
      }
      
      & .q-field__native{
        padding-top: 0px!important;
        font-weight: 600;
        padding-bottom: 11px!important;
        padding-right: 10px;
        text-align: end;
      }
      & .q-field__prefix{
        color: $grey-7;
        transform: translateY(-35%) translateX(205%)
      }
    }
  }
  @media screen and (max-width: 780px){
  }
</style>
<style lang="scss" scoped>
  .current_balance {
    background: $grey-4;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-radius: 10px;
  }
  
  .w-100 {
    width: 100%;
  }
</style>
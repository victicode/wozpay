<template>
  <div class="row q-px-none">
        <div class="col-12 q-px-md-xl q-px-md">
          <q-input
            class=" amount__input-loan q-pb-md"
            clearable
            clear-icon="eva-close-outline"
            color="grey-5"
            v-model="amount"
            name="id_user"
            label="Cargar tu capital"
            mask="###.###.###"
            reverse-fill-mask
            :rules="amountRules"
            autocomplete="off"
            maxlength="11"
            bg-color="white"
          >
            <template v-slot:prepend>
              Gs.
            </template>
          </q-input>
        </div>
        <div class="col-12 q-px-md-xl q-px-md">
          <div class="q-px-md-xl w-100 ">
            <q-btn 
              color="primary" 
              no-caps
              class="w-100 q-pa-sm q-mb-md" label="Actualizar capital"  
              :loading="loading"
              @click="setNewCapital()"
            >
              <template v-slot:loading>
                <q-spinner-facebook />
              </template>
            </q-btn>
          </div>
        </div>
      </div>
</template>
<script>
  import { ref, inject, onMounted} from 'vue';
  import wozIcons from '@/assets/icons/wozIcons';
  import util from '@/util/numberUtil';
  import { useRouter } from 'vue-router';
  import { useAuthStore } from '@/services/store/auth.store';
  import { useWalletStore } from '@/services/store/wallet.store';

  export default {

    setup () {
      //vue provider
      const icons = inject('ionIcons')
      const { numberFormat } = util;
      const router = useRouter()
      const user = useAuthStore().user;
      const capitalStore = useWalletStore();
      const loading = ref(false)
      const emitter = inject('emitter')
      // data
      const amount = ref(user.wallet.balance)
      // rules
      const amountRules = [
        val => (/[,%"'();&|<>]/.test(val) == false ) || 'No debe contener "[](),%|&;\'" ',
      ]

      const setNewCapital = () => {
        if(amount.value === user.wallet.balance) return
        loading.value = true
        const data = {
          amount: parseInt(amount.value.replace(/\./g, '')),
        }
        capitalStore.setNewAdminCapital(data)
        .then((response) => {
          if(response.code !== 200) throw response
          console.log(response)
          loading.value = false
          showNotification(setNotificationData(2))
        }).catch((response) => {
          loading.value = false
          amount.value = user.wallet.balance
          showNotification(setNotificationData(3))
        })
      }
      const showNotification = ({msg, title, color}) => {
        const data = {
          newColor: color, 
          newTitle: title,
          newText: msg, 
          newIcon: 'eva-bell-outline',
          newCallback: () => emitter.emit('offModalNotification'),
        }
        emitter.emit('modalNotification', data);
      } 
      const setNotificationData = (type) => {
        return type == 2
        ?
          {
            msg:'Tu capital ha sido actualizado con exito', 
            title:'Exito🎉',
            color:'positive',
          }
        :
        {
          msg: 'Ha ocurrido un error al actualizar tu capital', 
          title: 'Oh Oh',
          color:'negative',
        }

      }
      return {
        icons,
        loading,
        wozIcons,
        router,
        numberFormat,
        amount,
        amountRules,
        setNewCapital,
      }
    }
  };
</script>
<style lang="scss">
  .w-100 {
    width: 100%!important;
  }
  .amount__input-loan {
    & .q-field__control{
      height: 100px;
    }
    & .q-field__label{
      transform: translateY(250%) translateX(-15%);
      font-size: 2rem;

      overflow: visible;
    }
    &.q-field--focused .q-field__label, &.q-field--float .q-field__label{
      transition: all 0.3s ease-in;
      z-index: 100;
      font-size: 1.3rem;
      font-weight: 600;
      max-width: 133%;
      padding: 0px 10px;
      color: black;

      transform: translateY(70%) translateX(-20%) scale(0.75)!important;
    }
    
    & .q-field__native{
      padding-top: 15px!important;
      font-weight: 400!important;
      font-size: 2rem;
      text-align: center;
      transform: translateY(28%) translateX(-0%);
    }
    & .q-field__append{
      transform: translateY(50%)
    }
    & .q-field__prepend {
      opacity: 0;
      transition: 1s all ease;
    }
    &.q-field--float {
      & .q-field__prepend {
        opacity: 1;
        color: black;
        transform: translateY(100%) translateX(50%); 

      }
    }

  }
  @media screen and (max-width: 780px){
  }
</style>
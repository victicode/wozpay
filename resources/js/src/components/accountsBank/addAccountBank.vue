<template>
  <div>
    <Transition name="inFade">
      <div v-if="ready">
        <div class="q-pa-md">
          <div class="text-subtitle1 text-weight-medium">
            Datos bancarios
          </div>
          <div>
            <q-form
              id="LoginForm"
              class="q-gutter-md"
            >
            <div class="row ">
              <div class="col-12 q-my-md">
                <q-input
                  class="account_bankForm no-display-value"
                  outlined
                  color="positive"
                  v-model="selectedBank.name"
                  disabled
                  label="Entidad Bancaria"
                  autocomplete="off"
                > 
                <template v-slot:prepend>
                  <div class="input-logo-container">

                    <div style="height: 100%; width: 100%;" :class="selectedBank.logo">
                      <div v-html="wozIcons[selectedBank.logo]" />
                    </div>
                  </div>
                </template> 
                </q-input>
              </div>
              <div class="col-12 q-my-md">
                <q-input
                  class="account_bankForm q-pb-none"
                  outlined
                  clearable
                  :clear-icon="'eva-close-outline'"
                  color="positive"
                  v-model="newBankAccount.number"
                  name="id_user"
                  label="Número de cuenta"
                  autocomplete="off"
                  :rules="rulesForm('number')"
                />
              </div>
              <div class="col-12 q-my-md">
                <q-input
                  class="account_bankForm q-pb-none"
                  outlined
                  clearable
                  :clear-icon="'eva-close-outline'"
                  color="positive"
                  v-model="user.name"
                  name="id_user"
                  label="Titular de la cuenta"
                  :rules="rulesForm('owner')"
                  autocomplete="off"
                />
              </div>
              <div class="col-12 q-my-md">
                <q-select 
                  outlined
                  class="account_bankForm" 
                  v-model="newBankAccount.type" 
                  :options="['Ahorro', 'Corriente']" 
                  label="Tipo de cuenta" 
                  clearable
                  :rules="rulesForm('type')"
                  :clear-icon="'eva-close-outline'"
                  dropdown-icon="eva-chevron-down-outline"
                />
              </div>
              <div class="col-12 q-my-md">
                <q-input
                  class="account_bankForm"
                  outlined
                  clearable
                  :clear-icon="'eva-close-outline'"
                  color="positive"
                  v-model="user.dni"
                  name="id_user"
                  label="Número de cédula"
                  mask="###.###.###"
                  reverse-fill-mask
                  :rules="rulesForm('ownerDni')"
                  autocomplete="off"
                />
              </div>
              
              <div class="col-12 q-my-md q-mb-md q-px-md-xl q-pt-md-sm ">
                <q-btn 
                  id="login-form-button" 
                  label="Agrega cuenta bancaria" 
                  unelevated
                  no-caps 
                  color="primary q-py-md" 
                  class="full-width" 
                  :loading="loading"
                  @click="addAccountBank()" 
                >
                  <template v-slot:loading>
                    <q-spinner-facebook />
                  </template>
                </q-btn>
              </div>
            </div>
            </q-form>
          </div>
        </div>
      </div>
      <div v-else>
        <div>
          <div class="q-pa-md">
            <div class="q-my-sm">
              <q-skeleton type="QBadge"  />
            </div>
            <div class="q-px-md">

              <q-skeleton type="QBtn" v-for="n in 5" :key="n"  class="w-100 q-mt-md"/>
            </div>
            <q-skeleton type="QBtn" class="w-100 q-mt-md"/>
          </div>
        </div>
      </div>
    </Transition>
  </div>
</template>
<script>
  import { inject, onMounted, ref } from 'vue'
  import wozIcons from '@/assets/icons/wozIcons'
  import { useBankAccountStore } from '@/services/store/bankAccount.store'
  import { useAuthStore } from '@/services/store/auth.store'
  import { useRoute } from 'vue-router'
  import { useRouter } from 'vue-router'

  export default {
    setup () {
      const store = useBankAccountStore()
      const selectedBank = ref({})
      const ready = ref(false)
      const route = useRoute()
      const loading = ref(false)
      const user = useAuthStore().user;
      const newBankAccount = ref({
        bank: '',
        user: user.id,
        number:'',
        type:'',

      })
      // const user = useAuthStore().user;

      const getSelectedBank = () =>{
        store.getAllBanks().then((data) =>{
          if(data.code !== 200) return

          selectedBank.value = data.data.find((bank) => bank.id == route.params.id)
          newBankAccount.value.bank = selectedBank.value.id

          setTimeout(() => {
            ready.value = true
            return
          }, 800);
        })
      }
      const addAccountBank = () => {
        
      }
      const rulesForm = (id) => {
        const iRules = {
          number:[
            val => (val !== null && val !== '') || 'El número de cuenta es requerido.',
            val => (val.length >= 8 ) || 'Formato no valido',
            val => (/[,%"' ();&|<>]/.test(val) == false ) || 'No debe contener espacios, ni "[](),%|&;\'" ',
          ],
          owner:[
            val => (val !== null && val !== '') || 'Nombre del propietario es requerido.',
            val => (val.length >= 8 ) || 'Formato no valido',
            val => (/[,%"'();&|<>]/.test(val) == false ) || 'No debe contener "[](),%|&;\'" ',
          ],
          ownerDni:[
            val => (val !== null && val !== '') || 'El número de cedula es requerido.',
            val => (val.length >= 8 ) || 'Formato no valido',
            val => (/[,%"' ();&|<>]/.test(val) == false ) || 'No debe contener espacios, ni "[](),%|&;\'" ',
          ],
          type:[
            val => (val !== null && val !== '') || 'El número de cedula es requerido.',
            val => (/[,%"' ();&|<>]/.test(val) == false ) || 'No debe contener espacios, ni "[](),%|&;\'" ',
          ],
        }
        
        return iRules[id]
      }
      onMounted(() => {
        getSelectedBank()
      })
      return { wozIcons, selectedBank, user, ready, loading, newBankAccount, addAccountBank, rulesForm}
    },
  }
</script>
<style lang="scss" >
  .no-display-value{
    
    & .q-field__native{
      opacity: 0;
    }
  }
  .account_bankForm.q-field--auto-height.q-field--labeled{
     & .q-field__control-container{
      padding-top: 0px!important;
     }
  }
  .account_bankForm {
    & .q-field__control{
      border-radius: 10px!important;
    }
    & .q-field__label{
    transform: translateY(9%)
    }
    &.q-field--focused .q-field__label, &.q-field--float .q-field__label{
      z-index: 100;
      background: white!important;
      font-weight: 600;
      max-width: 133%;
      transform: translateY(-122%) translateX(4%) scale(0.75)!important;
    }
    
    & .q-field__native{
      padding-top: 15px!important;
      font-weight: 500;
    }
    & .q-field__append{
      transform: translateY(3%)
    }
  }
  .bancoBasa{
    transform: translateX(5%) translateY(30%)
  }
  .bancoRio{
    transform: translateY(35%) translateX(10%);
  }
  .continental{
    transform: translateY(35%) translateX(20%) scale(1.2);
  }
  .eko{
    transform: translateY(30%) translateX(10%);
  }
  .itau{
    transform: translateY(36%) translateX(25%);
  }
  .sudameris{
    transform: translateY(35%) translateX(23%) scale(1.2);
  }
  .ueno{
    width: 144% !important;
    transform: translateY(30%) translateX(5%);
  }
  .wally{
    transform: translateY(30%) translateX(5%);
  }
  .input-logo-container{
    height: 50px; overflow: hidden; width: max-content;  position: absolute
  }
  @media screen and (max-width: 780px){
  .account_bankForm {
      & .q-field__bottom{
        transform: translateY(15px);
      }
    }
  }
</style>
<style lang="scss" scoped>
.w-100{
    width: 100%;
  }
</style>
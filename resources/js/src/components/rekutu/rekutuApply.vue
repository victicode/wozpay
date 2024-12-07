<template>
  <div class="w-100 q-mx-none" >
    <div class="q-pt-sm">
      <q-toolbar class="bg-white text-black q-py-sm">
        <q-toolbar-title> 
          <div class="flex items-center justify-between position-relative">
            <span class="text-subtitle1 text-weight-bold q-mt-sm q-pt-xs text-center w-100">Formulario</span>
            <span style="position: absolute; right: 2%; " class="q-pt-sm">
              <q-btn unelevated flat round  style="color: black"   icon="eva-edit-2-outline" />
            </span>
          </div>
        </q-toolbar-title>
      </q-toolbar>
      <q-list class="q-px-sm">
        <q-item class="q-py- q-px-sm" >
          <q-item-section @click="showInputModal(1, 'business')">
            <div class="flex items-center justify-between">
              <q-item-label class="q-mt-xs text-weight-bold" >
              <span class="text-body2 text-weight-bold">
                Usar mismo formulario
              </span>
              </q-item-label>
              <q-item-label caption lines="1" class="text-weight-medium text-body2">{{ countUse }}/2</q-item-label>
            </div>
          </q-item-section>
        </q-item>
        <q-separator />
      </q-list>
      <q-toolbar class="bg-white text-black q-py-sm">
        <q-toolbar-title> 
          <div class="flex items-center justify-between position-relative">
            <span class="text-subtitle1 text-weight-bold q-mt-sm q-pt-xs text-center w-100">Comprobante de ingresos</span>
          </div>
        </q-toolbar-title>
      </q-toolbar>
      <q-list class="q-px-sm">
        <q-item class="q-py- q-px-sm" >
          <q-item-section @click="showInputModal(3, 'work_certificate')">
            <div class="flex items-center justify-between">
              <q-item-label class="q-mt-xs text-weight-bold" >
              <span class="text-body2 text-weight-bold">
                Certificado laboral firmado
              </span>
              </q-item-label>
              <q-item-label caption lines="1" class="text-weight-medium text-body2 cursor-pointer">
                <div v-if="!readTapes.work_certificate " >
                  Agregar
                  </div>
                  <div v-else>
                    <q-icon name="eva-checkmark-circle-2-outline" color="positive" size="1.8rem"/> 
                  </div>
              </q-item-label>
            </div>
          </q-item-section>
        </q-item>
        <q-separator />
        <q-item class="q-py- q-px-sm" >
          <q-item-section @click="showInputModal(3, 'last_ips')">
            <div class="flex items-center justify-between">
              <q-item-label class="q-mt-xs text-weight-bold" >
              <span class="text-body2 text-weight-bold">
                Último IPS
              </span>
              </q-item-label>
              <q-item-label caption lines="1" class="text-weight-medium text-body2 cursor-pointer">
                <div v-if="!readTapes.last_ips" class="text-red">
                  Actualizar
                </div>
                <div v-else>
                  <q-icon name="eva-checkmark-circle-2-outline" color="positive" size="1.8rem"/> 
                </div>
              </q-item-label>
            </div>
          </q-item-section>
        </q-item>
        <q-separator />
      </q-list>
      <q-toolbar class="bg-white text-black q-py-sm">
        <q-toolbar-title> 
          <div class="flex items-center justify-between position-relative">
            <span class="text-subtitle1 text-weight-bold q-mt-sm q-pt-xs text-center w-100">Linea de crédito disponible</span>
          </div>
        </q-toolbar-title>
      </q-toolbar>
      <q-list class="q-px-sm">
        <q-item class="q-py- q-px-sm" >
          <q-item-section @click="showInputModal(2, 'amount')">
            <div class="flex items-center justify-between">
              <q-item-label class="q-mt-xs text-weight-bold" >
              <span class="text-body2 text-weight-bold">
                {{ user.is_first_loan ? 'Primer préstamo' : 'Préstamo' }} 
              </span>
              </q-item-label>
              <q-item-label caption lines="1" class="text-weight-medium text-body2 cursor-pointer">{{ loan.amount ? 'Gs.' + numberFormat(loan.amount) : 'Seleccionar' }}</q-item-label>
            </div>
          </q-item-section>
        </q-item>
        <q-separator />
        <q-item class="q-py- q-px-sm" >
          <q-item-section @click="showInputModal(2, 'due_date')">
            <div class="flex items-center justify-between">
              <q-item-label class="q-mt-xs text-weight-bold" >
              <span class="text-body2 text-weight-bold">
                Plazo
              </span>
              </q-item-label>
              <q-item-label caption lines="1" class="text-weight-medium text-body2 cursor-pointer">{{ loan.due_date  ? loan.due_date + ' días' : 'Seleccionar' }} </q-item-label>
            </div>
          </q-item-section>
        </q-item>
        <q-separator />
        <q-item class="q-py- q-px-sm" >
          <q-item-section>
            <div class="flex items-center justify-between">
              <q-item-label class="q-mt-xs text-weight-bold" >
              <span class="text-body2 text-weight-bold">
                Total a devolver
              </span>
              </q-item-label>
              <q-item-label caption lines="1" class="text-weight-medium text-body2 ">Gs. {{ numberFormat(loan.amountToPay) }}</q-item-label>
            </div>
          </q-item-section>
        </q-item>
        <q-separator />
      </q-list>
    </div>
    <div class="q-px-md-xl q-mx-md-xl q-pt-lg q-px-md">
      <q-btn 
        @click=" createApplyLoan()" 
        color="primary" class="w-100 q-pa-sm q-mb-xl" 
        label="Presentar solicitiud" 
        :loading="loading"
      >
        <template v-slot:loading>
          <q-spinner-facebook />
        </template>
      </q-btn>
    </div>
    <div v-if="sendLoading">
      <doneModal :dialog="sendLoading" :text="'Solicitud enviada'" />
    </div>
    <div v-if="dialog == 'redirect'">
      <redirectModal :dialog="(dialog == 'redirect')" :type="redirectType" />
    </div>
    <div v-if="dialog == 'setValue'">
      <setValueModal :isRekutu="true" :dialog="(dialog == 'setValue')" :input="input" :days="interestRate.interestRate"  @hiddeModal="hiddeModal"/>
    </div>
  </div>
</template>
<script>
  import { ref, onMounted } from 'vue';
  import { useAuthStore } from '@/services/store/auth.store'
  import { useLoanStore } from '@/services/store/loan.store'
  import { useInterestStore } from '@/services/store/interest.store.js'
  import { useQuasar } from 'quasar'
  import { useRouter } from 'vue-router';
  import redirectModal from '@/components/creditApply/modals/redirectModal.vue';
  import setValueModal from '@/components/creditApply/modals/setValueModal.vue';
  import rekutuModal from '@/components/creditApply/modals/rekutuModal.vue';
  import doneModal from '@/components/layouts/modals/doneModal.vue';
  import { storeToRefs } from 'pinia'
  import util from '@/util/numberUtil'

  export default {
    components: {
      redirectModal,
      setValueModal,
      rekutuModal,
      doneModal
    },
    setup () {
      const q = useQuasar()
      const router = useRouter()
      const { user  } = storeToRefs(useAuthStore())

      const loanStore = useLoanStore();
      const interestStore = useInterestStore();
      const numberFormat = util.numberFormat
      
      // Data
      const isCurrentLoan = ref(true)
      const sendLoading = ref(false);
      const dialog = ref('')
      const redirectType = ref(0);
      const loading = ref(false)
      const load = ref(true)

      const isUserApply = ref(true)
      const interestRate = ref(1)
      const countUse = ref(0)
      const input = {
        title: '',
        type: 1,
        index:'',
      }
      const readTapes = ref({
        work_certificate: null,
        last_ips: null,
        
      })
      const loan = ref({
        amount: null,
        amountToPay: 0,
        due_date:null,
      })

      const titleText = {
        work_certificate: 'Certificado Laboral',
        last_ips: 'Último IPS',
        amount: 'Monto de prestamo',
        due_date: 'Plazo',
      }

      // Methods
      const validateUser = () => {
        
        if(user.value.verify_status != 2   ) {
          isUserApply.value = false
          redirectType.value = user.value.verify_status == 1 ? 3 : 2
          return isUserApply.value
        }

        if(!validateCard()) {
          user.value.card && user.value.card.status == 1
          ? redirectType.value =  5
          : router.push('/link_card?redirect=1')


          isUserApply.value = false
          return isUserApply.value
        }
        const dontValidate = ['facial_verify','is_public','email_verified_at','is_first_loan','created_at','card', 'updated_at', 'deleted_at',]

        Object.entries(user.value).forEach( ([key, value]) => {
          if(dontValidate.includes(key)) return
          if(!value) isUserApply.value = false 
        });

        
        redirectType.value = 1
        return isUserApply.value
      }
      const validateCard = () => {
        return user.value.card && user.value.card.status == 2
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
      const loadingShow = (state) => {
        loading.value = state;
      }
      const loadingDone = (state) => {
        sendLoading.value = state;
      }
      const showModal = (data) => {
        dialog.value = data
      }
      const showInputModal = (type, index) => {
        input.type = type;
        input.index = index;
        input.title = titleText[index];
        input.value = type != 2 ? readTapes.value[input.index] : [loan.value[input.index]]

        showModal('setValue')
      }
      const setInput = (data) => {
        input.type != 2 
        ? readTapes.value[input.index] = isFile(data) 
        : loan.value[input.index] = data
        calulateTotalAmount()
      }
      const isFile = (data) => {
        if(input.index == 'informconf' || input.index == 'work_certificate') return data[0]
        return data
      }
      const calulateTotalAmount = () => {
        if(input.index == 'due_date' || input.index == 'amount'){
          let interestsRate =  interestRate.value.interestRate.find(interest => interest.days == loan.value.due_date)
          if(!interestsRate) return 0
          let interestToAmount = interestsRate.interest/100;
          loan.value['amountToPay'] = isNaN((parseInt(loan.value.amount) * interestToAmount) + parseInt(loan.value.amount)) 
          ? 0 
          : (parseInt(loan.value.amount) * interestToAmount) + parseInt(loan.value.amount)
        }
      } 
      const hiddeModal = (data) => {
        dialog.value = ''
        if(!data) return
        setInput(data)
      }
      
      const createApplyLoan = () => {
        if(!validateForm()){
          showNotify('negative', 'Tienes que llenar todo el formulario')
          return
        }

        loadingShow(true)
        const formData = new FormData()

        formData.append('last_ips', readTapes.value.last_ips.length)
        formData.append('work', readTapes.value.work_certificate)
        formData.append('amount', loan.value.amount)
        formData.append('amountToPay', loan.value.amountToPay)
        formData.append('due_date', loan.value.due_date)
        formData.append('isRekutu', true)

        readTapes.value.last_ips.forEach((ips, index) => {
          formData.append('last_ips'+index, ips)
        });

        loanStore.createLoan(formData)
        .then((data) => {
          if(!data.code) throw data
          loadingDone(true)
          loadingShow(false)
          setTimeout(() => {
            router.push('/dashboard')
          }, 3500);
        }).catch((e) => {
          console.log(e)
          loadingShow(false)
          showNotify('negative', 'Error al enviar la solicitud')
        })
        
      }
      const validateForm = () => {
        let isValid = true 
        const dontValidate = ['amountToPay']
        const formInputs = Object.assign({}, readTapes.value, loan.value);

        Object.entries(formInputs).forEach( ([key, value]) => {
          if(dontValidate.includes(key)) return
          if(!value) isValid = false
        });
        
        return isValid
      }
      const activeLoan = () => {
        loanStore.getLoan(user.value.id).then((data) => {
          if(!data.code)  throw data
          if(data.data){
            countUse.value = data.data.red_tapes.use_count;
            isCurrentLoan.value = data.data.status !=3
              ? true 
              : false 
            load.value = false
            return
          }
          isCurrentLoan.value = false
          load.value = false
        }).catch((e) => {
          showNotify('negative', 'Error al obtener prestamo activo')
        })
      }
      const getInterestRate = () => {
        interestRate.value = []
        interestStore.getInterestRate()
        .then((response) => {
          if(response.code !== 200) throw response
          setTimeout(() => {
            interestRate.value = response.data;
          }, 500);
        })
        .catch((respnse) => {
          console.log(respnse)
          showNotify('negative', 'Error al obtener las tasas de intereses.')
        })
      }

      onMounted(() => {
        if(!validateUser()){
          showModal('redirect')
        }
        getInterestRate()
        activeLoan()

      })

      return {
        loading,
        load,
        countUse,
        sendLoading,
        user,
        dialog,
        readTapes,
        redirectType,
        loan,
        input,
        numberFormat,
        isCurrentLoan,
        router,
        interestRate,
        showModal,
        hiddeModal,
        showInputModal,
        createApplyLoan,
        
      }
    }
  };
</script>
<style lang="scss">
.inforconf__icon{
  position: absolute; 
  right: -8.5rem; 
  bottom: -1.8rem
}
#logout-button {
  padding: 10px;
}
.apply_section {
  height: 115%; 
  overflow-y: auto;
  &::-webkit-scrollbar {
    display: none;
  }
}
.text-auto-phase {
  word-break: auto-phrase!important;
}
.no-header-steper {
  box-shadow: none!important;

  & .q-stepper__header {
    display: none;
  }
  & .q-stepper__step-inner{
    padding: 0px!important
  }
}
@media screen and (max-width: 780px){
  .inforconf__icon{
    transform: scale(0.6);
    right: -6.7rem; 
    bottom: -1.5rem;
  }
}
</style>
<style lang="scss" scoped>
.w-100{
  width: 100%!important;
}
.more_money_requiriments {

  background: #e1e9fe;
  border-radius: 15px;

}
</style>
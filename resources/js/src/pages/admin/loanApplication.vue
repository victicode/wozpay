
<template>
  <div class="apply_section q-pb-lg" >
    <div class="q-pb-lg" v-if="Object.values(loan).length > 0" >
      <q-stepper
        v-model="step"
        ref="stepper"
        contracted
        color="primary"
        animated
        class="no-header-steper"
      >
        <q-step
          :name="1"
          title="Select campaign settings"
          icon="settings"
          :done="step > 1"
        >
          <div class="w-100 q-mx-none" >
            <q-toolbar class="bg-grey-5 text-black ">
              <q-toolbar-title> 
                <div class="w-100 flex items-center justify-between">
                  <span class="text-subtitle2 text-weight-bold q-mt-sm">Datos personales</span>
                </div>
              </q-toolbar-title>
            </q-toolbar>
            <q-list >
              <q-item class="q-py- q-px-sm" >
                <q-item-section>
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-caption text-weight-bold">
                      Nombre completo
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class=" text-caption">{{ loan.user.name }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section>
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-caption text-weight-bold">
                      N° de documento
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class=" text-caption">{{ numberFormat(loan.user.dni) }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section>
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-caption text-weight-bold">
                      Número de teléfono
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class=" text-caption">{{ loan.user.phone }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section>
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                      <div>
                        <span class="text-caption text-weight-bold">
                          Verificar identidad
                        </span>
                        <q-icon
                          :name="loan.user.verify_status == 2 ? icons.sharpVerified : icons.outlinedVerified"
                          size="sm"
                          :color=" loan.user.verify_status > 0 ? 'terciary' :'grey-6'"
                          class="user-verify-user"
                          :class="{'verify-user':loan.user.verify_status == 2, }"
                        />
                      </div>
                    </q-item-label>
                    <div class="flex items-center cursor-pointer" @click="goTo(loan.user.id)"  >
                      <q-item-label caption lines="1" class="text-caption q-mt-xs">
                        {{ 
                          loan.user.verify_status == 2 
                          ? 'Aprobado'
                          : loan.user.verify_status == 1
                          ? 'Pendiente'
                          : 'No subidos'
                        }}
                      </q-item-label>
                      <q-btn 
                        flat 
                        round 
                        size="xs"
                        class="q-pb-none q-ml-xs"
                      >
                        <q-icon name="eva-chevron-right-outline" color="grey-5" size="sm" />
                      </q-btn>
                    </div>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section>
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                      <div>
                        <span class="text-caption text-weight-bold">
                          Estado de cuenta
                        </span>
                      </div>
                    </q-item-label>
                    <q-item-label caption lines="1" class="text-weight-medium text-caption flex items-center">
                      <div class="q-mr-xs ">
                        <q-chip :color="setChip(loan.user.general_status == 1 ? 1 : 0).color" text-color="white" class="q-pt-sm" size="sm">
                          <div class="">
                            {{setChip(loan.user.general_status == 1 ? 1 : 0).text}}
                          </div>
                        </q-chip>  
                        <q-chip color="grey-6" text-color="white" class="q-pt-sm" size="sm" v-if="loan.user.isBlock == 1">
                          <div class="">
                            Bloqueado
                          </div>
                        </q-chip> 
                        <q-chip color="negative" text-color="white" class="q-pt-sm" size="sm" v-if="loan.user.deleted_at">
                          <div class="">
                            Eliminado
                          </div>
                        </q-chip> 
                      </div>
                    </q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
            </q-list>
            <!-- address -->
            <q-toolbar class="bg-grey-5 text-black q-mt-sm">
              <q-toolbar-title> 
                <div class="w-100 flex items-center justify-between">
                  <span class="text-subtitle2 text-weight-bold q-mt-sm">Dirección particular</span>
                </div>
              </q-toolbar-title>
            </q-toolbar>
            <q-list >
              <q-item class="q-py- q-px-sm" >
                <q-item-section>
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-caption text-weight-bold">
                      Ciudad
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class=" text-caption">{{ loan.user.city }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section>
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-caption text-weight-bold">
                      Barrio o localidad
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class=" text-caption">{{ loan.user.locality }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section>
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-caption text-weight-bold">
                      Calle y N° de casa
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class=" text-caption">{{ loan.user.address }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
            </q-list>
            <!-- professional -->
            <q-toolbar class="bg-grey-5 text-black q-mt-sm">
              <q-toolbar-title> 
                <div class="w-100 flex items-center justify-between">
                  <span class="text-subtitle2 text-weight-bold q-mt-sm">Información profesional</span>
                </div>
              </q-toolbar-title>
            </q-toolbar>
            <q-list >
              <q-item class="q-py- q-px-sm" >
                <q-item-section>
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-caption text-weight-bold">
                      Privado - Funcionario público
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class=" text-caption">{{ loan.user.work }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section>
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-caption text-weight-bold">
                      Cargo
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class=" text-caption">{{ loan.user.office }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section>
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-caption text-weight-bold">
                      Salario
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class=" text-caption">{{ loan.user.salary }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
            </q-list>
          </div>
        </q-step>
        <q-step
          :name="2"
          title="Select campaign settings"
          icon="settings"
          :done="step > 2"
        >
          <div class="w-100 q-mx-none" >
            <q-toolbar class="bg-grey-5 text-black ">
              <q-toolbar-title> 
                <div class="w-100 flex items-center justify-between">
                  <span class="text-subtitle2 text-weight-bold q-mt-sm">Datos laborales</span>
                </div>
              </q-toolbar-title>
            </q-toolbar>
            <q-list >
              <q-item class="q-py- q-px-sm" >
                <q-item-section @click="showInputModal(1, 'business')">
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      Empresa
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class="">{{ loan.red_tapes.business }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section @click="showInputModal(1, 'business_address')">
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      Dirección
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class="">{{ loan.red_tapes.business_address }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section @click="showInputModal(1, 'business_phone')">
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      Número de teléfono
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class="">{{ loan.red_tapes.business_phone }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section>
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      Aporta IPS
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class="q-mt-none">
                      <q-toggle size="md" color="positive" v-model="loan.red_tapes.ips" :val="loan.red_tapes.ips"  />
                    </q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
            </q-list>
            <q-toolbar class="bg-grey-5 text-black q-mt-sm">
              <q-toolbar-title> 
                <div class="w-100 flex items-center justify-between">
                  <span class="text-subtitle2 text-weight-bold ">Referencia laboral</span>
                </div>
              </q-toolbar-title>
            </q-toolbar>
            <q-list >
              <q-item class="q-py- q-px-sm" >
                <q-item-section @click="showInputModal(1, 'boss_name')">
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      Nombre de tu jefe directo
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class="">{{ loan.red_tapes.boss_name }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section @click="showInputModal(1, 'boss_phone')">
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      WhatsApp de tu jefe
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class="">{{ loan.red_tapes.boss_phone }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
            </q-list>
            <q-toolbar class="bg-grey-5 text-black q-mt-sm">
              <q-toolbar-title> 
                <div class="w-100 flex items-center justify-between">
                  <span class="text-subtitle2 text-weight-bold q-mt-sm">Referencia personal</span>
                </div>
              </q-toolbar-title>
            </q-toolbar>
            <q-list >
              <q-item class="q-py- q-px-sm" >
                <q-item-section @click="showInputModal(1, 'reference_name')">
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      Nombre y apellido
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class="">{{ loan.red_tapes.reference_name }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section @click="showInputModal(1, 'reference_relationship')">
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      Parentesco
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class="">{{ loan.red_tapes.reference_relationship }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section @click="showInputModal(1, 'reference_phone')">
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      WhatsApp
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class="">{{ loan.red_tapes.reference_phone }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
            </q-list>
          </div>
        </q-step>
        <q-step
          :name="3"
          title="Select campaign settings"
          icon="settings"
          :done="step > 3"
        >
          <div class="w-100 q-mx-none" >
            <q-toolbar class="bg-grey-5 text-black ">
              <q-toolbar-title> 
                <div class="w-100 flex items-center justify-between">
                  <span class="text-subtitle2 text-weight-bold q-mt-sm">Informconf</span>
                </div>
              </q-toolbar-title>
            </q-toolbar>
            <q-list >
              <q-item class="q-py- q-px-sm" >
                <q-item-section @click="showInputModal(3, 'informconf')">
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      Certificado - reporte de Informconf
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class="">{{ loan.red_tapes.informconf }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
            </q-list>
            <q-toolbar class="bg-grey-5 text-black q-mt-sm">
              <q-toolbar-title> 
                <div class="w-100 flex items-center justify-between">
                  <span class="text-subtitle2 text-weight-bold ">Comprobante de ingresos</span>
                </div>
              </q-toolbar-title>
            </q-toolbar>
            <q-list >
              <q-item class="q-py- q-px-sm" >
                <q-item-section @click="showInputModal(3, 'work_certificate')">
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      Certificado laboral firmado
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class="">{{ loan.red_tapes.work_certificate }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section @click="showInputModal(3, 'last_ips')">
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      Tres ultimos IPS
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class="">{{ loan.red_tapes.last_ips }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              
            </q-list>
            <q-toolbar class="bg-grey-5 text-black q-mt-sm">
              <q-toolbar-title> 
                <div class="w-100 flex items-center justify-between">
                  <span class="text-subtitle2 text-weight-bold q-mt-sm">Linea de crédito disponible</span>
                </div>
              </q-toolbar-title>
            </q-toolbar>
            <q-list >
              <q-item class="q-py- q-px-sm" >
                <q-item-section @click="showInputModal(2, 'amount')">
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                     {{ loan.user.is_first_loan ? 'Primer préstamo' : 'Préstamo' }} 
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class="">{{ numberFormat(loan.amount) }}</q-item-label>
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
                    <q-item-label caption lines="1" class="">{{ loan.due_date }} </q-item-label>
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
                    <q-item-label caption lines="1" class="">Gs. {{ numberFormat(loan.amount_to_pay) }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
            </q-list>
          </div>
        </q-step>
        <template v-slot:navigation>
          <q-stepper-navigation class="q-mt-md flex justify-end q-mx-md-xl q-mb-xl">
            <q-btn v-if="step > 1"  color="grey-6" @click="$refs.stepper.previous()" class="w-100 q-pa-sm q-mb-md" label="Volver"  />
            <q-btn 
              @click=" step < 3 ? $refs.stepper.next() : approveApplyLoan()" 
              color="primary" class="w-100 q-pa-sm q-mb-xl" 
              :label="step == 3 ? 'Presentar solicitiud' : 'Siguente'" 
              :loading="loading"
            >
              <template v-slot:loading>
                <q-spinner-facebook />
              </template>
            </q-btn>
          </q-stepper-navigation>
        </template>
      </q-stepper>
    </div>

    <div v-if="sendLoading">
      <doneModal :dialog="sendLoading" :text="'Solicitud enviada'" />
    </div>
    <div v-if="dialog == 'redirect'">
      <redirectModal :dialog="(dialog == 'redirect')" :type="redirectType" />
    </div>
    <div v-if="dialog == 'setValue'">
      <setValueModal  :dialog="(dialog == 'setValue')" :input="input"  @hiddeModal="hiddeModal"/>
    </div>
    
  </div>
</template>

<script>
  import { ref, inject, onMounted } from 'vue';
  import { useAuthStore } from '@/services/store/auth.store'
  import { useLoanStore } from '@/services/store/loan.store'
  import { useQuasar } from 'quasar'
  import { useRoute, useRouter } from 'vue-router';
  import redirectModal from '@/components/creditApply/modals/redirectModal.vue';
  import setValueModal from '@/components/creditApply/modals/setValueModal.vue';
  import doneModal from '@/components/layouts/modals/doneModal.vue';
  import util from '@/util/numberUtil'

  export default {
    components: {
      redirectModal,
      setValueModal,
      doneModal
    },
    setup () {
      const q = useQuasar()
      const router = useRouter()
      const loanStore = useLoanStore();
      const numberFormat = util.numberFormat
      const icons = inject('ionIcons')
      // Data
      const sendLoading = ref(false);
      const dialog = ref('')
      const loading = ref(false)
      const step = ref(1)
      const loan = ref({})
      const route = useRoute()
      // Methods
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
      const hiddeModal = (data) => {
        dialog.value = ''
        if(!data) return
        setInput(data)
      }

      const activeLoan = () => {
        loanStore.getLoanById(route.params.id).then((data) => {
          if(!data.code)  throw data

          loan.value = data.data
          loan.value.red_tapes.ips = (loan.value.red_tapes.ips == 1)
        }).catch((e) => {
          showNotify('negative', 'error al obtener prestamo activo')
        })
      }
      const setChip = (type) => {
        const chip = [ 
          {
            text: 'Suspendido',
            color: 'terciary'
          },
          {
            text: 'Activo',
            color: 'positive'
          },

        ]
        return chip[type]
      }
      const approveApplyLoan = () => {
        alert('biennn!')
      }
      onMounted(() => {
        activeLoan()
      })

      return {
        icons,
        loading,
        sendLoading,
        loan,
        dialog,
        step,
        numberFormat,
        setChip,
        approveApplyLoan,
      }
    }
  };
</script>
<style lang="scss">
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

<template>
  <div class="apply_section" >
    <div class="" v-if="Object.values(user).length > 0" >
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
                  <span class="text-subtitle2 text-weight-bold q-mt-sm">Datos laborales</span>
                </div>
              </q-toolbar-title>
            </q-toolbar>
            <q-list >
              <q-item class="q-py- q-px-sm" >
                <q-item-section @click="showModal('setValue')">
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      Empresa
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class="text-weight-medium text-body2">{{ readTapes.business ?? 'Agregar' }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section @click="showModal('setValue')">
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      Dirección
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class="text-weight-medium text-body2">{{ readTapes.business_address ?? 'Agregar' }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section @click="showModal('setValue')">
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      Número de teléfono
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class="text-weight-medium text-body2">{{ readTapes.business_phone ?? 'Agregar' }}</q-item-label>
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
                      <q-toggle size="md" color="positive" v-model="readTapes.ips" :val="true"  />

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
                <q-item-section @click="showModal('setValue')">
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      Nombre de tu jefe directo
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class="text-weight-medium text-body2">{{ readTapes.boss_name ?? 'Agregar' }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section @click="showModal('setValue')">
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      WhatsApp de tu jefe
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class="text-weight-medium text-body2">{{ readTapes.boss_phone ?? 'Agregar' }}</q-item-label>
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
                <q-item-section @click="showModal('setValue')">
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      Nombre y apellido
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class="text-weight-medium text-body2">{{ readTapes.reference_name ?? 'Agregar' }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section @click="showModal('setValue')">
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      Parentesco
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class="text-weight-medium text-body2">{{ readTapes.reference_relationship ?? 'Agregar' }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section @click="showModal('setValue')">
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      WhatsApp
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class="text-weight-medium text-body2">{{ readTapes.reference_phone ?? 'Agregar' }}</q-item-label>
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
                  <span class="text-subtitle2 text-weight-bold q-mt-sm">Informconf</span>
                </div>
              </q-toolbar-title>
            </q-toolbar>
            <q-list >
              <q-item class="q-py- q-px-sm" >
                <q-item-section @click="showModal('setValue')">
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      Certificado - reporte de Informconf
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class="text-weight-medium text-body2">{{ readTapes.informconf ?? 'Agregar' }}</q-item-label>
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
                <q-item-section @click="showModal('setValue')">
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      Certificado laboral firmado
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class="text-weight-medium text-body2">{{ readTapes.boss_name ?? 'Agregar' }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section @click="showModal('setValue')">
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      Tres ultimos IPS
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class="text-weight-medium text-body2">{{ readTapes.boss_phone ?? 'Agregar' }}</q-item-label>
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
                <q-item-section @click="showModal('setValue')">
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      Primer préstamo
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class="text-weight-medium text-body2">{{ readTapes.reference_name ?? 'Agregar' }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section @click="showModal('setValue')">
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      Plazo
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class="text-weight-medium text-body2">{{ readTapes.reference_relationship ?? 'Agregar' }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section @click="showModal('setValue')">
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      Total a devolver
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class="text-weight-medium text-body2">{{ readTapes.reference_phone ?? 'Agregar' }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
            </q-list>
            <div class="q-px-md">
              <div class="q-mt-lg more_money_requiriments q-pa-sm">
                <div class="text-body1 text-center text-weight-bold"> ¿Quieres una linea de crédito superior?</div>
                <div class="q-mt-md q-pl-lg">
                  <div class="q-mb-md text-weight-medium text-body2">• Carga y mantén un saldo de Gs. 500.000</div>
                  <div class="q-mb-md text-weight-medium text-body2">• Paga tus facturas de Aqui Pago</div>
                  <div class="q-mb-md text-weight-medium text-body2">• Adquiere una membresia de Woz Paraguay</div>
                  <div class="q-mb-md text-weight-medium text-body2">• Compra un libro digital de Woz Dropshipping</div>
                </div>
              </div>
            </div>
          </div>
        </q-step>
        <template v-slot:navigation>
          <q-stepper-navigation class="q-mt-md flex justify-end">
            <q-btn v-if="step > 1"  color="grey-6" @click="$refs.stepper.previous()" class="w-100 q-pa-sm q-mb-md" label="Volver"  />
            <q-btn @click="$refs.stepper.next()" color="primary" class="w-100 q-pa-sm q-mb-lg" :label="step === 2 ? 'Presentar solicitiud' : 'Siguente'" />
          </q-stepper-navigation>
        </template>
      </q-stepper>
    </div>
    <div class="row">
      <div class="col-12 q-mt-md q-mb-md q-px-md-xl q-px-xs-lg q-pt-md">
        <q-btn  
          label="Siguiente" 
          unelevated
          no-caps 
          color="promary" 
          class="full-width" 
          :loading="loading"
        >
        <template v-slot:loading>
          <q-spinner-facebook />
        </template>
        </q-btn>
      </div>
    </div>
    <div v-if="dialog == 'redirect'">
      <redirectModal :dialog="(dialog == 'redirect')" :type="redirectType" />
    </div>
    <div v-if="dialog == 'setValue'">
      <setValueModal  :dialog="(dialog == 'setValue')" :type="valueType"  @hiddeModal="hiddeModal"/>
    </div>
  </div>
</template>

<script>
  import { ref, inject, onMounted } from 'vue';
  import { useAuthStore } from '@/services/store/auth.store'
  import { useQuasar } from 'quasar'
  import { useRouter } from 'vue-router';
  import redirectModal from '@/components/creditApply/modals/redirectModal.vue';
  import setValueModal from '@/components/creditApply/modals/setValueModal.vue';

  export default {
    components: {
      redirectModal,
      setValueModal,
    },
    setup () {
      //vue provider
      const icons = inject('ionIcons')
      const $q = useQuasar()
      const router = useRouter()
      const user = useAuthStore().user;
      const isUserApply = ref(true)
      const dialog = ref('')
      const redirectType = ref(0);
      const step = ref(1)
      const valueType = ref(0);

      // Data
      const readTapes = ref({
        business: null,
        business_address: null,
        business_phone: null,
        ips:false,
        boss_name: null,
        boss_phone: null,
        reference_name: null,
        reference_phone: null,
        reference_relationship: null,
        informconf: null,
        work_certificate: null,
        last_ips: null,
        
      })
      const loading = ref(false)
      
      // Methods
      const validateUser = () => {
        if(user.verify_status != 2 ) {
          isUserApply.value = false
          redirectType.value = 2
          return isUserApply.value
        }

        const dontValidate = ['is_public','email_verified_at','created_at', 'updated_at', 'deleted_at']

        Object.entries(user).forEach( ([key, value]) => {
          if(dontValidate.includes(key)) return

          if(!value) isUserApply.value = false
        });
        redirectType.value = 1
        return isUserApply.value
      }
      const showNotify = (type, message) => {
        $q.notify({
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

      const showModal = (data) => {
        dialog.value = data
      }
      const hiddeModal = () => {
        dialog.value = ''
      }
      onMounted(() => {
        if(!validateUser()){
          showModal('redirect')
        }
      })
      return {
        icons,
        loading,
        user,
        dialog,
        router,
        readTapes,
        step,
        redirectType,
        valueType,
        showModal,
        hiddeModal,
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
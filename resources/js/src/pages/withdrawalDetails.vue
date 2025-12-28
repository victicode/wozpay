<template>
  <div style="height: 100vh;" class="q-pt-md">
    <Transition name="inFade">
      <div v-if="withdrawal && ready" class="h-100  w-100">
        <!-- Header -->
        <div class="q-pl-xs q-pb-md flex items-center justify-start">
          <q-btn 
            flat
            round
            icon="eva-arrow-back-outline"
            color="grey-8" 
            @click="router.push('/withdrawal-history')" 
          />
          <div class="q-ml-sm">
            <div class="text-h5 text-weight-bold">Detalles del Retiro</div>
            <div class="text-caption text-grey-6">Información de la orden</div>
          </div>
        </div>

        <!-- Content -->
        <div class="q-px-lg withdrawal__details q-pt-sm">
          <!-- Status -->
          <div class="flex justify-end q-mb-md">
            <div class="status-badge" :class="getStatusClass(withdrawal.status)">
              {{ withdrawal.status_label }}
            </div>
          </div>

          <!-- Amount -->
          <div class="detail-card">
            <div class="card-label">Monto solicitado</div>
            <div class="amount-main">
              Gs. {{ numberFormat(withdrawal.amount) }}
            </div>
          </div>

          <!-- Info Grid -->
          <div class="info-grid">
            <div class="detail-card">
              <div class="card-label">Comisión por tipo</div>
              <div class="card-value">
                Gs. {{ numberFormat(withdrawal.comision_by_type) }}
              </div>
            </div>

            <div class="detail-card">
              <div class="card-label">Comisión fija</div>
              <div class="card-value">
                Gs. {{ numberFormat(withdrawal.comision_fixed) }}
              </div>
            </div>

            <div class="detail-card highlight-card">
              <div class="card-label">Total a recibir</div>
              <div class="card-value highlight-value">
                Gs. {{ numberFormat(withdrawal.amount - withdrawal.comision_by_type - withdrawal.comision_fixed) }}
              </div>
            </div>
          </div>
          <div class="row q-mt-sm" style="width: 100%;">
            <div class="col-12 col-md-6 q-pr-md-sm q-pr-none">
              <div class="detail-card">
                <div class="card-label">Método de pago</div>
                <div class="bank-name"">
                  {{ withdrawal.method_label }}
                </div>
                <div class="account-value q-mt-xs">
                  Transfencia nacional
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6 q-pl-md-sm q-pl-none q-mt-sm">
              <div v-if="withdrawal.account_bank" class="detail-card">
                <div class="card-label">Cuenta bancaria</div>
                <div class="bank-name">
                  {{ withdrawal.account_bank.bank ? withdrawal.account_bank.bank.name : 'N/A' }}
                </div>
                <div class="account-value">
                  •••• {{ withdrawal.account_bank.account_number.slice(-4) }}
                </div>
                <div v-if="withdrawal.account_bank.account_holder_name" class="account-value q-mt-xs">
                  {{ withdrawal.account_bank.account_holder_name }}
                </div>
              </div>
            </div>
          </div>

          <!-- Bank Account -->
          

          <!-- Dates -->
          <div class="detail-card q-mt-sm">
            <div class="date-row">
              <div class="card-label">Fecha de solicitud</div>
              <div class="card-value">{{ formatDate(withdrawal.created_at) }}</div>
            </div>
            <div v-if="withdrawal.updated_at && withdrawal.updated_at !== withdrawal.created_at" class="date-row q-mt-sm">
              <div class="card-label">Última actualización</div>
              <div class="card-value">{{ formatDate(withdrawal.updated_at) }}</div>
            </div>
          </div>
        </div>
      </div>

      <!-- Loading State -->
      <div v-else-if="!ready" class="q-px-lg">
        <div class="q-mb-md">
          <q-skeleton type="rect" width="200px" height="40px" class="q-mb-md" />
          <q-skeleton type="text" width="150px" />
        </div>
        <q-skeleton type="rect" height="100px" class="q-mb-md" />
        <q-skeleton type="rect" height="150px" class="q-mb-md" />
        <q-skeleton type="rect" height="200px" />
      </div>

      <!-- Error State -->
      <div v-else-if="ready && !withdrawal" class="h-100 flex flex-center column">
        <div class="empty-state">
          <div class="empty-icon">
            <q-icon name="eva-alert-circle-outline" size="6rem" color="grey-4" />
          </div>
          <div class="text-h6 text-weight-medium text-grey-7 q-mt-lg q-mb-sm">
            Retiro no encontrado
          </div>
          <div class="text-body2 text-grey-6 text-center q-mb-lg" style="max-width: 280px;">
            No se pudo encontrar la información del retiro solicitado
          </div>
          <q-btn 
            unelevated
            no-caps 
            color="primary" 
            class="q-px-xl"
            @click="router.push('/withdrawal-history')" 
          >
            Volver al historial
          </q-btn>
        </div>
      </div>
    </Transition>
  </div>
</template>

<script>
import { onMounted, ref } from 'vue'
import { useWithdrawalStore } from '@/services/store/withdrawal.store'
import { useRouter, useRoute } from 'vue-router';
import utils from '@/util/numberUtil';
import moment from 'moment';
import 'moment/locale/es';
moment.updateLocale('es', 
  {
    months: 'Enero_Febrero_Marzo_Abril_Mayo_Junio_Julio_Agosto_Septiembre_Octubre_Noviembre_Diciembre'.split('_'),
    monthsShort: 'Enero._Feb._Mar_Abr._May_Jun_Jul._Ago_Sept._Oct._Nov._Dic.'.split('_'),
    weekdays: 'Domingo_Lunes_Martes_Miercoles_Jueves_Viernes_Sabado'.split('_'),
    weekdaysShort: 'Dom._Lun._Mar._Mier._Jue._Vier._Sab.'.split('_'),
    weekdaysMin: 'Do_Lu_Ma_Mi_Ju_Vi_Sa'.split('_')
  }
);

export default {
  setup () {
    const store = useWithdrawalStore()
    const withdrawal = ref(null)
    const ready = ref(false)
    const router = useRouter()
    const route = useRoute()
    const numberFormat = utils.numberFormat

    const getWithdrawalById = () => {
      ready.value = false
      const withdrawalId = route.params.id
      
      if (!withdrawalId) {
        ready.value = true
        return
      }

      store.getWithdrawal(withdrawalId).then((data) => {
        if(data.code !== 200) {
          ready.value = true
          return
        }
        withdrawal.value = data.data
        ready.value = true
      }).catch((error) => {
        console.error('Error al obtener retiro:', error)
        ready.value = true
      })
    }

    const getStatusClass = (status) => {
      const classes = {
        0: 'status-rejected',
        1: 'status-pending',
        2: 'status-approved'
      }
      return classes[status] || 'status-pending'
    }

    const getStatusIcon = (status) => {
      const icons = {
        0: 'eva-close-circle-outline',
        1: 'eva-clock-outline',
        2: 'eva-checkmark-circle-outline'
      }
      return icons[status] || 'eva-clock-outline'
    }

    const formatDate = (date) => {
      return moment(date).format('DD [de] MMMM YYYY, HH:mm')
    }

    onMounted(() => {
      getWithdrawalById()
    })

    return {
      withdrawal, 
      ready, 
      router, 
      numberFormat,
      getStatusClass,
      getStatusIcon,
      formatDate
    }
  },
}
</script>

<style lang="scss" scoped>
.withdrawal__details {
  overflow-y: auto; 
  height: 90%;
  padding-bottom: 2rem;
}

.detail-card {
  background: white;
  border-radius: 6px;
  padding: 1rem;
  margin-bottom: 0.5rem;
  border: 1px solid #e8e8e8;
}

.status-badge {
  display: inline-block;
  padding: 0.4rem 0.8rem;
  border-radius: 1rem;
  font-size: 0.75rem;
  font-weight: 500;
  text-transform: uppercase;
  letter-spacing: 0.3px;
  
  &.status-pending {
    background: #fff8e1;
    color: #f57c00;
  }
  
  &.status-approved {
    background: #e8f5e9;
    color: #388e3c;
  }
  
  &.status-rejected {
    background: #ffebee;
    color: #c62828;
  }
}

.card-label {
  font-size: 0.7rem;
  color: #999;
  font-weight: 400;
  margin-bottom: 0.4rem;
  text-transform: uppercase;
  letter-spacing: 0.2px;
}

.amount-main {
  font-size: 1.5rem;
  font-weight: 600;
  color: #1a1a1a;
  letter-spacing: -0.01em;
}

.info-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 0.5rem;
}

.card-value {
  font-size: 0.95rem;
  font-weight: 500;
  color: #333;
}

.highlight-card {
  grid-column: 1 / -1;
  background: #f1f8f4;
  border-color: #81c784;
}

.highlight-value {
  color: #2e7d32;
  font-size: 1.1rem;
  font-weight: 600;
}

.bank-name {
  font-size: 0.95rem;
  font-weight: 500;
  color: #1a1a1a;
  margin-bottom: 0.5rem;
}

.account-value {
  font-size: 0.85rem;
  color: #666;
  font-weight: 400;
}

.date-row {
  display: flex;
  flex-direction: column;
  gap: 0.2rem;
}

.order-id-value {
  font-size: 0.9rem;
  color: #666;
  font-weight: 500;
  font-family: monospace;
}

.empty-state {
  text-align: center;
  padding: 2rem;
}

.empty-icon {
  opacity: 0.5;
}

.h-100 {
  height: 100%;
}

@media screen and (max-width: 780px) {
  .info-grid {
    grid-template-columns: 1fr;
  }

  .amount-main {
    font-size: 1.3rem;
  }

  .detail-card {
    padding: 0.875rem;
  }
}
</style>
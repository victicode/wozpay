<template>
  <div style="height: 91vh;" class="q-pt-md">
    <Transition name="inFade">
      <div v-if="withdrawals.length > 0 && ready" class="h-100 w-100">
        <!-- Header -->
        <div class="q-pl-xs q-pb-md flex items-center justify-start">
          <q-btn 
            flat
            round
            icon="eva-arrow-back-outline"
            color="grey-8" 
            @click="router.go(-1)" 
          />
          <div class="q-ml-sm">
            <div class="text-h5 text-weight-bold">Retiros</div>
            <div class="text-caption text-grey-6">Historial de órdenes</div>
          </div>
          
        </div>

        <!-- List -->
        <div class="q-px-lg withdrawal__list">
          <div 
            class="withdrawal__item" 
            v-for="(withdrawal, key) in withdrawals" 
            :key="key"
            @click="goTo(withdrawal.id)"
          >
            <div class="withdrawal__content">
              <!-- Main Row -->
              <div class="main-row">
                <div class="amount-section">
                  <div class="amount-value">
                    Gs. {{ numberFormat(withdrawal.amount) }}
                  </div>
                  
                </div>
                <div class="status-badge" :class="getStatusClass(withdrawal.status)">
                  {{ withdrawal.status_label }}
                </div>
              </div>

              <!-- Bank Info -->
              <div v-if="withdrawal.account_bank" class="bank-section">
                {{ withdrawal.account_bank.bank ? withdrawal.account_bank.bank.name : 'N/A' }}
                <span class="account-number">•••• {{ withdrawal.account_bank.account_number.slice(-4) }}</span>
              </div>

              <!-- Bottom Info -->
              <div class="info-row">
                <span class="info-label">Comisión</span>
                <span class="info-value">Gs. {{ numberFormat(withdrawal.comision_by_type + withdrawal.comision_fixed) }}</span>
                <span class="info-separator">•</span>
                <span class="info-label">Recibirás</span>
                <span class="info-value highlight">Gs. {{ numberFormat(withdrawal.amount - withdrawal.comision_by_type - withdrawal.comision_fixed) }}</span>
              </div>
              <div class="amount-date q-mt-xs">
                {{ formatDate(withdrawal.created_at) }}
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Empty State -->
      <div v-else-if="withdrawals.length == 0 && ready" class="h-100 flex flex-center column">
        <div class="empty-state">
          <div class="empty-icon">
            <q-icon name="eva-credit-card-outline" size="6rem" color="grey-4" />
          </div>
          <div class="text-h6 text-weight-medium text-grey-7 q-mt-lg q-mb-sm">
            Sin órdenes de retiro
          </div>
          <div class="text-body2 text-grey-6 text-center q-mb-lg" style="max-width: 280px;">
            Aún no has realizado ninguna solicitud de retiro
          </div>
          <q-btn 
            unelevated
            no-caps 
            color="primary" 
            class="q-px-xl"
            @click="router.push('/withdrawal')" 
          >
            Crear orden de retiro
          </q-btn>
        </div>
      </div>
      
      <!-- Loading State -->
      <div v-else class="q-px-lg">
        <div class="withdrawal__item loading" v-for="n in 5" :key="n">
          <div class="withdrawal__content">
            <div class="main-row">
              <div>
                <q-skeleton type="text" width="150px" height="24px" class="q-mb-xs" />
                <q-skeleton type="text" width="100px" height="16px" />
              </div>
              <q-skeleton type="rect" width="80px" height="24px" style="border-radius: 12px;" />
            </div>
            <q-skeleton type="text" width="120px" height="16px" class="q-mb-sm" />
            <q-skeleton type="text" width="200px" height="14px" />
          </div>
        </div>
      </div>
    </Transition>  
  </div>
</template>

<script>
import { onMounted, ref } from 'vue'
import { useWithdrawalStore } from '@/services/store/withdrawal.store'
import { useAuthStore } from '@/services/store/auth.store'
import { useRouter } from 'vue-router';
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
    const authStore = useAuthStore()
    const withdrawals = ref([])
    const ready = ref(false)
    const router = useRouter()
    const numberFormat = utils.numberFormat

    const getWithdrawalsByUser = () => {
      ready.value = false
      store.allWithdrawalByUser(authStore.user.id).then((data) => {
        if(data.code !== 200) return
        withdrawals.value = data.data
        ready.value = true
      }).catch((error) => {
        console.error('Error al obtener retiros:', error)
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
      return moment(date).format('DD MMM YYYY, HH:mm')
    }
    const goTo = (id) => {
      router.push('/withdrawal-details/'+id)
    }
    onMounted(() => {
      getWithdrawalsByUser()
    })

    return {
      withdrawals, 
      ready, 
      router, 
      numberFormat,
      getStatusClass,
      getStatusIcon,
      formatDate,
      goTo,
    }
  },
}
</script>

<style lang="scss" scoped>
.withdrawal__list {
  overflow-y: auto; 
  height: calc(91vh - 80px);
  padding-bottom: 2rem;
}

.withdrawal__item {
  padding: 1.5rem 0;
  border-bottom: 2px solid #e0e0e0;
  transition: opacity 0.2s ease;

  &:last-child {
    border-bottom: none;
  }

  &:hover {
    opacity: 0.8;
  }

  &.loading {
    border-bottom-color: #f5f5f5;
  }
}

.withdrawal__content {
  width: 100%;
}

.main-row {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
}

.amount-section {
  flex: 1;
}

.amount-value {
  font-size: 1.25rem;
  font-weight: 600;
  color: #1a1a1a;
  letter-spacing: -0.02em;
}

.amount-date {
  font-size: 0.85rem;
  color: #999;
  font-weight: 500;
}

.status-badge {
  padding: 0.35rem 0.75rem;
  border-radius: 12px;
  font-size: 0.7rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  flex-shrink: 0;
  margin-top: 0.25rem;
  
  &.status-pending {
    background: #fff3cd;
    color: #856404;
  }
  
  &.status-approved {
    background: #d4edda;
    color: #155724;
  }
  
  &.status-rejected {
    background: #f8d7da;
    color: #721c24;
  }
}

.bank-section {
  font-size: 0.93rem;
  color: #666;
  margin-bottom: 0.25rem;
  font-weight: 400;
}

.account-number {
  color: #999;
  margin-left: 0.5rem;
}

.info-row {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  flex-wrap: wrap;
  font-size: 0.8rem;
}

.info-label {
  color: #999;
  font-weight: 400;
}

.info-value {
  color: #666;
  font-weight: 500;
  
  &.highlight {
    color: #4caf50;
    font-weight: 600;
  }
}

.info-separator {
  color: #ddd;
  margin: 0 0.25rem;
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
  .withdrawal__list {
    padding: 0 1rem;
  }

  .withdrawal__item {
    padding: 1.25rem 0;
  }

  .amount-value {
    font-size: 1.1rem;
  }

  .info-row {
    font-size: 0.8rem;
  }
}
</style>

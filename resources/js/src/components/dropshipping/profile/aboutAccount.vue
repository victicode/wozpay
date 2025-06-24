<template>
  <section class="q-mt-sm q-pt-md">
    <div >
      <div class="q-px-md">
        <div>
          <div class="aboutTitleSection flex items-end q-mt-sm" >
            <div>
              Sobre tu cuenta Dropshipping
            </div>
            
          </div>
           <div class="aboutSubtitle q-mt-xs">
            Información sobre tu cuenta Dropshipping
          </div>
        </div>
      </div>
      <div class="items__containerAbout q-px-md q-pt-sm  q-pb-lg q-mt-sm q-mx-md q-mb-md">
        <div v-for="(item, index) in formatDetails" :key="index" class="flex justify-between items-center q-pb-sm q-pt-md  items_about">
          <div class="text__aboutTitle">
            {{ item.title }}
          </div>
          <div class="text__aboutValue">
            {{ item.value }}
          </div>
        </div>
      </div>
    </div>
    
  </section>
</template>
<script>

import util from '@/util/numberUtil';
import { useDropshippingStore } from '@/services/store/dropshipping.store';
import { ref } from 'vue';
import { useAuthStore } from '@/services/store/auth.store'
import { storeToRefs } from 'pinia';
import moment from 'moment';
export default {
  props: {
    stadistics: Object,
  },
  setup (props) {
    const { user  } = storeToRefs(useAuthStore())
    const stadistics = ref(props.stadistics) 
    const dropStore = useDropshippingStore()
    const numberFormat = util.numberFormat

    const formatDetails = [
      {
        title: 'Pagos en Woz Ads',
        value: 'Gs. ' + numberFormat(stadistics.value.payAddsAmount)
      },
      {
        title: 'Transacciones - retiros de ganancias',
        value: 'Gs. ' + numberFormat(stadistics.value.totalEarnings)
      },
      {
        title: 'Cuentas bancarias',
        value: user.value.accountbanks_count + ( user.value.accountbanks_count > 1 ? ' cuentas vinculadas' : ' cuenta vinculada')
      },
      {
        title: 'Ciclo de facturación',
        value: user.value.dropshipping_account.type_label
      },
      {
        title: 'Vencimiento',
        value: moment(user.value.dropshipping_account.due_date).format('DD-MM-YYYY')
      }
    ]
    return {
      numberFormat,
      formatDetails  
    }
  }
}
</script>
<style lang="scss">
.text__aboutTitle{
  font-size: 1rem;
  font-weight: 400
}
.text__aboutValue{
  font-size: 0.92rem;
  font-weight: 400;
  color: #919398;
}
.items__containerAbout{
  background: #f3f6fe;
  border-radius: 1rem;
}
.items_about{
  border-bottom: 1px solid darkgray;
}
.badgeStadisticProfile{
  background: #efefef;
  border-radius: 0.5rem;
  width: fit-content;
  font-weight: 500;
  &.stadisticBadge{

    border-radius: 0.9rem!important;
    box-shadow: 0px 2px px 0px rgba(114, 114, 114, 0.308) ;
  }
}
.aboutSubtitle{
  font-size: 0.95rem;
  font-weight: 400;
  color: darkgray;
}
.aboutTitleSection{
  font-size: 1.7rem;
  font-weight: bold;
  color: #000;
  line-height: 1;
  &--profit{
    line-height: 1.1;
    font-size: 1.2rem;
    font-weight: bold;
    // color: #11c020;
  }
}
</style>
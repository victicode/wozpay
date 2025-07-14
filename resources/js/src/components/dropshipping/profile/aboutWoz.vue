<template>
  <section class="q-mt-sm q-pt-md" style="border-top: 1px solid darkgray;">
    <div >
      <div class="q-px-md">
        <div>
          <div class="aboutWozTitleSection flex items-end q-mt-sm" >
            <div>
              Sobre Woz Dropshipping
            </div>
            
          </div>
           <div class="aboutSubtitle q-mt-xs">
            Información sobre tu tienda Dropshipping
          </div>
        </div>
      </div>
      <div class="items__containerAbout q-px-md q-pt-sm  q-pb-lg q-mt-sm q-mx-md q-mb-md">
        <div v-for="(item, index) in formatDetails" :key="index" class="flex justify-between items-center q-pb-sm q-pt-md  items_about">
          <div class="text__aboutWozTitle">
            {{ item.title }}
          </div>
          <div class="text__aboutVWozalue">
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
export default {
  props: {
    stadistics: Object,
  },
  setup (props) {
    
    const stadistics = ref(props.stadistics) 
    const dropStore = useDropshippingStore()
    const numberFormat = util.numberFormat

    const formatDetails = [
      {
        title: 'Dropshipping internacional',
        value: 'Activado'
      },
      {
        title: 'Vendidos',
        value: numberFormat(stadistics.value.totalProductsSell) + ' Productos vendidos'
      },
      {
        title: 'Estado de pagos',
        value: stadistics.value.totalPay + ' pagos realizados'
      },
      {
        title: 'Ganancias',
        value: 'Gs. '+numberFormat(stadistics.value.totalEarnings)
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
.text__aboutWozTitle{
  font-size: 1rem;
  font-weight: 400
}
.text__aboutWozValue{
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
.aboutWozTitleSection{
  font-size: 1.3rem;
  font-weight: bold;
  color: #000;
  line-height: 1;
  &--profit{
    line-height: 1.1;
    font-size: rem;
    font-weight: bold;
    // color: #11c020;
  }
}
</style>
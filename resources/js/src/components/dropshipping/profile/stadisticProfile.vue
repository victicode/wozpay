<template>
  <section >
    <div class="flex">
      <div class="badgeStadistic q-px-md q-py-xs q-ml-md q-mb-sm">Mes de {{months[actualMonth - 1]}}</div>
      <div class="badgeStadistic q-px-md q-py-xs q-ml-md q-mb-sm">Ultimos 12 meses</div>
    </div>
    <div v-if="Object.values(statistics).length > 0">
      <div class="q-px-md">
        <div>
          <div class="sellStatidistic__sellVolumen flex items-end q-mt-sm" >
            <div>
              Gs. {{ numberFormat(statistics.totalSell) }}
            </div>
            
          </div>
           <div class="sellStatidistic__title q-mt-xs">
            Ventas totales en Dropshipping
          </div>
        </div>
      </div>
      <div class="q-px-md-lg q-px-sm q-pb-md-md q-mt-md">
        <div style="max-width: 100%; background: #f3f6fe; border-radius: 1.5rem;" class="q-px-md-md q-pt-xs q-pb-xs " >
          <apexchart type="area" height="160" :options="chartOptions" :series="series" class="q-mb-xs" style="transform: translateY(0.rem);"/>
        </div>
      </div>
    </div>
    <div v-else class="flex justify-center items-center q-pa-xl"> 
      <q-spinner-tail
        color="primary"
        size="2rem"
      />
    </div>
  </section>
</template>
<script>
import moment from 'moment/moment';
import { onMounted } from 'vue';
import util from '@/util/numberUtil';
import { useDropshippingStore } from '@/services/store/dropshipping.store';
import { ref } from 'vue';
export default {
  props: {
    user: Object,
  },
  setup (props) {
    
    const user = ref(props.user) 
    const dropStore = useDropshippingStore()
    const actualMonth =  moment().get('month')
    const statistics = ref({})
    const months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    const getLastMonth = () => {
      let result = []

      for (let index = 5; index >= 0; index--) {
        let selecction = actualMonth - index < 0 
        ? months.length + (actualMonth - index)
        : actualMonth - index

        result.push(months[selecction])
      }
      return result
    }
    const numberFormat = util.numberFormat


    const series = [
      {
        name: "Ventas",
        data: '80000,50000,30000,60000,100000,150000'.split(',')
      }, 
    ];
    const chartOptions = {
      chart: {
        type: 'area',
        height: 350,
        zoom: {
          enabled: false
        }
      },
      colors: ['#dfe5f7'],
      fill: {
        type: "gradient",
        gradient: {
          shadeIntensity: 1,
          opacityFrom:1,
          opacityTo: 1,
          stops: [100,100 ]
        }
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'straight',
        width: 3,
        colors:['#0449fa']
      },

      xaxis: {
        type: 'category',
        categories: getLastMonth(),
        labels:{
          show:false
        },

      },
      yaxis: {
        labels: {
          formatter: (value) => { 
            return 'GS '+ numberFormat(value,0)   
          },
          style: {
              colors: ['darkgray'],
              fontSize: '13px',
              fontFamily: 'Roboto',
              fontWeight: 400,
          },
        },
      },
    };
    
    const getProfit = (user) => {
      const lastMonth = 100000
      const residuo =  150000 - lastMonth
      const porcentage =   (residuo / lastMonth)*100
      return Number.isInteger(porcentage) ? porcentage : porcentage.toFixed(2)
    }

    const getStatdistics = () => {
      dropStore.getStadistics(user.value.id)
      .then((response) => {
        
        statistics.value = response.data;
      })
    }
    onMounted(() => {
      getLastMonth()
      getStatdistics()
    })
    
    return {
      numberFormat,
      series,
      chartOptions,
      months,
      actualMonth,
      statistics,
      getProfit,
    }
  }
}
</script>
<style lang="scss">
.badgeStadistic{
  background: #efefef;
  border-radius: 0.3rem;
  width: fit-content;
  font-weight: 500;
}
.sellStatidistic__title{
  font-size: 1rem;
  font-weight: 400;
  color: darkgray;
}
.sellStatidistic__sellVolumen{
  font-size: 1.9rem;
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
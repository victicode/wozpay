<template>
  <section >
    <div class="flex">
      <div class="badgeStadisticProfile q-px-md q-py-xs q-ml-md q-mb-sm">Mes de {{months[actualMonth - 1]}}</div>
      <div class="badgeStadisticProfile q-px-md q-py-xs q-ml-md q-mb-sm">Ultimos 12 meses</div>
    </div>
    <div v-if="Object.values(stadistics).length > 0">
      <div class="q-px-md">
        <div>
          <div class="sellStatidistic__sellVolumen flex items-end q-mt-sm" >
            <div>
              Gs. {{ numberFormat(stadistics.totalSell) }}
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
      <div class="flex justify-between q-px-md">
        <div class="badgeStadisticProfile stadisticBadge q-px-lg q-py-sm  q-mb-sm q-mt-lg ">
          <div class="text-subtitle1 text-bold">
            {{stadistics.totalPay}} {{ stadistics.totalPay > 1 ? 'Pagos' : 'Pago' }}
          </div>
          <div class="text-subtitle2">
            Pagos generales
          </div>
        </div>
        <div class="badgeStadisticProfile stadisticBadge q-px-lg q-py-sm q-ml-sm q-mb-sm q-mt-lg">
          <div class="text-subtitle1 text-bold">
            {{stadistics.totalPay}} {{ stadistics.totalPay > 1 ? 'Productos' : 'Producto' }}
          </div>
          <div class="text-subtitle2">
           Inventario Drophipping
          </div>
        </div>

      </div>
    </div>
    <div v-else class="flex justify-center items-center q-pa-xl"> 
      <q-spinner-tail
        color="primary"
        size="5rem"
      />
    </div>
  </section>
</template>
<script>
import moment from 'moment/moment';
import { onMounted } from 'vue';
import util from '@/util/numberUtil';
import { ref } from 'vue';
export default {
  props: {
    stadistics: Object,
  },
  setup (props) {
    
 
    
    const actualMonth =  moment().get('month')
    const stadistics = ref(props.stadistics)
    const months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    const getLastMonth = () => {
      let result = []
      let monthLimit = stadistics.value.volumenForMonth.split(',').length > 5 ? 5 : (stadistics.value.volumenForMonth.split(',').length-1)

      for (let index = monthLimit; index >= 0; index--) {
        let selecction = actualMonth - index < 0 
        ? months.length + (actualMonth - index)
        : actualMonth - index

        result.push(months[selecction])
      }
      return result
    }
    const numberFormat = util.numberFormat

    const series = [{
        name: "Ventas",
        data: stadistics.value.volumenForMonth.split(',')
      }];
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

    // const getProfit = (user) => {
    //   const lastMonth = 100000
    //   const residuo =  150000 - lastMonth
    //   const porcentage =   (residuo / lastMonth)*100
    //   return Number.isInteger(porcentage) ? porcentage : porcentage.toFixed(2)
    // }

    
    onMounted(() => {
      
  
    })
    
    return {
      numberFormat,
      series,
      chartOptions,
      months,
      actualMonth,
      stadistics,
    }
  }
}
</script>
<style lang="scss">
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
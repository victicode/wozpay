<template>
  <section >
    <div class="badgeStadistic q-px-sm q-py-xs q-ml-md q-mb-sm">Ultimos 5 meses</div>
    <div class="q-px-md">
      <div>
        <div class="sellStatidistic__title">
          Ventas totales
        </div>
        <div class="sellStatidistic__sellVolumen flex items-end q-mt-sm" >
          <div>
            GS {{ moneyFormatSell(product.actual_sell_volumen, 2) }}
          </div>
          <div class="sellStatidistic__sellVolumen--profit q-ml-sm" :class="getProfit(product) >= 0 ? 'text-positive':'text-negative'">
            {{(getProfit(product) >= 0 ? '+':'')+ getProfit(product) }}%
          </div>
        </div>
      </div>
    </div>
    <div class="q-px-md-lg q-px-sm q-pb-md-md">
      <div style="max-width: 100%; background: #f7f7f7; border-radius: 1.5rem;" class="q-px-md-md q-pt-md q-pb-xs " >
        <apexchart type="area" height="160" :options="chartOptions" :series="series" class="q-mb-xs"/>
      </div>
    </div>
  </section>
</template>
<script>
import moment from 'moment/moment';
import { onMounted } from 'vue';
import util from '@/util/numberUtil';
export default {
  props: {
    product: Object,
  },
  setup (props) {
    
    const product = ref(props.product) 
    const getLastMonth = () => {
      const actualMonth =  moment().get('month')
      const months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
      let result = []

      for (let index = 5; index >= 0; index--) {
        let selecction = actualMonth - index < 0 
        ? months.length + (actualMonth - index)
        : actualMonth - index

        result.push(months[selecction])
      }
      return result
    }
    const moneyFormatSell = util.moneyFormatSell


    const series = [
      {
        name: "Ventas",
        data: product.value.sell_volumen_last_month.split(',')
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
      colors: ['#d6edd5'],
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
        colors:['#48d545']
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
            return 'GS '+ moneyFormatSell(value,0)   
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
    
    const getProfit = (product) => {
      const lastMonth = parseInt(product.sell_volumen_last_month.split(',').at(-2).replace(/\]/g, ''))
      const residuo =  product.actual_sell_volumen - lastMonth

      const porcentage =   (residuo / lastMonth)*100

      return Number.isInteger(porcentage) ? porcentage : porcentage.toFixed(2)
    }


    onMounted(() => {
      getLastMonth()
    })
    
    return {
      moneyFormatSell,
      series,
      chartOptions,
      getProfit,
      product,
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
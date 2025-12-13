<template>
  <section style="height:95%">
    <div class="text-h6 q-ml-md q-pl-sm q-mb-lg" style="font-weight: bold;">
      Ganancias
    </div>
    <div v-if="ready">
      <div class="flex">
        <div class="badgeStadisticProfile q-px-md q-py-xs q-ml-md q-mb-md flex items-center">
          En tiempo real
          <div style="border-radius: 3rem; height: 0.85rem; width: 0.85rem; background: #19cd15;" class="q-ml-sm">
  
          </div>
        </div>
      </div>
      <div class="q-px-md">
        <div class="q-pl-xs" style="width:fit-content" @click="goTo('/dropshipping/sells/all/'+user.id)">
          <div class="sellStatidistic__sellVolumen flex items-end q-mt-sm" >
            <div>
              GS. {{ numberFormat(stadistics.totalEarnings) }}
            </div> 
          </div>
          <div class="sellStatidistic__title q-mt-xs">
            Ganancias totales en Dropshipping
          </div>
        </div>
      </div>
      <div class="q-px-md-lg q-px-sm q-pb-md-md q-mt-md">
        <div style="max-width: 100%; background: #f3f6fe; border-radius: 1.5rem;" class="q-px-md-md q-pt-xs q-pb-xs " >
          <apexchart type="area" height="160" :options="chartOptions" :series="series" class="q-mb-xs" style="transform: translateY(0.rem);"/>
        </div>
      </div>
      <div class="q-mt-lg">
        <div class="q-my-md">
          <div class="titleSectionInconme q-px-md q-py-md flex items-center">Ventas generales Woz Dropshipping</div>
          <div class="q-px-md q-pt-md ">
            <div class="flex justify-between items-center q-pb-sm" style="border-bottom:  1px solid darkgray;">
              <div class="items-text">Productos Vendidos</div>
              <div class="items-text text-grey-6">Gs.{{ numberFormat(stadistics.totalSell) }}</div>
            </div>
          </div>
        </div>
        <div class="q-my-md">
          <div class="titleSectionInconme q-px-md q-py-md flex items-center">Débitos Woz Dropshippig</div>
          <div class="q-px-md q-pt-md ">
            <div class="flex justify-between items-center q-pb-sm q-mb-lg" style="border-bottom:  1px solid darkgray;">
              <div class="items-text">Membresía Woz Dropshipping</div>
              <div class="items-text text-grey-6">Gs.{{ numberFormat(250000) }}</div>
            </div>
            <div class="flex justify-between items-center q-pb-sm q-mb-lg" style="border-bottom:  1px solid darkgray;">
              <div class="items-text">Publicidad Woz Ads</div>
              <div class="items-text text-grey-6">Gs.{{ numberFormat(stadistics.payAddsAmount) }}</div>
            </div>
            <div class="flex justify-between items-center q-pb-sm q-mb-lg" style="border-bottom:  1px solid darkgray;">
              <div class="items-text">Cursos comprados</div>
              <div class="items-text text-grey-6">Gs.{{ numberFormat(0) }}</div>
            </div>
            <div class="flex justify-between items-center q-pb-sm q-mb-lg" style="border-bottom:  1px solid darkgray;">
              <div class="items-text">Retiros o transferencias</div>
              <div class="items-text text-grey-6">Gs.{{ numberFormat(stadistics.withdrawal) }}</div>
            </div>
            <div class="flex justify-between items-center q-pb-sm q-mb-lg" style="border-bottom:  1px solid darkgray;">
              <div class="items-text">Comisiones a debitar</div>
              <div class="items-text text-grey-6">Gs.{{ numberFormat(stadistics.totalComisionWoz) }}</div>
            </div>
          </div>
        </div>
        <div class="q-my-md">
          <div class="titleSectionInconme q-px-md q-py-md flex items-center">Ganancias Woz Dropshipping</div>
          <div class="q-px-md q-py-md ">
            <div class="flex justify-between items-center q-pb-sm q-mb-lg" style="border-bottom:  1px solid darkgray;">
              <div class="items-text">Ganancias netas</div>
              <div class="items-text text-grey-6">Gs.{{ numberFormat(stadistics.totalEarnings) }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-else class="q-py-lg flex flex-center">
      <q-spinner-dots
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
import { useRouter } from 'vue-router';
import { storeToRefs } from 'pinia';
import { useAuthStore } from '@/services/store/auth.store';
import { useDropshippingStore } from '@/services/store/dropshipping.store';
export default {


  setup () {
    const { user } = storeToRefs(useAuthStore())
    const router = useRouter()
    const actualMonth =  moment().get('month')
    const dropStore = useDropshippingStore()
    const ready = ref(false)
    const stadistics = ref({
      volumenEarnsForMonth:'0'
    })
    const series = ref([]);
    const chartOptions = ref({});
     const getStatdistics = () => {
      dropStore.getStadistics(user.value.id)
      .then((response) => {
        stadistics.value = response.data;

        series.value = [{
          name: "Ventas",
          data: stadistics.value.volumenEarnsForMonth.split(',')
        }]
        chartOptions.value = {
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
        }

        setTimeout(() =>{
          ready.value = true
        } ,200)
      })
    }
    
    const months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    const getLastMonth = () => {

      let result = []
      let monthLimit = stadistics.value.volumenEarnsForMonth.split(',').length > 5 ? 5 : (stadistics.value.volumenEarnsForMonth.split(',').length-1)

      for (let index = monthLimit; index >= 0; index--) {
        let selecction = actualMonth - index < 0 
        ? months.length + (actualMonth - index)
        : actualMonth - index

        result.push(months[selecction])
      }
      return result
    }
    const numberFormat = util.numberFormat


    const goTo = (url) => {
      router.push(url)
    }

    onMounted(() => {
      getStatdistics()
    })
    
    return {
      numberFormat,
      series,
      chartOptions,
      months,
      actualMonth,
      stadistics,
      ready,
      user,
      goTo,
    }
  }
}
</script>

<style lang="scss">
.items-text{
  font-size: 1rem;
}
.titleSectionInconme{
  background: #d8d8d8;
  color: black;
  font-weight: 900;
  font-size: 1rem;
}
.badgeStadisticProfile{
  background: #efefef;
  border-radius: 0.5rem;
  cursor: pointer;
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
<template>
  <section class="q-px-md q-mt-lg bg-grey-3 q-py-md">
    <div class="bg-white  q-py-md q-px-" style="border-radius: 1rem;">
      <div class="q-px-md">
        <div class="barTitle">Woz Dropshipping</div>
        <div class="barDataFinal">12.3K</div>
        <div class="barSubtitle">Clientes registrados </div>
      </div>
      <div>
        <div class="q-my-sm q-px-sm"> 
          <div class="flex items-end chartContainer q-pa-md" style="background-color: #f3f9ff; background-repeat: no-repeat; background-position: center; background-size: 92% 70%;" :style="{backgroundImage:'url('+stadisticBg+')'}">
            <div class="barColumn q-mr-xs" style="height: 12rem;background: #edaf33;" />
            <div class="barColumn" style="height: 7rem; background: #016aff" />
            <div class="barColumn q-ml-xs" style="height: 4rem;background: #17c920" />
          </div>
        </div>
        <div class="flex flex-center q-py-sm q-mt-sm" style="border-top: 2px solid lightgrey;">
          <div class="flex items-center q-pr-sm">
            <div class="pointLegend q-mr-xs" style="background: #edaf33;"></div>
            <div class="legendText">Paraguay 73%</div>
          </div>
          <div class="flex items-center q-px-sm">
            <div class="pointLegend q-mr-xs" style="background: #016aff;"></div>
            <div class="legendText">Argentina 16.2%</div>
          </div>
          <div class="flex items-center q-pl-sm">
            <div class="pointLegend q-mr-xs" style="background: #17c920;"></div>
            <div class="legendText">Otros 10.8%</div>
          </div>
        </div>
      </div>
    </div>

    <div class="bg-white  q-py-md q-mt-md" style="border-radius: 1rem;">
      <div class="flex justify-between items-center q-px-md">
        <div class="">
          <div class="pieChartTitle">Inversión en Ads</div>
          <div class="pieChartSubtitle">
            Inversión publicitaria empresarial <br>Woz Paraguay
          </div>
        </div>
        <div class="textInversion">
          Gs. <b style="font-size: 2rem;">55M</b>
        </div>
      </div>
      <div style="border-top: 1px solid lightgray;" class="q-mt-sm q-py-sm flex justify-between items-center q-px-md">
        <div class="textPieLegend q-pa-md ">
          Invertimos en
          publicidad empresarial
          para destacar nuestro
          modelo de negocio,
          aprovecha nuestras
          herramientas para
          crecer en ventas de
          manera gratuita
        </div>
        <div>
          <div class="pie-chart-container">
              <div class="pie-chart"></div>
              
              <div class="legend">
                  <div class="legend-item google-label">
                      <span>Google</span>
                      <span class="percentage">35%</span>
                  </div>
                  
                  <div class="legend-item meta-label">
                      <span>Meta Business</span>
                      <span class="percentage">37%</span>
                  </div>
                  
                  <div class="legend-item tiktok-label">
                      <span>TikTok</span>
                      <span class="percentage">28%</span>
                  </div>
              </div>
          </div>
        </div>
      </div>
    </div>

    <div></div>
  </section>
</template>
<script>
import stadisticBg from '@/assets/images/stadisticBg.webp'
export default {
  
  setup() {
    return {
      stadisticBg
    }  
  },
}
</script>
<style lang="scss">
.barTitle{
  font-size: 1.02rem;
  font-weight: 700;
}
.barDataFinal{
  font-size: 2rem;
  font-weight: 900;
}
.barSubtitle{
  font-size: 0.8rem;
  font-weight: 500;
}
.legendText{
  font-size: 0.8rem;
  font-weight: 500;
}
.pointLegend{
  background: white;
  height: 0.5rem;
  width: 0.5rem;
  border-radius: 50%;
}
.barColumn{
  width: 3rem;
  background: white;
  border-radius: 0.5rem;
}
.chartContainer{
  
  border-radius: .8rem;
}
.pieChartTitle{
  font-size: 1.25rem;
  font-weight: 800;
}
.pieChartSubtitle{
  font-size: 0.75rem;
  font-weight: 500;
}
.textInversion{
  color: #17c920;
  font-size: 1.3rem;
  font-weight: 900;
}
.textPieLegend{
  width: 50%;
  background-color: #f3f9ff;
  font-weight: 500;
  font-size: 0.75rem;

  border-radius: 0.8rem;
}
 .pie-chart-container {
    position: relative;
    width: 300px;
    height: 300px;
}

.pie-chart {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background: conic-gradient(
        #edaf33 0% 35%,
        #17c920 35% 60%,
        #016aff 60% 100%
    );
    position: relative;
}

.legend {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    pointer-events: none;
}

.legend-item {
    position: absolute;
    color: white;
    font-weight: bold;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
    font-size: 14px;
    text-align: center;
    transform-origin: center;
}

.google-label {
    transform: rotate(17.5deg) translateY(-80px);
}

.meta-label {
    transform: rotate(53.5deg) translateY(-80px);
}

.tiktok-label {
    transform: rotate(86deg) translateY(-80px);
}

.percentage {
    display: block;
    font-size: 16px;
}
</style>
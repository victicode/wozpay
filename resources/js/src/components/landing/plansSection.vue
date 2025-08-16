<template>
  <div class="q-pt-md">
    <div class="titleSection-lading q-pl-lg q-pr-xl">
      Comienza con un <br> plan de vendedor <br>Dropper
    </div>
    <div class="text-subtitle2 subtitleDesSection q-px-lg q-mt-md">
      <div class="text-grey-6 q-pl-sm ">
        Te ofrecemos tres planes de vendedor
        que puedes adquirir para comenzar a
        vender en Woz Dropshipping
      </div>
    </div>
  </div>
  <div class="q-px-md q-pt-md">
    <div v-for="(plan, i) in plans" :key="i" class="plansBox q-my-md">
      <div class="q-pt-lg q-pb-md q-px-md">
        <div>
          <div style="font-weight: 500;font-size: 0.95rem;" class="text-white">Plan</div>
          <div class="planTitle ">{{ plan.title }}</div>
          <div class="planSubtitle q-mt-xs" v-html="plan.subtitle" />
        </div>
        <div class="text-white q-mt-md">
          <div class="text-bold">Beneficios:</div>
          <ul class="q-my-md">
            <li v-for="(benefit, key) in plan.benefits" :key="key" class="benefitItem q-mb-xs">
              <b class="q-mr-xs">•</b> {{benefit}}
            </li>
          </ul>
        </div>
        <div v-if="!plan.free">
            <div class="text-white" style="font-weight: 300;font-size: 0.9rem;">Costo de membresía</div>
            <div class="text-white costText">
              GS {{ numberFormat(plan.cost) }} <span style="font-size: 1rem; transform: translateY(-12px);">{{ i == 1 ? 'anual' : 'mensual' }}</span>
            </div>
            <div class="benefitOffer text-white">
              {{ plan.sutitleCost }}
            </div>
        </div>
      </div>
      <div class="planBottom q-px-md q-py-lg text-white" :style="'background-color:'+plan.color">
        {{ plan.bottomTitle }}
      </div>
    </div>
  </div>
</template>
<script>
import util from '@/util/numberUtil';

export default {
  
  setup() {

    const numberFormat = util.numberFormat
    const plans = [
      {
        title: 'DROPPER GRATUITO',
        subtitle: 'Con este plan podes vender hasta <br> 5 productos por mes',
        benefits: [
          'Hasta 5 productos',
          '15% de comision',
          'Ventas nacionales',
          'Retiros semanales'
        ],
        color:'#1c264b',
        bottomTitle:'Registrate gratuitamente',
        mostSell: false,
        free: true,
      },
      {
        title: 'DROPPER PROFESIONAL',
        subtitle: 'Dirigido a profesionales, tendrás acceso a más <br> herramientas',
        benefits: [
          'Productos ilimitados',
          '40% de comisión',
          'Ventas nacionales',
          'Ventas internacionales',
          'Retiros semanales'
        ],
        color:'#1cc718',
        bottomTitle:'Registrate por Gs. 250.000 anual',
        mostSell: true,
        free: false,
        cost: 250000,
        sutitleCost: 'Tarifa mensual luego del primer año Gs. 250.000'
      },
      {
        title: 'PROVEEDOR AUTORIZADO',
        subtitle: 'Exclusivo para tiendas fisicas.<br> Contrato minimo de 12 meses como proveedor Dropshipping',
        benefits: [
          'Productos ilimitados',
          'Más de 500 vendedores',
          'Ventas nacionales',
          'Ventas internacionales',
          'Mayor alcance',
          'Publicidad',
          'Sistema de gestión de ventas'
        ],
        color:'#0753e7',
        bottomTitle:'Registrate por Gs. 350.000 anual',
        mostSell: false,
        free: false,
        cost: 350000,
        sutitleCost: ''
      },
    ]
    return {
      plans,
      numberFormat
    }
  },
}
</script>

<style lang="scss">
.costText{
  font-size: 1.6rem;
  font-weight: 700;
  letter-spacing: 1.5px;
}
.benefitOffer{
  font-size: 0.6rem;
  font-weight: 300;
}
.benefitItem{
  font-size: 0.75rem;
  font-weight: 300;

}
.planSubtitle{
  color: white;
  font-size: 0.78rem;
  width: 100%;

}
.planTitle{
  font-size: 1.5rem;
  font-weight: 700;
  color: white;
}
.plansBox{
  border-radius: 1rem;
  overflow: hidden;
  background: #2f2d41;
}
.subtitleDesSection{
  width: 80%;
  position: relative;
  & .text-grey-6{
    line-height: 1.3;
  }
  &::after{
    content: '';
    top: -0.4rem;
    background: #2f2d41;
    border-radius: 1rem;
    height: 4rem;
    width: 2px;
    display: block;
    position: absolute;

  }
}
.titleSection-lading{
  color:#2f2d41;
  font-weight: 900;
  font-size:1.88rem;
  line-height: 1.2;
}
</style>
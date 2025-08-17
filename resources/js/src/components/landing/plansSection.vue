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
    <div v-for="(plan, i) in plans" :key="i" class="plansBox q-my-md" :style="{backgroundImage:'url('+plan.img+ ')', backgroundPosition:plan.position+'% center'}" style="    
    background-repeat: no-repeat;
    background-size: cover;">
      <div style="position: absolute; background: #00000085; top: 0; bottom: 0; left: 0; right: 0; z-index: 1;" />
      <div style="position: relative;z-index: 2">
        <div class="q-pt-lg q-pb-md q-px-md">
          <div v-if="plan.mostSell" class="text-white q-mb-md flex items-center mostSellBadge" >
            <div class=" q-mr-xs" style="font-weight: 400; font-size: 0.85rem;">
              Más adquirido 
            </div>
            <q-icon :name="icons.raiting" color="white" size="1.2rem" />
          </div>
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
  </div>
</template>
<script>
import util from '@/util/numberUtil';
import proveedor from '@/assets/images/proveedor.jpeg'
import profesional from '@/assets/images/profesional.jpeg'
import gratuito from '@/assets/images/gratuito.jpeg'
import { inject } from 'vue';

export default {
  
  setup() {
    const icons = inject('ionIcons');
    const numberFormat = util.numberFormat
    const plans = [
      {
        img: gratuito,
        position:2,
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
        img: profesional,
        position: 70,
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
        img: proveedor,
        position:15,
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
      numberFormat,
      icons,
    }
  },
}
</script>

<style lang="scss">
.mostSellBadge{
  padding: 0.4rem 1.2rem;
  background: #19cd15;
  border-radius: 0.45rem;
  width: max-content
}
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
  position: relative;
  background-size: cover;
  background-repeat: no-repeat;
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
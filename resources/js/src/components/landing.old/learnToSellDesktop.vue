<template>
<div class="q-px-xl q-pb-xl q-pt-md">
  <div class="q-mt-lg">
    <div class="titleSection-ladingPlan">Aprende cómo vender</div>
    <div class="q-mt-md titleSection-ladingPlan q-pl-sm" style="font-size: 1.2rem;">

      Crea una estrategia de ventas
    </div>
    <div class="subtitleDesSectionPlan q-px-xs q-mt-md">
      <div class=" q-pl-md ">
        Es es importante que sepas crear una estrategia de venta, te facilitamos algunos puntos a <br>
        tener en cuenta
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-4 q-pt-xl flex items-center q-pl-lg">
      <div v-html="wozIcons.userPanel" style="transform: scale(1.1);"/>
      <div class="q-mx-md">
        <div class="text-subPanel1">Realiza un análisis de tus </div>
        <div class="text-subPanel text-primary">Futuros competidores</div>
      </div>
    </div>
    <div class="col-4 q-pt-xl flex items-center q-pl-lg">
      <div v-html="wozIcons.podium" style="transform: scale(1.1);"/>
      <div class="q-mx-md">
        <div class="text-subPanel1">Encuentra el equilibrio con un  </div>
        <div class="text-subPanel text-sectionActive">Análisis FODA</div>
      </div>
    </div>
    <div class="col-4 q-pt-xl flex items-center q-pl-lg">
      <div v-html="wozIcons.menu" style="transform: scale(1.1);"/>
      <div class="q-mx-md">
        <div class="text-subPanel1">Sé único y crea un</div>
        <div class="text-subPanel" style="color:#1cd6b3">factor diferencial</div>
      </div>
    </div>
    <div class="col-4 q-pt-xl flex items-center q-pl-lg">
      <div v-html="wozIcons.usPan" style="transform: scale(1.1);"/>
      <div class="q-mx-md">
        <div class="text-subPanel1">Interioriza con tu cliente haciendo un </div>
        <div class="text-subPanel" style="color:#915e1a">Buyer Persona</div>
      </div>
    </div>
    <div class="col-4 q-pt-xl flex items-center q-pl-lg">
      <div v-html="wozIcons.speaker" style="transform: scale(1.1);"/>
      <div class="q-mx-md">
        <div class="text-subPanel1">Encara con un nuevo desafío con un  </div>
        <div class="text-subPanel" style="color: #229cb7;">Plan de Marketing</div>
      </div>
    </div>
    <div class="col-4 q-pt-xl flex items-center q-pl-lg">
      <div v-html="wozIcons.badge" style="transform: scale(1.1);"/>
      <div class="q-mx-md">
        <div class="text-subPanel1">Adquiere una imagen o una</div>
        <div class="text-subPanel text-sectionActive">Identidad de marca</div>
      </div>
    </div>
  </div>
  <div class="text__inblue q-pl-lg q-mt-lg">
    ¿Tienes problemas para crear una estrategia de ventas? Consigue un asesor en Woz Business
  </div>
  <div class="q-mt-lg cardTableLanding q-pa-xl">
    <div class="flex q-my-xl q-ml-lg">
      <div style="width:2.5rem">
        <div style="transform: scale(1.2);" v-html="wozIcons.userPanel"/>
      </div>
      <div class="q-pl-md">
        <div style=" font-size: 1.5rem;" class="text-subPanel3 text-primary">Futuros competidores</div>
        <div class="text-subPanel4 q-mt-md">
          Un análisis competitivo es una investigación sobre el panorama de tu segmento de mercado para descubrir lo que tus competidores <br>
          están haciendo. El objetivo es entender cómo se comportan dentro del mercado para planificar actividades comerciales que<br>
          contrarresten sus puntos fuertes y exploten los débiles
        </div>
      </div>
    </div>
    <div class="flex q-my-xl q-ml-lg">
      <div style="width:2.5rem">
        <div style="transform: scale(1.2);" v-html="wozIcons.podium"/>
      </div>
      <div class="q-pl-md">
        <div style=" font-size: 1.5rem;" class="text-subPanel3 text-sectionActive">Realiza un analisis FODA</div>
        <div class="text-subPanel4 q-mt-md">
          El análisis FODA consiste en realizar una evaluación de los factores de tu <b>FORTALEZA</b> y <b>OPORTUNIDADES</b> que en su<br>
          conjunto diagnostican la situación interna de una organización, así como su evaluación externa; es decir, las <b>DEBILIDADES</b> y<br>
          <b>AMENAZAS</b>.
        </div>
      </div>
    </div>
    <div class="flex q-my-xl q-ml-lg">
      <div style="width:2.5rem">
        <div style="transform: scale(1.2);" v-html="wozIcons.menu"/>
      </div>
      <div class="q-pl-md">
        <div style=" font-size: 1.5rem; color:#1cd6b3" class="text-subPanel3">Crea un factor diferencial</div>
        <div class="text-subPanel4 q-mt-md">
          Debes saber cómo distingues lo que vendes de los productos de tus competidores y aumenta la fidelidad de marca, las ventas y el<br>
          crecimiento. Por ejemplo, si tu empresa de ventas proporciona envíos las 24 horas del día con descuentos y atención al cliente y tus<br>
          competidores no, eso es un diferenciador.
        </div>
      </div>
    </div>
    <div class="flex q-my-xl q-ml-lg">
      <div style="width:2.5rem">
        <div style="transform: scale(1.2);" v-html="wozIcons.usPan"/>
      </div>
      <div class="q-pl-md">
        <div style=" font-size: 1.5rem; color:#915e1a" class="text-subPanel3">Forma un Buyer Persona</div>
        <div class="text-subPanel4 q-mt-md">
          Es una representación ficticia del público objetivo de una empresa mediante la que podemos conocer con detalle a su<br>
          audiencia para crear estrategias de marketing lo más orientadas posible a partir de sus necesidades.
        </div>
      </div>
    </div>
    <div class="flex q-my-xl q-ml-lg">
      <div style="width:2.5rem">
        <div style="transform: scale(1.2);" v-html="wozIcons.speaker"/>
      </div>
      <div class="q-pl-md">
        <div style=" font-size: 1.5rem; color: #229cb7;" class="text-subPanel3">Invierte en un plan de Marketing</div>
        <div class="text-subPanel4 q-mt-md">
          Un plan de marketing es un documento escrito, que resume lo que se conoce sobre el mercado e indica cómo es que la empresa<br>
          pretende alcanzar sus objetivos de marketing. El plan de marketing incluye directrices tácticas para los programas de marketing<br>
          y asignaciones financieras para el periodo que cubre.
        </div>
      </div>
    </div>
    <div class="flex q-my-xl q-ml-lg">
      <div style="width:2.5rem">
        <div style="transform: scale(1.2);" v-html="wozIcons.badge"/>
      </div>
      <div class="q-pl-md">
        <div style=" font-size: 1.5rem;" class="text-subPanel3 text-sectionActive">Identidad de marca</div>
        <div class="text-subPanel4 q-mt-md">
          Identidad de marca es el conjunto de rasgos que definen los valores y misión de tu negocio. Los logos de tu compañía, diseños <br>
          de productos y ética del negocio; todos forman parte de tu marca.
          <br><br>

          El objetivo es usar todos estos elementos visuales y físicos para crear una impresión positiva en tus clientes. La identidad de
          marca también: <br><br>
          • Les da a tus productos una sensación única <br><br>
          • Les muestra a los clientes quién eres y cómo resuelves los problemas <br><br>
          • Transmite cómo quieres que se sientan los clientes cuando usan tu producto <br><br>
        </div>
      </div>
    </div>
    
  </div>
</div>
</template>
<script>

import wozIcons from '@/assets/icons/wozIcons';

export default {
  setup() {

    return {
      wozIcons
    }
  },
}
</script>
<style>
.text-subPanel4{
  color: rgb(102 102 102);
  font-size: 1.02rem;
  font-weight: 100;
  font-family: 'Amazon Ember Regular'!important;
}
.text__inblue{
  color: #0269ff;
  font-size: 1.12rem;

  font-weight: 900;
  font-family: 'Amazon Ember Bolder'!important;
}
.text-subPanel1{
  font-size: 1.1rem;
  font-weight: 400;
  color: rgb(80, 80, 80)
}

.text-subPanel{
  font-size: 1.1rem;
  font-weight: 700;
}
.text-subPanel3{
  font-weight: 100;

  font-family: 'Amazon Ember Bolder'!important;
}
</style>
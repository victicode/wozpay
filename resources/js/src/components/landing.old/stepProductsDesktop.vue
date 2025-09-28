<template>
<div class="q-px-xl q-pb-xl q-pt-md">
  <div class="q-mt-lg">
    <div class="titleSection-ladingPlan">Selecciona tus productos</div>
    <div class="subtitleDesSectionPlan q-px-xs q-mt-md">
      <div class=" q-pl-md ">
        El principio de toda una venta exitosa es tener un producto ganador. <br>
        Asegurate de conseguir uno.
      </div>
    </div>
  </div>
  <div class="q-mt-xl row">
    <div class="col-3 q-my-sm q-mx-lg">
      <div class="header__item-p flex items-end q-pb-sm">
        <div v-html="wozIcons.docStep" />
        <div class="q-ml-sm ">
          Selección de categoria
        </div>
      </div>
      <div class="q-pt-xs content__item-p q-my-md">
        Identificamos nichos relevantes para vos, con potencial  <br>
        de crecimiento, alineados a tendencias y demandas de <br>
        mercado
      </div>
    </div>
    <div class="col-3 q-my-sm q-mx-lg">
      <div class="header__item-p flex items-end q-pb-sm">
        <div v-html="wozIcons.imgCheck" />
        <div class="q-ml-sm ">
          Elección del producto ganador
        </div>
      </div>
      <div class="q-pt-xs content__item-p q-my-md">
        Filtramos dentro de cada categoria rentable productos <br>
        con alto margen, demanda comprobada y potencial <br>
        viral
      </div>
    </div>
    <div class="col-3 q-my-sm q-mx-lg">
      <div class="header__item-p flex items-end q-pb-sm">
        <div v-html="wozIcons.stick" />
        <div class="q-ml-sm ">
          Analisis de productos con AI
        </div>
      </div>
      <div class="q-pt-xs content__item-p q-my-md">
        Puedes analizar productos en tiempo real con nuestras <br>
        herramientas de inteligencia artificial. <br>
      </div>
    </div>
    <div class="col-3 q-my-sm q-mx-lg">
      <div class="header__item-p flex items-end q-pb-sm">
        <div v-html="wozIcons.editItem" />
        <div class="q-ml-sm ">
          Buena descripción
        </div>
      </div>
      <div class="q-pt-xs content__item-p q-my-md">
        Seleccionamos un catalogo persuasivo, con rentabilidad <br>
        escalable listos para las ventas. <br>
      </div>
    </div>
    <div class="col-3 q-my-sm q-mx-lg">
      <div class="header__item-p flex items-end q-pb-sm">
        <div v-html="wozIcons.brush" />
        <div class="q-ml-sm ">
          Woz ADS
        </div>
      </div>
      <div class="q-pt-xs content__item-p q-my-md">
        Impulsa tus ventas automatizadas con Woz Ads
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
<style lang="scss">
.header__item-p {
  font-size: 1rem;
  font-weight: bold;
  border-bottom: 2px solid $primary;
}
.content__item-p{
  font-size: 0.86rem;
  font-weight: 100;
  font-family: 'Amazon Ember Regular'!important;
  color: rgb(75, 75, 75);

}
</style>
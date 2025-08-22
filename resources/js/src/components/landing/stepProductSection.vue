<template>
  <div class="q-pt-lg" >
    <div class="titleSection-lading q-pl-lg q-pr-xl " style="line-height: 1;">
      Selecciona tus <br>productos
    </div>
    <div class="text-subtitle2 subtitleMapSection q-px-lg q-mt-lg">
      <div class="text-grey-6 q-pl-sm ">
        El principio de toda una venta exitosa es tener un producto ganador. Asegurate de conseguir uno.
      </div>
    </div>

    <div class="q-py-md q-px-sm" >
      <div class="flex justify-between q-px-xs q-my-md" style="flex-wrap: nowrap;">
        <div style="width: 8%;" class="q-pt-sm">
          <div class="itemBadge flex flex-center" >A</div>
        </div>
        <div style="width: 86%;">
          <div class="header__item-p flex items-end justify-between q-pb-xs">
            <div>
              Selección de categoria
            </div>
            <div v-html="wozIcons.docStep" />
          </div>
          <div class="q-pt-xs content__item-p">
            Identificamos nichos relevantes para vos, con potencial de
            crecimiento, alineados a tendencias y demandas de
            mercado
          </div>
        </div>
      </div>
      <div class="flex justify-between q-px-xs q-my-md" style="flex-wrap: nowrap;">
        <div style="width: 8%;" class="q-pt-sm">
          <div class="itemBadge flex flex-center" >B</div>
        </div>
        <div style="width: 86%;">
          <div class="header__item-p flex items-end justify-between q-pb-xs">
            <div>
              Elección del producto ganador
            </div>
            <div v-html="wozIcons.imgCheck" />
          </div>
          <div class="q-pt-xs content__item-p">
            Filtramos dentro de cada categoria rentable productos
            con alto margen, demanda comprobada y potencial
            viral
          </div>
        </div>
      </div>
      <div class="flex justify-between q-px-xs q-my-md" style="flex-wrap: nowrap;">
        <div style="width: 8%;" class="q-pt-sm">
          <div class="itemBadge flex flex-center" >C</div>
        </div>
        <div style="width: 86%;">
          <div class="header__item-p flex items-end justify-between q-pb-xs">
            <div>
              Analisis de productos con AI
            </div>
            <div v-html="wozIcons.stick" />
          </div>
          <div class="q-pt-xs content__item-p">
            Puedes analizar productos en tiempo real con nuestras
            herramientas de inteligencia artificial.
          </div>
        </div>
      </div>
      <div class="flex justify-between q-px-xs q-my-md" style="flex-wrap: nowrap;">
        <div style="width: 8%;" class="q-pt-sm">
          <div class="itemBadge flex flex-center" >D</div>
        </div>
        <div style="width: 86%;">
          <div class="header__item-p flex items-end justify-between q-pb-xs">
            <div>
              Buena descripción
            </div>
            <div v-html="wozIcons.editItem" />
          </div>
          <div class="q-pt-xs content__item-p">
            Seleccionamos un catalogo persuasivo, con rentabilidad
            escalable listos para las ventas.
          </div>
        </div>
      </div>
      <div class="flex justify-between q-px-xs q-my-md" style="flex-wrap: nowrap;">
        <div style="width: 8%;" class="q-pt-sm">
          <div class="itemBadge flex flex-center" >E</div>
        </div>
        <div style="width: 86%;">
          <div class="header__item-p flex items-end justify-between q-pb-xs">
            <div>
              Woz ADS
            </div>
            <div v-html="wozIcons.brush" />
          </div>
          <div class="q-pt-xs content__item-p">
            Impulsa tus ventas automatizadas con Woz Ads
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

<style lang="scss">
.itemBadge{
  height: 2rem;
  width: 2rem;
  color: white;
  font-size: 1rem;
  font-weight: 900;
  background: $primary;
  border-radius: 3rem;
}
.header__item-p {
  font-size: 1rem;
  font-weight: bold;
  border-bottom: 2px solid $primary;
}
.content__item-p{
  font-size: 0.75rem;
  font-weight: 500;
  color: rgb(75, 75, 75);

}
</style>

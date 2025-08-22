<template>
  <section class=" sectionActiveBenefit q-pb-xl q-pt-md relative">
    <div style="position: relative; z-index: 3;">
      <div class="q-px-md   q-pt-md q-mb-lg">
        <div class="titleActiveBenefit">Activa una cuenta digital en Woz Pay</div>
        <div class="subtitleActiveBenefit q-mt-md">
          Con tu plan Profesional podes activar de forma 
          manual tu cuenta Woz Pay para vender sin complicaciones en todo el mundo
        </div>
      </div>
      <div>
        <div class="flex items-top q-my-md q-px-md" style="flex-wrap: nowrap;">
          <div style="width: 9%; transform: translateY(0.5rem);">
            <div class="flex flex-center checkMark">
              <q-icon name="eva-checkmark-outline" color="sectionActive" size="0.7rem" />
            </div>
          </div>
          <div style="width: 95%;" class="q-px-sm text-white itemBenefit">
            Realiza transferencias bancarias las 24 horas al día los 7 días de la <br>semana
          </div>
        </div>
        <div class="flex items-top q-my-md q-px-md" style="flex-wrap: nowrap;">
          <div style="width: 9%; transform: translateY(0.5rem);">
            <div class="flex flex-center checkMark">
              <q-icon name="eva-checkmark-outline" color="sectionActive" size="0.7rem" />
            </div>
          </div>
          <div style="width: 95%;" class="q-px-sm text-white itemBenefit">Cobra por tu ventas nacionales e internacionales con un solo link </div>
        </div>
        <div class="flex items-top q-my-md q-px-md" style="flex-wrap: nowrap;">
          <div style="width: 9%; transform: translateY(0.5rem);">
            <div class="flex flex-center checkMark">
              <q-icon name="eva-checkmark-outline" color="sectionActive" size="0.7rem" />
            </div>
          </div>
          <div style="width: 95%;" class="q-px-sm text-white itemBenefit">Consigue una tarjeta virtual de débito Woz Pay y genera puntos</div>
        </div>
        <div class="flex items-top q-my-md q-px-md" style="flex-wrap: nowrap;">
          <div style="width: 9%; transform: translateY(0.5rem);">
            <div class="flex flex-center checkMark">
              <q-icon name="eva-checkmark-outline" color="sectionActive" size="0.7rem" />
            </div>
          </div>
          <div style="width: 95%;" class="q-px-sm text-white itemBenefit">Accede a una línea de micro préstamos y mejora tu clasificación crediticia</div>
        </div>
      </div>
      <div class="q-mt-xl">
        <div class="flex flex-center q-px-xl">
          <img :src="phone" alt="">
        </div>
      </div>
    </div>
    <div class="p-figure" />

  </section>
</template>

<script>
import phone from '@/assets/images/phoneLandingNew.webp'
export default {
  
  setup() {
    return {
      phone
    }  
  },
}
</script>

<style lang="scss">
.itemBenefit{
  font-size: 1rem;
  font-weight: 400;

}
.checkMark{
  height: 1.1rem;
  width: 1.1rem;
  border-radius: 2rem;
  background: white;
}
.sectionActiveBenefit{
  background: #f9b229;
  height: fit-content;
  overflow: hidden;
}
.text-sectionActive{
  color: #f9b229;
}
.bg-sectionActive{
  background: #f9b229;

}
.titleActiveBenefit{
  width: 80%;
  color: white;
  font-size: 2.2rem;
  line-height: 1.2;
  font-weight: 900;
}
.subtitleActiveBenefit{
  width: 90%;
  font-size: 0.95rem;
  color: white;
}
.p-figure{
  position: absolute; 
  z-index: 2;
  bottom:-12rem; 
  right: -7rem;
  width: 35rem; 
  height: 40rem;
  border-radius: 2rem; 
  background: white;
  transform: rotate(-20deg);
}
</style>
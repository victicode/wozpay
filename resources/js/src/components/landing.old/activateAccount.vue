<template>
<section class="q-px-xl">
  <div class="sectionActiveLading q-py-xl relative q-my-md row">
    <div class="col-9">
      <div class="q-px-xl">
        <div class="textActivete">Activa una cuenta digital en Woz Pay</div>
        <div class="text-white text-subtitleActivete q-mt-sm">
          Con tu plan Profesional podes activar de forma manual tu cuenta Woz Pay para vender sin <br>
          complicaciones en todo el mundo

        </div>
      </div>
      <div class="row items-center q-px-lg q-pt-md" >
        <div class="col-6 q-py-sm flex q-px-md" style="flex-wrap: nowrap;">
          <div style="width: 8%; transform: translateY(0.2rem);">
            <div class="flex flex-center checkMark">
              <q-icon name="eva-checkmark-outline" color="sectionActive" size="1rem" />
            </div>
          </div>
          <div class="text-white text-itemSub q-pl-none">
            Realiza transferencias bancarias las <br>
            24 horas al día los 7 días de la <br>
            semana <br>
          </div>
        </div>
        <div class="col-6 q-py-sm flex q-px-md" style="flex-wrap: nowrap;">
          <div style="width: 8%; transform: translateY(0.2rem);">
            <div class="flex flex-center checkMark">
              <q-icon name="eva-checkmark-outline" color="sectionActive" size="1rem" />
            </div>
          </div>
          <div class="text-white text-itemSub q-pl-none">
            Consigue una tarjeta virtual de<br>
            débito Woz Pay y genera puntos<br>
          </div>
        </div>
        <div class="col-6 q-py-sm flex q-px-md" style="flex-wrap: nowrap;">
          <div style="width: 8%; transform: translateY(0.2rem);">
            <div class="flex flex-center checkMark">
              <q-icon name="eva-checkmark-outline" color="sectionActive" size="1rem" />
            </div>
          </div>
          <div class="text-white text-itemSub q-pl-none">
            Cobra por tu ventas nacionales e<br>
            internacionales con un solo link <br>
          </div>
        </div>
        <div class="col-6 q-py-sm flex q-px-md" style="flex-wrap: nowrap;">
          <div style="width: 8%; transform: translateY(0.2rem);">
            <div class="flex flex-center checkMark">
              <q-icon name="eva-checkmark-outline" color="sectionActive" size="1rem" />
            </div>
          </div>
          <div class="text-white text-itemSub q-pl-none">
            Accede a una línea de micro préstamos<br>
            y mejora tu clasificación crediticia<br>
          </div>
        </div>
      </div>
    </div>
    <div class="col-3 q-pl-xl">
      <img :src="phone"  style="width: 80%; transform: translateY(-1.6rem);"/>
    </div>
  </div>

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
<style>
.text-itemSub{
  font-size: rem;
  font-family: 'Amazon Ember Bolder'!important;
  font-weight: 100;
  line-height: 1.3;
}
.checkMark{
  height: 1.2rem;
  width: 1.2rem;
  border-radius: 2rem;
  background: white;
}
.text-sectionActive{
  color: #f9b229;
}
.bg-sectionActive{
  background: #f9b229!important;

}
.text-subtitleActivete{
  font-size: 1.05rem;
  font-family: 'Amazon Ember regular'!important;
  font-weight: 500;
}
.textActivete{
  font-size: 1.6rem;
  color:white;
  font-weight: 900;
  font-family: 'Amazon Ember Bolder'!important;
  
}
.sectionActiveLading{
  background: #f9b229;
  height: 22rem;
  overflow: hidden;
  border-radius: 1.1rem;

}
</style>
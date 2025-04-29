<template>
  <div>
    <section class="q-pt-xl q-px-md hero_content" >
      <div class="overflow" />
      <div class="q-pt-md q-pl-sm q-pr-md" style="z-index: 2; position: relative;">
        <div class="text-header1">
          WOZ DROPSHIPPING PARAGUAY
        </div>
        <div class="text-header2 q-mt-xs q-pr-lg">
          Genera 6.500.000 Guaraníes mensuales
          vendiendo productos premium
        </div>
        <q-btn color="white" text-color="black" label="Comezar a vender" no-caps id="initDropshipping_button" class="q-mt-lg q-mb-xl" />
      </div>
    </section>
    <div class="videoSection flex justify-center w-100 q-px-sm" style="z-index: 2; position: relative;">
      <video  class="">
        <source src="https://youtu.be/WQCRK5E4n-g?si=JUzX1FAz8a4Z-GMB" type="video/mp4" />
      </video>
    </div>
  </div>
</template>
<script >
  import { inject, onMounted, ref } from 'vue';
  import { useQuasar } from 'quasar'


  export default {

    setup () {
      //vue provider
      const icons = inject('ionIcons')
      const $q = useQuasar()

    }
  };
</script>
<style lang="scss">
.videoSection{
  transform: translateY(-10rem);
  & video {
    border-radius: 40px; height: 250px; width: 70%;
  }
}
#initDropshipping_button{
  padding: 1.2rem 1.5rem;
  border-radius: 1.5rem;
  & .block{
    
    font-weight: 500;
    letter-spacing: 0.8px;
    font-size: 1rem;
  }
  &:before{
    box-shadow: none;
  }
}
.hero_content{
  height: 46vh;
  background: url('https://wozpayments.com/public/images/web/dropshipping/dropshippingHero1.jpg');
  position: relative;
  & .overflow{
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    z-index: 1;
    background: rgba(0, 0, 0, 0.247);
  }
}
[class*=text-header]{
 
  color: white;
  z-index: 3;

}
.text-header1{
  font-family: 'Amazon Ember Bolder'!important;
  font-weight: bolder;
  font-size: 2rem;
  line-height: 1.2;
  letter-spacing: 1px;

}
.text-header2{
  font-family: 'Amazon Ember Regular'!important;
  // font-weight: bolder;
  font-size: 1rem;
  line-height: 1.5;
  letter-spacing: 1px;
}
@media screen and (max-width: 780px){
  .videoSection{

  & video {
    height: 210px; width: 100%;
  }
}
}

</style>
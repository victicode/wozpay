<template>
<section class="hero-content q-px-md q-pb-sm q-pt-lg q-px-md-sm " transition-style="in:circle:center" >
  <div class=" q-px-md-lg hero-content_title flex justify-between" transition-style="in:circle:center" >
    <div class="  text-weight-bold  text-font-roboto"  style="font-size: 1.8rem;color:#0269ff">
      Woz Paraguay
    </div>
    <dotsWoz class="q-pt-md"/>
  </div>
</section> 

</template>
<script>
  import dotsWoz from '@/components/dropshipping/layout/dots.vue';
  export default {
    components: {
      dotsWoz
    },
    setup() {
      
    },
  }
</script>
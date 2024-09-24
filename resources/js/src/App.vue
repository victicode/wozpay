<template>
  <q-layout view="hHh lpR fFf" style="overflow: hidden;">
    <baseLayoutVue class="body"/>
  </q-layout>
</template>
<script >
  import baseLayoutVue from '@/layouts/baseLayout.vue';

  export default {
    components: {
      baseLayoutVue
    }
  };
</script>
<style scss scoped>
  .body{
      width: 50%;
      margin: auto;
      overflow: hidden;
      position: relative;
  }

  @media screen and (max-width: 780px){
    .body{
      width: 100%;
      margin: auto;
    }
  }
</style>
<style>
.animate__animated {/* referring directly to the animation's @keyframe declaration */
  animation-duration: 0.2s; /* don't forget to set a duration! */
}
</style>
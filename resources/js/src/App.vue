<script setup>

</script>

<template>
  <div>
    <h1>Hola mundo</h1>
    <!-- <router-view v-slot="{Component}">
       <transition 
          mode="out-in" 
          enter-active-class="animate__animated animate__zoomIn" 
          leave-active-class="animate__animated animate__zoomOut"
        >
          <component :is="Component"/>
       </transition>
    </router-view> -->
  </div>
</template>
<style>
.animate__animated {/* referring directly to the animation's @keyframe declaration */
  animation-duration: 0.2s; /* don't forget to set a duration! */
}
</style>
<template>
  <q-layout view="hHh lpR fFf">
    <q-page-container class="body">
      <router-view v-slot="{ Component }">
        <transition name="vertical">
          <component :is="Component" />
        </transition>
      </router-view>
    </q-page-container>
  </q-layout>
</template>
<script>
  export default {
    setup () {
    }
  };

</script>
<style scoped>

</style>
<style>
.animate__animated {/* referring directly to the animation's @keyframe declaration */
  animation-duration: 0.2s; /* don't forget to set a duration! */
}
</style>
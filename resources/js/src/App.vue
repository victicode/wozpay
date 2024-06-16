<template>
  <q-layout view="hHh lpR fFf">
    <q-page-container class="body">
      <RouterView />
    </q-page-container>
  </q-layout>
</template>
<script>
  import { useQuasar } from 'quasar'
export default {
  setup () {
    const q = useQuasar()
    console.log(q)
    return {
      q,
    }
  }


};

</script>
<style scss scoped>
 .body{
    width: 50%;
    margin: auto;
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
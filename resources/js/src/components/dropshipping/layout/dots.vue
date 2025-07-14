<template>
  <div class="flex items-center">
    <div v-for="(i,n) in dots " :key="n" :style="'background:'+i" class="dotsWoz">
      
    </div>
  </div>
</template>
<script>

export default {

  setup(props) {
    const dots = [
      '#19cd15',
      '#0c3846',
      '#0449fa'
    ]
    return {
      dots,
    }
  },
}
</script>
<style>
.dotsWoz{
  height: 0.8rem;
  width: 0.8rem;
  border-radius: 50%;
  margin: 0px 0.07rem;
}

</style>
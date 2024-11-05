<template>
  <section class="q-mt-xs q-pt-xl q-pb-xs show-xs">
    <div class="backTop text-link0" @click="backtop()">
      Volver al principio
    </div>
  </section>
</template>
<script>


export default {
  setup() {
  
    return {
      backtop: () => {
        console.log('topree')
      }
    }
  },
}
</script>

<style lang="scss">
.backTop{
  display: flex;
  justify-content: center;
  width: 100%;
  font-size: 1.2rem;
  font-weight: bold;
  color: #2f2e41;
  transition: all 0.5 ease;
  cursor: pointer;
  &:hover{
    text-decoration: underline;
  }
}

</style>
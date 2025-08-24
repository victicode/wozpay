<template>
    <div>
      <landing v-if="currentScreen=='mobile'"/> 
      <landingOld v-else />
    </div>
</template>
<script>
  import landing from '@/pages/landing.vue';
  import landingOld from '@/pages/landing.old.vue';
  import { onMounted, ref } from 'vue';
  export default {
    components: {
      landing,
      landingOld
    },
    setup() {
      const currentScreen = ref('')
      const getCurrentScreen = () =>{
        console.log(window.screen.width)
        if(window.screen.width < 780 ){
          currentScreen.value = 'mobile'
        }
      }
      onMounted(() => {
        getCurrentScreen()
      })

      return{
        currentScreen
      }
    }

  }
</script>
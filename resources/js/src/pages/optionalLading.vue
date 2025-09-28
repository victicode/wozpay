<template>
    <div>
      <landing v-if="currentScreen=='mobile'"/> 
      <landingDesktop v-else />
    </div>
</template>
<script>
  import landing from '@/pages/landing.vue';
  import landingDesktop from '@/pages/landingDesktop.vue';
  import { onMounted, ref } from 'vue';
  export default {
    components: {
      landing,
      landingDesktop
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
<template>
  <main>
    <heroSection class="q-mb-md" />
    <frecuentQuestion />
    <logistSection />
  </main>
</template>
<script >
  import { inject, onMounted, ref } from 'vue';
  import heroSection from '@/components/dropshipping/landing/heroSection.vue';
  import frecuentQuestion from '@/components/dropshipping/landing/frecuentQuestion.vue';
  import logistSection from '@/components/dropshipping/landing/logistSection.vue';
  logistSection

  export default {
    components:{
      heroSection,
      frecuentQuestion,
      logistSection,
    },
    setup () {
    }
  };
</script>

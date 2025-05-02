<template>
  <main>
    <heroSection class="q-mb-md" />
    <frecuentQuestion />
  </main>
</template>
<script >
  import { inject, onMounted, ref } from 'vue';
  import heroSection from '@/components/dropshipping/landing/heroSection.vue';
  import frecuentQuestion from '@/components/dropshipping/landing/frecuentQuestion.vue';

  export default {
    components:{
      heroSection,
      frecuentQuestion
    },
    setup () {
    }
  };
</script>

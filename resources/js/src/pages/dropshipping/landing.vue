<template>
  <main>
    <heroSection class="q-mb-md" />
    <frecuentQuestion />
    <logistSection />
    <integrationSection /> 
    <buttonSection /> 
    <sellFloat />
  </main>
</template>
<script >
  import { inject, onMounted, ref } from 'vue';
  import heroSection from '@/components/dropshipping/landing/heroSection.vue';
  import frecuentQuestion from '@/components/dropshipping/landing/frecuentQuestion.vue';
  import logistSection from '@/components/dropshipping/landing/logistSection.vue';
  import integrationSection from '@/components/dropshipping/landing/integrationSection.vue';
  import buttonSection from '@/components/dropshipping/landing/buttonSection.vue';
  import sellFloat from '@/components/dropshipping/sellFloat.vue';
  export default {
    components:{
      heroSection,
      frecuentQuestion,
      logistSection,
      integrationSection,
      buttonSection,
      sellFloat
    },
    setup () {
    }
  };
</script>

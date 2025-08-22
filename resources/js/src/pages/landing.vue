<template>
  <div >
    <headerLanding />
    <heroSection />
    <plansSection />
    <shippingSection />
    <stadisticSection />
    <benefitToActiveSection />
    <learnToSellSection />
    <stepProductSection />
    <generateSell />
    <!-- <firstPartSection /> -->
    <backToTop />
    <directLink />
    <landingFooter />
  </div>
</template>
<script>
  import backToTop from '@/components/landing/backToTop.vue';
  import directLink from '@/components/landing/directLink.vue';
  import landingFooter from '@/components/landing/footer.vue';
  import { useQuasar } from 'quasar'
  import { onMounted } from 'vue';
  import headerLanding from '@/components/landing/header.vue';
  import heroSection from '@/components/landing/heroSection.vue';
  import plansSection from '@/components/landing/plansSection.vue';
  import shippingSection from '@/components/landing/shippingSection.vue';
  import stadisticSection from '@/components/landing/stadisticSection.vue';
  import benefitToActiveSection from '@/components/landing/benefitToActiveSection.vue';
  
  import learnToSellSection from '@/components/landing/learnToSellSection.vue';
  import stepProductSection from '@/components/landing/stepProductSection.vue';
  import generateSell from '@/components/landing/generateSell.vue';
  
  import firstPartSection from '@/components/landing/firstPartSection.vue';
  import gsap from '@/plugins/gsap/gsap';

  
  export default {
    components: {
      headerLanding,
      heroSection,
      plansSection,
      shippingSection,
      stadisticSection,
      benefitToActiveSection,
      learnToSellSection,
      stepProductSection,
      generateSell,
      firstPartSection,
      backToTop,
      directLink,
      landingFooter,
    },
    
    setup(){
      const $q = useQuasar()
      $q.addressbarColor.set('#1c3150')
      onMounted(() => {

        setTimeout(() => {
        }, 1000);
        
      })
    }
  }
</script>
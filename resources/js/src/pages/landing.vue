<template>
  <div >
    <headerLanding />
    <heroSection />
    <plansSection />
    <shippingSection />
    <stadisticSection />
    <backToTop />
    <directLink />
    <landingFooter />
  </div>
</template>
<script>
  import backToTop from '@/components/landing/backToTop.vue';
  import directLink from '@/components/landing/directLink.vue';
  import landingFooter from '@/components/landing/footer.vue';
  import shippingSection from '@/components/landing/shippingSection.vue';
  import stadisticSection from '@/components/landing/stadisticSection.vue';
  import { useQuasar } from 'quasar'
  import gsap from '@/plugins/gsap/gsap';
  import { onMounted } from 'vue';
  import headerLanding from '@/components/landing/header.vue';
  import heroSection from '@/components/landing/heroSection.vue';
  import plansSection from '@/components/landing/plansSection.vue';
  
  export default {
    components: {
      headerLanding,
      plansSection,
      shippingSection,
      stadisticSection,
      backToTop,
      directLink,
      landingFooter,
      heroSection,
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
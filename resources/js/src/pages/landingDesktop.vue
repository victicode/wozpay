<template>
  <div >
    <LandingHeader class="hidde-xs-flex"/>
    <heroSection class="my-element" />
    <planDropper />
    <activateAccount />
    <learnToSellDesktop />
    <stepProductsDesktop />
    <generateSellDesktop />
    <faqSectionDesktop />
    <downloadApp />
    <backToTop />
    <directLink />
    <landingFooter />

  </div>
</template>
<script>
  import LandingHeader from '@/components/landing.old/header.vue';
  import heroSection from '@/components/landing.old/heroSection.vue'
  import planDropper from '@/components/landing.old/planDropper.vue';
  import activateAccount from '@/components/landing.old/activateAccount.vue';
  import stepProductsDesktop from '@/components/landing.old/stepProductsDesktop.vue';
  import learnToSellDesktop from '@/components/landing.old/learnToSellDesktop.vue';
  import generateSellDesktop from '@/components/landing.old/generateSellDesktop.vue';
  import faqSectionDesktop from '@/components/landing.old/faqSectionDesktop.vue';
  import downloadApp from '@/components/landing.old/downloadApp.vue';
  import directLink from '@/components/landing.old/directLinkDesktop.vue';
  import backToTop from '@/components/landing/backToTop.vue';
  import landingFooter from '@/components/landing/footer.vue';
  import { useQuasar } from 'quasar'
  import { onMounted } from 'vue';
  export default {
    components: {
      LandingHeader,
      heroSection,
      planDropper,
      activateAccount,
      learnToSellDesktop,
      stepProductsDesktop,
      generateSellDesktop,
      faqSectionDesktop,
      downloadApp,
      backToTop,
      directLink,
      landingFooter,
    },
    
    setup(){
      const $q = useQuasar()
      $q.addressbarColor.set('#1c3150')
      onMounted(() => {

        // setTimeout(() => {
          
        //   gsap.to('.my-element1',{
        //     scrollTrigger: {
        //       trigger: '.my-element1',
        //       start:'top bottom',
        //       end:'bottom 100px',
              
        //     },
        //     opacity: 1,
  
        //   })
        //   gsap.to('.my-element2',{
        //     scrollTrigger: {
        //       trigger: '.my-element2',

        //       start:'-1000px bottom',
        //       end:'center 100px',
        //     },
        //     translateY:0,
        //     duration:1
        //   })
        //   gsap.to('.my-element3',{
        //     scrollTrigger: {
        //       trigger: '.my-element3',
        //       start:'-1000px bottom',
        //       end:'center 100px',
        //     },
        //     translateY:0,
        //     duration:1
        //   })
        //   gsap.to('.my-element4',{
        //     scrollTrigger: {
        //       trigger: '.my-element4',
        //       start:'-1000px bottom',
        //       end:'center 100px',
        //     },
        //     translateY:0,
        //     duration:1
        //   })
          
        // }, 1000);
        
      })
    }
  }
</script>
<style lang="scss" >


.my-element2, .my-element4{
  transform: translateY(1000px);
}
.my-element3{
  transform: translateY(1000px);
}
.my-element1{
  opacity: 0;   
}
</style>
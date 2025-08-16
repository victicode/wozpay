<template>
  <div >
    <LandingHeader class="hidde-xs-flex"/>
    <heroSection class="my-element" />
    <div class="my-element1">
      <businessSection />

    </div>
    <div class="my-element2">
      <transferSection />

    </div>
    <div class="my-element3">
      <aquipagoSection />

    </div>
    <div class="my-element4">
      <linkCardSection />

    </div>
    <backToTop />
    <directLink />
    <landingFooter />
  </div>
</template>
<script>
  import LandingHeader from '@/components/landing/header.vue';
  import heroSection from '@/components/landing/heroSection.vue'
  import businessSection from '@/components/landing/businessSection.vue';
  import transferSection from '@/components/landing/transferSection.vue';
  import aquipagoSection from '@/components/landing/aquipagoSection.vue';
  import linkCardSection from '@/components/landing/linkCardSection.vue';
  import backToTop from '@/components/landing/backToTop.vue';
  import directLink from '@/components/landing/directLink.vue';
  import landingFooter from '@/components/landing/footer.vue';
  import { useQuasar } from 'quasar'
  import gsap from '@/plugins/gsap/gsap';
  import { onMounted } from 'vue';
  export default {
    components: {
      LandingHeader,
      heroSection,
      businessSection,
      transferSection,
      aquipagoSection,
      linkCardSection,
      backToTop,
      directLink,
      landingFooter,
    },
    
    setup(){
      const $q = useQuasar()
      $q.addressbarColor.set('#1c3150')
      onMounted(() => {

        setTimeout(() => {
          
          gsap.to('.my-element1',{
            scrollTrigger: {
              trigger: '.my-element1',
              start:'top bottom',
              end:'bottom 100px',
              
            },
            opacity: 1,
  
          })
          gsap.to('.my-element2',{
            scrollTrigger: {
              trigger: '.my-element2',

              start:'-1000px bottom',
              end:'center 100px',
            },
            translateY:0,
            duration:1
          })
          gsap.to('.my-element3',{
            scrollTrigger: {
              trigger: '.my-element3',
              start:'-1000px bottom',
              end:'center 100px',
            },
            translateY:0,
            duration:1
          })
          gsap.to('.my-element4',{
            scrollTrigger: {
              trigger: '.my-element4',
              start:'-1000px bottom',
              end:'center 100px',
            },
            translateY:0,
            duration:1
          })
          
        }, 1000);
        
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
<template>
  <div>
    <LandingHeader class="desktop-only"/>
    <heroSection />
    <businessSection />
    <transferSection />
    <aquipagoSection />
    <linkCardSection />
  </div>
</template>
<script>
  import LandingHeader from '@/components/landing/header.vue';
  import heroSection from '@/components/landing/heroSection.vue'
  import businessSection from '@/components/landing/businessSection.vue';
  import transferSection from '@/components/landing/transferSection.vue';
  import aquipagoSection from '@/components/landing/aquipagoSection.vue';
  import linkCardSection from '@/components/landing/linkCardSection.vue';
  import { useQuasar } from 'quasar'

  export default {
    components: {
      LandingHeader,
      heroSection,
      businessSection,
      transferSection,
      aquipagoSection,
      linkCardSection
    },
    setup(){
      const $q = useQuasar()
      $q.addressbarColor.set('#1c3150')

    }
  }
</script>
<style lang="scss" >
.body{
  width: 100%!important;
}
</style>
<template>
  <main>
    <stadisticProfile :user="user" />
  </main>
</template>
<script >
  import { inject, ref } from 'vue';
  import { useAuthStore } from '@/services/store/auth.store'
  import { useQuasar } from 'quasar'
  import wozIcons from '@/assets/icons/wozIcons';
  import stadisticProfile from '@/components/dropshipping/profile/stadisticProfile.vue';
  import { storeToRefs } from 'pinia';
  

  export default {
    components:{
      stadisticProfile,
    },
    setup () {
      //vue provider
      const icons = inject('ionIcons')
      const $q = useQuasar()
      const { user  } = storeToRefs(useAuthStore())
      return {
        icons,
        user,
        wozIcons,
      }
    }
  };
</script>
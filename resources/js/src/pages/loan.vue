<template>
  <div>
    <div>
      <loanDetailsVue />
    </div>
  </div>
</template>
<script>
  import { useAuthStore } from '@/services/store/auth.store'
  import { inject,} from 'vue'
  import { useRouter } from 'vue-router'
  import loanDetailsVue from '@/components/loan/loanDetails.vue'

  export default {
    components: {
      loanDetailsVue,
    },
    setup() {
      //vue provider
      const user = useAuthStore().user;
      const icons = inject('ionIcons')
      const router = useRouter()


      // Data
      return{
        icons,
        user,
        router,
      }
    },
  }

</script>
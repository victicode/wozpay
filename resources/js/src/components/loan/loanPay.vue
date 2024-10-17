<template>
  <div class="q-pt-md">
    <pay-loan-with-card v-if="type == 'tpago'"/>
    <pay-loan-with-transfer v-if="'transfer'"/>
  </div>
</template>
<script>
  import { useAuthStore } from '@/services/store/auth.store'
  import { inject, onMounted, ref,} from 'vue'
  import { useRoute, useRouter } from 'vue-router'
  import { useLoanStore } from '@/services/store/loan.store'
  import payLoanWithCard from '@/components/loan/payLoanWithCard.vue'
  import payLoanWithTransfer from '@/components/loan/payLoanWithTransfer.vue'

  export default {
    components: {
      payLoanWithCard,
      payLoanWithTransfer
    },
    setup() {
      //vue provider
      const emitter = inject('emitter')
      const user = useAuthStore().user;
      const icons = inject('ionIcons')
      const router = useRouter()
      const route = useRoute();

      console.log(route)
      // Data
      return{
        icons,
        user,
        router,
        type: route.params.type,
      }
    },
  }
</script>
<style lang="scss" scoped>
.w-100 {
  width: 100%;
}
</style>
<style lang="scss" >
.amount_input {
  border-bottom: 1px solid $grey-6 ;
  display: flex;
  justify-content: center;
  position: relative;
  &.q-field--disabled .q-field__inner{
    background: transparent!important;
  }
  &.q-field--disabled .q-placeholder{
    opacity: 1!important;
  }
  & .q-field__control::before {
    border: 0px!important;
  }
  & .q-field__control-container{
    text-align: center;
  }
  & .q-field__prefix{
    position: absolute;
    font-size: 40px;
    margin-right: 10px;
    transform: translateY(0.5px) translateX(140%);
  }
  & .q-field__native{
    font-size: 40px;
    text-align: center;
  }
}
@media screen and (max-width: 780px){
  .amount_input { 
    & .q-field__prefix{
      transform: translateY(3.5px) translateX(40%)!important;
    }
  }
}

</style>

<template>
  <div class="q-pt-md ">
    <searchAndFilter />
    <transactionList />
  </div>
</template>
<script>
import { inject, onMounted, ref } from 'vue'
import util from '@/util/numberUtil'
import { useAuthStore } from '@/services/store/auth.store';
import { useWalletStore } from '@/services/store/wallet.store'
import { storeToRefs } from 'pinia'
import searchAndFilter from '@/components/transaction/searchAndFilter.vue';
import transactionList from '@/components/transaction/transactionList.vue';
export default {
  components:{
    searchAndFilter,
    transactionList,
  },
  setup () {
    const icons = inject('ionIcons')
    const { user  } = storeToRefs(useAuthStore())
    const { balances } = storeToRefs(useWalletStore())
    const numberFormat = util.numberFormat
    
    return {

    }
  },
}
</script>
<style lang="scss">

</style>
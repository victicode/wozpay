<template>
  <div class="q-pt-md " style="height: 100%;">
    <searchAndFilter />
    <transactionList />
  </div>
</template>
<script>
import searchAndFilter from '@/components/transaction/searchAndFilter.vue';
import transactionList from '@/components/transaction/transactionList.vue';
export default {
  components:{
    searchAndFilter,
    transactionList,
  },
  setup () {

    
    return {

    }
  },
}
</script>

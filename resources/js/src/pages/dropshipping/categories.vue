<template>
  <main>
    <section class="q-py-md q-px-sm">
      <activateArea v-if="!user.active_dropshipping"/>
    </section>
    <section class="q-px-sm q-mx-xs">
      <div class="categorieHeader q-px-md q-pt-md q-pb-md">
        <div class="titleCategorieHeader q-mt-xs">productos y categorias</div>
        <div class="text-white content__header q-mt-xs">
          Encuentra los mejores productos en múltiples
          categorías 
        </div>
      </div>
    </section>
    <section>
      <mostProfitable />
      <allCategories />
      
    </section>
    <!-- <sellFloat /> -->
  </main>

</template>
<script>
import mostProfitable from '@/components/dropshipping/categories/mostProfitable.vue';
import allCategories from '@/components/dropshipping/categories/allCategories.vue';
import activateArea from '@/components/dropshipping/categories/activateArea.vue';
import sellFloat from '@/components/dropshipping/sellFloat.vue';
import { storeToRefs } from 'pinia'
import { useAuthStore } from '@/services/store/auth.store'

export default {
  components:{
    mostProfitable,
    allCategories,
    activateArea,
    sellFloat,
  },
  setup () {
    const { user  } = storeToRefs(useAuthStore())
    console.log(user.value)
    return {
      user
    }
  }
}
</script>
<style lang="scss">

.categorieHeader{
  background: $primary;
  // border-top: 0.5rem solid #f8a80d;
  border-radius: 1.1rem;
}
.titleCategorieHeader{
  text-transform: uppercase;
  font-size: 1.3rem;
  font-weight: bold;
  letter-spacing: 0.5px;
  line-height: 1.2;
  color:white;
}
.content__header{
  font-family: 'Amazon Ember'!important;
  font-weight: 500;
  line-height: 1.2;

  font-size: 0.95rem;
}

</style>
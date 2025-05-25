<template>
  <main>
    <section class="q-py-md q-px-sm">
      <activateArea />
    </section>
    <section class="categorieHeader q-px-md q-pt-md q-pb-md">
      <div class="titleCategorieHeader q-mt-xs">productos y <br> categorias</div>
      <div class="text-white content__header q-mt-xs">
        Encuentra los mejores productos en múltiples
        categorías 
      </div>
    </section>
    <section>
      <mostProfitable />
      <allCategories />
    </section>
  </main>

</template>
<script>
import mostProfitable from '@/components/dropshipping/categories/mostProfitable.vue';
import allCategories from '@/components/dropshipping/categories/allCategories.vue';
import activateArea from '@/components/dropshipping/categories/activateArea.vue';

export default {
  components:{
    mostProfitable,
    allCategories,
    activateArea
  }
}
</script>
<style lang="scss">
.categorieHeader{
  background: $primary;
  border-top: 0.5rem solid #f8a80d;
}
.titleCategorieHeader{
  text-transform: uppercase;
  font-size: 1.8rem;
  font-weight: bold;
  letter-spacing: 0.5px;
  line-height: 1.2;
  color:white;
}
.content__header{
  font-family: 'Amazon Ember'!important;
  font-weight: 600;
  font-size: 1.1rem;
}
</style>
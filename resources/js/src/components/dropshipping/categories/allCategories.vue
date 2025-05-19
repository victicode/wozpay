<template>
  <div class="mostProfitableList  q-pb-md">
    <div class="q-px-md q-pt-md q-pb-sm" style="background:white">
      <div class="listTitleHeader">OTRAS CATEGORIAS</div>
      <!-- <div class="listTextHeader ellipsis" >Categorias y productos se renuevan semanalmente</div> -->
    </div>
    <div class="q-px-md">
      <div v-for="categorie in categories" :key="categorie.id" class="q-px-sm q-py-sm q-my-md all_category-item_content" >
        <div class="category__title--content q-pl-xs">
          <div class=" category__title ellipsis">
            {{ categorie.title }}
          </div>
          <!-- <q-icon name="eva-star-outline" color="terciary" size="1.4rem" v-for="i in categorie.reviews" :key="i" /> -->
        </div>
        <div class="flex category__action q-pl-sm q-pr-xs">
          <div class="products_list_quantity ellipsis">
            {{ numberFormat(categorie.products.length) }} productos 
          </div>
          <q-btn flat class="q-px-none">
            <q-icon name="eva-chevron-right-outline" color="grey" />
          </q-btn>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { useCategorieStore } from '@/services/store/categorie.store';
import { onMounted, ref } from 'vue';
import utils from '@/util/numberUtil';


export default {
  setup () {
      //vue provider
    const icons = inject('ionIcons')
    const numberFormat = utils.numberFormat
    const categorieStore = useCategorieStore()
    const categories = ref([])
    const getAllCategories = () => {
      categorieStore.getMostProlifict()
      .then((response) =>{
        categories.value = response.data
      })
    }

    onMounted(() => {
      getAllCategories()
    })

    
    return {
      categories,
      numberFormat,
    }
  }
}
</script>
<style lang="scss">
.mostProfitableList{
  background:#f3f3f3
}
.listTitleHeader{
  font-weight: bold;
  font-size: 1.25rem;
  letter-spacing: -0.5px;
}
.listTextHeader{
  font-size: 1rem;
  font-weight: 500;
  width: 100%;
  opacity: 0.6;
}
.all_category-item_content{
  display: flex;
  border-bottom: 1px solid lightgrey;
  border-radius: 1rem;
  justify-content: space-between;
  align-items: center;
}
.category__title--content{

  min-width: 45%;
}
.category__title{
  color: #9b9b9b;
  font-size: 1.02rem;
  width: 100%;
}
.products_list_quantity{
  color: #3d3d3d;
  font-size: 0.9rem;
  width: 84%;
}
.category__action{
  justify-content: end;
  align-items: center;
  max-width: 55%;
}
</style>
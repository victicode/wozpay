<template>
  <div class="mostProfitableList  q-pb-md">
    <div class="q-px-md q-pt-md q-pb-sm q-py-md-lg" style="background:white">
      <div class="listTitleHeader">OTRAS CATEGORIAS</div>
      <div class="listAll-TextHeader ellipsis" >Categoria A</div>
    </div>
    <div class="q-px-sm">
      <template v-if="categories.length > 0">
        <div v-for="categorie in categories" :key="categorie.id" class="q-px-sm q-py-sm q-my-md all_category-item_content" >
          <div class="category__titleAll--content q-pl-xs">
            <div class=" category__titleAll ellipsis">
              {{ categorie.title }}
            </div>
            <!-- <q-icon name="eva-star-outline" color="terciary" size="1.4rem" v-for="i in categorie.reviews" :key="i" /> -->
          </div>
          <div class="flex category__actionAll q-pl-sm q-pr-xs">
            <div class="products_list_quantity ellipsis">
              {{ numberFormat(categorie.products.length) }} productos 
            </div>
            <q-btn flat class="q-px-none" @click="gotTo(categorie.id)">
              <q-icon name="eva-chevron-right-outline" color="black" />
            </q-btn>
          </div>
        </div>
      </template>
      <template v-else> 
        <div class="q-pt-lg q-pb-md">
          <q-spinner-tail
            color="black"
            size="3rem"
            style="margin:auto"
          />
        </div>
      </template>
    </div>
  </div>
</template>

<script>
import { useCategorieStore } from '@/services/store/categorie.store';
import { onMounted, ref } from 'vue';
import utils from '@/util/numberUtil';
import { useRouter } from 'vue-router';


export default {
  setup () {
      //vue provider
    const router = useRouter()
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
    const gotTo = (id) => {
      router.push('/dropshipping/category/'+id+'/products')
    }
    onMounted(() => {
      getAllCategories()
    })

    
    return {
      categories,
      numberFormat,
      gotTo
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
.listAll-TextHeader{
  font-size: 1rem;
  width: 100%;
  font-weight: bold;
  margin-top: 0.2rem;
  // opacity: 0.6;
}
.all_category-item_content{
  display: flex;
  border-bottom: 1px solid lightgrey;
  justify-content: space-between;
  align-items: center;
}
.category__titleAll--content{

  min-width: 65%;
  max-width: 65%;

}
.category__titleAll{
  color: #161616;
  font-size: 1.02rem;
  width: 100%;
  font-weight: 500;
}
.products_list_quantity{
  color: #161616;
  font-size: 0.9rem;
  width: 84%;
  font-weight: 500;

}
.category__actionAll{
  justify-content: end;
  align-items: center;
  max-width: 35%;
  flex-wrap: nowrap;
}
</style>
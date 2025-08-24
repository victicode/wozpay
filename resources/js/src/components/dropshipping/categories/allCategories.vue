<template>
  <div class="allCategories  q-pb-md">
    <div class="q-px-md q-pt-md q-pb-sm q-py-md-lg" style="background:white">
      <div class="listTitleHeader">OTRAS CATEGORIAS</div>
    </div>
    <div >
      <template v-if="Object.values(categories).length > 0">
        <div v-for="(letter) in keys.length" :key="letter">
          <div class="listAll-TextHeader ellipsis q-px-sm q-py-sm "  style="background: lightgray;">Categoria {{ keys[letter-1] }}</div>
          <div v-for="categorie in categories[keys[letter-1]]" :key="categorie.id" class="q-px-md q-py-sm q-my-md all_category-item_content" >
            <div class="category__titleAll--content q-pl-xs">
              <div class=" category__titleAll ellipsis">
                {{ categorie.title }}
              </div>
              <!-- <q-icon name="eva-star-outline" color="terciary" size="1.4rem" v-for="i in categorie.reviews" :key="i" /> -->
            </div>
            <div class="flex category__actionAll q-pl-sm q-pr-xs">
              <div class="products_list_quantity ellipsis">
                <!-- {{ numberFormat(categorie.products.length) }} productos  -->
                {{ numberFormat(getRandomInt(100, 300)) }} productos 
              </div>
              <q-btn flat class="q-px-none" @click="gotTo(categorie.id)">
                <q-icon name="eva-chevron-right-outline" color="black" />
              </q-btn>
            </div>
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
    const categoriesList = [
      'A',
      'B',
      'C',
      'D',
      'E',
      'F',
    ]
    const getRandomInt = (min, max) => {
      min = Math.ceil(min); 
      max = Math.floor(max); 
      return Math.floor(Math.random() * (max - min + 1)) + min;
    }
    const router = useRouter()
    const icons = inject('ionIcons')
    const numberFormat = utils.numberFormat
    const categorieStore = useCategorieStore()
    const categories = ref({})
    const keys = ref([])
    const getAllCategories = () => {
      categorieStore.getAllCategorie()
      .then((response) =>{
          categories.value = response.data
          keys.value = Object.keys(categories.value).toReversed();

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
      keys,
      categoriesList,
      gotTo,
      getRandomInt
    }
  }
}
</script>
<style lang="scss">
.allCategories{
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
  font-size: 0.9rem;
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
  max-width: 36%;
  flex-wrap: nowrap!important
}

</style>
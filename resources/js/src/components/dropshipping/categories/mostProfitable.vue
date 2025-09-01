<template>
  <div class="mostProfitableList  q-pb-md">
    <div class="q-px-md q-pt-md q-pb-sm q-py-md-lg" style="background:white">
      <div class="listTitleHeader">CATEGORIAS MÁS RENTABLES - 2025</div>
      <div class="listTextHeader ellipsis" >Categorias y productos se renuevan semanalmente</div>
    </div>
    <div class="q-px-md">
      <template v-if="ready">
        <div v-if="mostProfitable.length > 0">
          <div v-for="categorie in mostProfitable" :key="categorie.id" class="q-px-sm q-py-sm q-my-md q-my-md-lg category-item_content" >
            <div class="category__title--content q-pl-xs">
              <div class=" category__title ellipsis">
                {{ categorie.title }}
              </div>
              <q-icon style="margin-left: -0.31rem; margin-top: -0.2rem;" :name="icons.raiting" color="terciary" size="1.5rem" v-for="i in categorie.rating" :key="i" />
            </div>
            <div class="flex category__action q-pl-sm q-pr-xs">
              <div class="products_active__quantity ellipsis">
  
                Ver {{ numberFormat(getRandomInt(100, 300)) }} productos activos
  
                <!-- Ver {{ numberFormat(categorie.products.length) }} productos activos -->
              </div>
              <q-btn flat class="q-px-none" @click="gotTo(categorie.id)" >
                <q-icon name="eva-chevron-right-outline" color="grey" />
              </q-btn>
            </div>
          </div>
        </div>
        <div v-else class="text-center text-bold text-h6">
          No hay categorias rentables 😞
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
    const mostProfitable = ref([])
    const ready = ref(false)
    const getMostProfitable = () => {
      categorieStore.getMostProlifict()
      .then((response) =>{
        mostProfitable.value = response.data
        ready.value = true
      })
      .catch(() =>{
        ready.value = true
      })
    }
    const getRandomInt = (min, max) => {
      min = Math.ceil(min); 
      max = Math.floor(max); 
      return Math.floor(Math.random() * (max - min + 1)) + min;
    }
    const gotTo = (id) => {
      router.push('/dropshipping/category/'+id+'/products')
    }
    onMounted(() => {
      getMostProfitable()
    })

    
    return {
      mostProfitable,
      numberFormat,
      icons,
      ready,
      gotTo,
      getRandomInt,
    }
  }
}
</script>
<style lang="scss">
.mostProfitableList{
  background:#fff
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
.category-item_content{
  display: flex;
  border: 1px solid $positive;
  border-radius: 1rem;
  justify-content: space-between;
  align-items: center;
  background:white;
}
.category__title--content{

  min-width: 35%;
}
.category__title{
  color: #9b9b9b;
  font-size: 1.02rem;
  width: 100%;
}
.products_active__quantity{
  color: #9b9b9b;
  font-size: 0.9rem;
  width: 68%;
}
.category__action{
  justify-content: end;
  align-items: center;
  max-width: 65%;
  min-width: 34%;
}

@media screen and (max-width: 780px){
  .products_active__quantity{

    width: 84%;
  }
  .category__title--content{
    max-width: 50%;
    min-width: 45%;
  }
  .category__action{
    min-width: auto;
    max-width: 55%;
  }
}
</style>
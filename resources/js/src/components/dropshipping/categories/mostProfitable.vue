<template>
  <div class="mostProfitableList q-px-md q-py-md">
    <div class="">
      <div class="listTitleHeader">CATEGORIAS MÁS RENTABLES - 2025</div>
      <div class="listTextHeader" >Categorias y productos se renuevan semanalmente</div>
    </div>
    <div>
      <div v-for="categorie in mostProfitable" :key="categorie.id" >
        {{ categorie.title }}
      </div>
    </div>
  </div>
</template>

<script>
import { useCategorieStore } from '@/services/store/categorie.store';
import { onMounted, ref } from 'vue';


export default {
  setup () {
      //vue provider
    const icons = inject('ionIcons')

    const categorieStore = useCategorieStore()
    const mostProfitable = ref([])
    const getMostProfitable = () => {
      categorieStore.getMostProlifict()
      .then((response) =>{
        mostProfitable.value = response.data
      })
    }

    onMounted(() => {
      getMostProfitable()
    })

    
    return {
      mostProfitable,
    }
  }
}
</script>
<style lang="scss">
.listTitleHeader{
  font-weight: bold;
  font-size: 1.3rem;
  letter-spacing: -0.5px;
}
.listTextHeader{
  font-size: 1rem;
  font-weight: 500;
  opacity: 0.6;
}
</style>
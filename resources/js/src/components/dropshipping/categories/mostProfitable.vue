<template>
  <div class="mostProfitableList q-px-md q-py-md">
    <div class="">
      <div class="listTitleHeader">CATEGORIAS MÁS RENTABLES - 2025</div>
      <div class="listTextHeader" >Categorias y productos se renuevan semanalmente</div>
    </div>
    <div>
      
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

    const getMostProfitable = () => {
      categorieStore.getMostProlifict()
      .then((response) =>{
        console.log(response)
      })
    }

    onMounted(() => {
      getMostProfitable()
    })

    
    return {

    }
  }
}
</script>
<style lang="scss">
.listTitleHeader{
  font-weight: bold;
  font-size: 1.4rem;
  letter-spacing: -0.5px;
}
.listTextHeader{
  font-size: 0.9rem;
  font-weight: 500;
  opacity: 0.6;
}
</style>
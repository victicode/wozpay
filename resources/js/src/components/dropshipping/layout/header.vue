<template>
  <header class="q-px-md q-px-md-xl q-pt-md " id="dropshipping-header" >
    <div class="text-header">
      Woz <br>
      Dropshipping
    </div>
    <div class="d-flex items-center q-mt-lg q-mt-md-none search-content">
      <input type="text" class="searchInput" placeholder="¿Qué producto estas buscando?" v-model="search">
      <!-- <q-input standout="bg-primary text-white" v-model="text" label="Custom standout" :dense="dense" /> -->
      <q-btn  color="white" text-color="primary" id="searchButton"  label="Buscar" no-caps />
    </div>
  </header>

</template>
<script >
  import { inject, onMounted, ref } from 'vue';
  import { useAuthStore } from '@/services/store/auth.store'
  import { useQuasar } from 'quasar'
  import MyCustomFont from '@/assets/fonts/Ember/AmazonEmber_Lt.ttf';
  export default {
    setup () {
      //vue provider
      const icons = inject('ionIcons')
      const $q = useQuasar()
      const user = ref(useAuthStore().user)
      const readyState = ref(false)
      const search = ref('');


      // Mounted
      onMounted(() =>{
        // getCurrentUser()
        $q.addressbarColor.set('#0449fb')
      })
      
      return {
        icons,
        readyState,
        user,
        search,
      }
    }
  };
</script>
<style lang="scss">
  @font-face {
      font-family: 'Amazon Ember'; /* Nombre de la fuente */
      src: url('../../../assets/fonts/Ember/AmazonEmber_Lt.ttf');
      /* El nombre del archivo importa debe coincidir con el nombre del archivo importado */
  }
  @font-face {
      font-family: 'Amazon Ember Regular'; /* Nombre de la fuente */
      src: url('../../../assets/fonts/Ember/AmazonEmber_Rg.ttf');
      /* El nombre del archivo importa debe coincidir con el nombre del archivo importado */
  }
  @font-face {
      font-family: 'Amazon Ember Bolder'; /* Nombre de la fuente */
      src: url('../../../assets/fonts/Ember/AmazonEmber_Bd.ttf');
      /* El nombre del archivo importa debe coincidir con el nombre del archivo importado */
  }

  #dropshipping-header{
    background: $primary;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  .text-header{
    font-family: 'Amazon Ember Bolder'!important;
    color:white;
    font-weight: bolder;
    font-size: 2.5rem;
    line-height: 1.2;
  }
  .searchInput{
    
    height: 3.5rem;
    width: 15.8rem;
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
    padding: 1rem 1rem;
    border-right: 2px solid $primary;
    letter-spacing: 0.8px;
    color: #81a4fc;
    font-weight: 600;

    &::placeholder{
      font-family: 'Amazon Ember'!important;
      color: #81a4fc;
      font-weight: 600;
    }
  }
  #searchButton{
    height: 3.5rem;
    border-radius: 0px;
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
    box-shadow: none;
    & .block{
      font-family: 'Amazon Ember'!important;
      color: #81a4fc;
      font-weight: 600;
      letter-spacing: 0.8px;
      
    }
    &:before{
      box-shadow: none;
    }
  }
  @media screen and (max-width: 780px){
    #dropshipping-header{
      flex-direction: column;
      align-items: start;
    }
    .search-content{
      width: 100%; 
      height: 3.5rem;
      overflow: hidden;
    }
    .searchInput{
      box-sizing: border-box;
      height: 100%;
      width: 75%;

    }
    #searchButton{
      width: 25%;

      height: 102%;
    }

  }
</style>
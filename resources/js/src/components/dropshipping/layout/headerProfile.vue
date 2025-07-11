<template>
  <header class="q-px-md q-px-md-lg q-pt-lg q-pb-lg others"  id="dropshipping-headerProfile" >
    <div class="flex justify-between items-end header__fisrtpartProfile q-pt-xs w-100 q-mb-md-sm" >
      <div class="text-header">
        Woz <br>Dropshipping
      </div>
      <div class="md-block">
        <div class="header__button q-pa-sm others" @click="router.push('/dropshipping/profile')" >
          <img :src="img2" alt="" style="width: 1.59rem; height: 1.59rem;" >
        </div>
      </div>
    </div>
    <div class="d-flex  items-center q-mt-lg  search-contentProfile q-mt-md-sm">
      <input type="text" class="searchInputProfile" placeholder="¿Qué producto estas buscando?" v-model="search">
      <!-- <q-input standout="bg-primary text-white" v-model="text" label="Custom standout" :dense="dense" /> -->
      <q-btn  text-color="primary" id="searchButtonProfile"  label="Buscar" no-caps />
    </div>
  </header>

</template>
<script >
  import { inject, onMounted, ref } from 'vue';
  import { useAuthStore } from '@/services/store/auth.store'
  import { useQuasar } from 'quasar'
  import img2 from '@/assets/images/vector2.png'
  import { useRouter } from 'vue-router';

  export default {

    setup () {
      //vue provider
      const icons = inject('ionIcons')
      const $q = useQuasar()
      const user = ref(useAuthStore().user)
      const readyState = ref(false)
      const search = ref('');
      const router = useRouter()

      onMounted(() =>{
        // getCurrentUser()
        $q.addressbarColor.set('#0449fb')
      })
      
      
      return {
        icons,
        readyState,
        user,
        search,
        img2,
        router
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
  #dropshipping-headerProfile{

    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    height: 26%;
  }
  .text-header{
    font-family: 'Amazon Ember Bolder'!important;
    font-weight: bolder;
    font-size: 1.6rem;
    line-height: 1.2;
    letter-spacing: -01px;
  }
  .principal{

    &#dropshipping-headerProfile{
      background: $primary;
    }
    & .text-header{

      color:white;
    }
    & .searchInputProfile{
      background: white;
      border-right: 2px solid $primary;
    }
    & #searchButtonProfile{
      background: white;
    }
    & .header__button{
      background: #1c5afa;
    }
  }

  .others{

    &#dropshipping-headerProfile{
      background: white;
      border-bottom: 2px solid rgba(211, 211, 211, 0);
    }
    & .text-header{

      color:#0c3846;

    }
    & .searchInputProfile{
      background: #f3f3f3;
    }

    & #searchButtonProfile{
      background: #f3f3f3;
    }
    & .header__button{
      background: #dde0e4;
    }
  }

  .header__fisrtpartProfile{
    width: 100%;
  }
  .searchInputProfile{
    
    height: 3.6rem;
    width: 85%;
    border-top-left-radius: 2rem;
    border-bottom-left-radius: 2rem;
    padding: 1rem 1rem;
    
    letter-spacing: 0.8px;
    color: #797979;
    font-weight: 600;

    &::placeholder{
      font-family: 'Amazon Ember'!important;
      color: #797979;
      font-weight: 600;
    }
  }
  #searchButtonProfile{
    height: 3.63rem;
    transform: translatey(-0.03rem);
    border-radius: 0px;
    border-top-right-radius: 2rem;
    border-bottom-right-radius: 2rem;
    box-shadow: none;
    & .block{
      font-family: 'Amazon Ember'!important;
      color: #797979;
      font-weight: 600;
      letter-spacing: 0.8px;
      
    }
    &:before{
      box-shadow: none;
    }
  }
  .header__button{
    height: 3.1rem;
    width: 3.1rem;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: all ease 0.5s;

    &:hover{
      cursor: pointer;
      opacity: 0.8;
      filter: contrast(0.9);
    }
    // margin: auto;
  }
  .search-contentProfile{
      width: 100%; 
      height: 3.5rem;
      overflow: hidden;
    }
  @media screen and (max-width: 780px){
    .header__fisrtpartProfile{
      width: 100%;
    }
    #dropshipping-headerProfile{
      flex-direction: column;
      align-items: start;
    }
    
    .searchInputProfile{
      box-sizing: border-box;
      height: 100%;
      width: 75%;

    }
    #searchButtonProfile{
      width: 25%;
      transform: translatey(-0.1rem);
      height: 102%;
    }

  }
</style>
<template>
  <header class="q-px-md q-px-md-lg q-pt-md q-pb-md " :class="styleHead" id="dropshipping-header" >
    <div class="flex justify-between items-end header__fisrtpart q-pt-xs" >
      <div class="text-header">
        Woz <br>
        Dropshipping
      </div>
      <div>
        <div class="header__button q-pa-sm" :class="styleHead" >
          <slot></slot>
        </div>
      </div>
    </div>
    <div class="d-flex items-center q-mt-md q-mt-md-none search-content">
      <input type="text" class="searchInput" placeholder="¿Qué producto estas buscando?" v-model="search">
      <!-- <q-input standout="bg-primary text-white" v-model="text" label="Custom standout" :dense="dense" /> -->
      <q-btn  text-color="primary" id="searchButton"  label="Buscar" no-caps />
    </div>
  </header>

</template>
<script >
  import { inject, onMounted, ref, watch } from 'vue';
  import { useAuthStore } from '@/services/store/auth.store'
  import { useQuasar } from 'quasar'
  

  export default {
    props:{
      styleHead: String,
    },
    setup (props) {
      //vue provider
      const icons = inject('ionIcons')
      const $q = useQuasar()
      const user = ref(useAuthStore().user)
      const readyState = ref(false)
      const search = ref('');
      const styleHead =  ref(props.styleHead)

      // Mounted
      watch(() => props.styleHead, (newValue) => {
        styleHead.value = newValue
      });

      onMounted(() =>{
        // getCurrentUser()
        $q.addressbarColor.set('#0449fb')
      })
      
      
      return {
        icons,
        readyState,
        user,
        search,
        styleHead
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

    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  .text-header{
    font-family: 'Amazon Ember Bolder'!important;
    font-weight: bolder;
    font-size: 2.3rem;
    line-height: 1.2;
    letter-spacing: -01px;
  }
  .principal{

    &#dropshipping-header{
      background: $primary;
    }
    & .text-header{

      color:white;
    }
    & .searchInput{
      background: white;
      border-right: 2px solid $primary;
    }
    & #searchButton{
      background: white;
    }
    & .header__button{
      background: #1c5afa;
    }
  }

  .others{

    &#dropshipping-header{
      background: white;
      border-bottom: 2px solid lightgray;
    }
    & .text-header{

      color:#0c3846;

    }
    & .searchInput{
      background: #f3f3f3;
    }

    & #searchButton{
      background: #f3f3f3;
    }
    & .header__button{
      background: #dde0e4;
    }
  }

  .header__fisrtpart{
    width: 50%;
  }
  .searchInput{
    
    height: 3.6rem;
    width: 15.8rem;
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
    padding: 1rem 1rem;
    
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
    height: 3.63rem;
    transform: translatey(-0.03rem);
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
  @media screen and (max-width: 780px){
    .header__fisrtpart{
      width: 100%;
    }
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
      transform: translatey(-0.1rem);
      height: 102%;
    }

  }
</style>
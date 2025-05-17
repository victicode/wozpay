<template>
  <section class="q-py-md q-px-sm">
    <div class="flex activateArea__container q-pa-md ">
      <div class="textActivateArea">
        <div class="first__text">Activalo por</div>
        <div class="second__text">Gs. 2500.000</div>
        <div class="third__text">Anual</div>
      </div>
      <div class="buttonActivateArea">
        <q-btn 
          unelevated  
          color="white" 
          text-color="black"
          class=""
          no-caps
        >
            Comenzar a vender
        </q-btn>
      </div>
    </div>
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

  </section>

</template>
<script>
import mostProfitable from '@/components/dropshipping/categories/mostProfitable.vue';


export default {
  components:{
    mostProfitable
  }
}
</script>
<style lang="scss">
.activateArea__container{
  background: #19cd15;
  color: white;
  border-radius: 1rem;
  align-items: end;
}
.textActivateArea{
  width: 50%;
  & .first__text{
    font-size: 1.1rem;
  }
  & .second__text{
    font-size: 1.6rem;
    font-weight: bold;
  }
  & .third__text{
    text-align: end;
    font-size: 1rem;
    transform: translateY(-0.5rem)
  }
}
.buttonActivateArea{
  width: 50%;
  display: flex;
  justify-content: center;
  flex-direction: column;
  align-items: end;
  & button {
    padding: 0.8rem ;
    border-radius: 1rem;
    & .q-btn__content{
      font-size: 0.9rem;
    }
  }
}
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
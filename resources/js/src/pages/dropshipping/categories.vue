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
</template>
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
    font-size: 1.2rem;
  }
  & .second__text{
    font-size: 1.8rem;
    font-weight: bold;
  }
  & .third__text{
    text-align: end;
    font-size: 1rem;
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
</style>
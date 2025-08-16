<template>
  <div class="q-px-lg q-py-md flex items-center" style="box-shadow: #00000033 0px 5px 18px 2px;
    z-index: 10;
    position: relative;">
    <div style="width: 50%;">
      <div class="text-terciary  woz-logo2">Woz Payments</div>
      <q-linear-progress rounded size="7px" track-color="backLinear"  :value="0.55" color="white" reverse class=" landing__progress" />
    </div>
    <div style="width: 50%;" class="flex items-center justify-around">
      <div class="text-link_header">Precios</div>
      <div class="text-link_header">Preguntas frecuentes</div>
      <div class="text-link_header active" @click="router.push('/login')">Regístrate o inicia sesión</div>
    </div>
  </div>
</template>
<script>

  import { useRouter } from 'vue-router';

  export default {
    setup(){
      return{
        router: useRouter()
      }
    }
  }
</script>
<style lang="scss">
.text-link_header{
  font-size: 1.15rem;
  cursor: pointer;
  font-weight: 500;
  transition: all 0.2s ease-in;
  &:hover{
    color: #ffc701!important;
  }
  &.active{
    color: $primary;
    &:hover{
      transform: scale(1.1);
    }
  }
}
.woz-logo2 {
  font-weight: bold;
  font-size: 2.5rem;
}
.landing__progress {
  margin-top: -0.5rem;
  border: 1px solid #ffc701!important;
  width: 35%!important;
  border-radius: 90px;
  & .q-linear-progress__track{
    opacity: 1;
  }
  & .q-linear-progress__model {
    border-top-right-radius: 90px;
    border-bottom-right-radius: 90px;
  }
}
</style>
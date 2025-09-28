<template>
  <div class="q-px-lg q-py-md flex items-center" style="box-shadow: #00000002 0px 5px 18px 2px;
    z-index: 10;
    position: relative; background: #2f2d41;">
    <div style="width: 50%;">
      <div class="text-white  woz-logoWhite">Woz Paraguay</div>
    </div>
    <div style="width: 50%;" class="flex items-center justify-around">
      <div class="text-white text-link_header">Aprender</div>
      <div class="text-white text-link_header">Empezar a vender</div>
      <div class="text-white text-link_header">Precios</div>
      <div class="text-link_header active flex-center"  @click="router.push('/register')">Crear cuenta</div>
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
    background: white;
    display: flex;
    color: #0185ff;
    padding: 0.5rem 1.8rem;
    border-radius: 0.5rem;
    &:hover{
      transform: scale(1.1);
    }
  }
}
.woz-logoWhite {
  font-weight: 900;
  font-size: 2.2rem;

}
</style>
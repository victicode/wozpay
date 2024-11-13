<template>
  <div class="text-center bg-footer q-px-lg q-py-md q-py-md-lg q-px-md-lg" style="box-shadow: rgba(0, 0, 0, 0.2) 0px 5px 18px 2px;
    z-index: 8;
    position: relative;">
    <div>
      {{moment().format('YYYY')}} © todos los derechos reservados @Wozparaguay | 
      Términos y Condiciones | política de privacidad
    </div>
  </div>
</template>
<script>
  import moment from 'moment';
  export default {
    setup(){
      return{
        moment
      }
    }
  }
</script>
<style>
.bg-footer {
    background: white;
    font-size: 1.1rem;
    font-weight: 500;
  }
@media screen and (max-width: 780px){

  .bg-footer {
    background: #c9c5c5;
    font-size: 0.85rem;
    font-weight: 500;
  }
}
</style>
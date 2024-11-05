<template>
  <section class="q-mt-xs q-py-md " >
    <div class="q-px-md q-px-md-xl" >
      <div class="text-link1 q-px-sm">
        Vincula una tarjeta de crédito o débito con <span class="text-link2 hidde-xs-inline">Woz Pay</span>
      </div>
      <div class="text-link2 q-mt-sm q-mt-md-none show-xs">
        Woz Pay
      </div>
      <div class="text-link3 q-px-md q-mt-sm q-mt-md-xs">
        Usa Woz Pay y vincula una tarjeta de crédito o débito para pagar cuentas, y solicitar préstamos
      </div>
    </div>
    <div >
      <div class="q-px-md q-px-md-xl">
        <div class="q-mt-lg  text-link0 text-dw q-pl-xs">
          Retira préstamos de acuerdo al tipo de tarjetas que tengas
        </div>
        <div class="text-link0 q-mt-md q-pl-md text-dw2">
          ¿Necesitas tu dinero al instante? Retíralo con Woz Pay. 
          Tu billetera electrónica más completa 
          <br>
          <br>
          Tabla de tarifario para retiro
        </div>
      </div>
      <div class="q-mt-md q-px-sm">
        <div style="  ">
          <div class="flex bg-table q-py-lg "  
          style="border-bottom: 1px solid #f9a826; border-left: 1px solid #d9d9d9; border-top: 1px solid #d9d9d9; border-right: 1px solid #d9d9d9; ">
            <div style="width: 30%;" class="text-center text-dw4 text-link0">Tarjetas</div>
            <div style="width: 70%;" class="flex justify-around ">
              <div class="text-link0 text-dw4 text-center">Tasa de interés</div>
              <div class="text-link0 text-dw4 text-center">Plataforma a usa</div>
              <div class="text-link0 text-dw4 text-center">Desembolso</div>
            </div>
          </div>
          <div style="border-bottom: 1px solid grey;border-left: 1px solid grey;border-right: 1px solid grey; ">
            <div class="flex items-center" >
              <div style="width: 30%; border-right: 2px solid #d9d9d9;" class="q-py-lg text-dw5 text-link0 q-pl-md">
               • Tarjetas de crédito
              </div>
              <div style="width: 70%; border-bottom: 2px solid #d9d9d9;" class="flex justify-around q-py-lg">
                <div class="text-link0 text-dw5 text-center" style="width: 33%;">22.2%</div>
                <div class="text-link0 text-dw5 text-center" style="width: 33%;">Woz Pay</div>
                <div class="text-link0 text-dw5 text-center" style="width: 33%;">Al instante</div>
              </div>
            </div>
            <div class="flex items-center" >
              <div style="width: 30%; border-right: 2px solid #d9d9d9;" class="q-py-lg text-dw5 text-link0 q-pl-md">
               • Tarjeta de débito
              </div>
              <div style="width: 70%; border-bottom: 2px solid #d9d9d9;" class="flex justify-around q-py-lg">
                <div class="text-link0 text-dw5 text-center" style="width: 33%;">30%</div>
                <div class="text-link0 text-dw5 text-center" style="width: 33%;">Woz Pay</div>
                <div class="text-link0 text-dw5 text-center" style="width: 33%;">Al instante</div>
              </div>
            </div>
            <div class="flex items-center" >
              <div style="width: 30%; border-right: 2px solid #d9d9d9;" class="q-py-lg text-dw5 text-link0 q-pl-md">
               • Primer préstamo 
              </div>
              <div style="width: 70%; " class="flex justify-around q-py-lg">
                <div class="text-link0 text-dw5 text-center" style="width: 33%;">Variable</div>
                <div class="text-link0 text-dw5 text-center" style="width: 33%;">Woz Pay</div>
                <div class="text-link0 text-dw5 text-center" style="width: 33%;">Al instante</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="q-px-md q-px-md-xl">
        <div class="q-mt-lg text-link0 q-pl-xs text-dw3">
          Efectiviza en tu Cuenta Bancaria personal
        </div>
        <div class="text-link0 q-mt-sm q-pl-xs  text-dw2">
          Puedes efectivizar en tu cuenta bancaria directamente, utilizando el método SIPAP
        </div>
      </div>
    </div>
  </section>
</template>
<script>
import imagen9 from '@/assets/images/IMAGEN_9.svg'
export default {
  setup() {
    return {
      imagen9
    }
  },
}
</script>

<style lang="scss">
.text-dw{
  color: #2f2e41;
  display: flex;
  font-size: 1.5rem;
  font-weight: bold!important;

  &::before{
    content: '';
    margin-right: 0.5rem;
    width: 10px;
    display: block;
    background: #2f2e41;
    border-radius: 20px;
    transform: translateY(-4px);
  }
}
.bg-table{
  background: #d9d9d9;
}
.text-dw2{
  font-size: 1.5rem;
  font-weight: 500!important;
  color: #666666!important;
}
.text-dw3{
  font-size: 1.5rem;
  font-weight: bold!important;
  color: #2f2e41;
}
.text-dw4{
  font-size: 1.3rem;
  font-weight: bold!important;
  color: #666666!important;
}
.text-dw5{
  font-size: 1.3rem;
  font-weight: 100!important;
  color: #666666!important;
}
.text-link1 {
  color: #2f2e41;
  font-size: 3.2rem;
  font-weight: bold!important;
}
.text-link2 {
  font-size: 3.2rem;
  font-weight: bolder!important;
  color:#f9a826;
}
.text-link3 {
  font-size: 1.5rem;
  font-weight: 500;
  width: 60%;
}
.img__aquipago{
  border-radius: 20px;
}
@media screen and (max-width: 780px){
  .text-dw{
    color: #2f2e41;
    display: flex;
    font-size: 1rem;
    font-weight: bold!important;
    &::before{
      content: '';
      margin-right: 0.5rem;
      width: 10px;
      display: block;
      background: #2f2e41;
      border-radius: 20px;
    }
  }
  .text-dw2{
    font-size: 0.93rem;
    font-weight: 500!important;
    color: #666666!important;
  }
  .text-dw3{
    font-size: 1.08rem;
    font-weight: bold!important;
    color: #2f2e41;
  }
  .text-dw4{
    font-size: 0.78rem;
    font-weight: bold!important;
    color: #666666!important;
  }
  .text-dw5{
    font-size: 0.93rem;
    font-weight: 100!important;
    color: #666666!important;
  }
  .text-link1 {
    color: #2f2e41;
    font-size: 1.8rem;
    font-weight: bold!important;
    text-align: center;
  }
  .text-link2 {
    font-size: 1.8rem;
    font-weight: bolder!important;
    color:#f9a826;
    text-align: center;
  }
  .text-link3 {
    text-align: center;
    font-size: 1rem;
    font-weight: 500;
    width: 100%;

  }
  .img__aquipago{
    border-radius: 20px;
  }
}
</style>
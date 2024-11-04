<template>
  <section class="q-mt-xs q-px-sm q-py-md ">
    <div>
      <div class="text-link1 text-center q-px-md">
        Vincula una tarjeta de crédito o débito con 
      </div>
      <div class="text-link2 text-center q-mt-sm">
        Woz Pay
      </div>
      <div class="text-link3 text-center q-px-md q-mt-sm">
        Usa Woz Pay y vincula una tarjeta de crédito o débito para pagar cuentas, y solicitar préstamos
      </div>
    </div>
    <div>
      <div>
        <div class="q-mt-lg text-link text-dw q-pl-xs">
          Retira préstamos de acuerdo al tipo de tarjetas que tengas
        </div>
        <div class="text-link q-mt-md q-pl-md text-dw2">
          ¿Necesitas tu dinero al instante? Retíralo con Woz Pay. 
          Tu billetera electrónica más completa <br>
          Tabla de tarifario para retiro
        </div>
      </div>
      <div class="q-mt-md q-px-sm">
        <div style="height: 150px; border: 1px solid grey; border-radius: 5px;">

        </div>
      </div>
      <div class="q-px-sm">
        <div class="q-mt-lg text-link q-pl-xs text-dw3">
          Efectiviza en tu Cuenta Bancaria personal
        </div>
        <div class="text-link q-mt-sm q-pl-xs  text-dw2">
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
  font-size: 1.1rem;
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
.text-link1 {
  color: #2f2e41;
  font-size: 1.8rem;
  font-weight: bold!important;
}
.text-link2 {
  font-size: 1.8rem;
  font-weight: bolder!important;
  color:#f9a826;
}
.text-link3 {
  font-size: 1rem;
  font-weight: 500;
}
.img__aquipago{
  border-radius: 20px;
}
</style>
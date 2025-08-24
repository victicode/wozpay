<template>

  <div class="q-py-lg" style="background: #f7f7f7;">
    <div class="flex items-center justify-center q-px-lg">
      <div class="border__title2" />
      <div class="titleBorder q-mx-md">
        Tercera parte
      </div>
      <div class="border__title2" />
    </div>
    <div class="q-mt-md q-px-sm">
      <div class=" q-px-sm q-py-lg">
        <div class="titleSection-lading  " >
          Vincula una cuenta <br> bancaria con <b class="text-sectionActive">Woz Pay </b>
        </div>
        <div class="q-mt-sm partTextL" style="">
          Usa Woz Pay y vincula una cuenta bancaria para
          recibir y retirar dinero desde cualquier ATM
        </div>
        <div class="text-subtitle2 subtitlethir  q-mt-lg">
          <div class="text-grey-6 q-pl-md ">
            ¿Necesitas tu dinero al instante? Retíralo con
            Woz Pay. tu billetera electrónica más completa
          </div>
        </div>
        <div style="border: 1px solid darkgray;" class="q-mt-xl">
          <div class="q-py-md q-px-sm bg-sectionActive text-white headerTablePart2" >
            Retiro de ganancias Woz Dropshipping
          </div>
          <div class="q-py-sm">
            <div class="q-py-sm">
              <div class="q-px-md "  >
                <div class="q-pb-sm" style="border-bottom: 1px solid lightgray;">
                  <div class="text__tablePart2">1 a 5 días luego del cierre de ventas</div>
                  <div class="q-mt-sm text__table2L">
                    <div class="flex justify-between items-center q-mt-sm">
                      <div>Comisión de retiro: </div>
                      <div>15%</div>
                    </div>
                    <div class="flex justify-between items-center q-mt-sm">
                      <div>Desembolso: </div>
                      <div>Al instante</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="q-py-sm">
              <div class="q-px-md "  >
                <div class="q-pb-sm" style="border-bottom: 1px solid lightgray;">
                  <div class="text__tablePart2">6 a 9 días luego del cierre de ventas</div>
                  <div class="q-mt-sm text__table2L">
                    <div class="flex justify-between items-center q-mt-sm">
                      <div>Comisión de retiro:</div>
                      <div>8,5%</div>
                    </div>
                    <div class="flex justify-between items-center q-mt-sm">
                      <div>Desembolso: </div>
                      <div>Al instante</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="q-py-sm">
              <div class="q-px-md "  >
                <div class="q-pb-sm" style="border-bottom: 1px solid lightgray;">
                  <div class="text__tablePart2">10 días luego del cierre de ventas</div>
                  <div class="q-mt-sm text__table2L">
                    <div class="flex justify-between items-center q-mt-sm">
                      <div>Comisión de retiro:</div>
                      <div>0%</div>
                    </div>
                    <div class="flex justify-between items-center q-mt-sm">
                      <div>Desembolso: </div>
                      <div>Al instante</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="q-px-sm">
      <div>
        <div class="timeLineContainer q-pl-sm q-my-md">
          <div class="q-pl-md">
            <div class="timelineTitle">
              Cierre de ventas en tu cuenta de
              vendedor profesional Woz Pay
            </div>
            <div class="timelineSubtitle q-mt-xs"> 
              Podrás vender y cerrar tus ventas de<br>
              manera ilimitada 
            </div>
          </div>
        </div>
        <div class="timeLineContainer2 q-pl-sm q-my-md">
          <div class="q-pl-md">
            <div class="timelineTitle">
              Tus ganancias en Woz Pay
            </div>
            <div class="timelineSubtitle q-mt-xs"> 
              Cuando cierres una venta,<br>
              puedes ver todas tus ganancias a<br>
              tu cuenta digital de Woz Pay
            </div>
          </div>
        </div>
        <div class="timeLineContainer3 q-pl-sm q-my-md">
          <div class="q-pl-md">
            <div class="timelineTitle">
              Retira tus ganancias en tu cuenta
              bancaria personal
            </div>
            <div class="timelineSubtitle q-mt-xs"> 
              Puedes efectivizar en tu cuenta bancaria
              directamente, utilizando el método SIPAP
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>
<style lang="scss">
.tipsTitle{
  font-size: 1.5rem;
  font-weight: 900;
}
.tipsContainer{
  border-radius: 1rem;
}

.subtitlethir{
  width: 100%;
  position: relative;
  & .text-grey-6{
    line-height: 1.3;
  }
  &::after{
    content: '';
    top: -0.5rem;
    background: #2f2d41;
    border-radius: 1rem;
    height: 3.2rem;
    width: 5px;
    display: block;
    position: absolute;

  }
}

.timelineTitle{
  color: #2f2d41;
  font-size: 1.2rem;
  font-weight: 900;
}
.timelineSubtitle{
  color: #adadad;
  font-size: 1rem;
  font-weight: 400;
}
.timeLineContainer{
  width: 100%;
  position: relative;
  &::after{
    content: '';
    top: 1rem;
    background: #f9b229;
    border-radius: 0.5rem;
    height: calc(200% - 2rem);
    width: 3px;
    display: block;
    position: absolute;
  }
  &::before{
    content: '';
    top: 5%;
    left: 2.4px;
    background: #f9b229;
    border-radius: 2rem;
    height: 0.9rem;
    width: 0.9rem;
    display: block;
    position: absolute;
  }
}
.timeLineContainer2{
  width: 100%;
  position: relative;
  &::after{
    content: '';
    top: 1rem;
    background: #f9b229;
    border-radius: 0.5rem;
    height: calc(200% - 2rem);
    width: 3px;
    display: block;
    position: absolute;
  }
  &::before{
    content: '';
    top: 30%;
    left: 2.4px;
    background: #f9b229;
    border-radius: 2rem;
    height: 0.9rem;
    width: 0.9rem;
    display: block;
    position: absolute;
  }
}
.timeLineContainer3{
  width: 100%;
  position: relative;
  &::before{
    content: '';
    top: 60%;
    left: 2.4px;
    background: #f9b229;
    border-radius: 2rem;
    height: 0.9rem;
    width: 0.9rem;
    display: block;
    position: absolute;
  }
}

</style>
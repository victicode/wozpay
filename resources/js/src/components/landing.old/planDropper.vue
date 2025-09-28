<template>
  <div class="q-px-xl">
    <div class="q-mt-lg">
      <div class="titleSection-ladingPlan">Comienza con un plan de vendedor Dropper</div>
      <div class="subtitleDesSectionPlan q-px-xs q-mt-md">
        <div class=" q-pl-md ">
          Te ofrecemos dos planes de vendedor que puedes adquirir para comenzar a vender en <br>
          Woz Dropshipping
        </div>
      </div>
    </div>
    <div class="cardTableLanding q-pa-xl q-mt-xl">
      <div style="border-bottom: 2px solid darkgrey;">
        <div class="textTablePlan q-py-md">Plan de Vendedor Profesional: Gs. 250.000 primer año</div>
        <div class="textTablePlan2">
          Con este plan dirigido a Vendedores Profesionales tendrás acceso a más herramientas con<br>
          una cuota anual de Guaraníes 250.000 <br><br>
          Luego de los 12 meses son Guaraníes 250.000 mensual
        </div>
        <div class="q-pb-xl">
          <table class="planTable">
            <thead>
              <tr style="border-bottom: 4px solid #2f2d41;">
                <th class="q-px-sm q-pb-sm text-center">Planes</th>
                <th class="q-px-sm q-pb-sm text-center">Cuota anual</th>
                <th class="q-px-sm q-pb-sm" style="width: 30%;">Donde registrarme</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="q-pt-md q-px-sm text-center">
                  Vendedor Profesional
                </td>
                <td class="q-pt-md q-px-sm text-center">
                  Gs. 250.000 primer año
                </td>
                <td class="q-pt-md q-px-sm ">
                  Registrate como vendedor independiente de <br> manera gratuita en este 
                  <i class="text-primary" @click="router.push('/dropshipping/welcome')">
                    enlace
                  </i>
                    
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div style="border-bottom: 2px solid darkgrey;">
        <div class="textTablePlan q-py-md">Plan de Proveedor Autorizado: Gs. 350.000 mensual</div>
        <div class="textTablePlan2 q-pb-md">
          Usá este plan sólo si tenes una tienda fisica y queres que otros vendan tus productos. <br>
          Contrato minimo de 12 meses como proveedor Dropshipping
        </div>
        <div class="q-pb-md">
          <table class="planTable">
            <thead>
              <tr style="border-bottom: 4px solid #2f2d41;">
                <th class="q-px-sm q-pb-sm text-center">Planes</th>
                <th class="q-px-sm q-pb-sm text-center">Mensualidad</th>
                <th class="q-px-sm q-pb-sm" style="width: 30%;">Donde registrarme</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="q-pt-md q-px-sm text-center">
                  Proveedor Autorizado
                </td>
                <td class="q-pt-md q-px-sm text-center">
                  Gs. 350.000 por 12 meses
                </td>
                <td class="q-pt-md q-px-sm ">
                  Registrate como vendedor independiente de <br> manera gratuita en este 
                  <i class="text-primary" @click="router.push('/dropshipping/welcome')">
                    enlace
                  </i>
                    
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import { useRouter } from 'vue-router'

  export default {
    setup(){
      return{
        router: useRouter(),
      }
    }
  }
</script>
<style lang="scss">
@font-face {
      font-family: 'Amazon Ember'; /* Nombre de la fuente */
      src: url('../../assets/fonts/Ember/AmazonEmber_Lt.ttf');
      /* El nombre del archivo importa debe coincidir con el nombre del archivo importado */
  }
  @font-face {
      font-family: 'Amazon Ember Regular'; /* Nombre de la fuente */
      src: url('../../assets/fonts/Ember/AmazonEmber_Rg.ttf');
      /* El nombre del archivo importa debe coincidir con el nombre del archivo importado */
  }
  @font-face {
      font-family: 'Amazon Ember Bolder'; /* Nombre de la fuente */
      src: url('../../assets/fonts/Ember/AmazonEmber_Bd.ttf');
      /* El nombre del archivo importa debe coincidir con el nombre del archivo importado */
  }
.textTablePlan{
  font-size: 1.3rem;
  color:#2f2d41;
  font-weight: 900;
  font-family: 'Amazon Ember Bolder'!important;
  
}
.planTable{
  width: 100%;
  & th {
    font-size: 1rem;
    color:#2f2d41;
    font-weight: 900;
    font-family: 'Amazon Ember Bolder'!important;
  }
  & td {
    font-size: 1rem;
    color:rgb(102 102 102);
    font-weight: 900;

    font-family: 'Amazon Ember'!important;
  }
}

.textTablePlan2{
  font-size: 1rem;
  color:rgb(102 102 102);
  font-weight: 900;
  font-family: 'Amazon Ember'!important;
  
}
.cardTableLanding{
  background: white;
  box-shadow: #00000046 0px 5px 20px 2px;
  border-radius: 1rem;
}
.subtitleDesSectionPlan{
  width: 80%;
  position: relative;
  font-size: 1.1rem;
  font-weight: 400;
  line-height: 1.5;
  color: hsl(0, 0%, 40%);
  
  &::after{
    content: '';
    top: -0.4rem;
    background: #2f2d41;
    border-radius: 1rem;
    height: 4rem;
    width: 0.4rem;
    display: block;
    position: absolute;

  }
}
.titleSection-ladingPlan{
  color:#2f2d41;
  font-weight: 900;
  font-size:2rem;
  line-height: 1.2;
}
</style>
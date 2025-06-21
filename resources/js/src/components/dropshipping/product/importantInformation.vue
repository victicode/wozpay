<template>
  <section class="q-pb-lg">
    <div class="anotherSection__text-title text-yellowLanding q-px-md">
      Informacion importante
    </div>
    <div style="background: #f7f7f7;" class="q-px-md q-pt-md q-pb-lg">
      <div class="q-px-md q-pt-sm" style="background: #f7efe0; border-radius: 1rem;">
        <div v-for="(information, key) in informations" :key="key" class="q-py-sm">
          <div class="title__information">{{ information.title }}</div>
          <div class="value__information">
            {{ information.value }}
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
<script>

import { inject, onMounted } from 'vue';
export default {

  setup (props) {
    const formattList = () => {
      return [
        {
          title:'Proveedores',
          value: 'Seleccionamos proveedores que pasan por una exhaustiva verificación y documentación para garantizar calidad y confianza.'
        },
        {
          title:'Análisis de productos',
          value: 'Utilizamos herramientas como Google Trends y otras fuentes de mercado nacional e internacional para identificar tendencias de productos relevantes.'
        },
        {
          title:'Publicidad (Woz Ads)',
          value: 'Creamos campañas publicitarias enfocada en nuestros nichos. Sin embargo, el cierre de ventas depende directamente del vendedor.'
        },
        {
          title:'Integraciones',
          value: 'Aunque independientes a nosotros, ofrecemos guías y herramientas para que los desarrolladores puedan integrar plataformas de manera eficiente.'
        },
        {
          title:'Plataforma',
          value: 'Claramente diferenciamos nuestra propuesta destacando que no somos. dropi'
        },
        {
          title:'Precios sugeridos',
          value: 'Calculamos estimativos en base a nuestro análisis y las ventas de otros clientes. Estos precios son orientativos y pueden variar según los criterios y estrategias de cada vendedor. Las ventas pueden resultar exitosas o no dependiendo de dichas estrategias.'
        },
        {
          title:'Cobros',
          value: 'El importe reflejado en Woz Payments al momento de generar links es el que se cobra.'
        },
        {
          title:'Envíos',
          value: 'Informamos a nuestros clientes sobre tiempos estimados que pueden variar.'
        },
        {
          title:'Oficinas',
          value: 'Operamos como una tienda completamente online, asegurando accesibilidad y comodidad para todos.'
        },
      ]
    }
    onMounted(() => {
     
    })
    
    return {
      informations: formattList(),
    }
  }
}
</script>
<style lang="scss">
.title__information{
  font-size: 1.2rem;
  font-weight: bold;
}
.value__information{
  font-size: 0.9rem;
  font-weight: 500;
}
</style>
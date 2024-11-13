<template>
  <section class="q-mt-xs q-px-xs q-py-md q-pb-lg direct__links q-pa-md-xl ">
    <div class="direct__links--container q-pb-md q-mt-md-lg">
      <div class="q-mt-lg list__link">
        <div class="q-pl-sm title__links q-mb-sm ">Woz Paraguay</div>
        <div class="flex ">
          <div v-for="(item, key) in wozParaguay" :key="key" class="item__woz q-pl-sm q-mt-xs q-pl-md-sm" :class="{'q-pl-xl':key%2!==0 }">
              {{ item }}
          </div>
        </div>
      </div>
      <div class="q-mt-lg list__link">
        <div class="q-pl-sm title__links q-mb-sm ">Programas de ventas</div>
        <div class="flex ">
          <div v-for="(item, key) in programs" :key="key" class="item__woz q-pl-sm q-mt-xs q-pl-md-sm" :class="{'q-pl-lg q-pr-sm':key%2!==0 }">
              {{ item }}
          </div>
        </div>
      </div>
      <div class="q-mt-lg list__link">
        <div class="q-pl-sm title__links q-mb-sm ">Corporativo</div>
        <div class="flex ">
          <div v-for="(item, key) in corporativo" :key="key" class="item__woz q-pl-sm q-mt-xs q-pl-md-sm" :class="{'q-pl-lg q-pr-sm':key%2!==0 }">
              {{ item }}
          </div>
        </div>
      </div>
      <div class="q-mt-lg list__link">
        <div class="q-pl-sm title__links q-mb-sm ">Comienza</div>
        <div class="flex ">
          <div v-for="(item, key) in init" :key="key" @click="router.push(item.value)" class="item__woz q-pl-sm q-mt-xs q-pl-md-sm" :class="{'q-pl-lg q-pr-sm':key%2!==0 }">
            {{ item.text }}
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
import { useRouter } from 'vue-router';



export default {
  setup() {
    return {
      router: useRouter(),
      wozParaguay: [
        'Woz Paraguay Marketplace',
        'Woz Music',
        'Woz Payment',
        'Woz 911',
        'Woz Book',
        'Woz Security',
        'Woz cars - Jahapy',
        'Woz Gaming',
        'Woz Cloud Services - WCS',
        'Woz Sports',
        'Woz Video Network - WVN',
        'Woz TV',
        'Woz Coffee Center',
        '',
        'Woz Green',
        '',
        'Woz Guitars',

      ],
      programs:[
        'Cumplimineto de las obligaciones',
        'Plan de negocios',
        'Woz Paraguay - SEPRELAD',
        'Rentabilidad',
        'Publicidad',
        '',
        'Programas beta',
        '',
        'Afiliaciones de programas'
      ],
      corporativo: [
        'Woz Paraguay EAS',
        'Como comprar acciones',
        'Comprar - venta de acciones',
        'Preguntas frecuentes',
        'Generar ganancias con las acciones'
      ],
      init: [
        {text: 'Inicia sesión', value:'/login'},
        {text: 'Preguntas frecuentes', value:'/'},
        {text: 'Registrate', value:'/register'},
        {text: 'Información adicional', value:'/'},
        {text: 'Ver membresias', value:'/'},
        {text: 'Descarga la APP', value:'/'},

      ]
    }
  },
}
</script>

<style lang="scss">
.list__link{
  width: 25%;
}
.direct__links{
 background:  #e6e6e6;
 &--container{
  display: flex;
  border-top: 2px solid #1c274c;

 }
}
.item__woz{
  width: 100%;
  font-size:1.1rem;
  font-weight: 400;
  color: #2f2e41;
  font-family: "Baloo Bhaina 2", sans-serif!important;
  font-optical-sizing: auto!important;
  // font-weight: inherit;
  font-style: normal!important;
  transition: all 1s ease;
  cursor: pointer;
  &:hover{
    text-decoration: underline;
  }
}
.title__links{
  color: #2f2e41;
  font-size: 1.4rem;
  font-weight: 600;
  font-family: "Baloo Bhaina 2", sans-serif!important;
  font-optical-sizing: auto!important;
  // font-weight: inherit;
  font-style: normal!important;
}

@media screen and (max-width: 780px){
  .direct__links{
   background:  #e6e6e6;
   &--container{
    display: block;
    border-top: 1px solid #1c274c;
    border-bottom: 1px solid #1c274c;
  
   }
  }
  .item__woz{
    width: 50%;
    font-size: 0.88rem;
    font-weight: 500;
    color: #2f2e41;
  }
  .title__links{
    color: #2f2e41;
    font-size: 1rem;
    font-weight: 600;
    text-decoration-line: underline;
    text-decoration-thickness: 2px;
  }
  .list__link{
    width: 100%;
  }
}
</style>
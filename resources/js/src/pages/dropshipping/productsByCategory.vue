<template>
  <div class="q-pb-lg">
    <section class="q-pt-md q-px-sm">
      <activateArea />
      <div class=" q-pt-md ">
        <div class="text-bold text--valiate q-px-md">
          Productos Woz Dropshipping
          <q-icon
            :name=" icons.sharpVerified"
            size="sm"
            color="terciary"
            class=""
          />
        </div>
    
        <div class="droppersInit q-mt-xs q-px-md q-py-sm q-mx-sm">
          <div class="flex items-center">
            <div class="text-dropper text__dropper q-mr-xs"> 
              Droppers
            </div> 
            <div v-html="wozIcons.droppers"/>
          </div>
          <div class="text__dropper2">{{ numberFormat(ramdonNumber(370, 50000)) }} Droppers están vendiendo estos producto</div>
        </div>
      
      </div>
    </section>
    <productSection class="q-pt-sm q-pb-xl q-mt-sm q-px-sm" />
    <div class="activate__section q-py-lg flex flex-center" v-if="user.dropshipping_account.status !== 2">
      <q-btn color="positive" no-caps unelevated style="border-radius: 1rem;" @click="router.push('/dropshipping/activateForm?amount=250000')"> 
        <div class="q-py-md q-px-lg " style="font-size: 1.1rem; font-weight: 400;">
          Activar membresia anual
        </div>
      </q-btn>
    </div>
  </div>
</template>
<script>

import activateArea from '@/components/dropshipping/categories/activateArea.vue';
import productSection from '@/components/dropshipping/product/productSectionCategory.vue';
import wozIcons from '@/assets/icons/wozIcons.js'
import { inject} from 'vue';
import util from '@/util/numberUtil';
import { storeToRefs } from 'pinia';
import { useAuthStore } from '@/services/store/auth.store';
import { useRouter } from 'vue-router';
export default {
  components:{
    activateArea,
    productSection,
  },
  setup() {
    const icons = inject('ionIcons');
    const numberFormat = util.numberFormat
    const { user } = storeToRefs(useAuthStore())

    const router = useRouter()

    const ramdonNumber = (min, max) => {
      return Math.floor(Math.random() * (max - min + 1)) + min;
    }
    return {
      user,
      icons,
      wozIcons,
      router,
      numberFormat,
      ramdonNumber,
    }
  }
}
</script>
<style lang="scss">
.activate__section{
  background: white;
  position: fixed;
  bottom: 0;
  width: 50%;
  z-index: 100;
}
.droppersInit{
  border: 1px solid goldenrod;
  border-radius: 1rem;
}
.text__dropper{
  font-size: 0.95rem;
  font-weight: bold;
}
.text__dropper2{
  color:rgb(133, 133, 133);
  font-weight: 400;
  font-size: 0.82rem;
}
.text--valiate{
  font-size: 1rem;
}
.products__section{
 min-height: 48.6vh;
 background:#efefef
}

@media screen and (max-width: 780px){
  .activate__section{
    width: 100%;
  }
}
</style>
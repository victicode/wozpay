<template>
  <div>
    <div class="row q-pt-lg">
      <div class="col-md-4 col-6 q-my-md flex column flex-center" @click="goTo('/admin/dropshipping/categories')">
        <div class="button__dropi flex flex-center">
          <q-icon  color="white" size="2rem" name="eva-keypad-outline" />
        </div>
        <div class="q-mt-xs text-subtitle1 text__button-drop">
          Categorias
        </div>
      </div>
      <div class="col-md-4 col-6 q-my-md flex column flex-center" @click="goTo('/admin/dropshipping/product')">
        <div class="button__dropi flex flex-center">
          <q-icon  color="white" size="2rem" name="eva-shopping-cart-outline" />
        </div>
        <div class="q-mt-xs text-subtitle1 text__button-drop">
          Productos
        </div>
      </div>
      <div class="col-md-4 col-6 q-my-md flex column flex-center" @click="goTo('/admin/dropshipping/product')">
        <div class="button__dropi flex flex-center">
          <q-icon  color="white" size="2rem" name="eva-shopping-bag-outline" />
        </div>
        <div class="q-mt-xs text-subtitle1 text__button-drop">
          Ventas
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import { useAuthStore } from '@/services/store/auth.store'
  import { inject, ref,} from 'vue'
  import { useRouter } from 'vue-router'
  
  export default {
    setup() {
      //vue provider
      const user = useAuthStore().user;
      const icons = inject('ionIcons')
      const router = useRouter()

      
      const goTo = (url) => {
        router.push(url)
      }

      return{
        icons,
        router,
        goTo,
      }
    },
  }
</script>
<style lang="scss">
.button__dropi{
  border-radius: 1rem;
  background: $primary;
  height: 4.3rem;
  width: 4.3rem;
  cursor: pointer;
  transition: all 0.5s ease;
  &:hover{
    opacity: 0.7;
  }
}
.text__button-drop{
  cursor: pointer;
}
</style>

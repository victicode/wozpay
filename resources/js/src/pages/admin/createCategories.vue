<template>
  <div>
    <div class="row q-pt-lg">
      <div class="col-md-4 col-6 q-my-md flex column flex-center" @click="dialog = 'create'">
        <div class="button__dropi flex flex-center">
          <q-icon  color="white" size="2rem" name="eva-plus-outline" />
        </div>
        <div class="q-mt-xs text-subtitle1 text__button-drop">
          Crear categoria
        </div>
      </div>
      <div class="col-md-4 col-6 q-my-md flex column flex-center" @click="dialog = 'charge'">
        <div class="button__dropi flex flex-center">
          <q-icon  color="white" size="2rem" name="eva-upload-outline" />
        </div>
        <div class="q-mt-xs text-subtitle1 text__button-drop">
          Carga masiva
        </div>
      </div>

    </div>
    <createCategorieModal :show="(dialog == 'create')" @hiddeModal="hiddeModal"/>
    <masiveCategorieModal :show="(dialog == 'charge')" @hiddeModal="hiddeModal"/>
  </div>
</template>
<script>
  import { useAuthStore } from '@/services/store/auth.store'
  import { inject, ref,} from 'vue'
  import { useRouter } from 'vue-router'
  import createCategorieModal from '@/components/admin/dropshipping/createCategorieModal.vue'
  import masiveCategorieModal from '@/components/admin/dropshipping/masiveCategorieModal.vue'
  
  export default {
    components:{
      createCategorieModal,
      masiveCategorieModal,
    },
    setup() {
      //vue provider
      const user = useAuthStore().user;
      const icons = inject('ionIcons')
      const router = useRouter()
      const dialog = ref('')
      
      const goTo = (url) => {
        router.push(url)
      }
      const hiddeModal = () => {
        dialog.value = ''
      }

      return{
        icons,
        router,
        dialog,
        hiddeModal,
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

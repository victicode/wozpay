<template>
  <div>
    <div class="position-relative"  v-if="ready" style="    height: 100%; overflow: hidden;">
      <div class="flex q-pb-sm w-100 flex-center">
        <div class="text-h6 q-pt-md text-weight-bold">
          Crear productos masivos
        </div>
      </div>
      <div class="row">

        <div class="col-12 text-subtitle1 q-py-sm q-px-md-xl text-weight-medium" >             
          <q-select 
            outlined 
            option-value="id" 
            option-label="title" 
            v-model="categorieSelected" 
            :options="categorieOption"  
            :clear-icon="'eva-close-outline'"
            dropdown-icon="eva-chevron-down-outline"
            behavior="menu"
            color="positive"
            class="createProductSelect" 

          />
        </div>
      </div>
      <div class=" text-center q-pt-md q-pb-none q-px-none card__product " style="    ">
        <div >
          <div  class="flex justify-between items-center" style="height: 100%; overflow: hidden; width: 100%;" >
            <div class="q-pt-none q-pb-none q-px-none w-100" style="height: 100%; overflow: none; width: 100%">
              <div
                class="q-pb-md"
                style="height: 100%; overflow: hidden; display: flex; flex-direction: column; justify-content: space-between;" 
              >
                <div class="q-px-md-xl q-px-md">
                  <fileDropZone @file-loaded="handleFileLoaded" />
                </div>

                <div class="flex justify-end q-pt-sm  q-px-md q-px-md-xl" v-if="readyCharge">
                  <q-btn label="Crear Productos"  color="primary" style="width: 100%; padding: 0.5rem 0rem;" :loading="loading" @click="createMassiveProduct()"/>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row q-pt-lg justify-end">
        <div class="col-md-4 col-6 q-my-md flex column flex-center" @click="dialog = 'create'">
          <div class="button__dropi flex flex-center">
            <q-icon  color="white" size="2rem" name="eva-plus-outline" />
          </div>
          <div class="q-mt-xs text-subtitle1 text__button-drop">
            Crear producto
          </div>
        </div>
      </div>
    </div>
    <div v-else class="q-py-lg flex flex-center " style="height: 50dvh;">
      <q-spinner
        color="primary"
        size="4rem"
      />
    </div>
    <createProducModal :show="(dialog == 'create')" @hiddeModal="hiddeModal"/>
    <!-- <masiveProductModal :show="(dialog == 'charge')" @hiddeModal="hiddeModal"/> -->
  </div>
</template>
<script>
  import { useQuasar } from 'quasar';

  import { inject, onMounted, ref,} from 'vue'
  import { useRouter } from 'vue-router'
  import createProducModal from '@/components/admin/dropshipping/createProducModal.vue'
  import { useProductStore } from '@/services/store/products.store';
  import { useCategorieStore } from '@/services/store/categorie.store';
  import fileDropZone from '@/components/admin/dropshipping/fileDropZone.vue';
  
  export default {
    components:{
      createProducModal,
      fileDropZone

    },
    setup() {

      const q = useQuasar()
      const loading = ref(false)
      const categorieStore = useCategorieStore();
      const productStore = useProductStore()
      const readyCharge = ref(false)
      const ready = ref(false)
      const dataForm = ref('') 
      const categorieSelected = ref({
        id:0,
        title:'Selecciona una categoria'
      })

      
      const categorieOption = ref([
        {
          id:0,
          title:'Selecciona una categoria'
        }
      ])
      
      const icons = inject('ionIcons')
      const router = useRouter()
      const dialog = ref('')
      
      const goTo = (url) => {
        router.push(url)
      }
      const hiddeModal = () => {
        dialog.value = ''
      }
      const getAllCategories = () => {
        ready.value = false
        categorieStore.getAllCategorieToSelect()
        .then((response) => {
          // ready.value = true
          categorieOption.value = [
            {
              id:0,
              title:'Selecciona una categoria'
            },
            ...response.data
          ]
          setTimeout(() => {
            ready.value = true

          }, 1000)
        })
      }
      const handleFileLoaded = (payload) => {
        readyCharge.value = true
        dataForm.value = JSON.stringify(payload.data);
      }
      const createMassiveProduct = () => {
        loading.value= true
        productStore.massiveCreate({data: {data: dataForm.value}, categorie:categorieSelected.value.id })
        .then((response) => {
          if(response.code !== 200 ) throw response
          ready.value = false
          setTimeout(() => {
            clearPage()
            showNotify('positive', 'Productos creados con exito')
            loading.value = false
            ready.value = true
          }, 1000);
        })
        .catch((response) => {
          loading.value= false
        })
      }
      const clearPage = () => {
        readyCharge.value = false
        categorieSelected.value = {
          id:0,
          title:'Selecciona una categoria'
        }
      }
      const showNotify = (type, message) => {
        q.notify({
          message: message,
          color: type,
          actions: [
            { icon: 'eva-close-outline', color: 'white', round: true, handler: () => { /* ... */ } }
          ]
        })
      }
      onMounted(() => {
        getAllCategories()
      })
      return{
        icons,
        router,
        dialog,
        ready,
        categorieSelected,
        categorieOption,
        readyCharge,
        loading,
        handleFileLoaded,
        hiddeModal,
        createMassiveProduct,
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

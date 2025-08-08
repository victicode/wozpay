<template>
  <div>
    <q-dialog v-model="dialog"  persistent class="productCreate__modal">
      <q-card class="position-relative dialog__product"  >
        <q-card-section class="flex q-pb-sm w-100 items-center justify-between">
          <div class="text-subtitle1 text-weight-bold">
            Crear Producto
          </div>
          <q-btn color="black" size="xs" round @click="hideModal()">
            <q-icon
                name="eva-close-outline"
                size="xs"
                color="white"
                class="q-mx-xs "
              />
          </q-btn>
        </q-card-section>
        <q-linear-progress :value="1" color="black" size="0.125rem"/>
        <q-card-section class=" text-center q-pt-md q-pb-none q-px-none card__product " style="    ">
          <div v-if="ready" style="    height: 100%; overflow: hidden;">
            <div  class="flex justify-between items-center" style="height: 100%; overflow: hidden;" >
              <q-card-section class="q-pt-none q-pb-none q-px-none w-100" style="height: 100%; overflow: none;">
                <q-form
                  @submit="nextStep()"
                  style="height: 100%; overflow: hidden;" 
                >
                  <div  class="product_container q-px-md" style="" >
                    <transition name="horizontal">
                      <template v-if="step==1">
                        <div class="w-100">
                          <div class="q-pb-md text-subtitle1 text-bold">
                            Ingresa datos del producto
                          </div>
                          <div class="q-pb-sm">
                            <label for="productImg">
                              <div>
                                <div class="bg-grey-6 flex flex-center imgLabel" v-if="!productForm.productImg "
                                  style="margin:auto; height:10rem; width:10rem; overflow:hidden; border-radius:0.6rem" >
                                  <q-icon size="3rem" color="grey-1" name="eva-plus-outline" />
                                </div>
                                <div v-else>
                                  <img :src="productImg" 
                                  style="margin:auto; height:10rem; width:10rem; overflow:hidden; border-radius:0.6rem; object-fit:cover" alt="" />
                                </div>
                              </div>
                            </label>
                          </div>
                          <div class="text-subtitle1 q-py-sm text-weight-medium" >             
                            <q-select 
                              outlined 
                              option-value="id" 
                              option-label="title" 
                              v-model="productForm.categorie" 
                              :options="categorieOption"  
                              :clear-icon="'eva-close-outline'"
                              dropdown-icon="eva-chevron-down-outline"
                              behavior="menu"
                              color="positive"
                              class="createProductSelect" 
    
                            />
                          </div>
                          <div class="text-subtitle1 q-py-sm text-weight-medium" >
                            <q-input
                              class="createProduct-input"
                              outlined
                              clearable
                              :clear-icon="'eva-close-outline'"
                              color="positive"
                              v-model="productForm.title"
                              label="Nombre de producto"
                              placholder="Ej. Auriculares inalámbricos Galaxy Buds3 Pro 2025"
                              autocomplete="off"
      
                            />
                          </div>
                          <div class="text-subtitle1 q-py-sm text-weight-medium" >
                            <q-input
                              class="createProduct-input"
                              outlined
                              clearable
                              :clear-icon="'eva-close-outline'"
                              color="positive"
                              v-model="productForm.quantity"
                              label="Cantidad"
                              mask="###.###.###"
                              reverse-fill-mask
                              autocomplete="off"
                              placholder="Ej. 15"
                            />
                          </div>
                          <div class="text-subtitle1 q-py-sm text-weight-medium" >            
                            <q-input
                              class="createProduct-input"
                              outlined
                              clearable
                              :clear-icon="'eva-close-outline'"
                              color="positive"
                              v-model="productForm.price"
                              label="Precio base"
                              mask="###.###.###"
                              reverse-fill-mask
                              autocomplete="off"
                              placholder="Ej. 10.000, 50.000"
                            />
                          </div>
                          <div class="text-subtitle1 q-py-sm text-weight-medium" >            
                            <q-input
                              class="createProduct-input"
                              outlined
                              clearable
                              :clear-icon="'eva-close-outline'"
                              color="positive"
                              v-model="productForm.unit"
                              label="Tipo de unidad"
                              placholder="Ej. Set, Uni, o Pcs"
                            />
                          </div>
                          <div class="text-subtitle1 q-pt-sm q-pb-md text-weight-medium" >            
                            <q-input
                              class="textArea"
                              outlined
                              clearable
                              :clear-icon="'eva-close-outline'"
                              color="positive"
                              v-model="productForm.description"
                              label="Descripción"
                              autogrow
                              autocomplete="off"
                              placholder="Ej. Audifono super potente con luces RGB"
                            />
                          </div>
    
                        </div>
                      </template>
                    </transition>
                    <transition name="horizontal">
                      <template v-if="step==2">
                        <div class="w-100">
                          <div class="q-pb-md text-subtitle1 text-bold">
                            Ingresa datos sobre el volumen de ventas
                          </div>
                          <div class="text-subtitle1 q-py-sm text-weight-medium" >
                            <q-input
                              class="createProduct-input"
                              outlined
                              clearable
                              :clear-icon="'eva-close-outline'"
                              color="positive"
                              v-model="productForm.sellActual"
                              label="Volumen de ventas actual"
                              autocomplete="off"
                              placholder="Ej. 10.000"
                              mask="###.###.###"
                              reverse-fill-mask
                            />
                          </div>
                          <div class="text-subtitle1 q-py-sm text-weight-medium" >
                            <q-input
                              class="createProduct-input"
                              outlined
                              clearable
                              :clear-icon="'eva-close-outline'"
                              color="positive"
                              v-model="productForm.sellLastMonths"
                              label="Historial de volumenes de venta"
                              autocomplete="off"
                              hint='Separa los montos con un "-"'
                            />
                          </div>

    
                        </div>
                      </template>
                    </transition>
                    <transition name="horizontal">
                      <template v-if="step==3">
                        <div class="w-100">
                          <div class="q-pb-md text-subtitle1 text-bold">
                            Ingresa datelles del envio/losgitica
                          </div>
                          <div class="text-subtitle1 q-py-sm text-weight-medium" >
                            <q-input
                              class="createProduct-input"
                              outlined
                              clearable
                              :clear-icon="'eva-close-outline'"
                              color="positive"
                              v-model="productForm.logistics"
                              label="Almacén/Logística"
                              autocomplete="off"
                              placholder="Envíos por Woz Dropshipping"
                            />
                          </div>
                          <div class="text-subtitle1 q-py-sm text-weight-medium" >
                            <q-input
                              class="createProduct-input"
                              outlined
                              clearable
                              :clear-icon="'eva-close-outline'"
                              color="positive"
                              v-model="productForm.timeShip"
                              label="Tiempo de entrega"
                              autocomplete="off"
                              placholder="Ej.Entrega en 1 a 4 días"
                            />
                          </div>
                          <div class="text-subtitle1 q-py-sm text-weight-medium" >
                            <q-input
                              class="createProduct-input"
                              outlined
                              clearable
                              :clear-icon="'eva-close-outline'"
                              color="positive"
                              v-model="productForm.payMethod"
                              label="Metodo de cobro"
                              autocomplete="off"
                              placholder="Ej. Woz payments"
                            />
                          </div>
                          <div class="text-subtitle1 q-py-sm text-weight-medium" >
                            <q-input
                              class="createProduct-input"
                              outlined
                              clearable
                              :clear-icon="'eva-close-outline'"
                              color="positive"
                              v-model="productForm.comision"
                              label="Retiro de ganacias - comisiones"
                              autocomplete="off"
                              placholder="Ej. 12"
                            />
                          </div>

    
                        </div>
                      </template>
                    </transition>
                    <transition name="horizontal">
                      <template v-if="step==4">
                        <div class="w-100">
                          <div class="q-pb-md text-subtitle1 text-bold">
                            Datos de review
                          </div>
                          <div class="text-subtitle1 q-py-sm text-weight-medium" >
                            <q-input
                              class="createProduct-input"
                              outlined
                              clearable
                              :clear-icon="'eva-close-outline'"
                              color="positive"
                              v-model="productForm.view"
                              label="Número de vistas"
                              autocomplete="off"
                              placholder="Ej. 4"
                            />
                          </div>
                          <div class="text-subtitle1 q-py-sm text-weight-medium" >
                            <q-input
                              class="createProduct-input"
                              outlined
                              clearable
                              :clear-icon="'eva-close-outline'"
                              color="positive"
                              v-model="productForm.reviews"
                              label="Número de review"
                              autocomplete="off"
                              placholder="Ej. 5"
                            />
                          </div>
                          <div class="text-subtitle1 q-py-sm text-weight-medium" >
                            <q-input
                              class="createProduct-input"
                              outlined
                              clearable
                              :clear-icon="'eva-close-outline'"
                              color="positive"
                              v-model="productForm.rating"
                              label="Cantidad de estrellas"
                              autocomplete="off"
                              placholder="Valor de 1 a 5"
                            />
                          </div>
                        </div>
                      </template>
                    </transition>
                  </div>

                  <input type="file"  id="productImg" ref="productImg" style="display: none;" @change="onFileChange" >
                
                  <div class="flex justify-end q-pt-sm  q-px-md">
                  
                    
                    <q-btn :label="step == 1 ? 'Cerrar' : 'Volver' " color="negative"  class="q-mx-sm" @click="step == 1 ? hideModal() : step--" />
                    <q-btn :label="step !== 3 ? 'Siguiente' : 'Enviar' "  color="black" type="submit" :loading="loading"/>
                  </div>
                </q-form>
              </q-card-section>
            </div>
          </div>
          <div v-else class="q-py-lg flex flex-center">
            <q-spinner
              color="primary"
              size="3em"
            />
          </div>
        </q-card-section>
      </q-card>
    </q-dialog>
  </div>
</template>
<script>
  import { useQuasar } from 'quasar';
  import { inject, onMounted, ref, } from 'vue';
  
  import util from '@/util/numberUtil'
  import { useCategorieStore } from '@/services/store/categorie.store';


  export default {
    props: {
      show: Boolean,
    },
    emits: ['hiddeModal', 'createProduct'],
    setup (props, { emit }) {
      const categorieStore = useCategorieStore();
      const productImg = ref(null)
      const step = ref(1)
      const productForm = ref({
        title:'',
        quantity:'',
        unit:'',
        price:'',
        categorie: {
          id:0,
          title:'Selecciona una categoria'
        },
        description:'',
        productImg:null,

        sellActual:'',
        sellLastMonths:'',

        logistics:'',
        timeShip:'',
        payMethod:'',
        
        view:0,
        reviews:0,
        rating:0,
      })
      const dialog = ref(props.show);
      const icons = inject('ionIcons')
      const q = useQuasar()
      const ready = ref(false)
      const numberFormat = util.numberFormat

      const categorieOption = ref([
        {
          id:0,
          title:'Selecciona una categoria'
        }
      ])
      const createProduct = () => {
        alert('eeeee')
      }
      const getAllCategories = () => {
        categorieStore.getAllCategorieToSelect()
        .then((response) => {
          categorieOption.value = [
            {
              id:0,
              title:'Selecciona una categoria'
            },
            ...response.data
          ]
        })
      }

      const nextStep = () => {
        if(step.value == 4){
          createProduct()
          return
        }
        step.value++
      }

      const hideModal = () => {
        emit('hiddeModal')
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

      const onFileChange = (e) => {
        const file = e.target.files[0];
        productForm.value.productImg = file
        return productImg.value= URL.createObjectURL(file)
      }
      watch(() => props.show, (newValue) => {
        dialog.value = newValue
        setTimeout(() => {
          ready.value = true
        }, 1000);
      });
      onMounted(() => {
        getAllCategories()
      })

      return {
        dialog,
        icons,
        ready,
        productForm,
        numberFormat,
        categorieOption,
        productImg,
        step,
        hideModal,
        nextStep,
        onFileChange,
      }
    }
  };
</script>
<style lang="scss">
  .card__product{
    height: 93%; overflow: hidden;
  }
  .product_container{
    height: 92%; overflow: auto;
  }
  .imgLabel{
    transition: all 0.5s ease;
    &:hover{
      opacity: 0.6;
    }
  }
  .createProductSelect.q-field--auto-height.q-field--labeled{
     & .q-field__control-container{
      padding-top: 0px!important;
     }
  }
  .textArea{
    & .q-field__control-container{
      padding-top: 19px!important;
    }

    & .q-field__control{
      border-radius: 10px!important;
    }
    &.q-field--focused .q-field__label, &.q-field--float .q-field__label{
      z-index: 100;
      background: white;
      font-weight: 600;
      max-width: 133%;
      transform: translateY(-125%) translateX(4%) scale(0.75)!important;
    }
  }
  .createProductSelect {
    & .q-field__control{
      border-radius: 10px!important;
      height: 50px!important;
      min-height: 50px!important;
    }
    & .q-field__label{
    transform: translateY(0%)
    }
    &.q-field--focused .q-field__label, &.q-field--float .q-field__label{
      z-index: 100;
      background: white;
      font-weight: 600;
      max-width: 133%;
      transform: translateY(-125%) translateX(4%) scale(0.75)!important;
    }
    
    & .q-field__native{
      padding-top: 5px!important;
      font-weight: 500;
    }
    & .q-field__append{
      transform: translateY(-2%)
    }
    & .q-field__messages {
      transform: translateY(-25%) translateX(-1%)
    }
    
  }
.createProduct-input {
  & .q-field__control {
    border-radius: 10px!important;
    height: 59px
  }
  & .q-field__label{
    transform: translateY(11%)
  }
  &.q-field--focused .q-field__label, &.q-field--float .q-field__label{
    z-index: 100;
    background: white!important;
    font-weight: 600;
    max-width: 133%;
    padding: 0px 10px;
    transform: translateY(-125%) translateX(4%) scale(0.75)!important;
  }
  
  & .q-field__native{
    padding-top: 15px!important;
    font-weight: 600;
  }
  & .q-field__append{
    transform: translateY(5%)
  }

}
@media screen and (max-width: 780px){
  .card__product{
    height: 92%;
  }
  .product_container{
    height: 91%;
  }
  .createProduct-input {
    & .q-field__bottom{
      transform: translateY(15px);
    }
  }
}
.noBorderInput{
  
  border-radius: 10px;
  padding: 0px 0.5rem;


  & input{
    cursor: pointer;
    font-family: "Roboto", sans-serif !important;
    font-style: normal;
    font-size: 1rem;
    font-weight: 500;
    line-height: 1.75rem;
    letter-spacing: 0.00937em;
    text-align: end;
  }
}
.productCreate__modal{
  width: 100%;
  & .q-dialog__inner--minimized{
    padding: 13px!important;
  }
}
</style>
<style lang="scss" scoped>

.dialog__product{
  width: 560px; 
  transition: all 0.8s ease; 
  max-height: 100%!important; 
  border-radius: 20px;
  height: 100vh;
  max-height:100vh;
  overflow: hidden;
}

.w-100 {
  width: 100%;
}
.negative-back {
  background-color: #ff00001a;border-radius: 20px;
}

.button-file {
  width: 60px; 
  height: 60px; 
  border-radius: 10px; 
  box-shadow: 0px 2px 8px 0px rgba(168, 167, 167, 0.829);
}
.cls-button{
  position: absolute; 
  right: -10px; 
  top:-10px; 
  z-index: 15;
}

@media screen and (max-width: 780px){
  .dialog__product{
    width: 400px; 
  }
}



</style>
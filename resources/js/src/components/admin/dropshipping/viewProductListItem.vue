<template>
  <div class="q-my-md q-py-xs">
    <div class="row items-end q-px-sm itemlisPro" style="height:4.5rem" @click="goTo(product.id)">
      <div class="col-md-2 col-3   bg-grey-5 flex flex-center img__conter" style=" border-radius: 0.5rem; height:100%;">
        <img :src="!product.image ? 'https://staging.wozpayments.com/public/images/products/default.png': product.image" alt="Imagen" class="productListSquare__img" @error="replaceWithDefault" />
      </div>
      <div class="col-md-10 col-9 q-pl-sm cursor-pointer" >
        <div style="border-bottom: 1px solid darkgrey" class="q-pb-sm">
          <div class="text-subtitle1">
            {{ product.title }}
          </div>
          <div class="text-caption">
             {{ product.categorie ? product.categorie.name : '' }}
          </div>
          <div class="text-subtitle2">
            Gs. {{ numberFormat(product.price) }}
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import { useAuthStore } from '@/services/store/auth.store'
  import { inject, ref,} from 'vue'
  import { useRouter } from 'vue-router'
  import util from '@/util/numberUtil';


  export default {
    props: [
      'product'
    ],
    setup(props) {
      //vue provider
      const numberFormat= util.numberFormat;
      const user = useAuthStore().user;
      const icons = inject('ionIcons')
      const router = useRouter()
      const product = props.product
      const replaceWithDefault = (event) =>  {
        event.target.src = 'https://staging.wozpayments.com/public/images/products/default.png'
      }

      const goTo = (id) => {
        router.push('/admin/dropshipping/product/view/'+id)
      }
      // Data
      return{
        icons,
        router,
        product,
        numberFormat,
        goTo,
        replaceWithDefault,
      }
    },
  }
</script>
<style lang="scss">
.itemlisPro{
  transition: all 0.5s ease;
  &:hover{
    opacity: 0.7;
  }
}
.img__conter{
  padding: 0px 2.3rem;
}
@media screen and (max-width: 820px){
  .img__conter{
    padding: 0px 1.7rem;  
  }
}

</style>
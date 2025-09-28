
<template>

    <div class=" q-my-md productSquareSimilar q-py-md q-px-md q-mr-md ">
      <div class="productSquareSimilar__img--container">
        <img :src="!product.image ? 'https://staging.wozpayments.com/public/images/products/default.png': product.image" alt="Imagen" @error="replaceWithDefault" class="productSquareSimilar__img">
        
      </div>
      <div class="q-ml-xs productSquareSimilar__detail--container">
        <div class="productSquareSimilar__title " >{{product.title}}</div>
        <div class="productSquareSimilar__vendorText">
          {{ product.vendor.name }}
          <q-icon
              :name=" icons.sharpVerified"
              size="1.1rem"
              color="terciary"
              class="q-mx-xs"
            />
        </div>
        <div class="productSquareSimilar__price q-my-xs">Precio proveedor: Gs. {{numberFormat(product.price)}}</div>
        <div class="productSquareSimilar__suggerPrice q-mb-xs">Precio sugerido: Gs. {{numberFormat(product.price+50000)}}</div>
        <div>
          <q-icon :name="icons.raiting" color="terciary" size="1.5rem" v-for="i in product.rating" :key="i" />
          <q-icon :name="icons.outlinedGrade" color="terciary" size="1.5rem" v-for="i in (5-product.rating)" :key="i" />
        </div>
      </div>
      
    </div>
</template>
<script>
import utils from '@/util/numberUtil';
export default {
  props: {
    product: Object,
  },
  emits: [],
  setup (props) {
    const icons = inject('ionIcons');
    const replaceWithDefault = (event) =>  {
      event.target.src = 'https://staging.wozpayments.com/public/images/products/default.png'
    }
    const  numberFormat = utils.numberFormat
    return {
      icons,
      product: props.product,
      numberFormat,
      replaceWithDefault,
    }
  }
}
</script>
<style lang="scss">
.productSquareSimilar{
  flex-wrap: nowrap;
  background: #f3f3f3;
  border-radius: 1rem;
  width: 17rem;
  box-shadow: 0px 5px 10px 0px #e3e3e3;
  &__title{
    font-weight: 900;
    font-size: 1rem;
    text-overflow: ellipsis;
    overflow: hidden;
    white-space:nowrap;
    width: 100%;
  }
  &__vendorText{
    font-weight: 400;
    display: flex;
    align-items: center;
    font-size: 0.88rem;
  }
  &__price{
    font-size: 0.85rem;
    color: rgb(85, 85, 85);
    font-weight: 400;
    letter-spacing: -0.3px;
  }
  &__suggerPrice{
    font-weight: bolder;
    color: #ffc701;
    font-size: 0.88rem;
    letter-spacing: -0.3px;
  }
}
.productSquareSimilar__img{
 
  object-fit: contain;
  background: rgba(255, 255, 255, 0);
  width: 100%;
  padding: 0% 25%;
  height: 7.5rem;
  &--container{
    width: 100%;
    overflow: hidden;
    padding: 0.1rem;
    border-radius: 0.8rem;
    margin-bottom: 0.5rem;
    // background: rgba(211, 211, 211, 0.418);

  }
}
.productSquareSimilar__detail{
  &--container{
    width: 100%;
  }
}
.text-stock{
  font-size: 0.9rem;
}
</style>
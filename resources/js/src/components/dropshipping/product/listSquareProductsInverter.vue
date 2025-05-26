
<template>
  <section class="q-px-md">
    <div class="flex q-mt-md productListSquareIn q-py-sm">
      <div class="q-ml-xs productListSquareIn__detail--container">
        <div class="productListSquareIn__title " >{{product.title}}</div>
        <div class="productListSquareIn__vendorText">
          Proveedor
          <q-icon
              :name=" icons.sharpVerified"
              size="1.1rem"
              color="terciary"
              class="q-mx-xs"
            />
        </div>
        <div class="productListSquareIn__price">Precio proveedor: Gs. {{numberFormat(product.price)}}</div>
        <div class="productListSquareIn__suggerPrice q-mb-xs">Precio sugerido: Gs. {{numberFormat(product.price + 5000)}}</div>
        <div>
          <q-icon :name="icons.raiting" color="terciary" size="1.5rem" v-for="i in product.rating" :key="i" />
          <q-icon :name="icons.outlinedGrade" color="terciary" size="1.5rem" v-for="i in (5-product.rating)" :key="i" />
        </div>
      </div>
      <div class="productListSquareIn__img--container">
        <img :src="product.image" alt="" class="productListSquareIn__img">
      </div>
    </div>
    <div class="text-right text-grey text-stock q-pr-sm">
      Stock disponible: {{ numberFormat(product.quantity) }}
    </div>
  </section>
</template>
<script>
import utils from '@/util/numberUtil';
export default {
  props: {
    product: Object,
  },
  emits: ['getPay'],
  setup (props, { emit }) {
    const icons = inject('ionIcons');

    const  numberFormat = utils.numberFormat
    return {
      icons,
      product: props.product,
      numberFormat,
    }
  }
}
</script>
<style lang="scss">
.productListSquareIn{
  flex-wrap: nowrap;
  background: white;
  border-radius: 1rem;
  &__title{
    font-weight: 900;
    font-size: 1rem;
    text-overflow: ellipsis;
    overflow: hidden;
    white-space:nowrap;
    width: 96%;
  }
  &__vendorText{
    font-weight: 400;
    display: flex;
    align-items: center;
    font-size: 0.95rem;
  }
  &__price{
    font-size: 0.99rem;
    color: rgb(85, 85, 85);
    font-weight: 400;
    letter-spacing: -0.3px;
  }
  &__suggerPrice{
    font-weight: bolder;
    color: #ffc701;
    font-size: 1rem;
    letter-spacing: -0.3px;
  }
}
.productListSquareIn__img{
 
  object-fit: contain;
  width: 100%;
  height: 7.5rem;
  &--container{
    width: 30%;
    overflow: hidden;
    padding: 0.1rem;
    border-radius: 0.8rem;
    // background: rgba(211, 211, 211, 0.418);

  }
}
.productListSquareIn__detail{
  &--container{
    width: 70%;

  }
}
.text-stock{
  font-size: 0.9rem;
}
</style>
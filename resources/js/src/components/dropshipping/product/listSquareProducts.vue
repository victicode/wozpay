
<template>
  <div class="flex q-mt-md productListSquare q-py-sm">
    <div class="productListSquare__img--container">
      <img :src="product.image" alt="" class="productListSquare__img">
    </div>
    <div class="q-ml-xs productListSquare__detail--container">
      <div class="productListSquare__title " @click="goTo(product.id)">{{product.title}}</div>
      <div class="productListSquare__vendorText">
        Proveedor
        <q-icon
            :name=" icons.sharpVerified"
            size="1.1rem"
            color="terciary"
            class="q-mx-xs"
          />
      </div>
      <div class="productListSquare__price">Precio proveedor: Gs. {{numberFormat(product.price)}}</div>
      <div class="productListSquare__suggerPrice q-mb-xs">Precio sugerido: Gs. {{numberFormat(product.price + 5000)}}</div>
      <div>
        <q-icon :name="icons.raiting" color="terciary" size="1.5rem" v-for="i in product.rating" :key="i" />
        <q-icon :name="icons.outlinedGrade" color="terciary" size="1.5rem" v-for="i in (5-product.rating)" :key="i" />
      </div>
    </div>
  </div>
</template>
<script>
import utils from '@/util/numberUtil';
import { useRouter } from 'vue-router';
export default {
  props: {
    product: Object,
  },
  emits: [],
  setup (props,) {
    const icons = inject('ionIcons');

    const  numberFormat = utils.numberFormat
    const router = useRouter()
    const goTo = (id) => {
      router.push('/dropshipping/product/'+id)
    }
    return {
      icons,
      product: props.product,
      numberFormat,
      goTo,
    }
  }
}
</script>
<style lang="scss">
.productListSquare{
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
    transition: all 0.5s ease;

    &:hover{
      cursor: pointer;
      text-decoration: underline;
    }

  }
  &__vendorText{
    font-weight: 400;
    display: flex;
    align-items: center;
    // font-weight: bolder;
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
.productListSquare__img{
 
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
.productListSquare__detail{
  &--container{
    width: 70%;

  }
}
</style>
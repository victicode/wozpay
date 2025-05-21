
<template>
  <div class="flex">
    <div>
      <img :src="product.image" alt="">
    </div>
    <div>
      <div>{{product.title}}</div>
      <div>--Proveedor--</div>
      <div>Precio proveedor: Gs. {{numberFormat(product.price)}}</div>
      <div>Precio sugerido: Gs. {{numberFormat(product.price + 5000)}}</div>
      <div>
        <q-icon name="eva-star-outline" color="terciary" size="1.4rem" v-for="i in product.rating" :key="i" />
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
  emits: ['getPay'],
  setup (props, { emit }) {
    const  numberFormat = utils.numberFormat
    return{
      product: props.product,
      numberFormat,
    }
  }
}
</script>
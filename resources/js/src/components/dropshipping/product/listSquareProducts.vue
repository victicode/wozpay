<template>
  <div>
    <div>
      <img :src="product.image" alt="">
    </div>
    <div>
      <div></div>
      <div></div>
      <div></div>
      <div></div>
      <div></div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    product: Object,
  },
  emits: ['getPay'],
  setup (props, { emit }) {
    return{
      product: props.product
    }
  }
}
</script>
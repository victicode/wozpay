<template>
  <main>
    hola
  </main>
</template>
<script>
import utils from '@/util/numberUtil';
import { useRouter } from 'vue-router';
export default {
  props: {
    product: Object,
  },
  emits: ['getPay'],
  setup (props, { emit }) {
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
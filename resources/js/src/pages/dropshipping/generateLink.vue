<template>
  <div v-if="load">
    <productLinkForm :product="product" />
  </div>
  <div  v-else style="height: 100vh;">
    <transition >
      <q-inner-loading
        :showing="true"
        label="Cargando"
        class="bg-white"
        color="primary"
        label-class="text-white"
        label-style="font-size: 1.1em"
      />
    </transition>
  </div>
</template>
<script>

  import { useRoute, useRouter } from 'vue-router';
  import noReady from "@/components/payLink/noReady.vue";
  import productLinkForm from "@/components/dropshipping/link/linkForm.vue";
  import { storeToRefs } from 'pinia'
  import { useAuthStore } from '@/services/store/auth.store'
  import { onMounted } from 'vue';
  import { useQuasar } from 'quasar';
  import wozIcons from '@/assets/icons/wozIcons';
  import { useProductStore } from '@/services/store/products.store';

export default {
  components:{
    noReady,
    productLinkForm
  },
  setup() {

    const { user  } = storeToRefs(useAuthStore())
    const requirements = ref({
      card: user.value.card  ?? false,
      current: user.value.current_loan ?? false,
      loan:user.value.loans_complete_count ?? false,
    })
    const prodcutStore = useProductStore()

    const showNotReady = ref(true)
    const load = ref(false)
    const colorBanner = ref('#0449fb')
    const router = useRouter();
    const route = useRoute();
    const product = ref({})
    const getProduct = (id) => {
      prodcutStore.getProductById(id)
      .then((response) => {
        product.value = response.data
        load.value = true;
      })
    }
    onMounted(() => {
      useQuasar().addressbarColor.set(colorBanner.value)
      getProduct(route.params.id)
    })
    return {
      router,
      wozIcons,
      showNotReady,
      load,
      requirements,
      product,
    }
  },
}
</script>
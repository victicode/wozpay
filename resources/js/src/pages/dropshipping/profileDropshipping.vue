<template>
  <main>
    <template v-if="Object.values(stadistics).length > 0">

      <stadisticProfile :stadistics="stadistics" />
      <aboutWoz :stadistics="stadistics"/>
      <aboutAccount :stadistics="stadistics"/>
    </template>
    <div v-else class="flex justify-center items-center q-pa-xl"> 
      <q-spinner-tail
        color="primary"
        size="5rem"
      />
    </div>
  </main>
</template>
<script >
  import { inject, onMounted, ref } from 'vue';
  import { useAuthStore } from '@/services/store/auth.store'
  import { useDropshippingStore } from '@/services/store/dropshipping.store';
  import { storeToRefs } from 'pinia';
  import { useQuasar } from 'quasar'
  import wozIcons from '@/assets/icons/wozIcons';
  import stadisticProfile from '@/components/dropshipping/profile/stadisticProfile.vue';
  import aboutWoz from '@/components/dropshipping/profile/aboutWoz.vue';
  import aboutAccount from '@/components/dropshipping/profile/aboutAccount.vue';

  export default {
    components:{
      stadisticProfile,
      aboutWoz,
      aboutAccount
    },
    setup () {
      //vue provider
      const dropStore = useDropshippingStore()
      const icons = inject('ionIcons')
      const $q = useQuasar()
      const { user  } = storeToRefs(useAuthStore())
      const stadistics = ref({}) 
      const getStatdistics = () => {
      dropStore.getStadistics(user.value.id)
        .then((response) => {
          stadistics.value = response.data;
        })
      }

      onMounted(() => {
        getStatdistics()
      })
      return {
        icons,
        user,
        wozIcons,
        stadistics,
      }
    }
  };
</script>
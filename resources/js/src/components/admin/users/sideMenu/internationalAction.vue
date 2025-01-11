<template>
  <div>
    <q-item class="q-py-none q-px-md" >
      <q-item-section>
        <div class="flex items-center justify-between">
          <q-item-label class="q-mt-xs text-weight-bold" >
            <span class="text-subtitle2 text-weight-medium">
              Activar
            </span>
          </q-item-label>
          <q-item-label>
            <van-switch v-model="checked.active" size="medium" @update:model-value="setStatus(1)"  :loading="loading"/>
          </q-item-label>
        </div>
      </q-item-section>
    </q-item>
    <q-item class="q-py-none q-px-md" >
      <q-item-section>
        <div class="flex items-center justify-between">
          <q-item-label class="q-mt-xs text-weight-bold" >
            <span class="text-subtitle2 text-weight-medium">
              Suspender
            </span>
          </q-item-label>
          <q-item-label>
            <van-switch v-model="checked.suspense" size="medium" @update:model-value="setStatus(2)" :loading="loading"/>
          </q-item-label>
        </div>
      </q-item-section>
    </q-item>
  </div>
</template>
<script >
  import { ref, inject, onMounted} from 'vue';
  import { useQuasar } from 'quasar';
  import { useWalletStore } from '@/services/store/wallet.store';

  export default {
    props: {
      user: Object,
    },

    setup (props) {
      //vue provider
      const user = ref(props.user)
      const emitter = inject('emitter');
      const walletStore = useWalletStore()

      const loading = ref(false)
      const q = useQuasar()

      const checked = ref({
        active: user.value.wallet_link.status == 2,
        suspense: !(user.value.wallet_link.status == 2),

      })

      const setStatus = (isBlock) => {
        loading.value = true
        let data = {}
          if(isBlock == 1){
            checked.value.active = true
            checked.value.suspense = !checked.value.active 
            data = {
              user: user.value.id,
              status: 2
            }
          }
          if(isBlock == 2){
            checked.value.suspense = true
            checked.value.active = !checked.value.suspense 
            data = {
              user: user.value.id,
              status: 0
            }
          }
          loading.value = false

          user.value.wallet_link.status == data.status 
          ? ''
          : sendData(data)
      }

      
      const sendData = (formData)  => {
        walletStore.setWalletStatus(formData)
        .then((data) => {
          if(data.code !== 200) throw data
          loading.value = false
          user.value.wallet_link.status = data.data.status
          formData.status == 0
          ? showNotify('negative', 'Cuenta internacional suspendida')
          : showNotify('positive', 'Cuenta internacional activa')
        })
        .catch((response) => {
          checked.value.suspense = false
          loading.value = false
          showNotify('negative', 'Error al cambiar estado')

        })
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


      const emitUserChanges = (user) => {
        emitter.emit('setUser', user);
      }
      return {
        loading,
        user,
        checked,
        setStatus,
      }
    }
  };
</script>

<style lang="scss" scoped>
.w-100 {
  width: 100%;
}
</style>
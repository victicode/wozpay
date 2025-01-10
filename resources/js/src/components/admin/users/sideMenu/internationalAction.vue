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
  import { useUserStore } from '@/services/store/user.store';
  import { useQuasar } from 'quasar';

  export default {
    props: {
      user: Object,
    },

    setup (props) {
      //vue provider
      const user = ref(props.user)
      const emitter = inject('emitter');
      const loading = ref(false)
      const userStore = useUserStore()
      const q = useQuasar()

      const checked = ref({
        active: user.value.wallet_link.status == 1,
        suspense: !(user.value.wallet_link.status == 1),

      })

      const setStatus = (isBlock) => {
        loading.value = true
        const data = isBlock == 1
        ? {
            user: user.value.id,
            status: checked.value.suspense
          } 
        : {
            user: user.value.id,
            block: checked.value.block 
          }

          if(isBlock == 1){
            checked.value.active = true
            checked.value.suspense = !checked.value.active 
          }
          if(isBlock == 2){
            checked.value.suspense = true
            checked.value.active = !checked.value.suspense 
          }
          loading.value = false

        // sendData(data)
      }


      const sendData = (formData)  => {
        userStore.setUserStatus(formData)
        .then((data) => {
          if(data.code !== 200) throw data
          loading.value = false
          emitUserChanges(data.data)
          setNotify(formData)
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
      const setNotify = (data) => {
        if(data.status) return showNotify(checked.value.suspense ? 'positive' : 'terciary', checked.value.suspense ? 'Usuario habilitado' : 'Usuario suspendido')

        showNotify(checked.value.block ? 'grey-8' : 'positive', checked.value.block ? 'Usuario bloqueado' : 'Usuario desbloqueado')
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
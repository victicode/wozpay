<template>
  <div>
    <q-item class="q-py-none q-px-md" >
      <q-item-section>
        <div class="flex items-center justify-between">
          <q-item-label class="q-mt-xs text-weight-bold" >
            <span class="text-subtitle2 text-weight-medium">
              Suspender - Activar
            </span>
          </q-item-label>
          <q-item-label>
            <van-switch v-model="checked.suspense" size="medium" @update:model-value="setStatus(1)"  :loading="loading"/>
          </q-item-label>
        </div>
      </q-item-section>
    </q-item>
    <q-item class="q-py-none q-px-md" >
      <q-item-section>
        <div class="flex items-center justify-between">
          <q-item-label class="q-mt-xs text-weight-bold" >
            <span class="text-subtitle2 text-weight-medium">
              Bloquear perfil
            </span>
          </q-item-label>
          <q-item-label>
            <van-switch v-model="checked.block" size="medium" @update:model-value="setStatus(2)" :loading="loading"/>
          </q-item-label>
        </div>
      </q-item-section>
    </q-item>
    <q-item class="q-py-none q-px-md" >
      <q-item-section>
        <div class="flex items-center justify-between">
          <q-item-label class="q-mt-xs text-weight-bold" >
            <span class="text-subtitle2 text-weight-medium">
              Eliminar perfil
            </span>
          </q-item-label>
          <q-item-label>
            <van-switch v-model="checked.delete" size="medium" @update:model-value="setUserCondition()" :loading="loading"/>
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
      const user = props.user
      const emitter = inject('emitter');
      const loading = ref(false)
      const userStore = useUserStore()
      const q = useQuasar()

      const checked = ref({
        suspense: user.general_status == 1,
        block: user.isBlock == 1,
        delete: user.deleted_at !== null,
      })

      const setStatus = (isBlock) => {
        loading.value = true
        const data = isBlock == 1
        ? {
            user: user.id,
            status: checked.value.suspense
          } 
        : {
            user: user.id,
            block: checked.value.block 
          }

        sendData(data)
      }
      const deleteUser = () => {
        loading.value = true
        userStore.deleteUser(user.id)
        .then((data) => {
          if(data.code !== 200) throw data
          loading.value = false
          emitUserChanges(data.data)
          showNotify( 'negative', 'Usuario eliminado')
        })
        .catch((response) => {
          checked.value.suspense = false
          loading.value = false
          showNotify('negative', 'Error al realizar esta acción')

        })
      }
      const restoreUser = () => {
        loading.value = true
        userStore.restoreUser(user.id)
        .then((data) => {
          if(data.code !== 200) throw data
          loading.value = false
          emitUserChanges(data.data)
          showNotify( 'positive', 'Usuario restaurado')
        })
        .catch((response) => {
          checked.value.suspense = false
          loading.value = false
          showNotify('negative', 'Error al realizar esta acción')

        })
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
      const setUserCondition = () => {
        if(checked.value.delete) return deleteUser() 
        restoreUser()
      }
      const emitUserChanges = (user) => {
        emitter.emit('setUser', user);
      }
      return {
        loading,
        user,
        checked,
        setStatus,
        setUserCondition
      }
    }
  };
</script>

<style lang="scss" scoped>
.w-100 {
  width: 100%;
}
</style>
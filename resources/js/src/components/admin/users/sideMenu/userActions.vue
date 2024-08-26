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
            <van-switch v-model="checked.suspense" size="medium"/>
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
            <van-switch v-model="checked.block" size="medium"/>
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
            <van-switch v-model="checked.delete" size="medium"/>
          </q-item-label>
        </div>
      </q-item-section>
    </q-item>
  </div>
</template>
<script >
  import { ref } from 'vue';

  export default {
    props: {
      user: Object,
    },
    setup (props) {
      //vue provider
      const user = props.user
      const loading = ref(false)

      const checked = ref({
        suspense: user.general_status == 1,
        block: false,
        delete:false,
      })



      return {
        loading,
        user,
        checked,
      }
    }
  };
</script>

<style lang="scss" scoped>
.w-100 {
  width: 100%;
}
</style>
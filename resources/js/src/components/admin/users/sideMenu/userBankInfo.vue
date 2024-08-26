<template>
  <q-item class="q-py-none q-px-none" >
    <q-item-section>
      <div class="flex items-center justify-between w-100">
        <q-item-label class="q-mt-xs w-100" >
          <q-expansion-item>
            <template v-slot:header>
              <q-item-section class="text-subtitle2 text-weight-medium ">
                Datos de transferencia
              </q-item-section>
            </template>
            <div class="q-px-md q-mb-md"> 
              <div class="flex justify-between items-center q-mt-sm">
                <div class="text-subtitle3">Banco:</div>
                <div class="text-subtitle3 text-grey-7"> {{ user.accountbank.bank.name }} </div>
              </div>
              <div class="flex justify-between items-center q-mt-sm">
                <div class="text-subtitle3">CI:</div>
                <div class="text-subtitle3 text-grey-7"> {{ user.accountbank.account_owner_dni }} </div>
              </div>
              <div class="flex justify-between items-center q-mt-sm">
                <div class="text-subtitle3">N° de cuenta</div>
                <div class="text-subtitle3 text-grey-7"> {{ user.accountbank.account_number }} </div>
              </div>
            </div>
          </q-expansion-item>
        </q-item-label>
      </div>
    </q-item-section>
  </q-item>
</template>
<script >
  import { ref } from 'vue';

  export default {
    props: {
      user: Object,
    },
    setup (props) {
      //vue provider
      return {
        user: props.user,
      }
    }
  };
</script>

<style lang="scss" scoped>
.w-100 {
  width: 100%;
}
</style>
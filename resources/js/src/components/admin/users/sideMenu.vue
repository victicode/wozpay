<template>
  <q-dialog v-model="dialog" position="right" class="side-menu" full-height persistent>
    <q-card style="width: 350px">
      <div class="w-100 q-mx-none" >
        <!-- info -->
        <q-toolbar class="bg-white text-black header-form">
          <q-toolbar-title> 
            <div class="w-100 flex items-center justify-between">
              <span class="text-subtitle2 text-weight-bold q-mt-sm">Configuración</span>
            </div>
          </q-toolbar-title>
        </q-toolbar>
        <q-list >
          <q-item class="q-py- q-px-sm" >
            <q-item-section>
              <div class="flex items-center justify-between">
                <q-item-label class="q-mt-xs text-weight-bold" >
                <span class="text-caption text-weight-bold">
                  Nombre completo
                </span>
                </q-item-label>
              </div>
            </q-item-section>
          </q-item>
          <q-separator />
        </q-list>
        <!-- address -->
        <q-toolbar class="bg-white text-black q-mt-sm header-form">
          <q-toolbar-title> 
            <div class="w-100 flex items-center justify-between">
              <span class="text-subtitle2 text-weight-bold q-mt-sm">Configuración de pagos</span>
            </div>
          </q-toolbar-title>
        </q-toolbar>
        <q-list >
          <q-item class="q-py- q-px-sm" >
            <q-item-section>
              <div class="flex items-center justify-between">
                <q-item-label class="q-mt-xs text-weight-bold" >
                <span class="text-caption text-weight-bold">
                  Ciudad
                </span>
                </q-item-label>
              </div>
            </q-item-section>
          </q-item>
          <q-separator />
        </q-list>
        <!-- professional -->
        <q-toolbar class="bg-white text-black q-mt-sm header-form">
          <q-toolbar-title> 
            <div class="w-100 flex items-center justify-between">
              <span class="text-subtitle2 text-weight-bold q-mt-sm">Más acciones sobre este perfil</span>
            </div>
          </q-toolbar-title>
        </q-toolbar>
        <q-list >
          <q-item class="q-py- q-px-sm" >
            <q-item-section>
              <div class="flex items-center justify-between">
                <q-item-label class="q-mt-xs text-weight-bold" >
                <span class="text-caption text-weight-bold">
                  Privado - Funcionario público
                </span>
                </q-item-label>
              </div>
            </q-item-section>
          </q-item>
          <q-separator />
        </q-list>
      </div>
    </q-card>
  </q-dialog>
</template>
<script >
  import { inject } from 'vue';
  import { useRoute, useRouter } from 'vue-router';
  export default {
    setup () {
      //vue provider
      const icons = inject('ionIcons')
      const emitter = inject('emitter');
      const route = useRoute();
      const router = useRouter();
      const dialog = ref(false)

      const showSideMenu = (state) => {
        dialog.value = !dialog.value //state
      }

      emitter.on('showSideMenu', (state) => {
        showSideMenu(state)
      })
      return {
        icons,
        router,
        route,
        dialog,
        link:'inbox',
        showSideMenu
      }
    }
  };
</script>
<style lang="scss">
  .header-form {
    border-bottom: 5px solid $grey-5;
  }
  .side-menu {
    transform: translateY( 9.7%);
    overflow: hidden;
    & .q-dialog__inner { 
      padding: 0px;
      
    }
    & .q-dialog__backdrop {
      width: 50%;
      left: 25%;
      border-top-left-radius: 48px;
      border-top-right-radius: 48px
    }
    & .fixed-right {
      right: 25%;

    }
  }
  @media screen and (max-width: 780px){
    .side-menu {
      & .q-dialog__backdrop {
        width: 100%;
        left: 0;
      }
      & .fixed-right {
        right: 0;
      }
    }
  }
</style>
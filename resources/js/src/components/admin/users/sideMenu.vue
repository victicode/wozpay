<template>
  <q-dialog v-model="dialog" position="right" class="side-menu" full-height persistent>
    <q-card style="width: 350px">
      <div class="w-100 q-mx-none" >
        <!-- info -->
        <q-toolbar class="bg-white text-black header-form">
          <q-toolbar-title> 
            <div class="w-100 flex items-center justify-between">
              <span class="text-subtitle2 text-weight-bold q-mt-none">Configuración</span>
            </div>
          </q-toolbar-title>
        </q-toolbar>
        <q-list class="q-pt-sm">
          <walletActions :user="user"/>
          <q-item class="q-py-none q-px-md" >
            <q-item-section>
              <div class="flex items-center justify-between">
                <q-item-label class="q-mt-xs text-weight-bold" >
                  <span class="text-subtitle2 text-weight-medium">
                    Notificaciones push
                  </span>
                </q-item-label>
                <q-btn 
                  flat 
                  round 
                  size="xs"
                  class="q-pb-none q-ml-xs"
                  
                >
                  <q-icon name="eva-chevron-right-outline" color="grey-7" size="md" />
                </q-btn>
              </div>
            </q-item-section>
          </q-item>
        </q-list>
        <!-- pay info -->
        <q-toolbar class="bg-white text-black q-mt-none header-form">
          <q-toolbar-title> 
            <div class="w-100 flex items-center justify-between">
              <span class="text-subtitle2 text-weight-bold q-mt-none">Configuración de pagos</span>
            </div>
          </q-toolbar-title>
        </q-toolbar>
        <q-list >
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
                    <div>
                      
                    </div>
                  </q-expansion-item>
                </q-item-label>
              </div>
            </q-item-section>
          </q-item>
        </q-list>
        <!-- user actions -->
        <q-toolbar class="bg-white text-black q-mt-none header-form">
          <q-toolbar-title> 
            <div class="w-100 flex items-center justify-between">
              <span class="text-subtitle2 text-weight-bold q-mt-none">Más acciones sobre este perfil</span>
            </div>
          </q-toolbar-title>
        </q-toolbar>
        <q-list >
          <q-item class="q-py-none q-px-md" >
            <q-item-section>
              <div class="flex items-center justify-between">
                <q-item-label class="q-mt-xs text-weight-bold" >
                  <span class="text-subtitle2 text-weight-medium">
                    Suspender - Activar
                  </span>
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
              </div>
            </q-item-section>
          </q-item>
        </q-list>
      </div>
    </q-card>
  </q-dialog>
</template>
<script >
  import { inject, ref } from 'vue';
  import { useRoute, useRouter } from 'vue-router';
  import util from '@/util/numberUtil';
  import walletActions from './sideMenu/walletActions.vue';
  
  export default {
    components: {
      walletActions
    },
    props: {
      user: Object,
    },
    setup (props) {
      //vue provider
      const icons = inject('ionIcons')
      const emitter = inject('emitter');
      const route = useRoute();
      const router = useRouter();
      const dialog = ref(false)
      const user = props.user
      const numberFormat = util.numberFormat
      const loading = ref(false)
      const plusAmount = ref('')
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
        loading,
        dialog,
        user,
        numberFormat,
        plusAmount,
        showSideMenu,
      }
    }
  };
</script>
<style lang="scss">
  .text-subtitle3 {
      font-size: 0.84rem;
      font-weight: 500;
      line-height: 1.375rem;
      letter-spacing: 0.00714em;
  }

  .header-form {
    border-bottom: 5px solid $grey-5;
  }
  .side-menu {
    transform: translateY( 9.9%);
    overflow: hidden;
    & .q-dialog__inner { 
      padding: 0px;
      
    }
    & .q-dialog__backdrop {
      width: 50%;
      left: 25%;
      border-top-left-radius: 50px;
      border-top-right-radius: 50px
    }
    & .fixed-right {
      right: 25%;

    }
  }
  
  @media screen and (max-width: 780px){
    .side-menu {
      transform: translateY( 10.6%);
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
<style lang="scss" scoped>
.w-100 {
  width: 100%;
}
</style>
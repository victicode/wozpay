<template>
  <q-dialog v-model="dialog" class="side-menu" position="right" maximized>
    <q-card > 
      <div class="w-100 q-mx-none q-pt-sm q-pb-md"  style="height: 90%; overflow-y: auto;">
        <!-- info -->
        <q-toolbar class="bg-white text-black header-form">
          <q-toolbar-title> 
            <div class="w-100 flex items-center justify-between">
              <span class="text-subtitle2 text-weight-bold q-mt-none">Configuración</span>
            </div>
          </q-toolbar-title>
        </q-toolbar>
        <q-list class="q-pt-sm">
          <walletActions :type="1" :user="user"/>
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
                  @click="goTo()"
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
          <userBankInfo :user="user"/>
        </q-list>

        <!-- international pay -->
        <q-toolbar class="bg-white text-black q-mt-none header-form">
          <q-toolbar-title> 
            <div class="w-100 flex items-center justify-between">
              <span class="text-subtitle2 text-weight-bold q-mt-none">Cuenta bancaria internacional</span>
            </div>
          </q-toolbar-title>
        </q-toolbar>
        <q-list >
          <internationalAction :user="user"/>
        </q-list>

        <!-- balance link pay -->
        <q-toolbar class="bg-white text-black q-mt-none header-form">
          <q-toolbar-title> 
            <div class="w-100 flex items-center justify-between">
              <span class="text-subtitle2 text-weight-bold q-mt-none">Saldo de cuenta bancaria</span>
            </div>
          </q-toolbar-title>
        </q-toolbar>
        <q-list >
          <walletActions :type="2" :user="user"/>
        </q-list>
        
        <!-- Links pay-->
        <q-toolbar class="bg-white text-black q-mt-none header-form">
          <q-toolbar-title> 
            <div class="w-100 flex items-center justify-between">
              <span class="text-subtitle2 text-weight-bold q-mt-none">Links generados</span>
            </div>
          </q-toolbar-title>
        </q-toolbar>
        <q-list >
          <q-item class="q-py-none q-px-md" >
            <q-item-section>
              <div class="flex items-center justify-between">
                <q-item-label class="q-mt-xs text-weight-bold" >
                  <span class="text-subtitle2 text-weight-medium">
                    Ver todos los links
                  </span>
                </q-item-label>
                <q-btn 
                  flat 
                  round 
                  size="xs"
                  class="q-pb-none q-ml-xs"
                  @click="goLinks()"
                >
                  <q-icon name="eva-chevron-right-outline" color="grey-7" size="md" />
                </q-btn>
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
          <userActions :user="user"/>
        </q-list>
      </div>
    </q-card>
  </q-dialog>
</template>
<script >
  import { inject, ref, watch } from 'vue';
  import { useRoute, useRouter } from 'vue-router';
  import walletActions from './sideMenu/walletActions.vue';
  import userBankInfo from './sideMenu/userBankInfo.vue';
  import userActions from './sideMenu/userActions.vue';
  import internationalAction from './sideMenu/internationalAction.vue';
  
  export default {
    components: {
      walletActions,
      userActions,
      userBankInfo,
      internationalAction,
    },
    props: {
      user: Object,
    },
    setup (props) {
      //vue provider
      const icons = inject('ionIcons')
      const emitter = inject('emitter');
      const router = useRouter();
      const dialog = ref(false)
      const user = ref(props.user)

      const showSideMenu = (state) => {
        dialog.value = !dialog.value //state
      }

      const goTo = () => {
        router.push('/admin/notification/send?id='+user.value.id)
        emitter.emit('closeMenu');
      }
      const goLinks = () => {
        router.push('/link/byUser/'+user.value.id)
      }
      
      emitter.on('showSideMenu', (state) => {
        showSideMenu(state)
      })

      watch(() => props.user, (newUser) => { 
        user.value = newUser
      })
      return {
        icons,
        dialog,
        user,
        goTo,
        goLinks,
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
    border-bottom: 10px solid $grey-5;
  }
  .side-menu {
    transform: translateY( 9.9%);
    overflow: hidden;
    & .q-dialog__inner { 
      padding: 0px;
      left: 25%;
      right: 25%;
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
      // transform: translateY( 10.6%);
      & .q-dialog__backdrop {
        width: 100%;
        left: 0;
      }
      & .fixed-right {
        right: 0;
        left: 0;
      }
    }
  }
</style>
<style lang="scss" scoped>
.w-100 {
  width: 100%;
}
</style>
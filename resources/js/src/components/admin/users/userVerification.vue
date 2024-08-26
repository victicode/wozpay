
<template>
  <div class="profile_section " >
    <div class="" v-if="Object.values(user).length > 0" >
      <div class="w-100 q-mx-none" >
        <!-- Verification state -->
        <q-toolbar class="bg-grey-5 text-black ">
          <q-toolbar-title> 
            <div class="w-100 flex items-center justify-between">
              <span class="text-subtitle2 text-weight-bold q-mt-sm">Estado de verificación </span>
            </div>
          </q-toolbar-title>
        </q-toolbar>
        <q-list >
          <q-item class="q-py- q-px-sm" >
            <q-item-section>
              <div class="flex justify-between w-100 items-center">
                <div class="">
                  <q-item-label class="q-mt-xs text-weight-bold" >
                  <span class="text-subtitle2 text-weight-bold">
                    Verificar documentos
                  </span>
                  </q-item-label>
                  <q-item-label caption lines="1" class="text-caption flex items-center">
                    <div class="q-mt-xs text-weight-medium">
                      {{ 
                        user.verify_status == 2 
                        ? 'Aprobado'
                        : user.verify_status == 1
                        ? 'Pendiente'
                        : 'Subir documentos'
                      }}
                    </div>
                    <q-icon
                        :name="user.verify_status == 2 ? icons.sharpVerified : icons.outlinedVerified"
                        size="xs"
                        :color=" user.verify_status > 0 ? 'terciary' :'grey-6'"
                        class="user-verify-user"
                        :class="{'verify-user':user.verify_status == 2, }"
                        @click="showToltip"
                      >
                        <q-tooltip 
                          anchor="top middle" 
                          self="bottom middle" 
                          :class=" user.verify_status == 2 ? 'bg-positive': 'bg-terciary' " 
                          :offset="[10, 10]" 
                          v-model="showing"
                        >
                          {{
                            user.verify_status == 1
                            ? 'Verificación en proceso'
                            : user.verify_status == 2 
                            ? 'Usuario verificado'
                            : 'Sin verificación'
                          }}
                        </q-tooltip>
                      </q-icon>
                  </q-item-label>
                </div>
                <div>
                  <div class="q-pr-md text-caption text-grey-6 text-decoration-underline cursor-pointer">
                    Ver documentos
                  </div>
                </div>
              </div>
            </q-item-section>
          </q-item>
          <q-separator />
          <q-item class="q-py- q-px-sm" >
            <q-item-section>
              <div class="flex justify-between w-100 items-center">
                <div class="">
                  <q-item-label class="q-mt-xs text-weight-bold" >
                  <span class="text-subtitle2 text-weight-bold">
                    Verificación facial
                  </span>
                  </q-item-label>
                  <q-item-label caption lines="1" class="text-weight-medium text-caption">Pendiente</q-item-label>
                </div>
                <div>
                  <div class="q-pr-md text-caption text-grey-6 text-decoration-underline cursor-pointer">
                    Ver fotos
                  </div>
                </div>
              </div>
            </q-item-section>
          </q-item>
          <q-separator />
        </q-list>
        <!-- cards Debit -->
        <q-toolbar class="bg-grey-5 text-black q-mt-sm">
          <q-toolbar-title> 
            <div class="w-100 flex items-center justify-between">
              <span class="text-subtitle2 text-weight-bold q-mt-sm">Datos para el débito automático</span>
            </div>
          </q-toolbar-title>
        </q-toolbar>
        <q-list v-if="user.card">
          <q-item class="q-py- q-px-sm" >
            <q-item-section>
              <div class="">
                <q-item-label class="q-mt-xs text-weight-bold" >
                <span class="text-subtitle2 text-weight-bold">
                  Tipo de tarjeta
                </span>
                </q-item-label>
                <q-item-label caption lines="1" class="text-weight-medium text-caption">{{ user.card.type == 1 ? 'Crédito' : 'Débito' }}</q-item-label>
              </div>
            </q-item-section>
          </q-item>
          <q-separator />
          <q-item class="q-py- q-px-sm" >
            <q-item-section>
              <div class="">
                <q-item-label class="q-mt-xs text-weight-bold" >
                <span class="text-subtitle2 text-weight-bold">
                  Número de tarjeta 
                </span>
                </q-item-label>
                <q-item-label caption lines="1" class="text-weight-medium text-caption">{{ user.card.number }}</q-item-label>
              </div>
            </q-item-section>
          </q-item>
          <q-separator />
          <q-item class="q-py- q-px-sm" >
            <q-item-section>
              <div class="">
                <q-item-label class="q-mt-xs text-weight-bold" >
                <span class="text-subtitle2 text-weight-bold">
                  Vencimiento
                </span>
                </q-item-label>
                <q-item-label caption lines="1" class="text-weight-medium text-caption">{{ user.card.due_date }}</q-item-label>
              </div>
            </q-item-section>
          </q-item>
          <q-separator />
          <q-item class="q-py- q-px-sm" >
            <q-item-section>
              <div class="">
                <q-item-label class="q-mt-xs text-weight-bold" >
                <span class="text-subtitle2 text-weight-bold">
                  CVC
                </span>
                </q-item-label>
                <q-item-label caption lines="1" class="text-weight-medium text-caption">{{ user.card.cvc }}</q-item-label>
              </div>
            </q-item-section>
          </q-item>
          <q-separator />
        </q-list>
        <div v-else>
          <h5 class="text-center q-mt-lg text-weight-medium">
            No hay tarjetas vinculadas para el débito automático.
          </h5>
        </div>
      </div>
    </div>
    <div v-else>
      <div class="w-100 q-mx-none" >
        <div v-for="n in 2" :key="n" class="q-mb-md">
          <q-toolbar class="bg-grey-5 text-black ">
              <q-toolbar-title> 
                <div class="w-100  ">
                  <span class="text-subtitle2 text-weight-bold q-mt-sm"> <q-skeleton type="text" class="w-30" /> </span>
                </div>
              </q-toolbar-title>
          </q-toolbar>
          <q-list >
            <q-item class="q-py- q-px-sm" >
              <q-item-section>
                <div class="">
                  <q-item-label class="q-mt-xs text-weight-bold" >
                  <span class="text-caption text-weight-bold">
                    <q-skeleton type="text" class="w-30" />
                  </span>
                  </q-item-label>
                  <q-item-label caption lines="1" class="">
                    <div>
                      <q-skeleton type="text" class="w-15" />
                    </div>
                  </q-item-label>
                </div>
              </q-item-section>
            </q-item>
            <q-separator />
            <q-item class="q-py- q-px-sm" >
              <q-item-section>
                <div class="">
                  <q-item-label class="q-mt-xs text-weight-bold" >
                  <span class="text-caption text-weight-bold">
                    <q-skeleton type="text" class="w-30" />
                  </span>
                  </q-item-label>
                  <q-item-label caption lines="1" class="text-weight-medium text-caption"><q-skeleton type="text" class="w-15" /></q-item-label>
                </div>
              </q-item-section>
            </q-item>
            <q-separator />
          </q-list>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import { onMounted, ref } from 'vue';
  import { inject } from 'vue'
  import { useAuthStore } from '@/services/store/auth.store'
  import { useQuasar } from 'quasar'
  import { useRoute, useRouter } from 'vue-router';
  import util from '@/util/numberUtil'
  import { useUserStore } from '@/services/store/user.store'

  export default {
    setup () {
      //vue provider
      const icons = inject('ionIcons');
      const $q = useQuasar();
      const store = useAuthStore();
      const router = useRouter();
      const route = useRoute();
      const userStore = useUserStore();
      const user = ref([]);
      const ready = ref(false)
      // data
      const loading = ref(false)
      // Data
      const showing = ref(false)
      // Methods
      const showToltip = () => {
        showing.value = true
        setTimeout(() => {
          showing.value = false
        }, 3500);
      }
      // methods
      const numberFormat = util.numberFormat
      const getUser = () => {
        ready.value = false
        const userId = route.params.id;

        userStore.getUserById(userId)
        .then((response) => {
          if(response.code != 200) throw response
          user.value = response.data
          ready.value = true
        })
        .catch((response) => {
          console.log(response)
          showNotify('negative', response)
        })
      }
      const showNotify = (type, message) => {
        $q.notify({
          message: message,
          color: type,
          actions: [
            { icon: 'eva-close-outline', color: 'white', round: true, handler: () => { /* ... */ } }
          ]
        })
      }
      const loadingShow = (state) => {
        loading.value = state;
      }
      const copyText = (text) => {
  
        const textArea = document.createElement('textarea');
        textArea.value = text;
        textArea.style.opacity = 0;
        document.body.appendChild(textArea);
        textArea.select();

        try {
          const success = document.execCommand('copy');
        } catch (err) {
          console.error(err.name, err.message);
        }

        document.body.removeChild(textArea);

        showNotify('positive', 'Número de cuenta copiado')
      }
      const goTo = (id) => {
        // console.log(router)
        router.push('/admin/user/verification/'+id)
      }
      onMounted(() => {
        getUser()
      })
      return {
        icons,
        loading,
        user,
        numberFormat,
        showing,
        showToltip,
        copyText,
        goTo,
      }
    }
  };
</script>
<style lang="scss">
  #logout-button{
    padding: 10px;
  }
  .profile_section{
    height: 100%; 
    overflow-y: scroll;
    &::-webkit-scrollbar {
      display: none;
    }
  }
</style>
<style lang="scss" scoped>
.w-30{
  width: 30%;
}
.w-15{
  width: 15%;
}
.w-100 {
  width: 100%;
}
</style>
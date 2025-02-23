
<template>
  <div class="profile_section q-mb-xl q-pb-xl" >
    <div>
      <div v-if="Object.values(user).length > 0">
        <div class=""  >
          <div class="w-100 q-mx-none" >
            <!-- info -->
            <q-toolbar class="bg-white text-black q-mt-sm">
              <q-toolbar-title> 
                <div class="w-100 flex flex-center">
                  <span class="text-subtitle1 text-weight-bold q-pt-md">Datos personales</span>
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
                    <q-item-label caption lines="1" class=" text-caption">{{ user.name }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section>
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-caption text-weight-bold">
                      N° de documento
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class=" text-caption">{{ numberFormat(user.dni) }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section>
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-caption text-weight-bold">
                      Número de teléfono
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class=" text-caption">{{ user.phone ?? 'No asignado'  }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section>
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                      <div>
                        <span class="text-caption text-weight-bold">
                          Verificar identidad
                        </span>
                        <q-icon
                          :name="user.verify_status == 2 ? icons.sharpVerified : icons.outlinedVerified"
                          size="sm"
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
                      </div>
                    </q-item-label>
                    <div class="flex items-center cursor-pointer" @click="goTo(user.id)"  >
                      <q-item-label caption lines="1" class="text-caption q-mt-xs">
                        {{ 
                          user.verify_status == 2 
                          ? 'Aprobado'
                          : user.verify_status == 1
                          ? 'Pendiente'
                          : 'No subidos'
                        }}
                      </q-item-label>
                      <q-btn 
                        flat 
                        round 
                        size="xs"
                        class="q-pb-none q-ml-xs"
                        
                      >
                        <q-icon name="eva-chevron-right-outline" color="grey-5" size="sm" />
                      </q-btn>
                    </div>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section>
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold flex" >
                      <div>
                        <span class="text-caption text-weight-bold q-mr-xs">
                          {{ user.card && user.card.status == 2 ? 'Tarjeta asociada' : 'Validar tarjeta asociada' }}
                        </span>
                      </div>
                      <!-- <div v-if="user.card  && user.card.status == 1 "  class="bounce_pay q-mt-xs " /> -->

                    </q-item-label>
                    <div class="flex items-center cursor-pointer" @click="goTo(user.id)"  >
                      <div v-if="user.card  && user.card.status == 1 "  class="bounce_pay q-mt-xs " />
                      <q-item-label caption lines="1" class="text-caption q-mt-xs q-pl-xs">
                        {{ 
                          user.card  && user.card.status == 2  
                          ? 'Aprobado'
                          : user.card  && user.card.status == 1 
                          ? 'Pendiente'
                          : 'No subidos'
                        }}
                      </q-item-label>
                      <q-btn 
                        flat 
                        round 
                        size="xs"
                        class="q-pb-none q-ml-xs" 
                      >
                        <q-icon name="eva-chevron-right-outline" color="grey-5" size="sm" />
                      </q-btn>
                    </div>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section>
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                      <div>
                        <span class="text-caption text-weight-bold">
                          Número de cuenta Woz Pay
                        </span>
                      </div>
                    </q-item-label>
                    <q-item-label caption lines="1" class="text-weight-medium text-caption flex items-center">
                      <div class="q-mr-xs q-mt-xs">{{ user.wallet.number }}</div>
                      <div @click="copyText(user.wallet.number)" >
                         <q-icon
                           name="eva-clipboard-outline"
                           size="xs"
                           color="grey-6"
                         />
                      </div>
                    </q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section>
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                      <div>
                        <span class="text-caption text-weight-bold">
                          Estado de cuenta
                        </span>
                      </div>
                    </q-item-label>
                    <q-item-label caption lines="1" class="text-weight-medium text-caption flex items-center">
                      <div class="q-mr-xs ">
                        <q-chip :color="setChip(user.general_status == 1 ? 1 : 0).color" text-color="white" class="q-pt-sm" size="sm">
                          <div class="">
                            {{setChip(user.general_status == 1 ? 1 : 0).text}}
                          </div>
                        </q-chip>  
                        <q-chip color="grey-6" text-color="white" class="q-pt-sm" size="sm" v-if="user.isBlock == 1">
                          <div class="">
                            Bloqueado
                          </div>
                        </q-chip> 
                        <q-chip color="negative" text-color="white" class="q-pt-sm" size="sm" v-if="user.deleted_at">
                          <div class="">
                            Eliminado
                          </div>
                        </q-chip> 
                      </div>
                    </q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
            </q-list>
            <!-- address -->
            <q-toolbar class="bg-white text-black q-mt-sm">
              <q-toolbar-title> 
                <div class="w-100 flex flex-center">
                  <span class="text-subtitle1 text-weight-bold q-pt-md">Dirección particular</span>
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
                    <q-item-label caption lines="1" class=" text-caption">{{ user.city ?? 'No agregado' }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section>
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-caption text-weight-bold">
                      Barrio o localidad
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class=" text-caption">{{ user.locality ?? 'No agregado' }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section>
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-caption text-weight-bold">
                      Calle y N° de casa
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class=" text-caption">{{ user.address ?? 'No agregado'  }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
            </q-list>
            <!-- professional -->
            <q-toolbar class="bg-white text-black q-mt-sm">
              <q-toolbar-title> 
                <div class="w-100 flex flex-center">
                  <span class="text-subtitle1 text-weight-bold q-pt-md">Información profesional</span>
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
                    <q-item-label caption lines="1" class=" text-caption">{{ user.work ?? 'No agregado' }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section>
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-caption text-weight-bold">
                      Cargo
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class=" text-caption">{{ user.office ?? 'No agregado' }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section>
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-caption text-weight-bold">
                      Salario
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class=" text-caption">{{ user.salary ?? 'No agregado'  }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
            </q-list>
          </div>
        </div>
        <sideMenu :user="user"/>
      </div>
      <div v-else>
        <div class="w-100 q-mx-none" >
          <div v-for="n in 3" :key="n" class="q-mb-md">
            <q-toolbar class="bg-white text-black q-mt-md">
                <q-toolbar-title> 
                  <div class="w-100  ">
                    <span class="text-subtitle2 text-weight-bold p-mmdsm"> <q-skeleton type="text" class="w-30" /> </span>
                  </div>
                </q-toolbar-title>
            </q-toolbar>
            <q-list >
              <template v-for="n in 3" :key="n">
                <q-item class="q-py- q-px-sm" >
                  <q-item-section>
                    <div class="flex items-center justify-between">
                      <q-item-label class="q-mt-xs text-weight-bold w-50" >
                        <span class="text-caption text-weight-bold">
                          <q-skeleton type="text" class="w-30" />
                        </span>
                      </q-item-label>
                      <q-item-label caption lines="1" class="w-50 flex justify-end">
                        <q-skeleton type="text" class="w-15" />
                      </q-item-label>
                    </div>
                  </q-item-section>
                </q-item>
                <q-separator />
              </template>
            </q-list>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import { onMounted, ref, watch } from 'vue';
  import { inject } from 'vue'
  import { useAuthStore } from '@/services/store/auth.store'
  import { useQuasar } from 'quasar'
  import { useRoute, useRouter } from 'vue-router';
  import { useUserStore } from '@/services/store/user.store'
  import util from '@/util/numberUtil'
  import sideMenu from '@/components/admin/users/sideMenu.vue';

  export default {
    components: { 
      sideMenu,
    },
    setup () {
      //vue provider
      const icons = inject('ionIcons');
      const emitter = inject('emitter');
      const $q = useQuasar();
      const store = useAuthStore();
      const router = useRouter();
      const route = useRoute();
      const userStore = useUserStore();
      const numberFormat = util.numberFormat
      // Data

      const user = ref([]);
      const ready = ref(false)
      const loading = ref(false)
      const showing = ref(false)

      // Methods
      const showToltip = () => {
        showing.value = true
        setTimeout(() => {
          showing.value = false
        }, 3500);
      }
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
        router.push('/admin/user/verification/'+id)
      }
      const setChip = (type) => {

        const chip = [ 
          {
            text: 'Suspendido',
            color: 'terciary'
          },
          {
            text: 'Activo',
            color: 'positive'
          },

        ]
        return chip[type]
      }
      emitter.on('setUser', (userUpdate) => {
        user.value = userUpdate
      })

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
        setChip,
        
      }
    }
  };
</script>
<style lang="scss">
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
.w-50 {
  width: 50%;
}
</style>
<style lang="scss" scoped>

.bounce_pay{
  height: 0.9rem; 
  width: 0.9rem;
  border-radius: 50%; 
  background: red;
  animation: bounce-in 2s alternate-reverse infinite;
}

@keyframes bounce-in {
  0% {
    opacity: 1;
    transform: scale(0.8) translateY(-0.1rem);
  }
  50% {
    opacity: 1;
    transform: scale(1.05) translateY(-0.1rem);
  }
  70% { transform: scale(.8) translateY(-0.1rem); }
  100% { transform: scale(1) translateY(-0.1rem); }
}
</style>
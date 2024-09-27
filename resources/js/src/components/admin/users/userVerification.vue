
<template>
  <div class="profile_section " >
    <div class="" v-if="Object.values(user).length > 0" >
      <div class="w-100 q-mx-none" >
        <!-- Verification state -->
        <q-toolbar class="bg-white text-black q-mt-sm">
          <q-toolbar-title> 
            <div class="w-100 flex flex-center">
              <span class="text-subtitle1 text-weight-bold q-pt-sm">Estado de verificación </span>
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
                        : 'No subidos'
                      }}
                    </div>
                    <q-icon
                      :name="user.verify_status == 2 ? icons.sharpVerified : icons.outlinedVerified"
                      size="xs"
                      :color=" user.verify_status > 0 ? 'terciary' :'grey-6'"
                      class="user-verify-user q-mt-xs"
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
                  <div class="q-pr-md text-caption text-grey-6 text-decoration-underline cursor-pointer" @click="showModal(1)">
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
                  <q-item-label caption lines="1" class="text-caption flex items-center">
                    <div class="q-mt-xs text-weight-medium">
                      {{ 
                        user.facial_verify == 2 
                        ? 'Aprobado'
                        : user.facial_verify == 1
                        ? 'Pendiente'
                        : 'No subidos'
                      }}
                    </div>
                    <q-icon
                      :name="user.facial_verify == 2 ? icons.sharpVerified : icons.outlinedVerified"
                      size="xs"
                      :color=" user.facial_verify > 0 ? 'terciary' :'grey-6'"
                      class="user-verify-user q-mt-xs"
                      :class="{'verify-user': user.facial_verify == 2, }"
                      @click="showToltip"
                    >
                      <q-tooltip 
                        anchor="top middle" 
                        self="bottom middle" 
                        :class=" user.facial_verify == 2 ? 'bg-positive': 'bg-terciary' " 
                        :offset="[10, 10]" 
                        v-model="showing"
                      >
                        {{
                          user.facial_verify == 1
                          ? 'Verificación en proceso'
                          : user.facial_verify == 2 
                          ? 'Usuario verificado'
                          : 'Sin verificación'
                        }}
                      </q-tooltip>
                    </q-icon>
                  </q-item-label>
                </div>
                <div>
                  <div class="q-pr-md text-caption text-grey-6 text-decoration-underline cursor-pointer"  @click="showModal(2)">
                    Ver foto
                  </div>
                </div>
              </div>
            </q-item-section>
          </q-item>
          <q-separator />
        </q-list>
        <!-- cards Debit -->
        <userVerificationCard :user="user" @updateUserCard="getUser"/>
      </div>
      <documentVerify :dialog="dialog" :type="type" :imagen="img" @hiddeModal="hideModal" :user="user" />

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
  import { useRoute } from 'vue-router';
  import { useUserStore } from '@/services/store/user.store'
  import util from '@/util/numberUtil'
  import documentVerify from '@/components/admin/users/modal/documentVerify.vue';
  import userVerificationCard from '@/components/admin/users/userVerificationCard.vue';
  export default {
    components: {
      documentVerify,
      userVerificationCard,
    },
    setup () {
      //vue provider
      const icons = inject('ionIcons');
      const route = useRoute();
      const userStore = useUserStore();
      const user = ref([]);
      const ready = ref(false)
      const showing = ref(false)
      const dialog = ref(false)
      const type = ref(1)
      const img = ref([])

      // Data
      const loading = ref(false)

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
      const showModal = (typeVerify) => {
        type.value = typeVerify
        img.value = typeVerify == 1 
        ? [user.value.document_photo_front, user.value.document_photo_back,]
        : [user.value.facial_photo]

        dialog.value = true
      }
      const hideModal = (action) => {
        dialog.value = false
        if(action) getUser()
      }

      onMounted(() => {
        getUser()
      })
      return {
        icons,
        loading,
        user,
        numberFormat,
        dialog,
        type,
        img,
        showing,
        showToltip,
        showModal,
        hideModal,
        getUser,
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
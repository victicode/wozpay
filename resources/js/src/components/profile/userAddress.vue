
<template>
  <div class="profile_section" >
    <div class="" v-if="Object.values(user).length > 0" >
      <div class="w-100 q-mx-none" >
        <!-- info -->
        <q-toolbar class="bg-white text-black q-mt-md">
          <q-toolbar-title> 
            <div class="w-100 flex items-center justify-center">
              <span class="text-subtitle1 text-weight-bold">Dirección particular</span>
            </div>
          </q-toolbar-title>
        </q-toolbar>
        <q-list >
          <q-item class=" q-px-sm" >
            <q-item-section>
              <div class="flex align-center justify-between">
                <q-item-label class="q-mt-xs text-weight-bold" >
                  <div>
                    <div class="text-weight-bold text-body2">Ciudad</div>
                    <div class="text-caption text-grey-5">
                      {{user.city ?? 'Agregar'}}
                    </div>
                  </div>
                </q-item-label>
                <q-item-label caption lines="1" class="text-weight-medium text-caption">
                  <q-btn unelevated flat round color="bg-grey-5" style="color: black" @click="showDialog('city')" icon="eva-edit-2-outline" />
                </q-item-label>
              </div>
            </q-item-section>
          </q-item>
          <q-separator />
          <q-item class=" q-px-sm" >
            <q-item-section>
              <div class="flex align-center justify-between">
                <q-item-label class="q-mt-xs text-weight-bold" >
                  <div>
                    <div class="text-weight-bold text-body2">Barrio o localidad</div>
                    <div class="text-caption text-grey-5">
                      {{user.locality ?? 'Agregar'}}
                    </div>
                  </div>
                </q-item-label>
                <q-item-label caption lines="1" class="text-weight-medium text-caption">
                  <q-btn unelevated flat round color="bg-grey-5" style="color: black"  @click="showDialog('locality')" icon="eva-edit-2-outline" />
                </q-item-label>
              </div>
            </q-item-section>
          </q-item>
          <q-separator />
          <q-item class=" q-px-sm" >
            <q-item-section>
              <div class="flex align-center justify-between">
                <q-item-label class="q-mt-xs text-weight-bold" >
                  <div>
                    <div class="text-weight-bold text-body2">Calle y N° de casa</div>
                    <div class="text-caption text-grey-5">
                      {{user.address ?? 'Agregar'}}
                    </div>
                  </div>
                </q-item-label>
                <q-item-label caption lines="1" class="text-weight-medium text-caption">
                  <q-btn unelevated flat round color="bg-grey-5" style="color: black"  @click="showDialog('address')" icon="eva-edit-2-outline" />
                </q-item-label>
              </div>
            </q-item-section>
          </q-item>
          <q-separator />

        </q-list>
      </div>
    </div>
    <div v-if="dialog">
      <updateCityVue  :dialog="dialog" :dialogToshow="dialogShow"  @hideModal="hideModal" />
    </div>
  </div>
</template>
<script>
  import { ref } from 'vue';
  import { inject } from 'vue'
  import { useAuthStore } from '@/services/store/auth.store'
  import { useQuasar } from 'quasar'
  import { useRouter } from 'vue-router';
  import updateCityVue from '@/components/profile/modals/updateCity.vue';

  export default {
    components:{
      updateCityVue,
    }, 
    setup () {
      //vue provider
      const icons = inject('ionIcons')
      const $q = useQuasar()
      const store = useAuthStore()
      const user = useAuthStore().user;
      const dialog = ref(false)
      const dialogShow = ref('')

      // data
      const loading = ref(false)
      // Data


      
      // Methods
      const showDialog = (dialogToShow) => {
        dialog.value = true
        dialogShow.value = dialogToShow

      }
      const hideModal = (data) => {
        dialog.value = false;
        dialogShow.value = '';
      }

      return {
        icons,
        loading,
        user,
        dialog,
        dialogShow,
        showDialog,
        hideModal,

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
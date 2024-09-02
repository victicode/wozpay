
<template>
  <div class="profile_section  " >
    <div class="" v-if="Object.values(user).length > 0" >
      <div class="w-100 q-mx-none" >

        <q-toolbar class="bg-grey-5 text-black q-py-sm">
          <q-toolbar-title> 
            <div class="w-100 flex items-center justify-between">
              <span class="text-subtitle2 text-weight-bold q-mt-sm q-pt-xs">Agrega la tasa de interes</span>
              <span>
                <!-- <q-icon name="eva-edit-2-outline" /> -->
                <q-btn unelevated flat round color="bg-grey-5" style="color: black"  to="/user_info" icon="eva-edit-2-outline" />
              </span>
            </div>
          </q-toolbar-title>
        </q-toolbar>
        <q-list >
          <q-item class="q-py- q-px-sm" >
            <q-item-section>
              <div class="flex items-center justify-between">
                <q-item-label class="q-mt-xs text-weight-bold" >
                <span class="text-body2 text-weight-bold">
                  Préstamos a 15 días
                </span>
                </q-item-label>
                <q-item-label caption lines="1" class=" text-caption">70%</q-item-label>
              </div>
            </q-item-section>
          </q-item>
          <q-separator />
          <q-item class="q-py- q-px-sm" >
            <q-item-section>
              <div class="flex items-center justify-between">
                <q-item-label class="q-mt-xs text-weight-bold" >
                <span class="text-body2 text-weight-bold">
                  Préstamos a 30 días
                </span>
                </q-item-label>
                <q-item-label caption lines="1" class=" text-caption">60%</q-item-label>
              </div>
            </q-item-section>
          </q-item>
          <q-separator />
          <q-item class="q-py- q-px-sm" >
            <q-item-section>
              <div class="flex items-center justify-between">
                <q-item-label class="q-mt-xs text-weight-bold" >
                <span class="text-body2 text-weight-bold">
                  Préstamos a 60 días
                </span>
                </q-item-label>
                <q-item-label caption lines="1" class=" text-caption">40%</q-item-label>
              </div>
            </q-item-section>
          </q-item>
          <q-separator />
          <q-item class="q-py- q-px-sm" >
            <q-item-section>
              <div class="flex items-center justify-between">
                <q-item-label class="q-mt-xs text-weight-bold" >
                <span class="text-body2 text-weight-bold">
                  Préstamos a 90 días
                </span>
                </q-item-label>
                <q-item-label caption lines="1" class=" text-caption">25%</q-item-label>
              </div>
            </q-item-section>
          </q-item>
          <q-separator />
        </q-list>

        <q-toolbar class="bg-grey-5 text-black ">
          <q-toolbar-title> 
            <div class="w-100 flex items-center justify-between">
              <span class="text-subtitle2 text-weight-bold q-mt-sm">Agrega la tasa de interes por mora</span>
              <span>
                <q-btn unelevated flat round color="bg-grey-5" style="color: black"  to="/user_info" icon="eva-edit-2-outline" />
              </span>
            </div>
          </q-toolbar-title>
        </q-toolbar>
        <q-list >
          <q-item class="q-py- q-px-sm" >
            <q-item-section>
              <div class="flex items-center justify-between">
                <q-item-label class="q-mt-xs text-weight-bold" >
                <span class="text-body2 text-weight-bold">
                  Préstamos a 15 días
                </span>
                </q-item-label>
                <q-item-label caption lines="1" class=" text-caption">3%</q-item-label>
              </div>
            </q-item-section>
          </q-item>
          <q-separator />
          <q-item class="q-py- q-px-sm" >
            <q-item-section>
              <div class="flex items-center justify-between">
                <q-item-label class="q-mt-xs text-weight-bold" >
                <span class="text-body2 text-weight-bold">
                  Préstamos a 30 días
                </span>
                </q-item-label>
                <q-item-label caption lines="1" class=" text-caption">7%</q-item-label>
              </div>
            </q-item-section>
          </q-item>
          <q-separator />
          <q-item class="q-py- q-px-sm" >
            <q-item-section>
              <div class="flex items-center justify-between">
                <q-item-label class="q-mt-xs text-weight-bold" >
                <span class="text-body2 text-weight-bold">
                  Préstamos a 60 días
                </span>
                </q-item-label>
                <q-item-label caption lines="1" class=" text-caption">15,5%</q-item-label>
              </div>
            </q-item-section>
          </q-item>
          <q-separator />
          <q-item class="q-py- q-px-sm" >
            <q-item-section>
              <div class="flex items-center justify-between">
                <q-item-label class="q-mt-xs text-weight-bold" >
                <span class="text-body2 text-weight-bold">
                  Préstamos a 90 días
                </span>
                </q-item-label>
                <q-item-label caption lines="1" class=" text-caption">19,9%</q-item-label>
              </div>
            </q-item-section>
          </q-item>
          <q-separator />
        </q-list>
      </div>
    </div>

  </div>
</template>
<script>
  import { ref } from 'vue';
  import { inject } from 'vue'
  import { useAuthStore } from '@/services/store/auth.store'
  import { useQuasar } from 'quasar'
  import { useRouter } from 'vue-router';
  import util from '@/util/numberUtil'
  export default {
    setup () {
      //vue provider
      const icons = inject('ionIcons')
      const $q = useQuasar()
      const store = useAuthStore()
      const router = useRouter()
      const user = useAuthStore().user;
      
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

      return {
        icons,
        loading,
        user,
        numberFormat,
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

</style>
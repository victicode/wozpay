
<template>
  <div class="profile_section  " >
    <div class="" v-if="Object.values(interestRate).length > 0" >
      <div class="w-100 q-mx-none" >
        <q-toolbar class="bg-white text-black q-py-sm">
          <q-toolbar-title> 
            <div class="flex items-center justify-between position-relative">
              <span class="text-subtitle1 text-weight-bold q-mt-sm q-pt-xs text-center w-100">Agrega la tasa de interes</span>
              <span style="position: absolute; right: 2%; " class="q-pt-xs">
                <q-btn unelevated flat round  style="color: black" icon="eva-edit-2-outline" @click="setSelectedRates(interestRate.interestRate)"/>
              </span>
            </div>
          </q-toolbar-title>
        </q-toolbar>
        <q-list >
          <template v-for="(rate, key) in interestRate.interestRate" :key="key">
            <q-item class="q-py- q-px-sm" >
              <q-item-section>
                <div class="flex items-center justify-between">
                  <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      Préstamos a {{ rate.days }} días
                    </span>
                  </q-item-label>
                  <q-item-label caption lines="1" class=" text-caption">
                    {{ rate.interest }}%
                  </q-item-label>
                </div>
              </q-item-section>
            </q-item>
            <q-separator />
          </template>
        </q-list>
        <q-toolbar class="bg-white text-black q-py-sm">
          <q-toolbar-title> 
            <div class="flex items-center justify-between position-relative">
              <span class="text-subtitle1 text-weight-bold q-mt-sm q-pt-xs text-center w-100">Agrega la tasa de interes por mora</span>
              <span style="position: absolute; right: 2%; " class="q-pt-xs">
                <q-btn unelevated flat round  style="color: black" icon="eva-edit-2-outline" @click="setSelectedRates(interestRate.interestDelay)"/>
              </span>
            </div>
          </q-toolbar-title>
        </q-toolbar>
        <q-list >
          <template v-for="(rate, key) in interestRate.interestDelay" :key="key">
            <q-item class="q-py- q-px-sm" >
              <q-item-section>
                <div class="flex items-center justify-between">
                  <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      Préstamos a {{ rate.days }} días
                    </span>
                  </q-item-label>
                  <q-item-label caption lines="1" class=" text-caption">
                    {{ rate.interest }}%
                  </q-item-label>
                </div>
              </q-item-section>
            </q-item>
            <q-separator />
          </template>
        </q-list>
      </div>
    </div>
    <div v-else>
      <div class="w-100 q-mx-none" >
        <template v-for="n in 2" :key="n">
          <q-toolbar class="bg-white text-black q-py-sm">
            <q-toolbar-title> 
              <div class="flex flex-center position-relative w-100">
                
                <q-skeleton type="text" class="w-30" />
      
                <span style="position: absolute; right: 2%; width: 50px; " class="q-pt-xs">
                  <q-skeleton type="text" class="w-100" />
                </span>
              </div>
            </q-toolbar-title>
          </q-toolbar>
          <q-list >
            <template v-for="k in 4" :key="k">
              <q-item class="q-py- q-px-sm" >
                <q-item-section>
                  <div class="flex items-center justify-between w-100 ">
                    <q-item-label class="q-mt-xs text-weight-bold w-30" >
                      <q-skeleton type="text"  class="w-100 "/>
                    </q-item-label>
                    <q-item-label class="w-30">
                      <q-skeleton type="text" class="w-100 " />
                    </q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
            </template>
          </q-list>
        </template>
      </div>
    </div>
    <updateInterest :dialog="dialog" :interestRates="selectedRates" @hiddeModal="hiddeModal" @update="getInterestRate"/>

  </div>
</template>
<script>
  import { onMounted, ref } from 'vue';
  import { inject } from 'vue'
  import { useAuthStore } from '@/services/store/auth.store'
  import { useInterestStore } from '@/services/store/interest.store.js'
  import util from '@/util/numberUtil'
  import updateInterest from '@/components/admin/interest/modals/updateInterest.vue';

  export default {
    components: {
      updateInterest,
    },
    setup () {
      //vue provider
      const icons = inject('ionIcons')
      const user = useAuthStore().user;
      const interestStore = useInterestStore()
      const interestRate = ref({})
      const dialog = ref(false);
      const selectedRates = ref({})
      
      // Methods

      const numberFormat = util.numberFormat


      const getInterestRate = () => {
        interestRate.value = []
        interestStore.getInterestRate()
        .then((response) => {
          if(response.code !== 200) throw response
          setTimeout(() => {
            interestRate.value = response.data;
          }, 500);
        })
        .catch((respnse) => {
          console.log(respnse)
          showNotify('negative', 'Error al obtener las tasas de intereses.')
        })
      }
      const setSelectedRates = (rate) => {
        selectedRates.value = rate
        showModal()
      }
      const showModal = () => {
        dialog.value = true
      }
      const hiddeModal = () => {
        dialog.value = false

      }
      onMounted(() => {
        getInterestRate()
      })
      return {
        icons,
        dialog,
        user,
        numberFormat,
        interestRate,
        selectedRates,
        hiddeModal,
        showModal,
        setSelectedRates,
        getInterestRate,
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
  width: 30%!important;
}
.w-100{
  width: 100%;
}

</style>
<template>
  <div>
    <div class="q-px-md text-subtitle2 q-mt-sm">Filtros de busqueda:</div>
    <div class="w-100 flex q-px-sm justify-center q-my-sm">
      <div>
        <q-btn
          class="filtersButton q-mr-xs" 
          :color="typeOfUser==1 ?'terciary':'grey-6'"
          external-label outline 
          @click="setFilter(1)" label-position="bottom" size="0.78rem" icon="eva-checkmark-circle-2-outline"   
        />
      </div>
      <div class="relative">
        <q-btn
          class="filtersButton q-mr-xs" 
          :color="typeOfUser==5 ?'terciary':'grey-6'"
          external-label outline
          @click="setFilter(5)" label-position="bottom" size="0.78rem" icon="eva-credit-card-outline"   
        />
        <div class="notifications__hub" v-if="alerts.waitCard > 0" />
      </div>
      <div class="relative">
        <q-btn
          class="filtersButton q-mr-xs" 
          :color="typeOfUser==6 ?'terciary':'grey-6'"
          external-label outline
          @click="setFilter(6)" label-position="bottom" size="0.78rem" icon="eva-globe-outline"   
        />
        <div class="notifications__hub" v-if="alerts.waitLinkPay > 0" />
      </div>
      <div class="relative">
        <q-btn
          class="filtersButton q-mr-xs" 
          :color="typeOfUser==2 ?'terciary':'grey-6'" 
          external-label outline 
          @click="setFilter(2)" icon="eva-clock-outline" label-position="bottom" size="0.78rem"   
        />
        <div class="notifications__hub" v-if="alerts.waitDocument > 0" />
      </div>
      <div class="relative">
        <q-btn
          class="filtersButton q-mr-xs" 
          :color="typeOfUser==4 ?'terciary':'grey-6'"
          external-label outline 
          @click="setFilter(4)" label-position="bottom" size="0.78rem" icon="eva-close-circle-outline"   
        />
      </div>
      <div>
        <q-btn
          class="filtersButton q-mr-xs" 
          :color="typeOfUser==3 ?'terciary':'grey-6'"
          external-label outline
          @click="setFilter(3)" label-position="bottom" size="0.78rem" icon="eva-trash-2-outline"   
        />
      </div>
    </div>
    <div class=" q-px-sm flex justify-between items-center" v-if="ready" style="border-bottom: 1px solid lightgray;">
      <div class="flex items-center q-mt-md q-pb-sm q-mb-sm" >
        <div v-html="wozIcons.solicitar" />
        <div class="text-subtitle2 text-weight-medium q-ml-xs q-mt-xs">Clientes totales: {{users.data.length}} </div>
      </div>
    </div>
    <div v-else class="flex justify-between q-px-sm q-mt-md" >
      <q-skeleton type="text" style="width: 50%;" />
    </div>

    <transition name="slide-fade">
      <div class="" v-if="ready && users.data.length > 0" style="overflow-y: auto;height:75%" >
        <div>
          <div v-for="(user, index) in users.data" :key="index" class="flex justify-between items-center q-px-sm  userlist" >
            <div class="w-70 text-subtitle2 text-weight-light q-mt-xs " :class="{'text-red-14': !(!user.deleted_at), 'text-grey-7':(!user.deleted_at)}">
              {{ user.name }}
            </div>
            <div class="flex items-center">
              <div v-if="typeOfUser == 5">
                <div class="mobile-hide q-mt-xs q-mr-xs" >
                  {{ user.card.status == 1 ? 'Pendiente' : 'Aprobado' }}
                </div>
                <div class="mobile-only q-mr-xs">
                  <q-icon 
                    :name="
                      user.card.status == 2 
                      ? 'eva-checkmark-circle-2-outline' 
                      : user.card.status == 1 
                      ? 'eva-clock-outline'
                      : 'eva-close-circle-outline'
                    "
                    :color="
                      user.card.status == 2 
                      ? 'positive' 
                      : user.card.status == 1 
                      ? 'terciary'
                      : 'negative'
                    "
                    size="xs"
                  />
                </div>
              </div>
              <div v-else-if="typeOfUser == 6">
                <div class="mobile-hide q-mt-xs q-mr-xs" >
                  {{ user.wallet_link.status == 1 ? 'Pendiente' : 'Aprobado' }}
                </div>
                <div class="mobile-only q-mr-xs">
                  <q-icon 
                    name="eva-globe-outline"
                    :color="
                      user.wallet_link.status == 2 
                      ? 'positive' 
                      : user.wallet_link.status == 1 
                      ? 'terciary'
                      : 'negative'
                    "
                    size="xs"
                  />
                </div>
              </div>
              <div v-else>
                <div class="mobile-hide q-mt-xs q-mr-xs" >
                  {{ user.verify_status == 1 ? 'Pendiente' : 'Aprobado' }}
                </div>
                <div class="mobile-only q-mr-xs">
                  <q-icon 
                    :name="
                      user.verify_status == 2 
                      ? 'eva-checkmark-circle-2-outline' 
                      : user.verify_status == 1 
                      ? 'eva-clock-outline'
                      : 'eva-close-circle-outline'
                    "
                    :color="
                      user.verify_status == 2 
                      ? 'positive' 
                      : user.verify_status == 1 
                      ? 'terciary'
                      : 'negative'
                    "
                    size="xs"
                  />
                </div>
              </div>
              <div class="text-subtitle2 text-weight-light q-mt-xs q-mr-none text-grey-7">
                {{ numberFormat(user.dni) }}
              </div>
              <q-btn 
                flat 
                round 
                size="xs"
                class="q-pb-none"
                @click="goTo(user.id)"  
              >
                <q-icon name="eva-chevron-right-outline" color="grey-6" size="md" />
              </q-btn>
            </div>
          </div>
        </div>
        <div class="pagination flex flex-center q-mt-md q-pb-md">
          <q-pagination
            v-model="currentPage"
            :max="users.last_page"
            direction-links
            outline
            ellipses
            color="primary"
            active-design="push"
            active-color="primary"
            active-text-color="white"
            size="0.9rem"
            gutter="sm"
            @update:model-value="setPage"
          />
        </div>
      </div>
    </transition>
    <transition name="slide-fade">
      <div class="" v-if=" ready && users.data.length == 0">
        <div class="flex flex-center">
          <h6 class="q-mt-md">No hay usuarios registrados😥</h6>
        </div>
      </div>
    </transition>
    <transition name="slide-fade">
      <div class="" v-if="!ready">
        <div>
          <div v-for="index in 10" :key="index" class="flex justify-between items-center q-pa-sm userlist">
            <div class="w-70 text-subtitle2 text-weight-light q-mt-xs text-grey-7">
              <q-skeleton type="text" />
            </div>
            <div class="flex justify-end w-30">
              <div class="text-subtitle2 text-weight-light q-mt-xs q-mr- text-grey-7 w-70">
                <q-skeleton type="text" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </transition>
  </div>
</template>
<script>
  import { ref, inject, onMounted, onUnmounted } from 'vue';
  import { useUserStore } from '@/services/store/user.store'
  import { useQuasar } from 'quasar'
  import { useRouter } from 'vue-router';
  import wozIcons from '@/assets/icons/wozIcons';
  import util from '@/util/numberUtil';
  import searchUser from '@/components/admin/users/searchUser.vue';
  import { storeToRefs } from 'pinia'

  export default {
    components: {
      searchUser,
    },  
    setup () {
      //vue provider
      const { stateList } = storeToRefs(useUserStore())
      const icons = inject('ionIcons')
      const emitter = inject('emitter')
      const $q = useQuasar()
      const userStore = useUserStore()
      const router = useRouter()
      const { numberFormat } = util;
      const loading = ref(false)
      const ready = ref(false)
      const currentPage = ref(1)
      const users = ref([])
      const typeOfUser = ref(stateList.value)
      const alerts  = ref({
        waitCard: 0,
        waitLinkPay: 0,
        waitDocument: 0,
      })
      // methods
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
      const getUsers = (search) => {
        ready.value = false
        const query = {
          page: currentPage.value,
          search: search? search.replace(/\./g, '') : '',
          typeOfUser: typeOfUser.value
        }
        userStore.getAllUser(query)
        .then((response) => {
          if(response.code != 200) throw response
          setTimeout(() => {
            users.value = response.data
            ready.value = true
            
          }, 1000);
        })
        .catch((response) => {
          console.log(response)
          showNotify('negative', response)
        })
      }
      const setPage = (page) => {
        currentPage.value = page
        getUsers('')
      }
      const getUsersBySearch = (search) => {
        currentPage.value = 1
        getUsers(search)
      }
      const goTo = (id) => {
        router.push('/admin/user/'+id)
      }
      const setFilter = (index)=> {
        typeOfUser.value = index
        userStore.setStateList(index)
        getUsers()
      }

      const getNofi = () => {
        userStore.getNotificationAdmininUser().then((response) => {
          alerts.value = response.data

          console.log(alerts.value)
        })
      }
      onMounted(() => {
        emitter.on('searchUser', (search) => {
          getUsersBySearch(search)
        })
        getNofi()
        getUsers()
      })
      onUnmounted(() => {
        emitter.off('searchUser')
      })

      return {
        icons,
        wozIcons,
        loading,
        ready,
        alerts,
        numberFormat,
        currentPage,
        users,
        typeOfUser,
        setPage,
        getUsers,
        goTo,
        setFilter,
      }
    }
  };
</script>

<style lang="scss">
  .filtersButton.q-btn--outline:before{
    background: white;
  }
  .filtersButton.active.q-btn--outline:before{
    background: rgb(218, 221, 13);
  }
  .filtersContent {

    & .q-fab__actions--left{
      margin-right: 0px;
      background: #044afbe0;
      justify-content: space-between;
      border-radius: 10px;
  
    }
    & .q-fab__actions .q-btn{
      margin: 5px 15px;
    }
  }
  .slide-fade-enter-active {
    transition: all 0.3s ease-out;
    position: absolute;
    width: 100%;
  }

  .slide-fade-leave-active {
    transition: all 0.2s;
    position: absolute;
    width: 100%;
    opacity: 0;

  }

  .slide-fade-enter-from,
  .slide-fade-leave-to {
    opacity: 0;
  }
  .slide-fade-leave-to {
    position: absolute;
  }

</style>
<style lang="scss" scoped>
.notifications__hub{
  position: absolute;
  top: -0.3rem;
  right: 0rem;
  width: 15px;
  height: 15px;
  background: rgb(238, 24, 24);
  border-radius: 50%;
}
.userlist {
  border-bottom: 1px solid $grey-4;
  padding-top: 0.3rem ;
  padding-bottom: 0.3rem;
}
.w-70 {
  width: 60%;
}
.w-30 {
  width: 30%;
}
.user_section{
  height: 100%;
}
.h-100 {
  height: 100%;
}
.h-20 {
  height: 20%;
}
@media screen and (max-width: 780px){
  .h-20 {
    height: 25%;
  }
}
</style>
<style lang="sass" scoped>
.example-fab-animate,
.q-fab:hover .example-fab-animate--hover
  animation: example-fab-animate 0.82s cubic-bezier(.36,.07,.19,.97) both
  transform: translate3d(0, 0, 0)
  backface-visibility: hidden
  perspective: 1000px

@keyframes example-fab-animate
  10%, 90%
    transform: scale(1)

  20%, 80%
    transform: scale(1.1)

  30%, 50%, 70%
    transform: scale(1.1)

  40%, 60%
    transform: scale(1.1)
</style>
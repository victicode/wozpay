<template>

  <div>
    <div class=" q-px-sm " v-if="ready" >
      <div class="flex items-center q-mt-md q-pb-sm q-mb-sm" style="border-bottom: 1px solid lightgray;">
        <div v-html="wozIcons.clients" />
        <div class="text-subtitle2 text-weight-medium q-ml-xs q-mt-xs">Cuotas pendientes de aprobación</div>
      </div>
    </div>
    <div v-else class="flex justify-between q-px-sm q-mt-md" >
      <q-skeleton type="text" style="width: 50%;" />
    </div>
    <transition name="slide-fade">
      <div v-if="ready && users.data.length > 0" >
        <div>
          <div v-for="(user, index) in users.data" :key="index" class="flex justify-between items-center q-px-sm userlist">
            <div class=" text-subtitle2 text-weight-light q-mt-xs text-grey-7">
              {{ user.name }}
            </div>
            <div class="flex items-center">
              <div class="text-subtitle2 text-weight-light q-mt-xs text-grey-7">
                {{ numberFormat(user.dni) }}
              </div>
              <q-btn 
                flat 
                round 
                size="xs"
                class="q-pb-none"
                @click="goTo(user.pays_pending[0].loan_id)"  
              >
                <q-icon name="eva-chevron-right-outline" color="grey-6" size="sm" />
              </q-btn>
            </div>
          </div>
        </div>
        <div class="pagination flex flex-center q-mt-md">
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
          <h6 class="q-mt-md q-px-md">No hay pagos pendiente.🧐</h6>
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

export default {
components: {
  searchUser,
},  
setup () {
  //vue provider
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
  const paysCount = ref(0)
  
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
    }
    userStore.getUsersByPaidPending(query)
    .then((response) => {
      console.log(response)
      if(response.code != 200) throw response
      setTimeout(() => {
        users.value = response.data.users
        paysCount.value = countAllPays(response.data.users.data)
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
    router.push('/admin/pay/loanView/'+id)
  }
  const countAllPays = (users) => {
    let count = 0
    users.forEach(user => {
      count += user.pays_pending.length
    });
    return count
  }
  onMounted(() => {
    emitter.on('searchUser', (search) => {
      getUsersBySearch(search)
    })
    getUsers()
  })
  onUnmounted(() =>{
    emitter.off('searchUser')
  })
  return {
    icons,
    wozIcons,
    loading,
    ready,
    numberFormat,
    currentPage,
    users,
    paysCount,
    setPage,
    getUsers,
    goTo,
  }
}
};
</script>

<style lang="scss">
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

.solict_icon {
  transform: scale(0.7);
  & path {
    stroke: #0449fb;
    opacity: 0.8!important;
  }
}
</style>
<style lang="scss" scoped>
.userlist {
  border-bottom: 1px solid $grey-4;
  padding-top: 0.3rem ;
  padding-bottom: 0.3rem;
}
.w-70 {
width: 70%;
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
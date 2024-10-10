<template>

  <div>
    <div class=" q-px-sm q-mt-md" v-if="ready">
      <div class="text-subtitle1 text-weight-bold">
        Tipo de atrasos 
       <span style="" class="text-caption">🔵🟡🔴</span> 
      </div>
      <div v-for="(legend, index) in slowPayerLegend" :key="index" class="flex justify-between items-center q-px-sm userlist">
        <div class=" text-subtitle2 text-weight-light  text-grey-7 ">
          <q-icon name="eva-alert-triangle-outline" size="xs" class="q-mr-xs" :color="legend.color"/>
          {{ legend.title }}
        </div>
        <div class="flex items-center text-grey-7">
         {{ legend.days }} días
        </div>
      </div>
    </div>
    <div v-else class="flex justify-between q-px-sm q-mt-md" >
      <q-skeleton type="text" class="w-30" />
      <q-skeleton type="text" class="w-30" />
    </div>
    <transition name="slide-fade">
      <div class="q-mt-lg" v-if="ready && users.data.length > 0" >
        <div>
          <div class=" text-subtitle1 text-weight-bold q-px-sm ">
            Clientes morosos
          </div>
          <div v-for="(user, index) in users.data" :key="index" class="flex justify-between items-center q-pa-sm userlist">
            <div class=" text-subtitle2 text-weight-light q-mt-xs text-grey-7">
              {{ user.name }}
            </div>
            <div class="text-subtitle2 text-weight-light  text-grey-7">
              {{ numberFormat(user.dni) }}
            </div>
            <div class="flex items-center cursor-pointer">
              <q-btn 
                flat
                size="xs" 
                class="q-mr-xs" 
                @click="goTo(user.loans[0].id)"
              >
                <q-icon name="eva-alert-triangle-outline" size="xs" class="q-mr-xs" :color="slowPayerLegend[setDueDaysCategorie(user.loans[0].days_due)].color" />
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
          <h6 class="q-mt-md">No hay clientes morosos. 🤘🏻</h6>
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
  const loansCount = ref(0)
  const slowPayerLegend = [
    {
      title: 'Atraso leve',
      color: 'primary',
      days: '1-2'
    },
    {
      title: 'Atraso moderado',
      color: 'terciary',
      days: '3-5'
    },
    {
      title: 'Atraso extendido',
      color: 'negative',
      days: '6-8'
    },

  ]
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
    userStore.getSlowPayerUser(query)
    .then((response) => {
      console.log(response)
      if(response.code != 200) throw response
      setTimeout(() => {
        users.value = response.data.users
        loansCount.value = response.data.loansComplete
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
    router.push('/admin/loan_view/'+id)
  }
  const setDueDaysCategorie = (days) => {
    if(!days) return 0
    if(days <= 2 ) return 0
    if(days >= 3 && days <= 5) return 1
    if(days >= 6) return 2
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
    slowPayerLegend,
    numberFormat,
    currentPage,
    users,
    loansCount,
    setPage,
    getUsers,
    goTo,
    setDueDaysCategorie,
    
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
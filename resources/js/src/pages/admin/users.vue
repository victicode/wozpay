<template>
  <div class="user_section " >
    <div class="h-100">
      <div class="h-20 q-pt-none q-pt-md-lg  search__container">
        <div>
          <div
            id="SearchUser"
            class="q-pt-sm q-px-lg q-px-md-xl"
          >
            <div class="row ">
              <div class="col-12 q-mt-md ">
                <q-input
                  class="search_users q-pb-md"
                  outlined
                  clearable
                  :clear-icon="'eva-close-outline'"
                  color="positive"
                  v-model="search"
                  name="id_user"
                  label="Escribe un número de documento"
                  mask="###.###.###"
                  reverse-fill-mask
                  :rules="searchRules"
                  autocomplete="off"
                  ref="searchRef"
                  bg-color="white"
                  @change="getUsers"
                  
                >
                  <template v-slot:prepend>
                    <q-icon name="eva-search-outline" />
                  </template>
                </q-input>
              </div>
            </div>
          </div>
          <div class="q-px-xs q-px-md-xl justify-start flex">
            <q-chip 
              clickable 
              @click="filters($event)" 
              color="filters" 
              text-color="#e7ffe1" 
              class="q-px-sm q-py-md"
            >
              <div class="flex flex-center">
                <div v-html="wozIcons.profile"  class="buttons-chip " />
                <div class="q-mt-xs">
                  Clientes
                </div>
              </div>
            </q-chip>
            <q-chip 
              clickable 
              @click="filters($event)" 
              color="filters" 
              text-color="#e7ffe1" 
              class="q-px-sm q-py-md"
            >
              <div class="flex flex-center">
                <div v-html="wozIcons.profile"  class="buttons-chip " />
                <div class="q-mt-xs">
                  Solicitudes
                </div>
              </div>
            </q-chip>
            <q-chip 
              clickable 
              @click="filters($event)" 
              color="filters" 
              text-color="#e7ffe1" 
              class="q-px-sm q-py-md"
            >
              <div class="flex flex-center">
                <div v-html="wozIcons.profile"  class="buttons-chip " />
                <div class="q-mt-xs">
                  Clientes al día
                </div>
              </div>
            </q-chip>
            <q-chip 
              clickable 
              @click="filters($event)" 
              color="filters" 
              text-color="#e7ffe1" 
              class="q-px-sm q-py-md q-mt-sm q-mt-md-xs"
            >
              <div class="flex flex-center">
                <div v-html="wozIcons.profile"  class="buttons-chip " />
                <div class="q-mt-xs">
                  Clientes en mora
                </div>
              </div>
            </q-chip>
          </div>

        </div>
      </div>
      <div>
        <transition name="slide-fade">
          <div class="" v-if="ready && users.data.length > 0">
            <div>
              <div v-for="(user, index) in users.data" :key="index" class="flex justify-between items-center q-pa-sm userlist">
                <div class="w-70 text-subtitle2 text-weight-light q-mt-xs text-grey-7">
                  {{ user.name }}
                </div>
                <div class="flex items-center">
                  <div class="text-subtitle2 text-weight-light q-mt-xs q-mr-xs text-grey-7">
                    {{ numberFormat(user.dni) }}
                  </div>
                  <q-btn 
                    flat 
                    round 
                    size="xs"
                    class="q-pb-none"
                    @click="router.push('')" 
                  >
                    <q-icon name="eva-chevron-right-outline" color="grey-6" size="md" />
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
            <div>
              <div v-for="(user, index) in users.data" :key="index" class="flex justify-between items-center q-pa-sm userlist">
                <div class="w-70 text-subtitle2 text-weight-light q-mt-xs text-grey-7">
                  {{ user.name }}
                </div>
                <div class="flex items-center">
                  <div class="text-subtitle2 text-weight-light q-mt-xs q-mr-xs text-grey-7">
                    {{ numberFormat(user.dni) }}
                  </div>
                  <q-btn 
                    flat 
                    round 
                    size="xs"
                    class="q-pb-none"
                    @click="router.push('')" 
                  >
                    <q-icon name="eva-chevron-right-outline" color="grey-6" size="md" />
                  </q-btn>
                </div>
              </div>
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
    </div>
  </div>
</template>
<script>
  import { ref, inject, onMounted } from 'vue';
  import { useAuthStore } from '@/services/store/auth.store'
  import { useUserStore } from '@/services/store/user.store'
  import { useQuasar } from 'quasar'
  import { useRouter } from 'vue-router';
  import wozIcons from '@/assets/icons/wozIcons';
  import util from '@/util/numberUtil';

  export default {
    setup () {
      //vue provider
      const icons = inject('ionIcons')
      const $q = useQuasar()
      const userStore = useUserStore()
      const router = useRouter()
      const { numberFormat } = util;
      const loading = ref(false)
      const ready = ref(false)

      // data
      const search = ref('')
      const currentPage = ref(1)
      const users = ref([])
      //ref
      const searchRef = ref(null)
      // rules
      const searchRules = [
        val => (/[,%"'();&|<>]/.test(val) == false ) || 'No debe contener "[](),%|&;\'" ',
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
      const getUsers = () => {
        ready.value = false
        const query = {
          page: currentPage.value,
          search: search.value ? search.value.replace(/\./g, '') : '',
        }
        userStore.getAllUser(query)
        .then((response) => {
          console.log(response)
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
      const filters = (e) => {
        console.log(e)
      } 

      const setPage = (page) => {
        currentPage.value = page
        getUsers()
      }

      onMounted(() => {
        getUsers()
      })
      return {
        icons,
        wozIcons,
        loading,
        ready,
        search,
        searchRef,
        searchRules,
        numberFormat,
        currentPage,
        users,
        filters,
        setPage,
        getUsers,
      }
    }
  };
</script>

<style lang="scss">
  .search_users {
    & .q-field__control{
      border-radius: 15px!important;
      height: 50px
    }
    & .q-field__label{
      transform: translateY(0%)
    }
    &.q-field--focused .q-field__label, &.q-field--float .q-field__label{
      transition: all 0.3s ease-in;
      z-index: 100;
      background: white;
      font-weight: 600;
      max-width: 133%;
      padding: 0px 10px;
      transform: translateY(-65%) scale(0.75)!important;
    }
    
    & .q-field__native{
      padding-top: 15px!important;
      font-weight: 600;
    }
    & .q-field__prepend{
      transform: translateY(-4%)
    }
    

  }
  @media screen and (max-width: 780px){
    .search_users {
      & .q-field__bottom{
        transform: translateY(15px);
      }
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
.userlist {
  border-bottom: 1px solid $grey-4;
}
.w-70 {
  width: 70%;
}
.w-30 {
  width: 30%;
}
.buttons-chip{
  transform: scale(.7);
}
.user_section{
  height: 100%;
}
.h-100 {
  height: 100%;
}
.h-20 {
  height: 26%;
}
.search__container {
  background: #d9d9d9;
  overflow: hidden;
}
</style>
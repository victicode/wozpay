<template>
  <div class="user_section " >
    <div class="h-100">
      <div class="h-20 q-pt-none q-pt-md-sm  search__container">
        <div>
          <searchUser :filter="filter" @getUsers="getUsersBySearch" @filters="setFilters"/>
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
                    @click="goTo(user.id)"  
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
            <div class="flex flex-center">
              <h4>No hay usuarios registrados</h4>
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
      const $q = useQuasar()
      const userStore = useUserStore()
      const router = useRouter()
      const { numberFormat } = util;
      const loading = ref(false)
      const ready = ref(false)
      const filter = ref(1);
      const currentPage = ref(1)
      const users = ref([])

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
      
      const setPage = (page) => {
        currentPage.value = page
        getUsers('')
      }

      const setFilter = (e) => {
        console.log(e)
      } 
      const getUsersBySearch = (search) => {
        currentPage.value = 1
        getUsers(search)
      }
      const setFilters = (newFilter) => {
        filter.value = newFilter
      } 
      const goTo = (id) => {
        // console.log(router)
        router.push('/admin/user/'+id)
      }

      onMounted(() => {
        getUsers()
      })
      return {
        icons,
        wozIcons,
        loading,
        ready,
        numberFormat,
        currentPage,
        users,
        filter,
        setFilters,
        setPage,
        getUsers,
        getUsersBySearch,
        goTo,
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
  height: 20%;
}
.search__container {
  background: #d9d9d9;
  overflow: hidden;
}
@media screen and (max-width: 780px){
  .h-20 {
    height: 25%;
  }
}
</style>
<template>
  <div >
    <div>
      <div class="row q-px-md-lg q-px-md" >
        <div class="col-12 q-mt-md q-px-md-xl q-px-md">
          <q-input
            class="search_users q-pb-none "
            outlined
            clearable
            clear-icon="eva-close-outline"
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
          >
            <template v-slot:prepend>
              <q-icon name="eva-search-outline" />
            </template>
          </q-input>
        </div>
      </div>
      <div class="row q-px-none">
        <div class="col-12 q-px-md-xl q-px-md">
          <q-input
            class=" amount__input-loan q-pb-md"
            clearable
            clear-icon="eva-close-outline"
            color="grey-5"
            v-model="amount"
            name="id_user"
            label="Cargar tu capital"
            mask="###.###.###"
            reverse-fill-mask
            :rules="amountRules"
            autocomplete="off"
            maxlength="11"
            bg-color="white"
          >
            <template v-slot:prepend>
              Gs.
            </template>
          </q-input>
        </div>
        <div class="col-12 q-px-md-xl q-px-md">
          <div class="q-px-md-xl ">
            <q-btn 
              color="primary" 
              no-caps
              class="w-100 q-pa-sm q-mb-md" label="Actualizar capital"  
            />
          </div>
        </div>
      </div>
      <div class="q-px-md-lg q-px-md q-mt-md-lg q-mt-md">
        <div class="text-body1 text-weight-bold">
          Prestamo aprobados
        </div>
        <div>
          <div v-if="ready && loans.data.length > 0">
            <div>
              <div v-for="(loan, index) in loans.data" :key="index" class="flex justify-between items-center q-mt-sm border-b-1 q-py-sm">
                <div class="text-subtitle2 text-grey-7 text-weight-ligth w-40 ellipsis">{{loan.name}}</div>
                <div class="text-subtitle2 text-grey-7 text-weight-ligth w-20 text-center">{{ numberFormat(loan.dni) }}</div>
                <div class="text-subtitle2 text-grey-7 text-weight-ligth w-20 text-right">Gs. {{ numberFormat(loan.loans[0].amount) }}</div>
              </div>
              <div class="pagination flex flex-center q-mt-md">
                <q-pagination
                  v-model="currentPage"
                  :max="loans.last_page"
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
          </div>
          <div v-if="ready && loans.data.length == 0">
            <div>
              No hay prestamos aprobados 😴
            </div>
          </div>
          <div v-if="!ready">
            <div>
              <div v-for="n in 10" :key="n" class="flex justify-between items-center q-mt-sm border-b-1 q-py-sm">
                <q-skeleton type="text" class="w-40 "/>
                <q-skeleton type="text" class="w-20 "/>
                <q-skeleton type="text" class="w-20 "/>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import { ref, inject, onMounted} from 'vue';
  import { useQuasar } from 'quasar'
  import wozIcons from '@/assets/icons/wozIcons';
  import util from '@/util/numberUtil';
  import { useRouter } from 'vue-router';
  import { useLoanStore } from '@/services/store/loan.store';
  import { useAuthStore } from '@/services/store/auth.store';

  export default {

    setup () {
      //vue provider
      const icons = inject('ionIcons')
      const emitter = inject('emitter')
      const $q = useQuasar()
      const { numberFormat } = util;
      const router = useRouter()
      const loanStore = useLoanStore()
      const user = useAuthStore().user;

      // data
      const amount = ref(user.wallet.balance)
      const search = ref('')
      const ready = ref(false)
      const currentPage = ref(1)
      const loans = ref([])

      //ref
      const searchRef = ref(null)
      // rules
      const searchRules = [
        val => (/[,%"'();&|<>]/.test(val) == false ) || 'No debe contener "[](),%|&;\'" ',
      ]
      const amountRules = [
        val => (/[,%"'();&|<>]/.test(val) == false ) || 'No debe contener "[](),%|&;\'" ',
      ]

      const getApproveLoan = (search) =>{
        ready.value = false
        const query = {
          page: currentPage.value,
          search: search ? search.replace(/\./g, '') : '',
        }
        loanStore.getApproveLoan(query)
        .then((response) => {
          console.log(response)
          if(response.code != 200) throw response
          setTimeout(() => {
            loans.value = response.data
            console.log(response)
              ready.value = true
            }, 1000);
        })
        .catch((response) => {
          console.log(response)
        })
      } 

      const setPage = (page) => {
        currentPage.value = page
        getApproveLoan('')
      }
      onMounted(() => {
        getApproveLoan(null)
      })

      return {
        icons,
        wozIcons,
        search,
        router,
        searchRef,
        searchRules,
        numberFormat,
        amount,
        amountRules,
        loans,
        currentPage,
        ready,
        setPage,
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
  .amount__input-loan {
    & .q-field__control{
      height: 100px;
    }
    & .q-field__label{
      transform: translateY(250%) translateX(-15%);
      font-size: 2rem;
      overflow: visible;
    }
    &.q-field--focused .q-field__label, &.q-field--float .q-field__label{
      transition: all 0.3s ease-in;
      z-index: 100;
      font-size: 1.3rem;
      font-weight: 600;
      max-width: 133%;
      padding: 0px 10px;
      color: black;

      transform: translateY(70%) translateX(-20%) scale(0.75)!important;
    }
    
    & .q-field__native{
      padding-top: 15px!important;
      font-weight: 100!important;
      font-size: 2rem;
      text-align: center;
      transform: translateY(28%) translateX(-0%);
    }
    & .q-field__append{
      transform: translateY(50%)
    }
    & .q-field__prepend {
      opacity: 0;
      transition: 1s all ease;
    }
    &.q-field--float {
      & .q-field__prepend {
        opacity: 1;
        color: black;
        transform: translateY(100%) translateX(50%); 

      }
    }

  }
  @media screen and (max-width: 780px){
    .search_users {
      & .q-field__bottom{
        transform: translateY(15px);
      }
    }
  }

</style>
<style lang="scss" scoped>
.border-b-1 {
  border-bottom: 1px solid $grey-5;
}

.w-40 {
  width: 40%;
}
.w-20 {
  width: 25%;
}
.w-100 {
  width: 100%;
}
.user_section{
  height: 100%;
}
.search__container {
  background: #d9d9d9;
  overflow: hidden;
}
</style>
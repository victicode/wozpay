<template>
  <div>
      <div
        id="SearchUser"
        class="q-pt-md-none q-pt-sm q-px-lg q-px-md-xl"
      >
      <div class="row ">
        <div class="col-12 q-mt-sm q-pt-xs ">
          <q-input
            class="search_users q-pb-md"
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
            @change="searchUser"
          >
            <template v-slot:prepend>
              <q-icon name="eva-search-outline" />
            </template>
          </q-input>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import { ref, inject} from 'vue';
  import { useQuasar } from 'quasar'
  import wozIcons from '@/assets/icons/wozIcons';
  import util from '@/util/numberUtil';
  import { useRouter } from 'vue-router';

  export default {

    setup () {
      //vue provider
      const icons = inject('ionIcons')
      const emitter = inject('emitter')

      const { numberFormat } = util;
      const router = useRouter()
      // data
      const search = ref('')
      //ref
      const searchRef = ref(null)
      // rules
      const searchRules = [
        val => (/[,%"'();&|<>]/.test(val) == false ) || 'No debe contener "[](),%|&;\'" ',
      ]


      const searchUser = (value) => {
        emitter.emit('searchUser', value);
      } 


      return {
        icons,
        wozIcons,
        search,
        searchRef,
        searchRules,
        numberFormat,
        router,
        searchUser,
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
  // #547fed;
  .chip__container {
    transition: all 0.5s ease;
    border: 1px solid transparent;

    &.active {
      background: #aebcdf!important;
      border: 1px solid #0449fb;
      & .filters__text {
        color: #0449fb;
      }
      & path {
        stroke: #0449fb!important;
      }
    }
  }
  .buttons-chip{
    transform: scale(.7);
    &.active {
      background: red;
    }
    &.danger {
      & path {
        stroke: red;
      }
    }&.success{
      & path {
        stroke: green;
      }
    }&.active{
      & path {
        stroke: red;
      }
    }
  }

</style>
<style lang="scss" scoped>
.w-70 {
  width: 70%;
}
.w-30 {
  width: 30%;
}

.user_section{
  height: 100%;
}
.search__container {
  background: #d9d9d9;
  overflow: hidden;
}
</style>
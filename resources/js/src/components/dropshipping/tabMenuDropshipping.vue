<template>
  <q-tabs
    no-caps
    right-icon="-"
    active-color="terciary"
    align="justify"
    class="bg-white text-dark shadow-0 fixed-bottom bottom-tab q-py-md-xs q-px-md-lg flex q-py-xs dropNavbar" 
  >
    <q-route-tab class="q-px-xs-sm q-px-md-lg q-mt-xs" exact >
      <div class="flex flex-center column">
        <div v-html="wozIcons.tabShop" />
        <span class="q-mt-xs text-dark text-captionTab">Explorar Productos</span>
      </div>
    </q-route-tab>
    <q-route-tab class="q-px-xs-sm q-px-md-lg q-mt-xs" :to="'/dropshipping/categories'" exact > 
      <div class="flex flex-center column">
        <section class="flex flex-center column relative">
          <div v-html="wozIcons.tabTag" />
        </section>
        <span class="q-mt-xs text-dark text-captionTab">Categorias</span>
      </div>
    </q-route-tab>

  </q-tabs>
</template>

<script>
import { inject, onMounted, ref } from 'vue'
import wozIcons from '@/assets/icons/wozIcons'



export default {
  setup () {
    const icons = inject('ionIcons')

    return { icons, wozIcons, }
  },
}
</script>
<style lang="scss">
.dropNavbar{

padding-top: 0px!important;
& .q-tab__indicator {
  bottom: 97%!important;
}
& .q-tab--active {
  & span {
    color:#ffc701!important;
  }
  & path {
    stroke: #ffc701;
  }
}
}
.text-captionTab{
  font-size: 0.8rem;
  color: black!important;
}
.q-tab__label{
    font-size: 0.72rem!important;
  }
</style>
<style lang="scss" scoped>
  .notificationBadge1{
    height: 15px;
    width: 15px;
    background: red;
    position: absolute;
    border-radius: 50%;
    left: 65%;
    bottom: 55%;
  }
  .w-100{
    width: 100%!important;
  }
  .bottom-tab{
    box-shadow: 0px -3px 15px 0px #7f7f7f3d !important;
    width: 50%;
    left: 25%;
    height: 9%;
    z-index: 2000;
  }
  @media screen and (max-width: 820px){
    .bottom-tab{
      width: 100%;
      left: 0%;
    }
  }
</style>
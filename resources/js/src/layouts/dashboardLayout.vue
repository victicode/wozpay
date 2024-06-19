<template>
  <div class="layout-dasboard__content">
    <div id="content-page" >
      <router-view v-slot="{ Component }">
          <transition name="fades" >
            <component :is="Component" />
          </transition>
        </router-view>
    </div>
    <div id="navbar-buttom">
      <navbarVue />
    </div>
  </div>
</template>
<script setup>
  import navbarVue from "@/components/layouts/navbar.vue";
</script>
<style lang="scss" scoped>
#content-page{
  height: 91vh;
}
.layout-dasboard__content{
  height: 100vh;
  max-height: 100vh;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}
</style>
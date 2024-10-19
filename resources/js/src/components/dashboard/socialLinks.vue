<template>
  <div class="flex items-center">
    <div>
      <div class="socialLink__container q-mx-lg">
        <div class="socialLink__img">
          <a href="https://cdn-www.lanacionpy.arcpublishing.com/negocios/2021/01/12/emprendedores-ln-renuncio-a-todo-y-en-5-anos-consolido-woz-paraguay-sitio-de-comercio-digital/" target="_blank">
            <img :src="ln" height="100%" width="100%" alt="">
          </a>
        </div>
      </div>
      <div class="text-weight-medium q-mt-xs flex justify-center items-center">
      <div>
        Prensa
      </div>
      <div>
        <q-icon  :name="icons.sharpVerified" color="terciary" size="1.1rem" style="margin-left: 0.05rem; margin-top: -0.1rem;"/>
      </div>
      </div>
    </div>
    <div>
      <div class="socialLink__container q-mx-lg">
        <div class="socialLink__img">
          <a href="https://www.instagram.com/wozparaguay" target="_blank">
            <img :src="ig" height="100%" width="100%" alt="">
          </a>
        </div>
      </div>
      <div class="text-weight-medium q-mt-xs flex justify-center items-center">
        <div>
          Instagram
        </div>
        <div>
          <q-icon  :name="icons.sharpVerified" color="terciary" size="1.1rem" style="margin-left: 0.05rem; margin-top: -0.1rem;"/>
        </div>
      </div>
    </div>
    <div>
      <div class="socialLink__container q-mx-lg">
        <div class="socialLink__img">
          <a href="https://www.facebook.com/WozParaguay" target="_blank">
            <img :src="fb" height="100%" width="100%" alt="">
          </a>
        </div>
      </div>
      <div class="text-weight-medium q-mt-xs flex justify-center items-center">
        <div class="">
          Facebook
        </div>
        <div>
          <q-icon  :name="icons.sharpVerified" color="terciary" size="1.1rem" style="margin-left: 0.05rem; margin-top: -0.1rem;"/>  
        </div>
      </div>
    </div>    
  </div>
</template>
<script>
  import ln from '@/assets/images/ln.png'
  import ig from '@/assets/images/ig.png'
  import fb from '@/assets/images/fb.png'
  import { inject } from 'vue';
  
export default {
  setup() {
    return {
      icons: inject('ionIcons'),
      ln,
      ig,
      fb
    }
  },
}
</script>
<style lang="scss">
  .socialLink__container{
    height: 52px;
    width: 52px;
    border-radius: 50%;
    border: 3px solid #ffc701;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0.15rem;
    transition: all 0.2s ease;
    &:hover {
      transform: scale(1.15);
    }
  }
  .socialLink__img{
    height: 100%;
    width: 100%;
    border-radius: 50%;
    overflow: hidden;
  }
</style>
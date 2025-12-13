<template>
  <div class="q-pb-md q-px-md q-px-md-lg"  >
    <div class=" q-pb-sm" >
      <div class="row">
        <div class="col-12 flex items-center justify-between">
          <div class="text-subtitle1 q-mt-none text-black-9 text-weight-medium">Volver a cobros nacionales</div>
          <div>
            <van-switch v-model="active" class="swichtDashboard" size="1.5rem"
              @update:model-value="redirect()" :loading="loading" active-color="#21BA45" inactive-color="#d8d8d8">
              <template #node>
                <div class="icon-wrapper">
                </div>
              </template>
            </van-switch>
          </div>
        </div>
      </div>
    </div>
    <div style="" class="q-mb-sm">
      <div class="quote-section" v-if="isReady" >
        <div class="row q-px-none">
          <div class="col-12 bg-white q-pa-md flex items-center justify-between  link__payContent" style="" >
            <div class="w-80xxccv flex items-center ">
              <div class=" q-mr-md-lg q-mr-sm q-mt-xs flex flex-center" style="width:36px; height:36px">
                <q-icon :name="icons.ionGlobeOutline" size="md" color="positive" />
              </div>
              <div class="flex items-center justify-between" style="width:75%" >
                <div class=" q-mr-md-none w-autox" >
                  <div>
                    <div class="text-weight-medium ellipsis text__mid" style="font-size: 0.89rem; ">Caja de ahorro</div>
                    <div  v-if="!(!user.wallet)" >N° {{user.wallet.number}}</div>
                    <div class="q-mt-xs text-grey-8 text-weight-medium" style="font-size: 0.79rem;" v-else >No tienes ningun préstamo</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="q-mr-none cursor-pointer flex items-center" >
                <div class="q-ml-sm q-ml-md-none q-pl-md-md  text-end">
                  <div class="cursor-pointer" >
                    <div class="text-weight-medium text-right ">
                      Disponible
                    </div>
                    <div class="text-weight-medium  q-mr-xs text-right " style="">Gs. {{numberFormat(user.wallet.balance)}}</div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
      <div class="quote-section" v-else>
        <div class="row q-px-none">
          <div class="col-12 bg-white q-pa-md flex items-center justify-between justify-md-start link__payContent" style="" >
            <div style="" class="w-10">
              <!-- <div v-html="wozIcons.withdrawal" /> -->
              <q-skeleton type="rect"  />
            </div>
            <div class="flex items-center justify-between  w-80 ">
              <div class=" q-mx-sm  w-50">
                <div class="text-weight-medium"><q-skeleton type="rect" /></div>
                <div class="text-weight-bold q-mt-xs"><q-skeleton type="rect" /></div>
              </div>
              <div class="q-mx-sm w-50 text-end">
                <div class="text-weight-medium text-right"><q-skeleton type="rect" /></div>
                <div class="text-weight-medium q-mt-xs text-right"><q-skeleton type="rect" /></div>
              </div>
            </div>
            <div class="w-10">
              <q-skeleton type="rect"  />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import { useAuthStore } from '@/services/store/auth.store'
  import util from '@/util/numberUtil'
  import { inject, ref, onMounted } from 'vue'
  import wozIcons from '@/assets/icons/wozIcons';
  import { useQuasar } from 'quasar';
  import { useRouter } from 'vue-router'
  import { storeToRefs } from 'pinia'

  export default {
    setup() {
      //vue provider
      const q = useQuasar()
      const { user  } = storeToRefs(useAuthStore())
      const icons = inject('ionIcons')
      const numberFormat = util.numberFormat
      const isReady = ref(false)
      // const loan = ref({}) 
      const router = useRouter()
      const active = ref(true)
      const loading = ref(false)
      const loanStatus = (state) => {
        const status = [
          {text:'Cancelado', color:'negative', texColor:'white' },
          {text:'Pendiente', color:'warning', texColor:'white' },
          {text:'Aprobado', color:'chip', texColor:'positive' },
          {text:'Pagada',    color:'chip', texColor:'positive' },
          {text:'No pagado', color:'deep-orange-13', texColor:'white' },
        ]
        return status[state]
      }
      const redirect = () => {
        active.value = false
        loading.value = true
        setTimeout(() => {
          router.push('/dashboard')
        }, 1000);
      }
      onMounted(() => {
        setTimeout(() => {
          isReady.value = true
        }, 500)
      })
      // Data
      return{
        active,
        loading,
        icons,
        user,
        numberFormat,
        isReady,
        wozIcons,
        router,
        loanStatus,
        redirect
      }
    },
  }

</script>
<style lang="scss">
.w-100 {
  width: 100%!important;
}
.swichtDashboard .van-switch__node {
  background: #fff;
}
.van-switch--loading .van-switch__node{
  background: #6c6c6c;
}
</style>


<style lang="scss" scoped>
.text__min{
  width: auto;
}
.link__payContent{
  border-radius:15px;
  //box-shadow: 0px 5px 5px 0px #aaaaaa
}
.loan_container{
  border-bottom: 1px solid #d3d3d3;
}
.w-80 {
  width: 90%;
}
.w-50 {
  width: 46%;
}
.w-10 {
  width: 6%;
}
.w-80xxccv {
  width: 80%;
}
.inforcof__icon2{
  position: absolute;
  right: 0rem;
  // margin-top: 0.2rem;
  transform: translateY(0.35rem) scale(0.95);
}
@media screen and (min-width: 381px) and (max-width: 780px){
  .w-85 {
    width: 90%;
  }
  .w-80xxccv {
    width: 60%;
  }
  .w-50 {
    width: 45%;
  }
  .text__mid{
    width: 100%;
  }
  .w-autox{
    width: 100%;
  }
}

@media screen and (max-width: 380px){
  .w-85 {
    width: 90%;
  }
  .w-80xxccv {
    width: 60%;
  }
  .w-50 {
    width: 45%;
  }
  .text__mid{
    width: 100%;
  }
  .w-autox{
    width: 100%;
  }
}
</style>
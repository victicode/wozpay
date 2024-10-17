
<template>
  <div class="profile_section q-pt-none" >
    <div class="q-mt-sm"  >
      <div class="w-100 q-mx-none" v-if="loadingCard">
        <!-- info -->
        <q-list  class="q-px-md">
          <q-item class="q-py- q-px-sm" v-if="Object.values(card).length > 0 && card.status == 2">
            <q-item-section>
              <div class="flex items-center justify-between">
                <div>
                  <q-item-label class="q-mt-xs text-weight-bold" >
                  <span class="text-body2 text-weight-bold">
                    Tarjeta vinculada
                  </span>
                  </q-item-label>
                  <q-item-label caption lines="1" class=" text-caption">Paga con tu tarjeta vinculada</q-item-label>
                </div>
                <div>
                  <q-btn 
                    unelevated 
                    flat 
                    round 
                    color="grey-6"  
                    icon="eva-chevron-right-outline" 
                    @click="router.push('/loan_pay/tpago')"  
                  />
                </div>
              </div>
            </q-item-section>
          </q-item>
          <q-separator />
          <q-item class="q-py- q-px-sm" >
            <q-item-section>
              <div class="flex items-center justify-between">
                <div>
                  <q-item-label class="q-mt-xs text-weight-bold" >
                  <span class="text-body2 text-weight-bold">
                    Transferencia bancaria
                  </span>
                  </q-item-label>
                  <q-item-label caption lines="1" class=" text-caption">Haz una transferencia</q-item-label>
                </div>
                <div>
                  <q-btn 
                    unelevated 
                    flat 
                    round 
                    color="grey-6"  
                    icon="eva-chevron-right-outline" 
                    @click="router.push('/loan_pay/transfer')"  
                  />
                </div>
              </div>
            </q-item-section>
          </q-item>
          <q-separator />
        </q-list>
      </div>
      <div class="w-100 q-mx-none" v-else >
        <!-- info -->
        <q-list  class="q-px-md">
          <div v-for="n in 2" :key="n">
            <q-item class="q-py- q-px-sm">
              <q-item-section>
                <div class="flex items-center justify-between">
                  <div class="w-50">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      <q-skeleton type="text" style="width: 30%;"/>
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class=" text-caption"><q-skeleton type="text" style="width: 20%;" /></q-item-label>
                  </div>
                  <div class="w-50 flex justify-end">
                    <q-skeleton type="text" style="width: 5%;" />
                  </div>
                </div>
              </q-item-section>
            </q-item>
            <q-separator />
          </div>
        </q-list>
      </div>
    </div>
  </div>
</template>
<script>
  import { useAuthStore } from '@/services/store/auth.store'
  import { inject, ref,} from 'vue'
  import { useRouter } from 'vue-router'
  import { useCardStore } from '@/services/store/card.store'


  export default {
    setup() {
      //vue provider
      const user = useAuthStore().user;
      const icons = inject('ionIcons')
      const router = useRouter()
      const cardStore = useCardStore()
      const card = ref({})
      const loadingCard = ref(false)
      
      const getLinkCard = () => {
        
        cardStore.getCard(user.id).then((data) => {
          if(data.code !== 200) throw data
          setTimeout(()=>{
            loadingCard.value = true;
            card.value = data.data ? Object.assign(data.data) : {}
          }, 500)
        }).catch((response) => {
          showNotify('negative', response)
        })
      }

     
      onMounted(() => {
        getLinkCard();
      })

      // Data
      return{
        icons,
        card,
        router,
        loadingCard,
      }
    },
  }
</script>
<style lang="scss" scoped>
.w-50{
  width: 50%;
}
.w-100 {
  width: 100%;
}
</style>
<style lang="scss" >
.amount_input {
  border-bottom: 1px solid $grey-6 ;
  display: flex;
  justify-content: center;
  position: relative;
  &.q-field--disabled .q-field__inner{
    background: transparent!important;
  }
  &.q-field--disabled .q-placeholder{
    opacity: 1!important;
  }
  & .q-field__control::before {
    border: 0px!important;
  }
  & .q-field__control-container{
    text-align: center;
  }
  & .q-field__prefix{
    position: absolute;
    font-size: 40px;
    margin-right: 10px;
    transform: translateY(0.5px) translateX(140%);
  }
  & .q-field__native{
    font-size: 40px;
    text-align: center;
  }
}
@media screen and (max-width: 780px){
  .amount_input { 
    & .q-field__prefix{
      transform: translateY(3.5px) translateX(40%)!important;
    }
  }
}

</style>

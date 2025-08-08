<template>
  <div>
    <div class="w-100 q-mx-none">
      <!-- info -->
      <q-list  class="q-px-md  q-pt-sm">
        <q-item class="q-py- q-px-sm">
          <q-item-section>
            <div class="flex items-center justify-between">
              <div>
                <q-item-label class="q-mt-xs text-weight-bold" >
                <span class="text-body2 text-weight-bold">
                  Ver categorias
                </span>
                </q-item-label>
                <q-item-label caption lines="1" class=" text-caption">Visualiza las categorias actuales</q-item-label>
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
                  Cargar categorias
                </span>
                </q-item-label>
                <q-item-label caption lines="1" class=" text-caption">Sube el archivo con las nuevas categorias</q-item-label>
              </div>
              <div>
                <q-btn 
                  unelevated 
                  flat 
                  round 
                  color="grey-6"  
                  icon="eva-chevron-right-outline" 
                  @click="router.push('/admin/dropshipping/categories/create')"  
                />
              </div>
            </div>
          </q-item-section>
        </q-item>
        <q-separator />
      </q-list>
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

      


      // Data
      return{
        icons,
        router,
      }
    },
  }
</script>
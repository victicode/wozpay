<template>
  <div style="height: 91vh;">
    <div class="q-pa-md">
      <Transition name="inFade">
        <div v-if="banks.length > 0 && ready">
          <div>
            <div class="text-subtitle1 text-weight-bold ">Entidades</div>
            <div>
              <div v-for="(bank,index) in banks" :key="index" style="border: 1px solid red; border-radius:8px" class="q-pa-md q-mb-xs" >
                <!-- <img :src="bank.logo" alt="" style="height:50px; "> -->
                 <div v-html="wozIcons[bank.logo]" />
              </div>
            </div>
          </div>
        </div>
        <div v-else-if="banks.length == 0 && ready" >

        </div>
        <div v-else>
          cargando
        </div>
      </Transition>      
    </div>
  </div>
</template>
<script>
import { inject, onMounted, ref } from 'vue'
import wozIcons from '@/assets/icons/wozIcons'
import { useBankAccountStore } from '@/services/store/bankAccount.store'
import { useAuthStore } from '@/services/store/auth.store'

export default {
  setup () {
    const icons = inject('ionIcons')
    const store = useBankAccountStore()
    
    const user = useAuthStore().user;
    
    const banks = ref([])
    const ready = ref(false)

    const getAllBanks = () =>{
      store.getAllBanks().then((data) =>{
        if(data.code !== 200) return
        console.log(data)
        banks.value = data.data
        setTimeout(() => {
          ready.value = true
          return
        }, 1000);
      })
    }
    onMounted(() => {
      getAllBanks()
    })
    return { banks, ready, wozIcons }
  },
}
</script>
<template>
  <div style="height: 91vh;">
    <div>
      <Transition name="inFade">
        <div v-if="bankAccounts.length > 0 && ready">
          <div>
            <div>
              <div>
                <div></div>
                <div></div>
              </div>
              <div>
                <div></div>
                <div></div>
              </div>
              <div>
                <div></div>
                <div></div>
              </div>
              <div>
                <div></div>
                <div></div>
              </div>
              <div>
                <div></div>
                <div></div>
              </div>
            </div>
          </div>
        </div>
        <div v-else-if="bankAccounts.length == 0 && ready" >

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
import { useRouter } from 'vue-router';

export default {
  setup () {
    const icons = inject('ionIcons')
    const store = useBankAccountStore()
    const user = useAuthStore().user;
    const bankAccounts = ref([])
    const ready = ref(false)
    const router = useRouter()

    const getAccountsBankbyUser = () =>{
      store.getAllAccountBankByUser(user.id).then((data) =>{
        if(data.code !== 200) return
        console.log(data)
        bankAccounts.value = data.data
        if(bankAccounts.value.length == 0)  {router.push('/bank'); return }
        setTimeout(() => {
          ready.value = true
        }, 5000);
      })
    }
    onMounted(() => {
      getAccountsBankbyUser()
    })
    return { bankAccounts, ready, }
  },
}
</script>
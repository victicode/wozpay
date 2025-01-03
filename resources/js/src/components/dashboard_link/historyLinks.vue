<template>
  <div>
    <div class="q-pl-md-lg q-pl-md">
      <div class="text-subtitle1 text-bold">Links generados</div>
      <div class="text-subtitle1">Historial de links generados</div>
    </div>
    <div>
      <div v-if="userLinks.length > 0" class="q-px-md" >
        <div v-for="(link, index) in userLinks" :key="index" class="q-mt-md flex items-center">
          <q-icon name="eva-link-2-outline" size="md" />
          <div style="border-bottom: 1px solid lightgray; width: 90%;" class="q-px-md flex items-center justify-between ">
            <div>
              <div class="text-subtitle1 text-weight-medium">Link de pago</div>
              <div class="text-subtitle2 text-weight-regular">N° {{ link.code }}</div>
            </div>
            <div>
              <div 
                class="text-subtitle2 text-grey-6 text-right text-weight-medium" 
                :class="{'text-positive': link.status == 2, 'text-terciary':link.status == 1 ,'text-negative':link.status == 0 }"
              >
                {{link.status == 2 ? moment(link.created_at).format('DD/MM/YYYY') : 'Pendiente'}}
              </div>
              <div 
                style="font-size: 15px;" 
                class="text-weight-medium text-right" 
                :class="{'text-positive': link.status == 2, 'text-grey-6':link.status == 1 ,'text-negative':link.status == 0 }"
              >
                GS {{ numberFormat(link.amount) }}
              </div>
              <div class="text-subtitle2 text-grey-6 text-right text-weight-medium"  v-if="link.status != 2">
                {{link.status == 2 ? moment(link.created_at).format('DD/MM/YYYY') : 'Pendiente'}}
              </div>
            </div>
          </div>

        </div>
      </div>
      <div v-else>

      </div>
    </div>
  </div>
</template>
<script>
  import { useAuthStore } from '@/services/store/auth.store'
  import util from '@/util/numberUtil'
  import { inject, ref, onMounted } from 'vue'
  import wozIcons from '@/assets/icons/wozIcons';
  import { useLinkStore } from '@/services/store/link.store';
  import { useQuasar } from 'quasar';
  import { useRouter } from 'vue-router'
  import { storeToRefs } from 'pinia'
  import moment from 'moment';
  export default {
    setup() {
      //vue provider
      const q = useQuasar()
      const { user  } = storeToRefs(useAuthStore())
      const icons = inject('ionIcons')
      const numberFormat = util.numberFormat
      const isReady = ref(false)
      const router = useRouter()
      const linkStore = useLinkStore()
      const userLinks = ref([])
      const getLinkByUser = () => {
        linkStore.getLinksByUser(user.value.id)
        .then((response) => {
          if(response.code !== 200) throw response
          userLinks.value = response.data
          clocks(response.data)
        })
        .catch((response) => {
          console.log(response)
          showNotify('negative', response)
        })
      }
      const showNotify = (type, message) => {
        q.notify({
          message: message,
          color: type,
          actions: [
            { icon: 'eva-close-outline', color: 'white', round: true, handler: () => { /* ... */ } }
          ]
        })
      }
      const clocks = (data) =>{
        const filter = data.filter((item) => item.status != 2)
        console.log(filter)
        // if(currentTicket.value){
        //   interval.value = setInterval( () => {
        //     let today = new moment();
        //     let product_due_date = moment(currentTicket.value.updated_at);
        //     let diff_due_date = Math.round(moment.duration(today.diff(product_due_date)).as('seconds'));
        //     let seconds = () => {
        //       return (diff_due_date % 60+'').length == 1
        //       ?  '0' + diff_due_date % 60
        //       : diff_due_date % 60
        //     }
        //     let minute = () => {
        //       return (parseInt(diff_due_date / 60)+'').length == 1
        //       ?  '0' + parseInt(diff_due_date / 60)
        //       : parseInt(diff_due_date / 60)
        //     }
        //     let hour = () => {
        //       return (parseInt(diff_due_date / 3600)+'').length == 1
        //       ?  '0' + parseInt(diff_due_date / 3600)
        //       : parseInt(diff_due_date / 3600)
        //     }
  
        //     date.value =  hour() + ':' + minute() + ':' + seconds();
        //   }, 1000 )
        // }
      }
      onMounted(() => {
        getLinkByUser()
        // window.Echo
        // .channel('userUpdateEvent'+user.id)
        // .listen('UserUpdateEvent', async () => {
        // })
      })
      // Data
      return{
        icons,
        user,
        moment,
        numberFormat,
        isReady,
        wozIcons,
        router,
        userLinks,
      }
    },
  }

</script>
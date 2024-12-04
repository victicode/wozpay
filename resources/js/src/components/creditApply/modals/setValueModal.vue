<template>
  <q-dialog v-model="dialog" persistent backdrop-filter="blur(8px)">
    <q-card style="min-width: 350px">
      <q-card-section>
        <div class="text-subtitle1 text-weight-bold"> Agregar {{ title }}</div>
      </q-card-section>
      <q-card-section class="q-pt-none" style="overflow-y: hidden"  v-if="type == 1" >
        <q-input 
          dense 
          v-model="setterVal" 
          clearable 
          clear-icon="eva-close-outline" 
          autofocus   
        />
      </q-card-section>
      <q-card-section class="q-pt-none" style="overflow-y: hidden"  v-if="type == 2" >
        <van-picker 
          v-model="setterVal" 
          :columns="index == 'due_date' ? days : amounts" 
          visible-option-num="7" 
          :show-toolbar="false"  
          class="van_picker_up" 
        />
      </q-card-section>
      <q-card-section class="q-pt-none" style="overflow-y: hidden"  v-if="type == 3" >
        <q-file 
          class="inputLoanField" 
          v-model="setterVal" 
          clearable clear-icon="eva-close-outline"  
          autofocus dense max-files="3" multiple label="Ver en carpeta 📂">
          <template v-slot:prepend>
            <q-icon name="eva-attach-2-outline" />
          </template>
        </q-file>
      </q-card-section>

      <q-card-actions align="right" class="text-primary">
        <q-btn flat label="Volver" @click="hiddeModal()"/>
        <q-btn flat label="Confirmar" :loading="loading" @click="setValue()" > 
          <template v-slot:loading>
            <q-spinner-facebook />
          </template>
        </q-btn>
      </q-card-actions>
    </q-card>
  </q-dialog>
</template>
<script>
  import { ref, onMounted } from 'vue';
  import { useAuthStore } from '@/services/store/auth.store'
  import { useQuasar } from 'quasar'
  import { useRouter } from 'vue-router';
  import util from '@/util/numberUtil'
 
  export default {
    props: {
      dialog: Boolean,
      input: Object,
      days: Object,
      isRekutu: Boolean
    },
    emits: ['hiddeModal'],
    setup (props, { emit }) {

      //vue provider
      const user = useAuthStore().user;
      const router = useRouter()
      const dialog = props.dialog
      const type = props.input.type
      const index = props.input.index
      const title = props.input.title
      const setterVal = ref()
      const daysOutFormatted = props.days
      const loading = ref(false)
      const numberFormat = util.numberFormat
      const days = ref([])
      
      const amounts = user.is_first_loan && user.loans_complete_count == 0
      ? [
          { text: 'Gs. '+numberFormat(50000), value: 50000 },
          // { text: 'Gs. '+numberFormat(100000), value: 100000 },
          // { text: 'Gs. '+numberFormat(150000), value: 150000 },
          // { text: 'Gs. '+numberFormat(200000), value: 200000 },
        ]
      : user.loans_complete_count == 1 && props.isRekutu
      ? [
          { text: 'Gs. '+numberFormat(50000), value: 50000 },

        ]
      : user.loans_complete_count == 2 && props.isRekutu
      ? [
          { text: 'Gs. '+numberFormat(50000), value: 50000 },

        ]
      : user.loans_complete_count == 1
      ? [
          { text: 'Gs. '+numberFormat(50000), value: 50000 },
          { text: 'Gs. '+numberFormat(100000), value: 100000 },
          { text: 'Gs. '+numberFormat(150000), value: 150000 },
          { text: 'Gs. '+numberFormat(200000), value: 200000 },
          { text: 'Gs. '+numberFormat(225000), value: 225000 },
          { text: 'Gs. '+numberFormat(250000), value: 250000 },
          { text: 'Gs. '+numberFormat(300000), value: 300000 },

        ]
      : user.loans_complete_count == 2
      ? [
          { text: 'Gs. '+numberFormat(50000), value: 50000 },
          { text: 'Gs. '+numberFormat(100000), value: 100000 },
          { text: 'Gs. '+numberFormat(150000), value: 150000 },
          { text: 'Gs. '+numberFormat(200000), value: 200000 },
          { text: 'Gs. '+numberFormat(225000), value: 225000 },
          { text: 'Gs. '+numberFormat(250000), value: 250000 },
          { text: 'Gs. '+numberFormat(300000), value: 300000 },
          { text: 'Gs. '+numberFormat(325000), value: 325000 },
          { text: 'Gs. '+numberFormat(350000), value: 350000 },
          { text: 'Gs. '+numberFormat(375000), value: 375000 },
          { text: 'Gs. '+numberFormat(400000), value: 400000 },
          { text: 'Gs. '+numberFormat(425000), value: 425000 },
          { text: 'Gs. '+numberFormat(450000), value: 450000 },
          { text: 'Gs. '+numberFormat(500000), value: 500000 },
        ]
      : [
        { text: 'Gs. '+numberFormat(100000), value: 100000 },
        { text: 'Gs. '+numberFormat(250000), value: 250000 },
        { text: 'Gs. '+numberFormat(500000), value: 500000 },
        { text: 'Gs. '+numberFormat(750000), value: 750000 },
        { text: 'Gs. '+numberFormat(1000000), value: 1000000 },
        { text: 'Gs. '+numberFormat(1300000), value: 1300000 },
        { text: 'Gs. '+numberFormat(1500000), value: 1500000 },
        { text: 'Gs. '+numberFormat(2000000), value: 2000000 },
        { text: 'Gs. '+numberFormat(2500000), value: 2500000 },
        { text: 'Gs. '+numberFormat(3000000), value: 3000000 },
        { text: 'Gs. '+numberFormat(3500000), value: 3500000 },
        { text: 'Gs. '+numberFormat(3750000), value: 3750000 },
        { text: 'Gs. '+numberFormat(4000000), value: 4000000 },
        { text: 'Gs. '+numberFormat(4250000), value: 4250000 },
        { text: 'Gs. '+numberFormat(4500000), value: 4500000 },
        { text: 'Gs. '+numberFormat(4750000), value: 4750000 },
        { text: 'Gs. '+numberFormat(5000000), value: 5000000 },
        ]
      // Methods
      const setInterestRate = () => {
        const formattedValue = []
        if(user.is_first_loan && user.loans_complete_count == 0){
          formattedValue.push({
            text:`${daysOutFormatted[0].days} días`,
            value: daysOutFormatted[0].days,
          })
        }else if((user.loans_complete_count == 1 && props.isRekutu) || (user.loans_complete_count == 2 && props.isRekutu)){
          formattedValue.push({
            text:`${daysOutFormatted[0].days} días`,
            value: daysOutFormatted[0].days,
          })
        }
        else{
          Object.values(daysOutFormatted).forEach((rates) => {
            formattedValue.push({
              text:`${rates.days} días`,
              value: rates.days,
            })
          })
        }
        return formattedValue
      }

      const hiddeModal = () => {
        emit('hiddeModal', null)
      }
      const setValue = () => {
        const value = type == 1
        ? setterVal.value
        : type == 2
        ? setterVal.value[0]
        : setterVal.value

        emit('hiddeModal', value)
      }

      const setValueByType = () => {
        if(props.input.value){
          setterVal.value = props.input.value
          return
        }

        setterVal.value = type == 1 
        ? ''
        : type == 2 
        ? [{text:'', value:''}]
        : null
      }
      onMounted(() => {
        setValueByType() 
        if(type == 2) {
          days.value = setInterestRate()
        }
      })

      return {
        loading,
        dialog,
        router,
        days,
        amounts,
        type,
        title,
        index,
        setterVal,
        hiddeModal,
        setValue,
      }
    }
  };
</script>
<style lang="scss">
.inputLoanField.q-field--dense.q-field--float .q-field__label {
    transform: translateY(-63%) translateX(-1%) scale(0.75);
}
.van_picker_up{
  transform: translateY(-10%); 
  height: 268px;

  & .van-ellipsis{
    font-size: 120%;
  }
  & [class*=van-hairline]:after{
    border-color: #000!important;
  }
}
</style>

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
        <q-file  v-model="setterVal" clearable clear-icon="eva-close-outline"  autofocus dense >
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
    },
    emits: ['hiddeModal'],
    setup (props, { emit }) {

      //vue provider
      const router = useRouter()
      const dialog = props.dialog
      const type = props.input.type
      const index = props.input.index
      const title = props.input.title
      const setterVal = ref()
      const loading = ref(false)
      const numberFormat = util.numberFormat

      const days = [
        { text: '7 días', value: 7 },
        { text: '10 días', value: 10 },
        { text: '15 días', value: 15 },
        { text: '30 días', value: 30 },
        { text: '60 días', value: 60 },
      ];

      const amounts = [
        { text: 'Gs. '+numberFormat(50000), value: 50000 },
        { text: 'Gs. '+numberFormat(70000), value: 70000 },
        { text: 'Gs. '+numberFormat(100000), value: 100000 },
        { text: 'Gs. '+numberFormat(200000), value: 200000 },
        { text: 'Gs. '+numberFormat(300000), value: 300000 },
        { text: 'Gs. '+numberFormat(400000), value: 400000 },
        { text: 'Gs. '+numberFormat(500000), value: 500000},
        { text: 'Gs. '+numberFormat(600000), value: 600000 },
        { text: 'Gs. '+numberFormat(700000), value: 700000 },
        { text: 'Gs. '+numberFormat(800000), value: 800000 },
        { text: 'Gs. '+numberFormat(900000), value: 900000 },
        { text: 'Gs. '+numberFormat(1000000), value: 1000000 },
        { text: 'Gs. '+numberFormat(1100000), value: 1100000 },
        { text: 'Gs. '+numberFormat(1200000), value: 1200000 },
        { text: 'Gs. '+numberFormat(1300000), value: 1300000 },
        { text: 'Gs. '+numberFormat(1400000), value: 1400000 },

      ]
      // Methods
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

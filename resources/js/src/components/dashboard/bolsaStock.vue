<template>
  <div>
    <div class="q-px-md">
      <div class="text_titleP">Acciones de Woz Paraguay Holding</div>
      <div class="text_subtitleP q-mb-sm">
        Puedes comprar acciones de Woz
      </div>
    </div>
    <div class="row q-px-xs q-mb-md">
      <div class="actionP col-4" v-for="(item, index) in plansInfo" :key="index">
        <div class="w-full actionsContainer">
          <div class="w-full text-white text-header_i" :class="'bg-'+item.color">
            {{ item.headerTitle }}
          </div>
          <div class="infoSectionP q-px-sm">
            <div>
              <div class="flex items-center">
                <div class="titleComapnyP">{{ item.company }}</div>
                <q-icon
                  :name="icons.sharpVerified"
                  size="1rem"
                  color="terciary"
                  class="q-pl-xs"
                />
              </div>
              <div class="labelName">{{ item.label }}</div>
            </div>
            <div class="flex items-center w-full justify-between">
              <div class="text-priceP">
                GS. {{ numberFormat(item.price) }}
              </div>
              <div class="text-badgeP ">
                +3%
              </div>
            </div>
            <div class="text_opt">
              Compra disponible en acciones
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
  import sadFace from '@/assets/images/sadFace.svg'
  import { useLoanStore } from '@/services/store/loan.store';
  import { colors, useQuasar } from 'quasar';
  import { useRouter } from 'vue-router'
  import wozIcons from '@/assets/icons/wozIcons';

  export default {
    setup() {
      const q = useQuasar()
      const user = useAuthStore().user;
      const icons = inject('ionIcons')
      const numberFormat = util.numberFormat
      const plansInfo = [
        {
          headerTitle: 'Corporativo',
          company: 'Woz Paraguay',
          label: 'Empresa',
          price: 845670,
          color: 'blueDeep',
        },
        {
          headerTitle: 'Comercio electronico',
          company: 'Woz Dropshipping',
          label: 'Empresa',
          price: 45670,
          color:'blueSky',
        },
        {
          headerTitle: 'Comercio electronico',
          company: 'Woz Marketplace',
          label: 'Empresa',
          price: 45670,
          color: 'greenLight'
        }
        
      ]
      onMounted(() => {
      })
      // Data
      return{
        plansInfo,
        icons,
        wozIcons,
        numberFormat,
      }
    },
  }

</script>
<style>
  .text_opt{
    color: darkgray;
    font-size: 62%;
    margin:0.2rem 0px;
    line-height: 1.1;
  }
  .text-badgeP{
    font-weight: 400;
    color: #19cd15;
    font-size: 0.6rem;
  }
  .text-priceP{
    font-weight: 600;
    padding-top:0.15rem 
  }
  .titleComapnyP{
    font-size: 70%;
    color: black;
    font-weight: 600;
  }
  .labelName{
    font-size: 65%;
    color: rgb(110, 110, 110);
  }
  .infoSectionP{
    padding-top:0.2rem ;
    border: 1px solid lightgray;
    border-bottom-left-radius: 0.4rem;
    border-bottom-right-radius: 0.4rem;

  }
  .text_titleP{
    color: black;
    font-weight: 500;
  }
  .text_subtitleP{
    color: #225ffa;
    font-size: 0.7rem;
    font-weight: 500;
  }
  .actionP{
    padding: 0px 0.1rem;
  }
  .text-header_i{
    font-size: 0.5rem;
    font-weight: 500;
    padding: 0.25rem 0.5rem;
  }
  .bg-blueDeep{
    background: #0c3846;
  }
  .bg-blueSky{
    background: #0449fa;
  }
  .bg-greenLight{
    background: #19cd15;
  }
  .actionsContainer{
    border-radius: 0.4rem;
    overflow: hidden;
  }
</style>
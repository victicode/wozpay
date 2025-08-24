<template>
  <div class="bg-white q-py-lg q-mt-sm ">
    <div style="background: #f7f7f7;" class="q-py-lg q-px-md">
      <div class="sectionTitle3">
        ¿Que dicen <br>nuestros clientes?
      </div>
      <div class="q-mt-md">
        <div class="opinionContainer q-pa-md">
          <div class="q-pb-sm q-pt-sm" style="border-bottom: 2px solid #0269ff;">
            <q-icon style="margin-left: -0.31rem; margin-top: -0.2rem;" :name="icons.raiting" color="sectionActive" size="2.5rem" v-for="i in 5" :key="i" />
          </div>
          <div class="q-mt-sm flex items-start" style="flex-wrap: nowrap;">
            <div class="aconniic">“</div>
            <div class="q-ml-sm opinionText q-pt-md">

              Mejoramos las ventas de
              nuestros catálogos, proceso
              lento pero con buenos resultados
              a largo plazo.
            </div>
          </div>
          <div class="text-right q-mt-lg">
            <div class="opinionAutor">Araceli Rivas</div>
            <div class="opinionAutorType">Proveedor Mayorista</div>
          </div>

        </div>
      </div>
      <div class="q-mt-lg q-pt-sm" >
        <div class=" q-pt-md " style="border-top: 1px solid lightgray;">
          <div class="flex justify-between  items-end q-px-sm">
            <div class="autorName q-pl-xs">
              Tienda G Store
            </div>
            <div class="dateOpinion text-grey-7 q-pr-xs">
              Abril 04 - 2025
            </div>
          </div>
          <div class="flex items-center opinionContainer2 q-pa-md q-mt-sm" style="flex-wrap: nowrap;">
            <div class="aconniic2">“</div>
            <div class="q-mr-md q-ml-sm textOpinion2 ">
              La inversión es la mejor manera de
              salir adelante con trabajo del equipo
              y la atención
            </div>
            <div class="flex" style="flex-wrap: nowrap;">
              <q-icon style="margin-left: -0.41rem; margin-top: -0.2rem;" :name="icons.raiting" color="sectionActive" size="1.5rem" v-for="i in 5" :key="i" />

            </div>
          </div>
          <div class="likedText text-grey-6 q-ml-sm">
            A 459 personas les sirvió esta opinión
          </div>
        </div>
        <div class=" q-pt-md " style="border-top: 1px solid lightgray;">
          <div class="flex justify-between  items-end q-px-sm">
            <div class="autorName q-pl-xs">
              Rubi Accesorios
            </div>
            <div class="dateOpinion text-grey-7 q-pr-xs">
              Junio 17 - 2023
            </div>
          </div>
          <div class="flex items-center opinionContainer2 q-pa-md q-mt-sm" style="flex-wrap: nowrap;">
            <div class="aconniic2">“</div>
            <div class="q-mr-md q-ml-sm textOpinion2 ">
              La atención destacable y los cursos
              gratuitos de Dropshipping
            </div>
            <div class="flex" style="flex-wrap: nowrap;">
              <q-icon style="margin-left: -0.41rem; margin-top: -0.2rem;" :name="icons.raiting" color="sectionActive" size="1.5rem" v-for="i in 4" :key="i" />

            </div>
          </div>
          <div class="likedText text-grey-6 q-ml-sm">
            A 49 personas les sirvió esta opinión
          </div>
        </div>
      </div>

      
    </div>
    <div class="bg-primary q-px-md q-py-xl flex flex-center">
        <q-btn color="sectionActive" unelevated="" no-caps style="border-radius: 0.888rem;" @click="router.push('/login')">
          <div class="q-py-md q-px-md" style="font-size: 1.0rem;">
            Registrate para ver todas las opiniones 
          </div>
        </q-btn>
    </div>
  </div>
</template>
<script>
import { useCategorieStore } from '@/services/store/categorie.store';
import { onMounted, ref } from 'vue';
import utils from '@/util/numberUtil';
import { useRouter } from 'vue-router';


export default {
  setup () {
      //vue provider
    const icons = inject('ionIcons')
    const numberFormat = utils.numberFormat
    const router = useRouter()
    
    return {
      icons,
      router,
    }
  }
}
</script>
<style lang="scss">
.textOpinion2{
  font-size: 0.8rem;
  font-weight: 500;
  font-style: italic;
}
.likedText{
  font-size: 0.8rem;

}
.autorName{
  font-weight: 900;
  font-size: 1.05rem;
}
.dateOpinion{
  font-weight: 500;
  font-size: 0.8rem;
}
.opinionText{
  font-size: 1.13rem;
  font-weight: 500;
}
.aconniic{
  font-size: 4rem;
  color: $primary;
  font-weight: 900;
}
.aconniic2{
  font-size: 2rem;
  color: $primary;
  font-weight: 900;
}
.opinionContainer2{

  background: white;
  border-radius: 1.4rem;
}
.opinionContainer{
  border: 1px solid $primary;
  background: white;
  border-radius: 1.88rem;
}
.sectionTitle3{
  font-size: 2rem;
  font-weight: 900;
}
.opinionAutor{
  font-size: 1.2rem;
  font-weight: 900;
}
.opinionAutorType{
  font-size: .99rem;
  font-weight: 500;
  color: $primary;
}
</style>
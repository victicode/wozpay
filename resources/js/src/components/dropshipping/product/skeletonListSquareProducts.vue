<template>
  <q-item style="max-width: 100%" class="items-start">
    <q-skeleton height="6rem" width="6rem" square style="border-radius: 1rem;" />
    <q-item-section class="q-ml-sm">
      <q-item-label>
        <q-skeleton type="text" height="1.1rem" />
      </q-item-label>
      <q-item-label>
        <q-skeleton type="text" height="1rem"  width="55%" />
      </q-item-label>
      <q-item-label>
        <q-skeleton type="text" width="75%" height="1rem" />
      </q-item-label>
      <q-item-label caption>
        <q-skeleton type="text" width="75%" height="1rem"/>
      </q-item-label>
      <div class="flex q-mt-xs">
        <q-skeleton type="circle" class="q-mr-xs" height="1.2rem" width="1.2rem" v-for="i in 5" :key="i"/>
      </div>
    </q-item-section>
  </q-item>
</template>
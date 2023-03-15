<template>
  <q-layout view="lHh Lpr lFf" class="img-background bg-grey-1" >
   <q-page-container class="container-fluid">
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import { onMounted } from 'vue'

export default {
  setup() {
    onMounted(() => {
      //console.log('[LayEmpty] onMounted route.meta =', {...route})
    })
  }
}
</script>

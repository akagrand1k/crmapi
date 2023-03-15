<template>
<br/>
<div class="q-ml-sm"><strong>Список доступных страниц</strong></div>
  <q-list bordered separator class="bg-white q-ma-sm">
    <q-item v-for="(route, idx) of routes" :key="idx" clickable v-ripple exact>
      <q-item-section>
        <q-item-label>{{route.meta.title||route.name}}</q-item-label>
        <q-item-label caption>{{route.path}}</q-item-label>
      </q-item-section>
    </q-item>
  </q-list>
</template>

<script>
import { useRouter} from 'vue-router'

export default {
  setup() {
    const router = useRouter()

    return {
      routes: router.getRoutes()
    }
  }
}
</script>
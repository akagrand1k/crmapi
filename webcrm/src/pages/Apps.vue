<template>
<div class="q-pa-md" style="max-width: 600px;">
  <q-list bordered class="bg-white">

    <q-toolbar class="bg-primary text-white shadow-2">
      <q-toolbar-title>Модули</q-toolbar-title>
    </q-toolbar>

    <app-btn v-for="(app, idx) of apps" :key="idx" :app=app />

  </q-list>
</div>
</template>

<script>
import { computed } from 'vue'
import { useStore } from 'vuex'

import AppBtn from '@/components/AppBtn.vue'

export default {

  components: { AppBtn },

  setup () {
    const store = useStore()
    const apps = computed(() => store.getters['app/apps'])

    return {
      apps
    }
  }
}
</script>
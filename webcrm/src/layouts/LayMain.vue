<template>
  <div class="crm-page bg-blue-grey-2" style="padding-left: 3.5rem; min-height: 100vh;">
    <router-view/>
  </div>
  <nav-bar />
</template>

<script>
import NavBar from '@/layouts/NbMenu.vue'

export default {
  components: { NavBar },
  setup() {

  }
}
</script>


<template>

  <nb-slide />
  
  <div class="crm-nav bg-white">
    <q-list>

      <q-item clickable v-ripple style="padding: 0;" :to="{name: 'Home'}" exact>
        <q-item-section avatar>
          <q-img :src="userAvatar" style="width: 57px" />
        </q-item-section>
      </q-item>

      <nb-btn v-for="(app, idx) of apps" :key="idx" :item=app />
      
      <q-item :to="{name: 'Apps'}" :class=active.value clickable v-ripple exact>
        <q-item-section avatar>
          <q-icon name="extension"></q-icon>
          <div class="crm-nb-btn">Модули</div>
        </q-item-section>
      </q-item>

    </q-list>
  </div>
</template>

<script>
import { computed } from 'vue'
import { useStore } from 'vuex'
import { useRoute } from 'vue-router'

import useNavBarSlide from '@/models/navbar-slide.js'
import NbSlide from './NbSlide.vue'
import NbBtn from './NbBtn.vue'

export default {

  components: { NbSlide, NbBtn },

  setup() {
    const store = useStore()
    const route = useRoute()

    const slide = useNavBarSlide()
    const apps = computed(() => store.getters['app/apps'])

    return {
      userAvatar: '/avatar.png',
      active: computed(() => route.name == 'apps' ? 'q-router-link--active' : ''),
      apps,
      slide
    }
    
  }
}
</script>

<style>
  .crm-nav {
    top:0;left:0; position: fixed; min-height: 100vh; 
    width: 3.5rem; border-right:1px solid grey;
    box-shadow: 1px 0 2px rgb(0 255 0 / 10%);
  }
</style>
<template>

  <q-item v-if="app.menu" @click="itemClick" :class=config.active.value clickable v-ripple exact>
    <q-item-section avatar>
      <q-icon :name=item.config.meta.icon><!--
        <q-tooltip class="bg-white text-black shadow-3" :delay="1000">
          <strong>{{item.meta.title||item.name}}</strong>
          <div>{{config.tip}}</div>
        </q-tooltip>-->
      </q-icon>
      <div class="crm-nb-btn">{{item.config.meta.title||item.config.name}}</div>
    </q-item-section>
  </q-item>
</template>

<style>
  .crm-nb-btn { font-size: 8px;text-align: center; width: 48px; left: 0; margin-left: -12px;}
</style>

<script>
import { computed } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import { useStore } from 'vuex'

export default {

  props: {
    item: Object
  },

  setup(props) {

    //console.log('props.item.config', props.item.config, 'props.item.config.value', props.item.config.value)
    const app = props.item
    const cnf = props.item.config

    const router = useRouter()
    const route = useRoute()
    const store = useStore()
    const config = {
      type: cnf.meta && cnf.meta.menu ? cnf.meta.menu.type : 'btn',
      active: computed(() => cnf.name == route.name ? 'q-router-link--active' : '')
    }

    function itemClick() {
      //console.log('[NbBtn] click', cnf, config)
      store.commit('navbar/hide')
      if (config.type == 'btn') {
        //console.log('[NbBtn] routes = ', router.getRoutes())
        router.push({name: cnf.name})
      } else {
        store.commit('navbar/items', cnf.meta.menu.items)
      }
    }

    return {
      app,
      config,
      itemClick
    }
  }
}
</script>
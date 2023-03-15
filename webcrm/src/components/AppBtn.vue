<template>
  <q-item>
    <q-item-section>
      <q-item-label>{{app.name}}</q-item-label>
      <q-item-label caption>Какое-то описание</q-item-label>
    </q-item-section>
    <q-item-section side >
      <q-toggle color="blue" v-model="menu" />
    </q-item-section>
  </q-item>
</template>

<script>
import { computed } from 'vue'
import { useStore } from 'vuex'

export default {
  props: { app: Object },
  setup(props) {
    const store = useStore()
    // console.log('[AppBtn] props', props.app.slug, props.app.menu)

    const menu = computed({
      get:() => props.app.menu ? true : false,
      set:(value) => {
        props.app.menu = value
        console.log('[AppBtn]',props.app.slug,'invisible.set', props.app.menu)
        store.dispatch('app/menu', {'slug': props.app.slug, 'menu': value})
      }
    })

    return {
      menu
    }
  }
}
</script>
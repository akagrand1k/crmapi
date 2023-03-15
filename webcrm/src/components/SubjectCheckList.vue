<template>
  <q-list v-if="options" class="bg-white" bordered separator>
    <q-item
      clickable
      v-ripple
      v-for="opt of options" :key="opt.id"
    >
      <subject-check-list-box 
        :value="subjects.findIndex(sbj => sbj.id == opt.id) == -1 ? false : true" 
        @attach="$emit('attach', opt)"
        @detach="$emit('detach', opt)"
      />
      <q-item-section>{{ opt.name }}</q-item-section>
    </q-item>
  </q-list>

  <q-inner-loading v-else showing style="height: 70vh;">
    <q-spinner-gears size="50px" color="primary" />
  </q-inner-loading>
</template>

<script>
import { ref } from 'vue'
import { useStore } from 'vuex'
import SubjectCheckListBox from './SubjectCheckListBox.vue'

export default {
  components: { SubjectCheckListBox },
  props: ['subjects'],
  emits: ['attach', 'detach'],

  setup() 
  {
    //console.log('props', props)
    const store = useStore()
    const options = ref(null)

    store.dispatch('subject/all').then((subjects)=>{
      //console.log('s resp', resp)
      options.value = subjects
    })

    return {
      options,
    }
  },
}
</script>

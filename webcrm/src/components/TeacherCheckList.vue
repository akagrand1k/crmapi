<template>
  <q-list v-if="options" class="bg-white" bordered separator>
    <q-item
      v-ripple
      v-for="opt of options" :key="opt.id"
    >
      <teacher-check-list-box 
        :value="teachers.findIndex(tchr => tchr.id == opt.id) == -1 ? false : true" 
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
import api from '@/lib/api.js'
import { ref } from 'vue'
// import { useStore } from 'vuex'
import TeacherCheckListBox from './TeacherCheckListBox.vue'

export default {
  components: { TeacherCheckListBox },
  props: ['teachers'],
  emits: ['attach', 'detach'],

  setup() 
  {
    //console.log('props', props)
    // const store = useStore()
    const options = ref(null)

    api.trans('/teachers',).then((resp) => {
      resp.data.map(tchr => {tchr.name = `${tchr.lastname} ${tchr.firstname} ${tchr.middlename}`})
      options.value = resp.data.sortBy('lastname', 'firstname')
    })

    return {
      options,
    }
  },
}
</script>

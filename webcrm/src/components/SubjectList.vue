<template>
  <q-btn 
    class   = "q-mb-sm"
    color   = "primary" 
    label   = "Предмет" 
    icon    = "add_circle_outline" 
    @click  = "addItem" 
  />

  <q-list class="bg-white" bordered separator>
    <q-item
      class="crm-show-side-on-hover"
      clickable
      v-ripple
      v-for="subject of subjects" 
      :key="subject.id"
    >
      <q-item-section @click="$emit('select', subject)">{{ subject.name }} ({{ subject.duration }} ч)</q-item-section>
      <q-item-section side>
        <q-btn flat round color="grey" icon="delete_forever" @click="remove(subject)" />
      </q-item-section>
    </q-item>
  </q-list>

  <q-inner-loading v-if="!subjects" showing style="height: 70vh;">
    <q-spinner-gears size="50px" color="primary" />
  </q-inner-loading>
</template>

<script>
// import api from '@/lib/api.js'
import { ref } from 'vue'
import { useStore } from 'vuex'

export default {
  emits: ['select', 'deleted'],

  setup(props, {emit}) 
  {
    //console.log('props', props)
    const store = useStore()
    const subjects = ref(null)

    store.dispatch('subject/all').then((resp)=>{
      subjects.value = resp
    })
    /* api.trans('/subjects', { teacher_id: props.teacher.id }).then((resp) => {
        subjects.value = resp.data
      }) */

    return {
      subjects,
      addItem() {
        store.dispatch('subject/create').then((subject)=>{
          emit('select', subject)
        })
      },
      remove(subject){
        //console.log('remove', subject)
        emit('deleted', subject)
        store.dispatch('subject/delete', subject.id).then()
      }
    }
  },
}
</script>

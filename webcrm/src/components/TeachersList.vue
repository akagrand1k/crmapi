<template>
  <q-btn 
    class   = "q-mb-sm"
    color   = "primary" 
    label   = "Преподаватель" 
    icon    = "add_circle_outline" 
    @click  = "addItem" 
  />

  <q-list bordered separator class="bg-white">
    <q-item
      class="crm-show-side-on-hover"
      clickable
      v-ripple
      v-for="teacher of teachers"
      :key="teacher.id"
    >
      <q-item-section @click="$emit('select', teacher)">{{ name(teacher) }}</q-item-section>
      <q-item-section side>
        <q-btn flat round color="grey" icon="delete_forever" @click="remove" />
      </q-item-section>
    </q-item>
  </q-list>
  
  <q-inner-loading v-if="!teachers" showing style="height: 70vh;">
    <q-spinner-gears size="50px" color="primary" />
  </q-inner-loading>
</template>

<script>
import api from '@/lib/api.js'
import filter_name from '@/filters/name.filter'
import { ref } from 'vue'

export default {
  props: ['sortBy'],
  emits: ['select'],

  setup(props) {
    //console.log('sortBy', props)
    const name = filter_name
    const teachers = ref(null)

    api.trans('teachers',{}).then((resp) => {
      teachers.value = props.sortBy ? resp.data.sortBy(...props.sortBy) : resp.data
    })

    return {
      teachers,
      name,
      
      addItem() {

      },
      remove() {

      }
    }
  },
}
</script>

<template>

  <q-list v-if="students" class="bg-white" bordered separator>
    <q-toolbar class="bg-grey-3">
      <q-toolbar-title>Студенты</q-toolbar-title>
    </q-toolbar>
    
    <q-item
      v-for="student of students" :key="student.id"
    >
      <q-item-section>{{ name(student) }}</q-item-section>
    </q-item>
  </q-list>

  <q-inner-loading v-else showing style="height: 70vh;">
    <q-spinner-gears size="50px" color="primary" />
  </q-inner-loading>
</template>

<script>
import api from '@/lib/api.js'
import filter_name from '@/filters/name.filter'
import { ref } from 'vue'

export default {
  components: { },
  props: ['gang', 'sortBy'],

  setup(props) 
  {
    const name = filter_name
    const students = ref(null)

    api.trans('/gangs', { gang_id: props.gang.id }).then((resp) => {
      students.value = props.sortBy ? resp.data.sortBy(...props.sortBy) : resp.data
    })

    return {
      name,
      students,

      attach(student) {
        api.trans('/gangs/attach-student', { 
          gang_id: props.gang.id,
          student_id: student.id
        }).then((resp) => {
          students.value.push(resp.data)
          if(props.sortBy){
            students.value.sortBy(...props.sortBy)
          }
        })
      },

      detach(student) {
        api.trans('/gangs/detach-student', { 
          gang_id: props.gang.id,
          student_id: student.id
        }).then((resp) => {
          students.value.push(resp.data)
          if(props.sortBy){
            students.value.splice(students.value.findIndex(user => user.id == resp.data.id), 1)
          }
        })
      }
    }
  },
}
</script>

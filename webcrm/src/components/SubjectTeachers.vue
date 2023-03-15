<template>

  <q-list v-if="teachers" class="bg-white" bordered separator>
    <q-toolbar class="bg-grey-3">
      <q-toolbar-title>Преподаватели</q-toolbar-title>
      <q-btn flat round dense icon="edit" @click="showModal" />
    </q-toolbar>
    
    <q-item
      v-for="teacher of teachers" :key="teacher.id"
    >
      <q-item-section>{{ name(teacher) }}</q-item-section>
      <!-- <q-item-section>{{ teacher.lastname }}</q-item-section> -->
    </q-item>
  </q-list>

  <q-inner-loading v-else showing style="height: 70vh;">
    <q-spinner-gears size="50px" color="primary" />
  </q-inner-loading>

  <q-dialog v-model="modalDialog" persistent>
    <q-card>
      <q-bar class="bg-primary text-white">
        <q-icon name="add_circle_outline" />
        <div>Добавление предмета</div>
        <q-space />
        <q-btn dense flat icon="close" v-close-popup />
      </q-bar>

      <q-card-section style="max-height: 80vh" class="scroll">
        <teacher-check-list :teachers="teachers" @attach="attach" @detach="detach" />
      </q-card-section>
      <!-- <q-card-section class="q-pt-none"> -->
    </q-card>
  </q-dialog>

</template>

<script>
import api from '@/lib/api.js'
import filter_name from '@/filters/name.filter'
import { ref } from 'vue'
import { useStore } from 'vuex'
import TeacherCheckList from './TeacherCheckList.vue'

export default {
  components: { TeacherCheckList },
  props: ['subject', 'sortBy'],

  setup(props,) 
  {
    const store = useStore()
    const name = filter_name
    const teachers = ref(null)
    const modalDialog = ref(false)

    api.trans('/teachers', { subject_id: props.subject.id }).then((resp) => {
      teachers.value = props.sortBy ? resp.data.sortBy(...props.sortBy) : resp.data
    })

    return {
      name,
      teachers,
      modalDialog,
      showModal() {
        modalDialog.value = true
      },
      attach(teacher) {
        store.dispatch('subject/attachTeacher', {
          teacher_id: teacher.id, subject_id: props.subject.id
        }).then((resp)=>{
          teachers.value.push(resp.data)
          if(props.sortBy){
            teachers.value.sortBy(...props.sortBy)
          } 
        })
      },
      detach(teacher) {
        store.dispatch('subject/detachTeacher', {
          teacher_id: teacher.id, subject_id: props.subject.id
        }).then((resp)=>{
          // console.log('resp', resp)
          teachers.value.splice(teachers.value.findIndex(user => user.id == resp.data.id), 1)
        })
      }
    }
  },
}
</script>

<template>

  <q-list v-if="subjects" class="bg-white" bordered separator>
    <q-toolbar class="bg-grey-3">
      <q-toolbar-title>Предметы</q-toolbar-title>
      <q-btn flat round dense icon="edit" @click="showModal" />
    </q-toolbar>
    
    <q-item
      clickable
      v-ripple
      v-for="subject of subjects" :key="subject.id"
    >
      <q-item-section>{{ subject.name }}</q-item-section>
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

      <q-card-section>
        <subject-check-list :subjects="subjects" @attach="attach" @detach="detach" />
      </q-card-section>
      <!-- <q-card-section class="q-pt-none"> -->
    </q-card>
  </q-dialog>

</template>

<script>
import api from '@/lib/api.js'
import { ref } from 'vue'
import { useStore } from 'vuex'
import SubjectCheckList from './SubjectCheckList.vue'


export default {
  components: { SubjectCheckList },

  props: ['teacher'],

  setup(props, {emit}) 
  {
    //console.log('props', props)
    const store = useStore()
    const subjects = ref(null)
    const modalDialog = ref(false)

    api.trans('/subjects', { teacher_id: props.teacher.id }).then((resp) => {
      subjects.value = resp.data.sortBy('name')
    })

    return {
      subjects,
      modalDialog,
      showModal() {
        modalDialog.value = true
      },
      attach(subject) {
        store.dispatch('subject/attachTeacher', {
          subject_id: subject.id, teacher_id: props.teacher.id
        }).then((resp)=>{
          // console.log('attachTeacher resp', resp)
          subjects.value.push(resp.data)
          subjects.value.sortBy('name')
        })
      },
      detach(subject) {
        store.dispatch('subject/detachTeacher', {
          subject_id: subject.id, teacher_id: props.teacher.id
        }).then((resp)=>{
          // console.log('detachTeacher resp', resp)
          subjects.value.splice(subjects.value.findIndex(sbj => sbj.id == resp.data.id), 1)
        })
      }
    }
  },
}
</script>

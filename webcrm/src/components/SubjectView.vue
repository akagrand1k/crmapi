<template>
  <q-card bordered style="min-height: 90vh;">
    <q-card-section>
      <div class="text-h6">
        <hot-edit :data="subject" field="name" dispatch="subject/patch" />
      </div>
    </q-card-section>

    <q-separator />

    <q-card-section class="q-pa-sm">
      <subject-teachers :subject="subject" :sortBy="['lastname','firstname']" />
    </q-card-section>
  </q-card>
</template>

<script>
import api from '@/lib/api.js'
import { ref } from 'vue'
import { useStore } from 'vuex'
import HotEdit from '@/components/HotEdit.vue'
import SubjectTeachers from './SubjectTeachers.vue'

export default {
  components: { HotEdit, SubjectTeachers },
  props: ['subject'],

  setup(props) {
    const store = useStore()

    return {
      name(teacher) {
        return `${teacher.lastname} ${teacher.firstname} ${teacher.middlename}`
      },
      addItem() {
        
      },
      remove() {
        store.dispatch('subject/delete', props.subject.id)
      }
    }
  },
}
</script>

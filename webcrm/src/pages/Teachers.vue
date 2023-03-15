<template>
  <q-splitter v-model="splitterModel" :limits="[33, 99]" style="height: 100vh" >
    <template v-slot:before>
      <div class="q-pa-sm q-pr-md">
        <teachers-list @select="showView" :sort-by="['lastname','firstname']" />
      </div>
    </template>
    <template v-slot:after>
      <div class="q-pa-sm">
        <teacher-view v-if="teacher" :teacher="teacher" :key="teacher.id" />
      </div>
    </template>
  </q-splitter>
</template>

<script>
import { ref } from 'vue'
import TeachersList from '@/components/TeachersList.vue'
import TeacherView from '@/components/TeacherView.vue'

export default {
  components: { TeachersList, TeacherView },
  setup() {

    const splitterModel = ref(50)
    const teacher = ref(null);

    return {
      splitterModel,
      teacher,

      showView(user) {
        teacher.value = user
        splitterModel.value = 50
        // console.log('[Course] clickCourse = ', subject)
      }
    }
    
  },
}
</script>
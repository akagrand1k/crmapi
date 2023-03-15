<template>
  <q-card bordered style="min-height: 90vh;">
    <q-card-section>
      <div class="text-h6">
        <hot-edit :data="teacher" field="lastname" dispatch="teacher/patch" />
        <hot-edit :data="teacher" field="firstname" dispatch="teacher/patch" />
        <hot-edit :data="teacher" field="middlename" dispatch="teacher/patch" />
      </div>
    </q-card-section>
  <q-separator />
    <q-card-section>
      <teacher-subjects :teacher="teacher" />
    </q-card-section>
  <q-separator />
    <q-card-section>
      Группы
    </q-card-section>
  <q-separator />
    <q-card-section>
      Индивидуальные
    </q-card-section>
  <q-separator />
    <q-card-section>
      Замены
    </q-card-section>    
  </q-card>
</template>

<script>
import HotEdit from './HotEdit.vue'
import TeacherSubjects from './TeacherSubjects.vue'

export default {
  components: { HotEdit, TeacherSubjects },
  props: ['teacher'],

  setup() {
    return {

    }
  }
}
</script>

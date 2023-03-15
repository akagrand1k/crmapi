<template>
  <q-card bordered style="min-height: 90vh;">
    <q-card-section>
      <div class="text-h6">
        <hot-edit :data="gang" field="name" api="gangs/patch" />
      </div>
    </q-card-section>

    <q-separator />

    <q-card-section class="q-pa-sm">
      <gang-students :gang="gang" :sortBy="['lastname','firstname']" />
    </q-card-section>
  </q-card>
</template>

<script>
import HotEdit from '@/components/HotEdit.vue'
import GangStudents from './GangStudents.vue'

export default {
  components: { HotEdit, GangStudents },
  props: ['gang'],

  setup(props) {
    return {
    }
  },
}
</script>

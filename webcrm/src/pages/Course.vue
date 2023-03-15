<template>
  <q-splitter v-model="splitterModel" :limits="[33, 99]" style="height: 100vh" >
    <template v-slot:before>
      <div class="q-pa-sm">
        <subject-list @select = "showView" @deleted = "hideView" />
      </div>
    </template>
    <template v-slot:after>
      <div class="q-pa-sm">
        <subject-view v-if="subject" :subject="subject" :key="subject.id" />
      </div>
    </template>
  </q-splitter>
</template>

<script>
import { ref } from 'vue'
import SubjectList from '@/components/SubjectList.vue'
import SubjectView from '@/components/SubjectView.vue'

export default {
  components: { SubjectView, SubjectList },
  setup() {

    const splitterModel = ref(50)
    const subject = ref(null);
  
    return {
      splitterModel,
      subject,
      showView(subj) {
        if(subj) {     
          subject.value = subj
          splitterModel.value = 50
        }
        // console.log('[Course] clickCourse = ', subject)
      },
      hideView(subj){
        //console.log('subj', subj, 'subject', subject);
        if(subject.id == subj.id){
          subject.value = null
        }
      }
    }
    
  },
}
</script>
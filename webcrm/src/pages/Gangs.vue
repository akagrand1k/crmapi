<template>
  <q-splitter v-model="splitterModel" :limits="[33, 99]" style="height: 100vh" >
    <template v-slot:before>
      <div class="q-pa-sm">
        <gang-list @select = "showView" @deleted = "hideView" />
      </div>
    </template>
    <template v-slot:after>
      <div class="q-pa-sm">
        <gang-view v-if="gang" :gang="gang" :key="gang.id" />
      </div>
    </template>
  </q-splitter>
</template>

<script>
import { ref } from 'vue'
import GangList from '@/components/GangList.vue'
import GangView from '@/components/GangView.vue'

export default {
  components: { GangView, GangList },
  setup() {

    const splitterModel = ref(50)
    const gang = ref(null);
  
    return {
      splitterModel,
      gang,
      showView(g) {
        if(g) {     
          gang.value = g
          splitterModel.value = 50
        }
      },
      hideView(g){
        if(gang.id == g.id){
          gang.value = null
        }
      }
    }
    
  },
}
</script>
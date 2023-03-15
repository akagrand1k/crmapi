<template>
  <div v-if="roles" class="q-pa-md">

    <q-select
      label="Выберите роль"
      v-model="curRole"
      emit-value
      :options="roles"
      :option-label="opt => Object(opt) === opt && 'name' in opt ? opt.name : ''"
    />
    
    <div v-if="curRole" :key="curRole">

      <q-markup-table separator="horizontal" flat bordered>
        <thead>
          <tr>
            <th>Модуль</th>
            <th>Права</th>
            <th>Доступ</th>
          </tr>
        </thead>
        <tbody>
          <perm-tr v-for="(app, idx) of apps" :key="idx" :app=app :role=curRole />
        </tbody>
      </q-markup-table>

    </div>

  </div>
</template>

<script>
import { ref } from 'vue'
import { useStore } from 'vuex'

import PermTr from '@/components/PermTr.vue'

export default {
  components: {PermTr},
  setup () {
    
    const store = useStore()

    const curRole = ref(null)
  
    let apps = ref([])
    let roles = ref(null)

    store.dispatch('perm/perms').then((resp) => {
      //console.log('[Roles] resp = ', resp)
      apps.value = resp.apps     
      roles.value = resp.roles
    })

    return {
      curRole,
      apps,
      roles,
      changeRoles(v){
        //console.log('[Roles] changeRoles =', v)
        curRole.value = v
      }
    }
  }
}
</script>

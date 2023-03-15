<template>

  <tr v-for="(perm, idx) of app.perms" :key="idx" class="q-tr--no-hover">

    <td v-if="app.perms.length>1 && idx == 0" :rowspan=app.perms.length >
      <strong>{{app.name}}</strong>
    </td>

    <td v-else-if="app.perms.length < 2">
      <strong>{{app.name}}</strong>
    </td>

    <perm-td :perm=perm :role=role />

  </tr>

</template>

<script>
import PermTd from './PermTd.vue'

export default {
  components: {PermTd},
  props:['app', 'role'],
  setup(){
  }
}
</script>
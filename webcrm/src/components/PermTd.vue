<template>
    <td>{{perm.name}}</td>
    <td><q-toggle color="blue" v-model="val" /></td>
</template>

<script>
import { ref, watch} from 'vue'
import { useStore } from 'vuex'

export default {
  props:['perm', 'role'],
  setup(props){

    const store = useStore()

    const val = ref(
      props.role.perms.some(perm => {
        if(props.perm.id === perm.id){
          //console.log('[PermTd.getMenu]', props.perm, ' =', perm)
          return true
        }
      })
    )

    watch(val, (nV, pV) => {
      //console.log('[PermTd.menu.set] perm =', props.perm, 'props.role.perms =', props.role.perms)
      if(nV === true) {
        props.role.perms.push(props.perm)
      }else {
        props.role.perms = props.role.perms.filter(perm => {
          return perm.id != props.perm.id
        })
      }
      const apps = store.getters['perm/appsById']
      store.dispatch('perm/sync', {
        app: apps[props.perm.app_id].slug,
        perm: props.perm.slug,
        role: props.role.slug,
        val: nV
      })
    })

    return {
      val
    }
  }
}
</script>
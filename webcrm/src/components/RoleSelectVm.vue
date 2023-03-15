<template>
  <q-select
      label="Фильтр по ролям"
      use-chips
      dense
      multiple
      v-model="roles"
      emit-value
      map-options
      :options="options"
      :option-value="opt => Object(opt) === opt && 'slug' in opt ? opt.slug : null"
      :option-label="opt => Object(opt) === opt && 'name' in opt ? opt.name : ''"
      @filter="filterFn"
      @filter-abort="abortFilterFn"
    />
</template>

<script>
import { onMounted, ref, watch } from 'vue'
import { useStore } from 'vuex'

export default {

  props: {
    roles: {type: Array, default: []}
  },
  emits: ['update'],

  setup(props, { emit }) {

    const store = useStore()

    const roles = ref(props.roles)
    const options = ref(null)

    onMounted(() => {/*
      store.dispatch('role/list').then((resp)=>{
        options.value = resp
      })*/
    })

    watch(roles, (nV, pV) => {
      // console.log('[RoleSelect] emit', nV)
      emit('update', nV)
    })

    return {
      roles,
      options,

      filterFn (val, update, abort) {
        if (options.value !== null) {
          // already loaded
          update()
          return
        }
        store.dispatch('role/list').then((resp)=>{
          update(() => {
            options.value = resp
          })
        })
      },
      abortFilterFn () {
        // console.log('delayed filter aborted')
      } 
    }
  }
}
</script>
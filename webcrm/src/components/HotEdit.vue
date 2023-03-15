<template>
  <div style="border-bottom: 1px dashed grey;">
    {{ data[$attrs.field] }}
    <q-popup-edit 
      v-model="data[$attrs.field]" 
      v-slot="scope" 
      @save="save"
    >
      <q-input 
        v-model="scope.value" dense autofocus @keyup.enter="scope.set" 
        hint="'Enter' - сохранение, 'Esc' - выход"
        style="min-width: 175px;"
      />
    </q-popup-edit>
  </div>
</template>

<script>//@save="$emit('save', data)"
import api from '@/lib/api.js'
import { useStore } from 'vuex'

export default {
  props: ['data'],
  emits:['save'],
  
  inheritAttrs: false,

  setup(props, {emit, attrs}) {

    const store = useStore()
    const oV = props.data[attrs.field]
    //console.log('[HotEdit] oV = ', oV)

    return {
      save(nV) {
        if(nV === oV) return;
        //console.log('[HotEdit] save nV = ', nV, oV)
        const patch = {id: props.data.id, new:{}, old:{}}
        patch.new[attrs.field] = nV
        patch.old[attrs.field] = oV
        if (attrs.api) api.trans('gangs/patch', patch)
        else if (attrs.dispatch) store.dispatch(attrs.dispatch, patch)
        emit('save', patch)
      }
    }
  }
}
</script>
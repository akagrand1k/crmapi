<template>
  <q-item-section avatar>
    <q-checkbox v-model = "val" @update:model-value="change" />
  </q-item-section>
</template>

<script>
import { ref } from 'vue'

export default {
  props: ['value'],
  emits: ['attach', 'detach'],

  setup(props, {emit}) 
  {
    const val = ref(props.value)

    return {
      val,
      change(value){
       emit( value ? 'attach' : 'detach') 
      },
    }
  },
}
</script>

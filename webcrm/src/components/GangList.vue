<template>
  <q-btn 
    class   = "q-mb-sm"
    color   = "primary" 
    label   = "Группу" 
    icon    = "add_circle_outline" 
    @click  = "addItem" 
  />

  <q-list class="bg-white" bordered separator>
    <q-item
      class="crm-show-side-on-hover"
      clickable
      v-ripple
      v-for="gang of gangs" 
      :key="gang.id"
    >
      <q-item-section @click="$emit('select', gang)">{{ gang.name }}</q-item-section>
      <q-item-section side>
        <q-btn flat round color="grey" icon="delete_forever" @click="remove(gang)" />
      </q-item-section>
    </q-item>
  </q-list>

  <q-inner-loading v-if="!gangs" showing style="height: 70vh;">
    <q-spinner-gears size="50px" color="primary" />
  </q-inner-loading>
</template>

<script>
import api from '@/lib/api.js'
import { ref } from 'vue'

export default {
  emits: ['select', 'deleted'],

  setup(props, {emit}) 
  {
    //console.log('props', props)
    const gangs = ref(null)

    api.trans('gangs',{}).then((resp) => {
      gangs.value = resp.data
    })

    return {
      gangs,
      addItem() {
         api.trans('gangs/create').then((gang)=>{
          gangs.value.push(gang.data)
          emit('select', gang.data)
        })
      },
      remove(gang){
        console.log('remove Gang', gang.id)
        emit('deleted', gang)
        api.trans('gangs/delete', {id: gang.id}).then((resp)=>{
          gangs.value.splice(gangs.value.findIndex(g => g.id == gang.id), 1)
        })
      }
    }
  },
}
</script>

<template>
  {{ row[column] }}
  <q-popup-edit 
    v-model="row[column]" 
    v-slot="scope" 
    @save="$emit('save', {name:column, row})"
  >
    <q-input 
      v-model="scope.value" dense autofocus @keyup.enter="scope.set" 
      hint="'Enter' - сохранение, 'Esc' - выход"
      style="min-width: 195px;"
    />
  </q-popup-edit>
</template>

<script>
export default {
  props: ['row', 'column'],
  emits:['save'],
}
</script>
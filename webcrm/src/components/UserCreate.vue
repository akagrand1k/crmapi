<style>
.my-card label.q-field {
  width: 31%;
  display: inline-block;
}
</style>

<template>
  <div style="padding: 1rem;">
    <q-btn v-if="!showForm" color="primary" label="Добавить" @click="(showForm=true)" />
    <div v-else>
      <q-btn color="primary" label="Скрыть форму" @click="(showForm=false)" />
      <q-card class="my-card">
        <q-card-section>
          <user-form :init=init v-on:singuprespone="singUpRespone" />
        </q-card-section>
      </q-card>
    </div>
  </div>
</template>

<script>
import { reactive, ref, computed } from 'vue'
import UserForm from './UserForm.vue'

export default {
  components: { UserForm },
  props: {
    role: {
      type: String
    }
  },
  emits: ['usercreated'],
  setup(props, {emit}) {

    const showForm = ref(false)
    const init = computed(() => reactive({role: props.role})) 
/*
    watch(() => props.role, (first, second) => {
      // console.log("[UserTable.watch] props.role first:", first, 'second:', second)
      init.role = first
    })
*/
    const singUpRespone = (respone) => {
      console.log('[UserCreate.singUpRespone]')
      if (respone.status == 'success') {
        showForm.value = false
        emit('usercreated')
      }
    }

    return {
      showForm,
      init,
      singUpRespone
    }
  }
}
</script>
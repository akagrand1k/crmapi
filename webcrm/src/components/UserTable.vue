<template> 
  <q-table
    :columns="columns"
    :rows="rows"
    row-key="id"

    v-model:pagination="pagination"
    :loading="loading"
    @request="onRequest"

    v-model:selected="selected"
    :selected-rows-label="getSelectedString"
    selection="multiple"
  >
  <!-- binary-state-sort -->
    <template v-slot:body="props">
      <q-tr :props="props">
        <q-td>
          <q-checkbox v-model="props.selected"/>
        </q-td>
        <q-td key="name" :props="props">
          <span><td-popup-edit :row="props.row" :column="'lastname'" @save="patch" /></span>
          <span><td-popup-edit :row="props.row" :column="'firstname'" @save="patch" /></span>
          <span><td-popup-edit :row="props.row" :column="'middlename'" @save="patch" /></span>
        </q-td>
        <q-td key="phone" :props="props">
          <td-popup-edit :row="props.row" :column="'phone'" @save="patch" />
        </q-td>
        <q-td key="email" :props="props">
          <td-popup-edit :row="props.row" :column="'email'" @save="patch" />
        </q-td>
      </q-tr>
    </template>
  </q-table>
</template>

<script> 
import { computed, reactive, ref, onMounted, watch } from 'vue'
import { useStore } from 'vuex'

// TODO: Переделать на HotEdit 
import TdPopupEdit from '@/components/TdPopupEdit';

const columns = [
  { name: 'name',  label: 'ФИО', align: 'left', sortable: true },
  { name: 'phone', label: 'Телефон', field: 'phone' },
  { name: 'email', label: 'E-mail', field: 'email' },
]

export default {

  components: { TdPopupEdit },
  
  props: ['cnf'],
  emits: ['selected'],

  setup (props, { emit }) 
  {
    const store = useStore()
    const loading = ref(false)

    const selected = ref([])
    const rows = ref([])
    const pagination = ref({
      sortBy: 'name',
      descending: false,
      page: 1,
      rowsPerPage: 20,
      rowsNumber: 1
    })

    const filter = computed(() => props.cnf.filter)//ref('')
    const roles = computed(() => props.cnf.roles)//ref('')

    async function onRequest (data) {
      const { page, rowsPerPage, sortBy, descending } = data.pagination
      //const filter = data.filter

      loading.value = true

      const respone = await store.dispatch('user/list', {
        data: { roles: roles.value }, filter: filter.value,
        page, rowsPerPage, sortBy, descending
      })

      if (respone.status == 'success') {
        rows.value.splice(0, rows.value.length, ...respone.data.users)

        pagination.value.page = respone.data.page
        pagination.value.rowsPerPage = rowsPerPage

        pagination.value.rowsNumber = respone.data.total

        pagination.value.sortBy = sortBy
        pagination.value.descending = descending
      }
      loading.value = false
    }

    onMounted(() => {
      // get initial data from server (1st page)
      // onRequest1(props.role)
      // onRequest({
      //   pagination: pagination.value,
      //   filter: filter.value
      // })
    })
    watch([roles, filter], ([newA, newB], [prevA, prevB]) => {
      // console.log("[UserTable.watch] props.role first:", first, 'second:', second)
      // onRequest1(first)
      onRequest({
        pagination: pagination.value,
        //filter: filter.value
      })
    })
    watch(selected, (nV, oV) => {
      emit('selected', nV)
    })

    return {
      filter,
      loading,
      pagination,
      columns,
      rows,

      onRequest,

      selected,
      getSelectedString () {
        return selected.value.length === 0 ? '' : `${selected.value.length} record${selected.value.length > 1 ? 's' : ''} selected of ${rows.value.length}`
      },

      patch (data) {
        // TODO: Сохранение на сервер 
        console.log('data = ', data)
      } 
    }
  }
}
</script>
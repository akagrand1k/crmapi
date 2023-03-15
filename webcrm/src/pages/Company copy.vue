<template>
  <div class="q-mx-sm">
    <q-card>
      <q-card-section class="bg-primary text-white">
        <div class="row items-center no-wrap">
          <div class="col">
            <div class="text-h6">
              <hot-edit :data="company" field="name" dispatch="company/patch" @save="companyName" />
            </div>
          </div>
          <div class="col-auto">
            <q-btn label="Филиал" color="white" flat icon="add_circle_outline" @click="addNewFilial" />
          </div>
        </div>
      </q-card-section>
    </q-card>

    <company-filial :filials="filials" :company="company" />

  </div>

</template>

<script>
  import bbApi from '@/lib/api'

  import {
    useStore
  } from 'vuex'

  import {
    ref
  } from 'vue'

  import HotEdit from '@/components/HotEdit.vue'
  import CompanyFilial from '@/components/CompanyFilial.vue'

  export default {

    components: {
      HotEdit,
      CompanyFilial
    },

    setup() {

      const store = useStore()
      const company = store.getters['auth/company']

      const filials = ref([]);
      bbApi.trans('filials', {
        company_id: company.id
      }).then((resp) => {
        if (resp.status === 'success') {
          filials.value = resp.data;
        }
      })

      return {
        company,
        filials,
        companyName(data) {
          console.log('[Company] companyName data =', data)
        },
        addNewFilial() {

          let newFilial = bbApi.trans('filials/create', {
            company_id: company.id
          }).then((resp) => {
            if (resp.status === 'success') {
              filials.value.push(resp.data);
            }
          });

          // filials.push(newFilial)
        }
      }
    }
  }
</script>
<template>
  <div style="overflow-x: hidden;">

    <q-btn class="q-ma-md" color="secondary" label="Sign Out" @click="logout" />

    <div style="padding: 10px;">

      <strong>Начальные данные</strong>

      <q-list bordered class="rounded-borders bg-white">
      
        <q-expansion-item expand-separator icon="perm_identity" label="User"><!-- default-opened -->
          <q-card>
            <q-card-section style="overflow:hidden;">
              <pre>{{printJson('auth/user')}}</pre>
            </q-card-section>
          </q-card>
        </q-expansion-item>
        <q-expansion-item expand-separator icon="apartment" label="Company">
          <q-card>
            <q-card-section>
              <pre>{{printJson('auth/company')}}</pre>
            </q-card-section>
          </q-card>
        </q-expansion-item>
        <q-expansion-item expand-separator icon="theater_comedy" label="Roles">
          <q-card>
            <q-card-section>
              <pre>{{printJson('auth/roles')}}</pre>
            </q-card-section>
          </q-card>
        </q-expansion-item>
        <q-expansion-item expand-separator icon="extension" label="Apps">
          <q-card>
            <q-card-section>
              <pre>{{printJson('app/apps')}}</pre>
            </q-card-section>
          </q-card>
        </q-expansion-item>

      </q-list>

    </div>
  </div>
</template>

<script>
import { useStore } from 'vuex'
import { useRouter } from 'vue-router'

export default {
  setup () {
    const store = useStore()
    const router = useRouter()

    return {
      printJson(action) {
        return JSON.stringify([store.getters[action]], null, 2)
      },
      logout () {
        store.dispatch('signOut')
        router.push({ name: 'Sign In' })
      }
    }
  }
}
</script>

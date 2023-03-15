import { createApp } from 'vue'
import App from '@/App.vue'
import router from '@/router'
import store from '@/store'
import { Quasar } from 'quasar'
import quasarUserOptions from '@/plugins/quasar-user-options'
// import Calendar from '@quasar/quasar-ui-qcalendar'
// import '@quasar/quasar-ui-qcalendar/dist/index.css'


import bbAlert from '@/plugins/notify.plugin'
import bbLoading from '@/plugins/loading.plugin'

createApp(App)
  .use(Quasar, quasarUserOptions)
  .use(store)
  .use(router)
  .use(bbAlert)
  .use(bbLoading)
  .mount('#app')

require('@/plugins/global/sortBy.plugin')

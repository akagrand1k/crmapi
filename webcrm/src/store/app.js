import bbApi from '@/lib/api'

export default {

  namespaced: true,

  state: () => ({
    apps: {},
    perms: {},
    initialRoute: 'unresolved'
  }),

  mutations: {

    appsRaw (state, apps) {
      state.apps = apps
    },

    apps (state, apps) {
      const res = {}
      apps.forEach((app) => {
        app.config = JSON.parse(app.config)
        res[app.slug] = app
      })
      state.apps = res
      state.initialRoute = 'unresolved'
    },

    perms(state, perms) {
      const res = {}
      perms.forEach((perm) => {
        if(!res[perm.app_id]){
          res[perm.app_id] = []
        }
        res[perm.app_id][perm.slug] = perm
      })
      state.perms = res
    },

    setApps (state, val) { 
      state.apps = val
      //console.log('state.side_panel', state.side_panel)
    },

    reset(s) { 
      s.apps = {} 
      s.perms = {}
      s.initialRoute = 'unresolved'
    },

  },

  actions: {
    async menu ({commit, getters}, data) 
    {
      const tmp = getters['apps']
      tmp[data.slug]['menu'] = data.menu
      commit('appsRaw', tmp)
      await bbApi.trans('apps/menu', data)
    },

    async apps ({commit, getters}) 
    {
      if (!getters.loaded) {
        const respone = await bbApi.trans('apps')
        //console.log('[Store.App] list()', respone.status, respone.data)
        if (respone.status === 'success') {
          commit('apps', respone.data.apps)
        }
      } else {
        //console.log('[Store.App] list() from State')
      }
      return Promise.resolve(getters.apps)
    },

  },

  getters: {
    apps: s => s.apps,
    perms: s => s.perms,
    loaded: s => Object.keys(s.apps).length > 0 ? true : false,
    routes: s => s.initialRoute
  }
}

import bbApi from '@/lib/api'

export default {
  namespaced: true,
  state: () => ({
    perms:[],
    appsById:{}
  }),
  getters: {
    perms: s => s.perms,
    appsById: s => s.appsById,
  },
  mutations: {
    perms (state, perms) { 
      const res = {}
      perms.apps.forEach((app) => {
        res[app.id] = app
      })
      state.appsById = res
      state.perms = perms
    },
    reset (s) {
      s.perms = []
      s.appsById = {}
    }
  },
  actions: {

    async perms ({commit, getters}) {

      if (getters.perms.length === 0) {
        const respone = await bbApi.trans('perms')
        //console.log('[vuex.Perm] perms()', respone.status, respone.data.perms)

        if (respone.status === 'success') {
          commit('perms', respone.data)
        }
      } else {
        //console.log('[vuex.Perm] perms() from Cache')
      }
      return Promise.resolve(getters.perms)
    },

    sync ({}, data) {
      console.log('[vuex.Perm] sync data =', data)
      bbApi.trans('perms/sync', data)
    }
  }
}

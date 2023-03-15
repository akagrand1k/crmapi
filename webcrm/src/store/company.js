import bbApi from '@/lib/api'

export default {

  namespaced: true,

  state: {
    loaded: true
  },

  actions: {

    async patch ({commit}, data) {
      const respone = await bbApi.trans('company', data)
      if (respone.status === 'success') {
        commit('auth/company', respone.data, {root: true})
      }
      return respone
    },

  },

  mutations: {
    loaded (s, val){ s.loaded = val || true },
  },

  getters: {
    loaded: s => s.loaded
  }
}
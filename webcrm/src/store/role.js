import bbApi from '@/lib/api'

export default {
  namespaced: true,
  state: () => ({
    roles:[]
  }),
  mutations: {
    setRoles (state, roles) { 
      state.roles = roles
    },
    reset (s) {
      s.roles = []
    }
  },
  actions: {

    list1 ({commit, getters}) {

      if (getters.roles.length === 0) {
        bbApi.trans('roles').then((respone) => {
          if (respone.status === 'success') {
            //console.log('[vuex.Role] list()', respone.status, respone.data.roles)
            commit('setRoles', respone.data.roles)
          }
        })
      } else {
        //console.log('[vuex.Role] list() from Cache')
      }
      return getters.roles
    },

    async list ({commit, getters}) {

      if (getters.roles.length === 0) {
        const respone = await bbApi.trans('roles')
        //console.log('[vuex.Role] list()', respone.status, respone.data.roles)

        if (respone.status === 'success') {
          commit('setRoles', respone.data.roles)
        }
      } else {
        //console.log('[vuex.Role] list() from Cache')
      }
      return Promise.resolve(getters.roles)
    }
  },
  getters: {
    roles: s => s.roles,
  }
}

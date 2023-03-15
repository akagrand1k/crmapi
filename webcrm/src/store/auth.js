import bbApi from '@/lib/api'
import token from '@/lib/token'

export default {

  namespaced: true,

  state: {
    user: {},
    company: {},
    roles: {},

    loaded: false
  },

  actions: {

    async sign ({commit}, data) {
      const respone = await bbApi.trans(data.url, data.data)
      if (respone.status === 'success') {
        commit('user', respone.data.user)
        commit('company', respone.data.company)
        commit('roles', respone.data.roles) 
        commit('app/apps', respone.data.apps, {root: true})
        commit('app/perms', respone.data.apps, {root: true})
      }
      return respone
    },

    async signUp ({dispatch}, data) {
      return await dispatch('sign', {url: 'auth/sign-up', data})
    },

    async signIn ({dispatch}, data) {
      return await dispatch('sign', {url: 'auth/sign-in', data})
    },
    
    async signInit ({dispatch}) {
      return await dispatch('sign', {url: 'auth/sign-init'})
    },

  },

  mutations: {
    loaded (s, val){ s.loaded = val || true },
    signOut (s) 
    {
      s.user = {}
      token.remove()
      s.school = {}
      s.role = {}
    },
    user (state, user) 
    { 
      state.user = user
      if (user.api_token) {
        token.save(user.api_token)
      }
    },
    company (state, company) { state.company = company },
    roles (state, roles) { state.roles = roles },
  },

  getters: {

    test: () => 'test get',
    user: s => s.user,
    company: s => s.company,
    roles: s => s.roles,

    loaded: s => Object.keys(s.user).length > 0
    //loaded: s => s.loaded
  }
}
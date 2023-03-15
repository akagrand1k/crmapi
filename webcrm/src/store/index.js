import { createStore } from 'vuex'
import auth from './auth'
import error from './error'
import navbar from './navbar'
import user from './user'
import app from './app'
import perm from './perm'
import role from './role'
import subject from './subject'

export default createStore({
  state: {
  },
  mutations: {
  },
  actions: {
    signOut({commit}) {
      commit('auth/signOut')
      commit('app/reset')
      commit('perm/reset')
      commit('role/reset')
      commit('subject/reset')
    }
  },
  modules: {
    auth,
    error,
    navbar,
    user,
    app,
    perm,
    role,
    subject,
  }
})

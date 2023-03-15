export default {

  namespaced: true,

  state: {
    error: null,
    offline: false
  },

  mutations: {
    setOffline (state, offline) { 
      console.log('[store.error] setOffline', offline)
      state.offline = offline 
    },

    sendError (state, error) { console.log('Send Error to Server', error) },
    saveError (state, error) { window.localStorage.setItem('bbErrorLast', error) },
    
    setError (state, error) { state.error = error },
    clearError (state) { state.error = null }
  },

  getters: {
    error: s => s.error,
    offline: s => s.offline
  },
  
  actions: {

  }
}

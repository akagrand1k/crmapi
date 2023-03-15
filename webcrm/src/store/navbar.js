export default {

  namespaced: true,

  state: () => ({
    show: false,
    items: []
  }),

  mutations: {
    show (state) { state.show = true },
    hide (state) { state.show = false },
    items (state, val) { 
      state.items = val
      state.show = true 
    }
  },

  actions: {

  },

  getters: {
    show: s => s.show,
    items: s => s.items
  }
}

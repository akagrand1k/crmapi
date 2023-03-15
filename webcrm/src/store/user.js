import bbApi from '@/lib/api'

export default {
  namespaced: true,
  state: () => ({
    currentUser: {},
    test1: 'user'
  }),
  mutations: {
    
  },
  actions: {

    async list ({}, data) {
      // console.log('data',data);
      const respone = await bbApi.trans('users', data)
      // console.log('[Store.user] list(', JSON.stringify(data) ,')', respone.status, respone.data)
      return respone.status === 'success' ? respone : Promise.resolve([])
    },

    async create ({}, data) {
      // console.log('data',data);
      const respone = await bbApi.trans('users/create', data)
      // console.log('[Store.user] list(', JSON.stringify(data) ,')', respone.status, respone.data)
      return respone.status === 'success' ? respone : Promise.resolve([])
    },

    async fake ({}, data) {
      // console.log('data',data);
      const respone = await bbApi.trans('users/fake', data)
      // console.log('[Store.user] list(', JSON.stringify(data) ,')', respone.status, respone.data)
      return respone.status === 'success' ? respone : Promise.resolve([])
    }
  },
  getters: {
    loaded: s => s.test1
  }
}

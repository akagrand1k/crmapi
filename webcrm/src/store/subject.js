import api from '@/lib/api'

export default {
  namespaced: true,
  state: () => ({
    subjects: []
  }),
  mutations: {
    init (s, subjects) { s.subjects = subjects },
    add (s, subject) { s.subjects.unshift(subject) },
    update (s, data) { 
      const i = s.subjects.Index(sbj => sbj.id == data.id)
      s.subjects[i] = [...s.subjects[i], ...data]
    },
    delete (s, id) { s.subjects.splice(s.subjects.findIndex(sbj => sbj.id == id), 1) },
    reset (s) { s.subjects = [] }
  },
  actions: {

    async all ({commit, getters}) {

      if (getters.subjects.length === 0) {
        const respone = await api.trans('subjects')
        // console.log('[vuex.Subject] list()', respone.status, respone.data)
        if (respone.status === 'success'){ 
          commit('init', respone.data) 
        }
      } else {
        //console.log('[vuex.Role] list() from Cache')
      }
      return getters.subjects
    },

    async create ({ commit, getters }, data) {
      const resp = await api.trans('subjects/create', data)
      if (resp.status === 'success') {
        commit('add', resp.data)
        return getters.subject(resp.data.id)
      }
      return null
    },

    async patch ({ commit, getters }, data) {
      const resp = await api.trans('subjects/patch', {id: data.id, data: data.new})
      if (resp.status === 'success') {
        if(!resp.data) {
          commit('update', {id: data.id, data: data.old})
        }
        //
        //return getters.subject(resp.data.id)
      }
      //return null
    },

    async delete ({ commit, getters }, id) {
      const resp = await api.trans('subjects/delete', { id })
      if (resp.status === 'success') {
        commit('delete', id)
      }
    },

    async attachTeacher ({ }, data) {
      return await api.trans('teacher/attach-subject', data)
    },
    async detachTeacher ({ }, data) {
      return await api.trans('teacher/detach-subject', data)
    }
  },
  getters: {
    subjects: s => s.subjects,
    subject: s => id => s.subjects.find(subject => subject.id === id)
  }
}

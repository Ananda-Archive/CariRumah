import Vue from 'vue'
import Vuex from 'vuex'
import province from './modules/province'
import createPersistedState from "vuex-persistedstate";

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    uid:'',
  },
  mutations: {
    setUid (state, id) {
      state.uid = id
    },
  },
  actions: {
    mutateUid( {commit}, id ) {
      commit('setUid', id)
    },
  },
  modules: {
    province
  },
  plugins: [createPersistedState()]
})

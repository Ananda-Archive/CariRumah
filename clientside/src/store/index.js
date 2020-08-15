import Vue from 'vue'
import Vuex from 'vuex'
import province from './modules/province'
import createPersistedState from "vuex-persistedstate";

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    uid:'',
    searchStore:null,
  },
  mutations: {
    setUid (state, id) {
      state.uid = id
    },
    setSearchStore (state, searchStore) {
      state.searchStore = searchStore
    }
  },
  actions: {
    mutateUid( {commit}, id ) {
      commit('setUid', id)
    },
    mutateSearchStore( {commit}, searchStore ) {
      commit('setSearchStore',searchStore)
    }
  },
  modules: {
    province
  },
  plugins: [createPersistedState()]
})

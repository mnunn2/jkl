import Vue from 'vue'
import Vuex from 'vuex'
import Axios from 'axios'

Vue.use(Vuex)

export const store = new Vuex.Store({
  state: {
    workers: [],
    projects: [],
    jobs: [],
  },
  getters: {

    GET_WORKERS : state => {
      return state.workers;
    },

    GET_PROJECTS : state => {
      return state.projects;
    },

    GET_JOBS : state => {
      return state.jobs;
    }

  },
  mutations: {

    SET_WORKERS : (state, payload) => {
      state.workers = payload
    },

    SET_PROJECTS : (state, payload) => {
      state.projects = payload
    },

    SET_JOBS : (state, payload) => {
      state.jobs = payload
    },

  },
  actions: {

    FETCH_WORKERS : async (context,payload) => {
      let { data } = await Axios.get("http://www.jkl.com/api/workers")
      context.commit('SET_WORKERS',data)
   },

    FETCH_PROJECTS : async (context,payload) => {
      let { data } = await Axios.get("http://www.jkl.com/api/projects")
      context.commit('SET_PROJECTS',data)
   },

    FETCH_JOBS : async (context,payload) => {
      let { data } = await Axios.get("http://www.jkl.com/api/jobs")
      context.commit('SET_JOBS',data)
   },

  }
})

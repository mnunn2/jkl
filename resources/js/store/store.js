import Vue from 'vue'
import Vuex from 'vuex'
import Axios from 'axios'

Vue.use(Vuex)

export const store = new Vuex.Store({
    state: {
        workers: [],
        projects: [],
        jobs: [],
        timeEntries: [],
    },
    getters: {
        GET_TIME_ENTRIES: state => {
            return state.timeEntries;
        },
        GET_WORKERS: state => {
            return state.workers;
        },
        GET_PROJECTS: state => {
            return state.projects;
        },
        GET_JOBS: state => {
            return state.jobs;
        }
    },
    mutations: {
        SET_TIME_ENTRIES: (state, payload) => {
            let timeEntries = payload.map(function (obj) {
                var rObj = {};
                rObj["id"] = obj.id;
                rObj["name"] = obj.worker.forename + " " + obj.worker.last_name;
                rObj["hours"] = obj.hours;
                rObj["amount"] = obj.amount / 100;
                rObj["job"] = obj.job.name;
                rObj["date"] = obj.date;
                return rObj;
            });
            state.timeEntries = timeEntries;
        },
        DELETE_TIME_ENTRY: (state, payload) => {
            //console.log(payload)
            state.timeEntries = state.timeEntries.filter(function (obj) {
                return obj.id !== payload;
            });
            //console.log(timeEntries)
            //state.timeEntries = timeEntries;
        },
        SET_WORKERS: (state, payload) => {
            state.workers = payload
        },
        SET_PROJECTS: (state, payload) => {
            state.projects = payload
        },
        SET_JOBS: (state, payload) => {
            state.jobs = payload
        },
    },
    actions: {
        FETCH_TIME_ENTRIES: async (context, payload) => {
            let {
                data
            } = await Axios.get("api/time-entries")
            context.commit('SET_TIME_ENTRIES', data)
        },
        FETCH_WORKERS: async (context, payload) => {
            let {
                data
            } = await Axios.get("api/workers")
            context.commit('SET_WORKERS', data)
        },
        FETCH_PROJECTS: async (context, payload) => {
            let {
                data
            } = await Axios.get("api/projects")
            context.commit('SET_PROJECTS', data)
        },
        FETCH_JOBS: async (context, payload) => {
            let {
                data
            } = await Axios.get("api/jobs")
            context.commit('SET_JOBS', data)
        },
        SAVE_TIME_ENTRY: async (context, payload) => {
            let {
                data
            } = await Axios.post("api/time-entry", payload)
            //context.commit('SET_JOBS',data)
        },
        deleteTimeEntry: async (context, payload) => {
            //let { data } = await Axios.post("api/time-entry", payload)
            context.commit('DELETE_TIME_ENTRY', payload)
        },
    }
})

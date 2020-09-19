import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from "vuex-persistedstate";
import Axios from 'axios'

// const vuexPersist = new VuexPersist({
//   key: 'trach.io-app',
//   storage: window.localStorage
// })

//tutorial https://flaviocopes.com/vuex/
// https://flaviocopes.com/vuex-persist-localstorage/
// https://medium.com/dailyjs/mastering-vuex-zero-to-hero-e0ca1f421d45
Vue.use(Vuex)

export const store = new Vuex.Store({
    plugins: [createPersistedState()],

    state: {
        shift: {},
        o2Status: {},
        coughStatus: {},
        suctionStatus: {},
        nebStatus: {},
        desatStatus: {},
        envStatus: {},
        toiletStatus: {},
        medStatus: {},
        awakesleepStatus: {},
        event_actions: {},
        notification_count: '',
        env_temp_scale: ''
    },

    mutations: {
        SET_SHIFT(state, shift) {
            state.shift = shift
        },
        SET_O2STATUS(state, o2Status) {
            state.o2Status = o2Status
        },
        SET_COUGHSSTATUS(state, coughStatus) {
            state.coughStatus = coughStatus
        },
        SET_SUCTIONSSTATUS(state, suctionStatus) {
            state.suctionStatus = suctionStatus
        },
        SET_NEBSSTATUS(state, nebStatus) {
            state.nebStatus = nebStatus
        },
        SET_DESATSTATUS(state, desatStatus) {
            state.desatStatus = desatStatus
        },
        SET_ENVSTATUS(state, envStatus) {
            state.envStatus = envStatus
        },
        SET_TOILETSTATUS(state, toiletStatus) {
            state.toiletStatus = toiletStatus
        },
        SET_MEDSTATUS(state, medStatus) {
            state.medStatus = medStatus
        },
        SET_AWAKESLEEPSTATUS(state, awakesleepStatus) {
            state.awakesleepStatus = awakesleepStatus
        },
        SET_EVENTACTIONS(state, event_actions) {
            state.event_actions = event_actions
        },
        SET_NOTIFICATIONCOUNT(state, notification_count) {
            state.notification_count = notification_count
        },
        SET_ENVTEMPSCALE(state, env_temp_scale) {
            state.env_temp_scale = env_temp_scale
        },
        SET_EVENTACTION_STATUS(state, value){
            const index = state.event_actions.findIndex(item => item.id == value.id); //double equals only
            Vue.set(state.event_actions[index], 'status', value.status)
        },
        SET_EVENTACTIONS_O2_THRESHOLD(state, value) {
            const index = state.event_actions.findIndex(item => item.id === 1);
            Vue.set(state.event_actions[index], 'thresholds', value)
        },
        SET_EVENTACTIONS_COUGH_THRESHOLD(state, value) {
            const index = state.event_actions.findIndex(item => item.id === 3);
            Vue.set(state.event_actions[index], 'thresholds', value)
        },
        SET_EVENTACTIONS_DESAT_THRESHOLD(state, value) {
            const index = state.event_actions.findIndex(item => item.id === 4);
            Vue.set(state.event_actions[index], 'thresholds', value)
        },
        SET_EVENTACTIONS_NEB_THRESHOLD(state, value) {
            const index = state.event_actions.findIndex(item => item.id === 5);
            Vue.set(state.event_actions[index], 'thresholds', value)
        },
        SET_EVENTACTIONS_SUCTION_THRESHOLD(state, value) {
            const index = state.event_actions.findIndex(item => item.id === 2);
            Vue.set(state.event_actions[index], 'thresholds', value)
        },
    },
    actions : {
        GET_O2STATUS : async (context,payload) => {
            let { data } = await Axios.get('/api/o2LatestStatus');
            context.commit('SET_O2STATUS',data);
        },
        GET_COUGHSSTATUS : async (context,payload) => {
            let { data } = await Axios.get('/api/latest-cough');
            context.commit('SET_COUGHSSTATUS',data);
        },
        GET_DESATSTATUS : async (context,payload) => {
            let { data } = await Axios.get('/api/latest-desat');
            context.commit('SET_DESATSTATUS',data);
        },
        GET_SUCTIONSSTATUS : async (context,payload) => {
            let { data } = await Axios.get('/api/latest-suction');
            context.commit('SET_SUCTIONSSTATUS',data);
        },
        GET_NEBSSTATUS : async (context,payload) => {
            let { data } = await Axios.get('/api/latest-neb');
            context.commit('SET_NEBSSTATUS',data);
        },
        GET_ENVSSTATUS : async (context,payload) => {
            let { data } = await Axios.get('/api/latest-envvar');
            context.commit('SET_ENVSTATUS',data);
        },
        GET_TOILETSSTATUS : async (context,payload) => {
            let { data } = await Axios.get('/api/latest-toilet');
            context.commit('SET_ENVSTATUS',data);
        },
        GET_MEDSSTATUS : async (context,payload) => {
            let { data } = await Axios.get('/api/latest-med');
            context.commit('SET_ENVSTATUS',data);
        },
        GET_AWAKESLEEPSSTATUS : async (context,payload) => {
            let { data } = await Axios.get('/api/latest-awakesleep');
            context.commit('SET_ENVSTATUS',data);
        },

        GET_EVENTACTIONS : async (context,payload) => {
            let { data } = await Axios.get('/api/event-action');
            context.commit('SET_EVENTACTIONS',data);
        },
        GET_NOTIFICATIONCOUNT : async (context,payload) => {
            let { data } = await Axios.get('/api/notification-count');
            context.commit('SET_NOTIFICATIONCOUNT',data);
        },
        GET_ENVTEMPSCALE : async (context,payload) => {
            let { data } = await Axios.get('/api/get-temp-scale');
            context.commit('SET_ENVTEMPSCALE',data);
        },

        SAVE_O2STATUS : async (context,payload) => {
            context.commit('SET_O2STATUS',payload);
        },
        SAVE_COUGHSSTATUS : async (context,payload) => {
            context.commit('SET_COUGHSSTATUS',payload);
        },
        SAVE_DESATSTATUS : async (context,payload) => {
            context.commit('SET_DESATSTATUS',payload);
        },
        SAVE_SUCTIONSSTATUS : async (context,payload) => {
            context.commit('SET_SUCTIONSSTATUS',payload);
        },
        SAVE_NEBSSTATUS : async (context,payload) => {
            context.commit('SET_NEBSSTATUS',payload);
        },
        SAVE_ENVSSTATUS : async (context,payload) => {
            context.commit('SET_ENVSTATUS',payload);
        },
        SAVE_TOILETSSTATUS : async (context,payload) => {
            context.commit('SET_TOILETSTATUS',payload);
        },
        SAVE_MEDSSTATUS : async (context,payload) => {
            context.commit('SET_MEDSTATUS',payload);
        },
        SAVE_AWAKESLEEPSSTATUS : async (context,payload) => {
            context.commit('SET_AWAKESLEEPSTATUS',payload);
        },
        SAVE_EVENTACTIONS : async (context,payload) => {
            context.commit('SET_EVENTACTIONS',payload);
        },
        SAVE_EVENTACTION_STATUS : async (context,payload) => { // Set card status
            context.commit('SET_EVENTACTION_STATUS',payload);
        },
        SAVE_ENVTEMPSCALE : async (context,payload) => {
            context.commit('SET_ENVTEMPSCALE',payload);
        },
        RESET_STATE(state) {
            Object.keys(state.state).forEach(key => {
               state.state[key] = {};
            })
            window.localStorage.clear();
        }
    },
    getters: {
        shift: state => state.shift,
        o2Status: state => state.o2Status,
        coughStatus: state => state.coughStatus,
        suctionStatus: state => state.suctionStatus,
        nebStatus: state => state.nebStatus,
        desatStatus: state => state.desatStatus,
        envStatus: state => state.envStatus,
        toiletStatus: state => state.toiletStatus,
        medStatus: state => state.medStatus,
        awakesleepStatus: state => state.awakesleepStatus,
        event_actions : state => state.event_actions,
        notification_count : state => state.notification_count,
        env_temp_scale : state => state.env_temp_scale,
    }

})


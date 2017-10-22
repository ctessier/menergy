import Vue from 'vue'
import Vuex from 'vuex'
import * as getters from './getters'
import * as actions from './actions'
import * as types from './mutation-types'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        measures: {},
        isLoading: false,
        error: null
    },
    getters,
    mutations: {
        [types.SET_LOADING]: (state, loading) => {
            state.isLoading = loading
        },
        [types.SET_ERROR]: (state, message) => {
            state.error = message
            state.isLoading = false
        },
        [types.RECEIVE_MESURES]: (state, { measures }) => {
            for (let i = 0 ; i < measures.length ; ++i) {
                const key = 'measure_'+measures[i].id
                Vue.set(state.measures, key, measures[i])
            }
            state.isLoading = false
        }
    },
    actions
})

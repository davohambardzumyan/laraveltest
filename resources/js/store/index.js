import Vue from 'vue';
import Vuex from 'vuex';
import auth from "./modules/auth";

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        loader: false,
        app_name: process.env.MIX_APP_NAME
    },
    mutations: {
        startLoader(state) {
            state.loader = true
        },
        stopLoader(state) {
            state.loader = false
        }
    },
    getters: {
        isLoaderProcessing(state) {
            return state.loader
        },
        appName(state) {
            return state.app_name
        }
    },
    modules:{
        auth
    }
})

export default store;

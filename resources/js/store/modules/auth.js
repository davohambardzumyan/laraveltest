export default {
    state: {
        isLoaded: false,
        auth: localStorage.getItem("auth"),
        user: null,
    },
    mutations: {
        logout(state) {
            state.auth = "";
            state.user = null;
            localStorage.removeItem("auth");
        },
        login(state, user) {
            state.auth = "1";
            state.user = user
            localStorage.setItem('auth', "1")
        },
        setUser(state, payload) {
            state.user = payload;
        },
        setIsLoaded(state, isLoaded) {
            state.isLoaded = isLoaded
        }
    },
    actions: {
        login({commit}, payload) {
            commit('login', payload)
            return Promise.resolve();
        },
        setUser({commit}, payload) {
            commit('setUser', payload)
            return Promise.resolve();
        },
        logout({commit}) {
            commit('logout')
            return Promise.resolve();
        },
        setIsLoaded({commit}, isLoaded) {
            commit('setIsLoaded', isLoaded)
            return Promise.resolve();
        },
    },
    getters: {
        isAuthenticated(state) {
            return !!state.auth
        },
        user(state) {
            return state.user
        },
        isLoaded(state) {
            return state.isLoaded
        },
        isAdmin(state) {
            return state.user.role === 'admin'
        },
        fullName(state) {
            return state.user.first_name + ' ' + state.user.last_name
        }
    }
}

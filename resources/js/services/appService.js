import store from "../store";
import auth from "../repository/auth"

export const reBootstrap = async () => {
    if (!!localStorage.getItem('auth') && !store.getters.user) {
        store.commit('startLoader')
        await auth.me().then(async (response) => {
            await store.dispatch('login', response.data)
            await store.dispatch('setIsLoaded', true)
        }).finally(() => {
            store.commit('stopLoader')
        })
    } else if (!localStorage.getItem('auth') && store.getters.user) {
        store.commit('startLoader')
        await store.dispatch('logout')
        await store.dispatch('setIsLoaded', true)
        store.commit('stopLoader')
    }
}

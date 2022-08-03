import store from "../../store";

export default function auth({next}) {
    if (!store.getters.isAuthenticated) {
        return next({
            name: 'Login'
        })
    }

    return next()
}

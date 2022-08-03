import store from "../../store";

export default function guest({next}) {
    if (store.getters.isAuthenticated) {
        return next({
            name: 'Dashboard'
        })
    }

    return next()
}

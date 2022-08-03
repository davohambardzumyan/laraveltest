import store from "../../store";

export  function authorizeAdmin({next}) {
    if (!store.getters.isAuthenticated || !this.store.getters.isAdmin) {
        return next({
            name: '404'
        })
    }

    return next()
}

export  function authorizeUser({next}) {
    if (!store.getters.isAuthenticated || this.store.getters.isAdmin) {
        return next({
            name: '404'
        })
    }

    return next()
}

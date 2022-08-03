import Vue from 'vue'
import VueRouter from 'vue-router'
import routes from "./routes";
import middlewarePipeline from "./middlewarePipeline";
import {reBootstrap} from "../services/appService";

Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    routes
});


const DEFAULT_TITLE = process.env.MIX_APP_NAME;

router.beforeEach(async (to, from, next) => {
    document.title = to.meta.title || DEFAULT_TITLE

    if (!to.meta.middleware) {
        return next()
    }

    await reBootstrap();

    const middleware = to.meta.middleware

    const context = {
        to,
        from,
        next
    }

    return middleware[0]({
        ...context,
        next: middlewarePipeline(context, middleware, 1)
    })
});

export default router;

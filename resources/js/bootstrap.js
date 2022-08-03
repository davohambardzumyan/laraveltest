import store from "./store";
import router from "./router";
import Vue from "vue";
import {reBootstrap} from "./services/appService";

window._ = require('lodash');
window.axios = require('axios');

window.axios.defaults.headers.common["Accept"] = "application/json";
window.axios.defaults.headers.post["Content-Type"] = "application/json";
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const config = {
    baseURL: "/api",
    timeout: 600000,
    withCredentials: true,
};

const _axios = window.axios.create(config);

_axios.interceptors.request.use(
    function (config) {
        return config;
    },
    function (error) {
        return Promise.reject(error);
    }
);

_axios.interceptors.response.use(
    function (response) {
        return response;
    },
    async function (error) {

        if ([500, 403, 404].includes(error.response.status)) {
            await router.push(`/${error.response.status}`);
        } else if (error.code === 'ECONNABORTED' ||
            typeof error.response === "undefined") {
            await router.push("/500");
        } else if (error.response && error.response.status === 401) {
            await store.dispatch("logout");
            await router.push("/login");
        } else if (error.response && error.response.status === 302) {
            await reBootstrap()
            await router.push("/dashboard");
        } else if (error.response.data && ![500, 400, 401, 422, 302].includes(error.response.status)) {
            Vue.$toast.error(error.response.data.message ?? 'Something went wrong.');
        }

        return Promise.reject(error);
    }
);

window.axios = _axios;


/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });

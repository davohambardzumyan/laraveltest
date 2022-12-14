import Vue from "vue";
import App from "./App.vue"
import router from "./router";
import store from "./store";
import vuetify from "./plugins/vuetify";

require('./bootstrap');
require('./plugins/toast')

new Vue({
    router,
    store,
    vuetify,
    render: h => h(App),
}).$mount("#app");

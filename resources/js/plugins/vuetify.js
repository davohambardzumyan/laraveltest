import Vuetify from "vuetify";
import Vue from "vue";

Vue.use(Vuetify)

const vuetify = new Vuetify({
    theme: {
        themes: {
            light: {
                primary: "#24695c",
                secondary: "#202938",
                quaternary: "#156192",
                accent: "#24695c",
                error: "#ff0000",
                warning: "#f8ac59",
                info: "#13387b",
                success: "#4caf50",
                background: "#ff0000",
            }
        },
        dark: false,
        options: {
            themeCache: {
                get: key => localStorage.getItem(key),
                set: (key, value) => localStorage.setItem(key, value),
            },
            customProperties: true
        },
    },
    icons: {
        iconfont: 'md',
    }
})

export default vuetify

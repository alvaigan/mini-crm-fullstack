import "./bootstrap";

import Vue from "vue";
import App from "./App.vue";
import Vuesax from "vuesax";
import "vuesax/dist/vuesax.css";
import "../css/tailwindcss.css";
import VueRouter from "vue-router";
import Vuex from "vuex";
import routes from "./src/router/routes.js";
import contactsStore from "./src/stores/contacts.store.js";
import rolesStore from "./src/stores/roles.store.js";
import VueDebounce from "vue2-debounce";

Vue.use(VueRouter);
Vue.use(Vuesax);
Vue.use(Vuex);
Vue.use(VueDebounce);

const store = new Vuex.Store({
    modules: {
        contacts: contactsStore,
        roles: rolesStore,
    },
});

const router = new VueRouter({
    mode: "history",
    routes: routes,
});

new Vue({
    render: (h) => h(App),
    router,
    store,
}).$mount("#app");

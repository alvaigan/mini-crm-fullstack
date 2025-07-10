import "./bootstrap";

import Vue from "vue";
import App from "./App.vue";
import Vuesax from "vuesax";
import "vuesax/dist/vuesax.css";
import "../css/tailwindcss.css";
import VueRouter from "vue-router";
import routes from "./src/router/routes.js";

Vue.use(VueRouter);
Vue.use(Vuesax);

const router = new VueRouter({
    mode: "history",
    routes: routes,
});

new Vue({
    render: (h) => h(App),
    router,
}).$mount("#app");

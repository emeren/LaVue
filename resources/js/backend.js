window.Vue = require("vue");
window.axios = require("axios");
import VueRouter from "vue-router";
import { ServerTable, ClientTable, Event } from "vue-tables-2";
import Notifications from "vue-notification";
import VuePaginate from "vue-paginate";
import { VueEditor } from "vue2-editor";
//local
import routes from "./backend/routes/routes.js";
import store from "./backend/store/index";

//IE < 11 hax
import "es6-promise/auto";

Vue.use(ClientTable, {
    sortIcon: {
        is: "fa-sort",
        base: "ml-2 fas",
        up: "fa-sort-up",
        down: "fa-sort-down",
    },
    texts: {
        count:
            "Wyświetla {from} do {to} z {count} elementów|{count} elementy|Jeden element",
        first: "Pierwszy",
        last: "Ostatni",
        filter: "Filtruj:",
        filterPlaceholder: "Wyszukaj",
        limit: "Elementów:",
        page: "Strona:",
        noResults: "Brak pasujących elementów",
        filterBy: "Filtruj wg. {column}",
        loading: "Ładuję...",
        defaultOption: "Wybierz {column}",
        columns: "Kolumny",
    },
});

Vue.use(VueRouter);
Vue.use(VuePaginate);
Vue.use(Notifications);
const router = new VueRouter({
    mode: "hash",
    routes,
});
Vue.component("Dashboard", require("./backend/Dashboard.vue").default);
const app = new Vue({
    router,
    store,
}).$mount("#app");

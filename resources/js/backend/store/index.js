import Vue from "vue";
import Vuex from "vuex";
import VuexPersist from "vuex-persist";
Vue.use(Vuex);

const vuexLocalStorage = new VuexPersist({
    key: "rcps-admin", // The key to store the state on in the storage provider.
    storage: window.localStorage
});
//stores
import dashboardStore from "./modules/dashboardStore";
import usersStore from "./modules/usersStore";
import permissionsStore from "./modules/permissionsStore";

import postsStore from "./modules/posts";
import categoriesStore from "./modules/categoriesStore";
import rolesStore from "./modules/rolesStore";

export default new Vuex.Store({
    // plugins: [vuexLocalStorage.plugin],
    modules: {
        dashboard: dashboardStore,
        users: usersStore,
        roles: rolesStore,
        permissions: permissionsStore,
        posts: postsStore,
        categories: categoriesStore,
    }
});

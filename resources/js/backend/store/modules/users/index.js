import actions from "./actions";
import getters from "./getters";
import mutations from "./mutations";

const state = {
    users: [],
};


export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};

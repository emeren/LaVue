import actions from "./actions";
import getters from "./getters";
import mutations from "./mutations";

const state = {
    posts: [],
    filters: {
        sort: "desc",
        status: "all",
        search: "",
        category: null,
    },
    activePostsCategories: [],
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};

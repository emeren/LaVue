const state = {
    asideStatus: false
};

const getters = {
    asideCollapse: state => state.asideStatus
};

const actions = {
    toggleAside({ commit }) {
        commit("TOGGLE_ASIDE");
    }
};
const mutations = {
    TOGGLE_ASIDE(state) {
        state.asideStatus = !state.asideStatus;
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};

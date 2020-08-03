import axios from "axios";
const usersApi = "/panel/api/users/"

const state = {
    users: [],
    allUsers: []
};

const getters = {
    getUsers: state => state.users
};

const actions = {
    loadUsers({ commit }) {
        axios
            .get(usersApi)
            .then(response => response.data.data)
            .then(users => {
                console.log('users', users);
                commit("LOAD_USERS", users);
            });
    }
};

const mutations = {
    LOAD_USERS(state, users) {
        state.users = users
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};

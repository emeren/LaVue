import axios from "axios";
const usersApi = "/panel/api/users/"

const state = {
    users: [],
};

const getters = {
    getUsers: state => state.users,
    getUser: (state) => (userId) => state.users.find((user) => user.id == userId)
};

const actions = {
    loadUsers({ commit }) {
        axios
            .get(usersApi)
            .then(response => response.data.data)
            .then(users => {
                commit("LOAD_USERS", users);
            });
    },
    updateUser({ commit }, userData) {
        axios.put(usersApi + userData.id, userData).then(user => {
            commit("UPDATE_USER", user.data);
        });
    }
};

const mutations = {
    LOAD_USERS(state, users) {
        state.users = users
    },
    UPDATE_USER(state, updatedUserdata) {
        let index = state.users.findIndex((user) => user.id == updatedUserdata.id);
        state.user.splice(index, 1, updatedUserdata);
    }

};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};

import axios from "axios";

const usersApi = "/panel/api/users/"

//POSTS
const loadUsers = ({ commit }) => {
    axios
        .get(usersApi)
        .then(response => response.data.data)
        .then(users => {
            commit("LOAD_USERS", users);
        });
}
const createUser = ({ commit }, userData) => {
    axios.post(usersApi, userData).then(user => {
        commit("CREATE_USER", user.data);
    });
}

const updateUser = ({ commit }, userData) => {
    axios.put(usersApi + userData.id, userData).then(user => {
        console.log('user updateUser', user);
        commit("UPDATE_USER", user.data);
    });
}

export default {
    loadUsers,
    createUser,
    updateUser
};

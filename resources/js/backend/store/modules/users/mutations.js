const LOAD_USERS = (state, users) => {
    console.log('state', state);
    console.log('users from mutation', users);
    state.users = users
}
const CREATE_USER = (state, createdUserData) => {
    let index = state.users.findIndex((user) => user.id == createdUserData.id);
    state.users.push(index, 1, createdUserData);
}
const UPDATE_USER = (state, updatedUserdata) => {
    let index = state.users.findIndex((user) => user.id == updatedUserdata.id);
    state.users.splice(index, 1, updatedUserdata);
}

export default {
    LOAD_USERS,
    CREATE_USER,
    UPDATE_USER
};


const getUsers = state => state.users;


const singleUser = (state) => (userId) => {
    return state.users.find((user) => user.id == userId);
};

const userPosts = (state) => (userId) => {
    let user = state.users.find((user) => user.id == userId);
    return user.posts
};




export default {
    getUsers,
    singleUser,
    userPosts
};

import axios from "axios";
const postsApi = "/panel/api/posts/";

//POSTS
const loadPosts = ({ commit }) => {
    axios
        .get(postsApi)
        .then(response => response.data.data)
        .then(posts => {
            commit("LOAD_POSTS", posts);
            //Categories used by posts
            commit("LOAD_POSTS_CATEGORIES");
        });
};
const createPost = ({ commit }, postData) => {
    axios.post(postsApi, postData).then(post => {
        commit("CREATE_POST", post.data);
    });
};
const updatePost = ({ commit }, postData) => {
    axios.put(postsApi + postData.id, postData).then(post => {
        commit("UPDATE_POST", post.data);
    });
};
const deletePost = ({ commit }, postId) => {
    axios.delete(postsApi + postId).then(post => {
        commit("DELETE_POST", postId, post);
        commit("LOAD_POSTS_CATEGORIES");
    });
};
const changeStatus = ({ commit }, postData) => {
    axios.put(postsApi + postData.id, postData).then(post => {
        commit("UPDATE_POST", post.data);
    });
};

//POSTS FILTERS

const filterPosts = ({ commit }, filters) => {
    commit("FILTER_POSTS", filters);
};

const statusFilter = ({ commit }, status) => {
    commit("STATUS_FILTER", status);
};
const categoryFilter = ({ commit }, category) => {
    commit("CATEGORY_FILTER", category);
};

const searchByWord = ({ commit }, search) => {
    commit("SEARCH", search);
};

export default {
    loadPosts,
    createPost,
    updatePost,
    changeStatus,
    deletePost,
    filterPosts,
    statusFilter,
    categoryFilter,
    searchByWord
};

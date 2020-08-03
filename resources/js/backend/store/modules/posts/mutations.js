//POSTS

const LOAD_POSTS = (state, posts) => {
    state.posts = posts;
};
const CREATE_POST = (state, createdPostData) => {
    let index = state.posts.findIndex((post) => post.id == createdPostData.id);
    state.posts.push(index, 1, createdPostData);
};
const UPDATE_POST = (state, updatedPostData) => {
    let index = state.posts.findIndex((post) => post.id == updatedPostData.id);
    state.posts.splice(index, 1, updatedPostData);
};
const DELETE_POST = (state, deletedPostId) => {
    let index = state.posts.findIndex((post) => post.id == deletedPostId);
    state.posts[index].deleted_at = Date.now();
};

//CATEGORIES
const LOAD_POSTS_CATEGORIES = (state) => {
    let itemNotDeleted = state.posts.filter((post) => post.deleted_at == null);
    let postsCategories = itemNotDeleted.map((post) => post.categories);
    let uqniePostsCategories = new Set(postsCategories.flat(2));
    state.activePostsCategories = [...uqniePostsCategories];
};

//FILTERS
const STATUS_FILTER = (state, status) => {
    state.filters.status = status;
};
const CATEGORY_FILTER = (state, category) => {
    state.filters.category = parseInt(category);
};
const SEARCH = (state, search) => {
    state.filters.search = search;
};

export default {
    LOAD_POSTS,
    CREATE_POST,
    UPDATE_POST,
    DELETE_POST,
    LOAD_POSTS_CATEGORIES,
    STATUS_FILTER,
    CATEGORY_FILTER,
    SEARCH,
};

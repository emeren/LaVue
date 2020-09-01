//POSTS
const allPosts = (state) => { };

const deletedPosts = (state) =>
    state.posts.filter((post) => post.deleted_at != null);

const singlePost = (state) => (id) => {
    return state.posts.find((post) => post.id == id);
};

const userPosts = (state) => (userId) => {
    return state.posts.find((post) => post.author == userId);
};

const postsCount = (state) =>
    state.posts.filter((post) => post.deleted_at == null).length;

const deletedPostsCount = (state) =>
    state.posts.filter((post) => post.deleted_at != null).length;

const filteredPosts = (state) => {
    let fPosts = [];

    //TODO split filters
    switch (state.filters.status) {
        case "all": {
            fPosts = state.posts;
            break;
        }
        case "published": {
            fPosts = state.posts.filter((post) => post.published == true);
            break;
        }
        case "unpublished": {
            fPosts = state.posts.filter((post) => post.published == false);
            break;
        }
    }

    //category filters
    if (!state.filters.category && state.filters.category !== 0) {

    } else {
        if (state.filters.category !== 0) {
            fPosts = fPosts.filter(
                (p) =>
                    p.categories.filter((c) => c == state.filters.category).length
            );
        } else {
            fPosts = fPosts.filter((fp) => {
                return fp.categories == 0

            });
        }
    }
    // search input filter
    if (state.filters.search.length) {
        fPosts = fPosts.filter((fpost) => {
            return (
                !state.filters.search ||
                fpost.title
                    .toLowerCase()
                    .indexOf(state.filters.search.toLowerCase()) > -1
            );
        });
    }

    //item deleted filter
    let itemNotDeleted = fPosts.filter((post) => post.deleted_at == null);
    return itemNotDeleted;
};

//CATEGORIES

const activePostsCategories = (state) => {
    return state.activePostsCategories;
};
const categoriesCount = (state) => state.activePostsCategories.length;


export default {
    allPosts,
    deletedPosts,
    singlePost,
    userPosts,
    deletedPostsCount,
    postsCount,
    filteredPosts,
    activePostsCategories,
    categoriesCount,
};

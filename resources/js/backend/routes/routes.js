import Users from "../pages/users/Users";
import User from "../pages/users/User";
import Desktop from "../pages/Desktop";

import Posts from "../pages/posts/Posts";
import Post from "../pages/posts/post/Post";

import Categories from "../pages/categories/Categories";

import Logs from "../pages/Logs";

const routes = [
    { path: "/", component: Desktop, name: "dashboard" },
    { path: "/users", component: Users },
    { path: "/user/:id", component: User, meta: { transitionName: 'slide' } },

    //posts
    { path: "/posts", component: Posts, name: "posts" },
    { path: "/post/:id", component: Post, name: "post", meta: { transitionName: 'slide' } },
    { path: "/post/add", component: Post, name: "post-add", meta: { transitionName: 'slide' } },
    { path: "/categories", component: Categories, name: "categories" },
    //categories


    //system
    { path: "/logs", component: Logs },
];

export default routes;

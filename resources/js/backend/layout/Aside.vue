<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <div class="sidebar">
            <NavUserPanel :user="user"></NavUserPanel>
            <NavTop></NavTop>
            <nav class="mt-2">
                <ul
                    class="nav nav-pills nav-sidebar flex-column"
                    data-widget="treeview"
                    role="menu"
                    data-accordion="false"
                >
                    <NavItem icon="fa-th" title="Desktop" link="/"></NavItem>
                    <NavItemTree
                        icon="fa-book-open"
                        name="blog"
                        title="Blog"
                        link="#"
                        :subItems="subMenuBlog"
                    ></NavItemTree>
                    <NavItemTree
                        icon="fa-user"
                        name="users"
                        title="Users"
                        link="#"
                        :subItems="subMenuUsers"
                    ></NavItemTree>
                    <NavItem
                        icon="fa-tools"
                        title="Logs"
                        link="/logs"
                    ></NavItem>
                </ul>
            </nav>
        </div>
        <Logout></Logout>
    </aside>
</template>

<script>
import NavItem from "./partials/aside/Navitem";
import NavItemTree from "./partials/aside/NavItemTree";
import NavTop from "./partials/aside/NavTop";
import NavUserPanel from "./partials/aside/NavUserPanel";

import Logout from "./partials/aside/Logout";
export default {
    components: {
        NavItem,
        NavItemTree,
        NavTop,
        NavUserPanel,
        Logout
    },
    props: ["user"],
    data() {
        return {
            subMenuBlog: [
                {
                    title: "Posts",
                    link: "/posts",
                    icon: "fa-file-alt"
                },
                {
                    title: "Categories",
                    link: "/categories",
                    icon: "fa-list-alt"
                }
            ],
            subMenuUsers: [
                {
                    title: "Users",
                    link: "/users",
                    icon: "fa-file-alt"
                },
                {
                    title: "Roles",
                    link: "/roles",
                    icon: "fa-list-alt"
                },
                {
                    title: "Permmisions",
                    link: "/permmisions",
                    icon: "fa-list-alt"
                }
            ]
        };
    }
};
</script>

<style lang="scss" scoped></style>

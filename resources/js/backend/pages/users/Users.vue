<template>
    <div class="container-fluid">
        <ContentHeader title="Users"></ContentHeader>
        <div class="row">
            <ContentColorBox title="Users" bg="blue"></ContentColorBox>
        </div>
        <div class="row py-5">
            <div class="col-lg-12 col-sm-12 col-12">
                <a
                    class="btn btn-success btn-sm text-white"
                    href="panel#/users/add"
                >
                    <i class="fas fa-plus"></i> Create
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Users</h3>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped projects">
                            <thead>
                                <tr>
                                    <th style="width: 1%"></th>
                                    <th style="width: 20%">Name</th>
                                    <th style="width: 30%">Email</th>
                                    <th>Roles</th>
                                    <th>Posts</th>
                                    <th style="width: 20%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <SingleUserRow
                                    v-for="user in allUsers"
                                    :key="user.id"
                                    :userData="user"
                                    :userPostUserPercentage="allUsers"
                                ></SingleUserRow>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapState } from "vuex";

import ContentHeader from "../../layout/partials/ContentHeader";
import ContentColorBox from "../../components/ContentColorBox";

import SingleUserRow from "./SingleUserRow";
import { method } from "lodash";
export default {
    components: {
        ContentColorBox,
        ContentHeader,
        SingleUserRow
    },
    mounted() {
        this.$store.dispatch("users/loadUsers");
    },
    computed: {
        allUsers() {
            return this.$store.getters["users/getUsers"];
        },
        postsCount() {
            return this.allUsers.reduce(
                (acc, cur) => acc + cur.posts.length,
                0
            );
        }
    },
    methods: {
        userPostUserPercentage(userPostsLength) {
            const allPostsCount = this.allUsers.reduce(
                (acc, cur) => acc + cur.posts.length,
                0
            );
            const postProcentage = Math.floor(
                (userPostsLength / allPostsCount) * 100
            );

            return postProcentage;
        }
    }
};
</script>

<style lang="scss" scoped></style>

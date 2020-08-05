<template>
    <div class="container-fluid">
        <ContentHeader
            :title="isEditing ? 'Edit user' : 'Create user'"
        ></ContentHeader>
        <div class="row py-5 ">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile" v-if="user">
                        <div class="text-center">
                            <img
                                class="profile-user-img img-fluid img-circle"
                                :src="
                                    `https://api.adorable.io/avatars/285/${user.id}@adorable.png`
                                "
                                alt="User profile picture"
                            />
                        </div>

                        <h3 class="profile-username text-center">
                            {{ user.name }}
                        </h3>

                        <p class="text-muted text-center" v-if="user.email">
                            {{ user.email }}
                        </p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Posts</b>
                                <a class="float-right">{{
                                    user.posts.length
                                }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Posts</b>
                                <a class="float-right">{{
                                    user.posts.length
                                }}</a>
                            </li>
                        </ul>

                        <a href="#" class="btn btn-primary btn-block"
                            ><b>Send message</b></a
                        >
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-lg-7 col-md-7 col-dm-12" v-if="userData">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Change User Data</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input
                                    v-model="userData.name"
                                    type="text"
                                    name="name"
                                    class="form-control"
                                    id="exampleInputEmail1"
                                    placeholder="Enter name"
                                />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile"
                                    >Avatar 75x75</label
                                >
                                <!-- <div class="input-group">
                                    <div class="custom-file">
                                        <input
                                            name="avatar"
                                            type="file"
                                            class="custom-file-input"
                                            id="exampleInputFile"
                                        />
                                        <label
                                            class="custom-file-label"
                                            for="exampleInputFile"
                                            >Choose file</label
                                        >
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id=""
                                            >Upload</span
                                        >
                                    </div>
                                </div> -->
                            </div>
                            <div class="form-group">
                                <label for="InputPassword">New password</label>
                                <input
                                    v-model="userData.password"
                                    type="password"
                                    class="form-control"
                                    id="exampleInputPassword1"
                                    placeholder="Password"
                                    name="password"
                                />
                            </div>
                            <div class="form-group">
                                <label for="ConfirmPassword"
                                    >Repeat password</label
                                >
                                <input
                                    v-model="userData.password"
                                    type="password"
                                    class="form-control"
                                    id="exampleInputPassword1"
                                    placeholder="Repeat password"
                                    name="confirm-password"
                                />
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button
                                type="submit"
                                class="btn btn-primary"
                                @click.prevent="formSubmit()"
                            >
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from "vuex";

import InfoBox from "../../components/InfoBox";
import ContentHeader from "../../layout/partials/ContentHeader";
export default {
    name: "User",
    components: {
        ContentHeader
    },
    data() {
        return {
            isEditing: true,
            userData: {
                email: "",
                name: "",
                password: "",
                confirmPassword: "",
                created_at: "",
                updated_at: ""
            }
        };
    },
    created() {
        this.userData = this.getUser(this.$route.params.id);
    },
    mounted() {
        this.$store.dispatch("users/loadUsers");
    },
    computed: {
        ...mapGetters("users", ["getUser"]),
        user() {
            console.log("this.$store", this.getUser(this.$route.params.id));
            let user = this.getUser(this.$route.params.id);
            this.userData = user;
            return user;
        },
        userPosts() {
            return this.$store.getters["posts/userPosts"];
        }
    },
    methods: {
        formSubmit() {
            this.$route.params.id > 0 ? this.updateUser() : this.createUser();
        },
        createUser() {
            this.$store.dispatch("users/createUser", this.userData).then(
                this.$notify({
                    group: "foo-css",
                    title: "Success!",
                    text: "User created",
                    type: "success"
                })
            );
            this.$router.push({ name: "users" });
        },
        updateUser() {
            this.$store.dispatch("users/updateUser", this.userData).then(
                this.$notify({
                    group: "foo-css",
                    title: "Update",
                    text: "User updated",
                    type: "success"
                }),
                this.$router.push({ name: "users" })
            );
        }
    }
};
</script>

<style lang="scss" scoped></style>

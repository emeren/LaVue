<template>
    <div class="container-fluid">
        <ContentHeader
            :title="isEditing ? 'Edit user' : 'Create user'"
        ></ContentHeader>
        <div class="row py-5 ">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile" v-if="userData">
                        <div class="text-center">
                            <img
                                class="profile-user-img img-fluid img-circle"
                                :src="
                                    `https://api.adorable.io/avatars/285/1@adorable.png`
                                "
                                alt="User profile picture"
                            />
                        </div>

                        <h3 class="profile-username text-center">
                            {{ userData.name }}
                        </h3>

                        <p class="text-muted text-center" v-if="userData.email">
                            {{ userData.email }}
                        </p>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">User posts</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <ul
                            class="products-list product-list-in-card pl-2 pr-2"
                        >
                            <li
                                class="item"
                                v-for="post in posts"
                                :key="post.id"
                            >
                                <div class="product-img">
                                    <img
                                        alt="Avatar"
                                        class="thumbnail"
                                        :src="
                                            `https://picsum.photos/${post.id}`
                                        "
                                    />
                                </div>
                                <div class="product-info">
                                    <a
                                        href="javascript:void(0)"
                                        class="product-title"
                                        >{{ post.title }}
                                        >
                                        <span
                                            class="product-description"
                                            v-html="post.description"
                                        >
                                        </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-7 col-dm-12" v-if="userData">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Change userData Data</h3>
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
                                <label for="exampleInputEmail1">Email</label>
                                <input
                                    v-model="userData.email"
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    id="exampleInputEmail1"
                                    placeholder="Enter email"
                                />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile"
                                    >Avatar 75x75</label
                                >
                                <div class="input-group">
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
                                </div>
                            </div>
                            <div class="form-group mt-3">
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
                                    v-model="userData.confirmPassword"
                                    type="password"
                                    class="form-control"
                                    id="exampleInputPassword1"
                                    placeholder="Repeat password"
                                    name="confirmPassword"
                                />
                            </div>
                            <div class="form-group">
                                <div class="mt-3">
                                    <input
                                        id="allowedLogin"
                                        type="checkbox"
                                        :value="userData.allowed_login"
                                        v-model="userData.allowed_login"
                                    />
                                    <label for="allowedLogin">
                                        Allowd login
                                    </label>
                                </div>
                            </div>

                            <UserRoles :userData="userData"></UserRoles>
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

import UserRoles from "./UserRoles";
export default {
    name: "User",
    components: {
        ContentHeader,
        UserRoles
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
                roles: [],
                updated_at: "",
                allowed_login: false
            }
        };
    },
    beforeCreate() {
        this.$store.dispatch("users/loadUsers");
        this.$store.dispatch("roles/loadRoles");
    },
    created() {
        if (this.$route.params.id > 0) {
            const user = this.singleUser(this.$route.params.id);
            this.userData = user;
            console.log("user123", user);
            this.isEditing = true;
        } else {
            this.isEditing = false;
        }
    },
    computed: {
        ...mapGetters("users", ["singleUser"]),
        ...mapGetters("users", ["userPosts"]),
        ...mapGetters("roles", ["getRoles"]),
        roles() {
            return this.getRoles;
        },
        posts() {
            let posts = this.userPosts(this.$route.params.id);
            return posts;
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

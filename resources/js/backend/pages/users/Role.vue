<template>
    <div class="container-fluid">
        <ContentHeader title="Manage role"></ContentHeader>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Change User Data</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form">
                <div class="card-body">
                    <div class="form-group" v-if="isEditing">
                        <label for="exampleInputEmail1">Name</label>
                        <input
                            v-model="roleData.name"
                            type="text"
                            name="name"
                            class="form-control"
                            id="exampleInputEmail1"
                            placeholder="Enter name"
                        />
                    </div>
                    <div class="form-group" v-if="isEditing">
                        <div>
                            <div
                                class="chiller_cb"
                                v-for="permission in permissions"
                                :key="permission.id"
                            >
                                <input
                                    v-if="roleData.permissions.length"
                                    :id="'cat' + permission.id"
                                    type="checkbox"
                                    :value="permission.id"
                                    v-model="roleData.permissions"
                                    @change="handlePermissionChange($event)"
                                    checked
                                />

                                <input
                                    v-else
                                    :id="'cat' + permission.id"
                                    type="checkbox"
                                    :value="permission.id"
                                    v-model="roleData.permissions"
                                    @change="handlePermissionChange($event)"
                                />
                                <label :for="'cat' + permission.id">
                                    {{ permission.name }}
                                </label>
                                <span></span>
                            </div>
                        </div>
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
</template>

<script>
import { mapGetters } from "vuex";

import InfoBox from "../../components/InfoBox";
import ContentHeader from "../../layout/partials/ContentHeader";
export default {
    name: "Role",
    components: {
        ContentHeader
    },
    data() {
        return {
            isEditing: false,
            roleData: {
                name: "",
                permissions: []
            }
        };
    },
    created() {
        if (this.$route.params.id > 0) {
            this.roleData = this.getRole(this.$route.params.id);
            console.log("roleData", this.roleData);
            this.isEditing = true;
        } else {
            this.isEditing = false;
        }
    },
    computed: {
        ...mapGetters("roles", ["getRole"]),
        permissions() {
            console.log("this.$store", this.$store);
            return this.$store.getters["permissions/getPermissions"];
        }
    },
    methods: {
        handlePermissionChange(event) {
            console.log("change", event.target.value);
        },
        formSubmit() {
            this.$route.params.id > 0 ? this.updatePost() : this.createPost();
        },
        updatePost() {
            this.$store.dispatch("roles/updateRole", this.roleData).then(
                this.$notify({
                    group: "foo-css",
                    title: "Update",
                    text: "Role updated",
                    type: "success"
                }),
                this.$router.push({ name: "roles" })
            );
        },
        createPost() {
            this.$store.dispatch("roles/createRole", this.roleData).then(
                this.$notify({
                    group: "foo-css",
                    title: "Success!",
                    text: "Role added to database",
                    type: "success"
                })
            );
            this.$router.push({ name: "roles" });
        }
    }
};
</script>

<style lang="scss" scoped></style>

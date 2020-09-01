<template>
    <div class="row">
        <div class="col-lg-12 py-3">
            <div class="actions">
                <a
                    class="btn btn-success btn-sm text-white"
                    href="panel#/role/add"
                >
                    <i class="fas fa-plus"></i> Create
                </a>
            </div>
        </div>
        <div class="col-lg-12 py-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Users roles</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10px">id</th>
                                <th>Role name</th>
                                <th>Permissions</th>
                                <th style="width: 40px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="role in allRoles.slice().reverse()"
                                :key="role.id"
                            >
                                <td>{{ role.id }}</td>
                                <td>{{ role.name }}</td>
                                <td>
                                    <ul class="list-unstyled">
                                        <li
                                            v-for="permission in role.permissions"
                                            :key="permission"
                                        >
                                            {{ permissionName(permission) }} |
                                            {{
                                                permissionGuardName(permission)
                                            }}
                                        </li>
                                    </ul>
                                </td>
                                <td class="project-actions text-right">
                                    <a class="btn btn-primary btn-sm" href="#">
                                        <a :href="`/panel#/role/${role.id}`"
                                            ><i
                                                class="fas fa-search text-white"
                                            ></i
                                        ></a>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Roles",
    mounted() {
        this.$store.dispatch("roles/loadRoles");
        this.$store.dispatch("permissions/loadPermissions");
    },
    computed: {
        allRoles() {
            return this.$store.getters["roles/getRoles"];
        },
        allPermisions() {
            console.log(
                "object",
                this.$store.getters["permissions/getPermissions"]
            );
            return this.$store.getters["permissions/getPermissions"];
        },
        postsCount() {
            return this.allUsers.reduce(
                (acc, cur) => acc + cur.posts.length,
                0
            );
        }
    },
    methods: {
        permissionName(permission) {
            return this.allPermisions.find(perm => perm.id === permission).name;
        },
        permissionGuardName(permission) {
            return this.allPermisions.find(perm => perm.id === permission)
                .guard_name;
        }
    }
};
</script>

<style lang="scss" scoped></style>

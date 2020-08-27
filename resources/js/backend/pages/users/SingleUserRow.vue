<template>
    <tr>
        <td>
            <img
                alt="Avatar"
                class="table-avatar"
                :src="
                    `https://api.adorable.io/avatars/285/${userData.id}@adorable.png`
                "
            />
        </td>
        <td>
            <a>{{ userData.name }}</a>
            <br />
            <small>Created {{ userData.created_at }}</small>
        </td>
        <td>
            <a>{{ userData.email }}</a>
        </td>
        <td v-if="userData.roles.length" class="roleListBox">
            <span
                class="roleListItem"
                v-for="roleId in userData.roles"
                :key="roleId"
                >{{ getRoleName(roleId) }}</span
            >
        </td>
        <td v-else>none</td>
        <td class="project_progress">
            <div class="progress progress-sm">
                <div
                    class="progress-bar bg-green"
                    role="progressbar"
                    aria-volumenow="57"
                    aria-volumemin="0"
                    aria-volumemax="100"
                    :style="`width: ${userPostUserPercentage}%`"
                ></div>
            </div>
            <small>
                <strong>{{ userData.posts.length }}</strong> posts in blog
            </small>
        </td>
        <td class="project-actions text-right">
            <a class="btn btn-primary btn-sm" href="#">
                <a :href="`/panel#/user/${userData.id}`"
                    ><i class="fas fa-search text-white"></i
                ></a>
            </a>
        </td>
    </tr>
</template>

<script>
import { mapGetters } from "vuex";
export default {
    name: "SingleUserRow",
    props: {
        userData: {
            required: true
        },
        userPostUserPercentage: {
            required: false
        }
    },
    data() {
        return {
            user: {}
        };
    },
    created() {
        console.log("this.userData", this.userData);
    },
    computed: {
        ...mapGetters("user", ["activeUserRoles"]),
        ...mapGetters("roles", ["getRoles"])
    },
    methods: {
        getRoleName(roleId) {
            let roles = this.getRoles;
            let role = roles.filter(role => role.id == roleId);
            if (role.length) {
                return role[0]["name"];
            }
            return "none";
        }
    }
};
</script>

<style lang="scss" scoped>
.change-status-btn {
    cursor: pointer;
}
.roleListBox {
    // display: flex;
    // flex-wrap: nowrap;
    .roleListItem {
        background: lightblue;
        padding: 2px 6px;
        margin: 2px;
        border-radius: 5px;
    }
}
.thumbnail {
    border-radius: 100%;
}
</style>

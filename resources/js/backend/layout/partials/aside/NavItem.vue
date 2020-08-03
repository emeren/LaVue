<template>
    <li class="nav-item">
        <router-link
            exact-active-class="active"
            :to="link"
            :class="`nav-link`"
            :target="target"
        >
            <i :class="`nav-icon fas ${icon}`"></i>
            <p>
                {{ title }}
                <span class="right badge badge-danger">{{ rightText }}</span>
            </p>
        </router-link>
    </li>
</template>

<script>
export default {
    props: {
        title: {
            type: String,
            default: "empty title"
        },
        link: {
            type: String,
            default: "empty title"
        },
        rightText: {
            type: String,
            default: ""
        },
        icon: {
            type: String,
            default: "fa-th"
        },
        target: {
            type: String,
            default: "_self"
        }
    }
};
</script>

<style lang="scss" scoped></style>

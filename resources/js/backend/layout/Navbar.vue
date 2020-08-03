<template>
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a
                    class="nav-link"
                    data-widget="pushmenu"
                    href="#"
                    @click="toggleAside"
                >
                    <i class="fas fa-bars"></i>
                </a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a
                    class="nav-link"
                    data-widget="control-sidebar"
                    data-slide="true"
                    href="#"
                    @click="goDashboard"
                >
                    <i class="fas fa-th-large"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->
</template>

<script>
import { mapGetters } from "vuex";
export default {
    name: "Navbar",
    data() {
        return {
            isAsideActive: false
        };
    },
    computed: {},
    methods: {
        toggleAside() {
            this.$store.dispatch("dashboard/toggleAside");
        },
        goDashboard() {
            this.$router.push({ path: "/" });
        }
    }
};
</script>

<style lang="scss" scoped></style>

<template>
    <div class="p-3 mx-auto cover-container d-flex w-100 h-100 flex-column">
        <header class="mb-auto masthead">
            <div class="inner">
                <h3 class="masthead-brand">LaVue CMS</h3>
                <nav class="nav nav-masthead justify-content-center">
                    <a class="nav-link active" href="#">Home</a>
                    <a class="nav-link" href="#">Documentation</a>
                    <a class="nav-link" href="#">GitHub</a>
                    <a class="nav-link" href="#">Contact</a>
                </nav>
            </div>
        </header>

        <main role="main" class="text-center inner cover">
            <h1 class="cover-heading">LaVue CMS</h1>
            <p class="lead">
                Laravel, Vue, Vuex, Bootstrap - cms project
            </p>
            <p class="lead">
                <a href="#" class="btn btn-lg btn-secondary">github</a>
            </p>
        </main>
        <Footer></Footer>
    </div>
</template>

<script>
import Footer from "./layout/Footer";
export default {
    name: "Main",
    components: {
        Footer
    }
};
</script>

<style lang="scss" scoped></style>

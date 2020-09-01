<template>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ title }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Layout</a>
                        </li>
                        <li class="breadcrumb-item active">{{ title }}</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
</template>

<script>
export default {
    name: "ContentHeader",
    props: {
        title: {
            type: String,
            default: "empty title"
        }
    }
};
</script>

<style lang="scss" scoped></style>

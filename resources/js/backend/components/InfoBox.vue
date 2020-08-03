<template>
    <div :class="`col-lg-${size}`">
        <div class="info-box">
            <span :class="`info-box-icon bg-${bg}`">
                <i :class="`fa ${icon}`"></i
            ></span>

            <div class="info-box-content">
                <span class="info-box-text"> {{ title }}</span>
                <span class="info-box-number">{{ number }}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
</template>

<script>
export default {
    props: {
        icon: {
            type: String,
            default: "fas fa-user"
        },
        number: {
            default: "0"
        },
        title: {
            type: String,
            default: "empty title"
        },
        link: {
            type: String,
            default: "#"
        },
        linkText: {
            type: String,
            default: "Link tekst"
        },
        size: {
            default: 3
        },
        //from bootstrap primarry,succes etc
        bg: {
            type: String,
            default: "info"
        }
    }
};
</script>

<style lang="scss" scoped></style>

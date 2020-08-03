<template>
    <div :class="`col-lg-${size}`">
        <!-- small box -->
        <div :class="`small-box bg-${bg}`">
            <div class="inner">
                <h3>{{ number }}</h3>
                <p>{{ title }}</p>
            </div>
            <div class="icon">
                <i :class="icon"></i>
            </div>
            <a :href="link" class="small-box-footer">
                {{ linkText }}
                <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
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

<template>
    <div class="container-fluid">
        <ContentHeader title="Categories"></ContentHeader>
        <div class="row">
            <InfoBox bg="success" size="6"></InfoBox>
            <InfoBox
                bg="primary"
                title="Posts count"
                :number="4"
                size="6"
            ></InfoBox>
        </div>

        <div class="justify-content-between row">
            <nested-test class="col-8" v-model="nestedCategories" />
            <!-- <raw-displayer
                class="col-4"
                :title="'Vuex Store'"
                :value="elements"
      />-->
        </div>
    </div>
</template>

<script>
import ContentHeader from "../layout/partials/ContentHeader";
import ContentColorBox from "../components/ContentColorBox";
import InfoBox from "../components/InfoBox";
import NestedTest from "./components/NestedCategory.vue";
import SingleCategoryRow from "./components/SingleCategoryRow";

import { mapGetters } from "vuex";
export default {
    data() {
        return {
            name: "Categories",
            display: "Nested (v-model & vuex)",
            order: 16
        };
    },

    components: {
        ContentHeader,
        InfoBox,
        NestedTest,
        singleRow: SingleCategoryRow
    },
    created() {
        this.$store.dispatch("categories/loadCategories");
    },

    computed: {
        ...mapGetters("categories", ["getCategories"]),
        nestedCategories: {
            get() {
                return this.getCategories;
            },
            set(value) {
                console.log(value);
                this.$store.dispatch("categories/updateCategories", value);
            }
        }
    },
    methods: {}
};
</script>

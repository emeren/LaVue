<template>
  <div class="container-fluid">
    <ContentHeader title="Kategorie"></ContentHeader>
    <div class="row">
      <InfoBox bg="success" size="6"></InfoBox>
      <InfoBox bg="primary" title="empty title" :number="4" size="6"></InfoBox>
    </div>
    <div class="row py-5">
      <div class="col-md-5">
        <h2>Dostosuj uklad kategorii</h2>
      </div>
    </div>
    <div class="justify-content-between row">
      <!-- <nested-test class="col-6" v-model="nestedCategories" /> -->
      <div class="col-md-6 categoriesBlock">
        <CategoryList
          class
          v-for="category in getCategories"
          :key="category.id"
          :categories="category.children"
          :name="category.name"
          :catId="category.id"
          :postsCount="category.postsCount"
          :current="category"
        ></CategoryList>
      </div>
      <CategoryForm :cats="flatCategories"></CategoryForm>
    </div>
  </div>
</template>

<script>
import ContentHeader from "../../layout/partials/ContentHeader";
import ContentColorBox from "../../components/ContentColorBox";
import InfoBox from "../../components/InfoBox";

import CategoryForm from "./CategoryForm";
import CategoryList from "./CategoryList";
import NestedTest from "./NestedCategory.vue";
import SingleCategoryRow from "./SingleCategoryRow";

import { mapGetters } from "vuex";
export default {
  data() {
    return {
      categoryData: [],
      editing: false,
    };
  },

  components: {
    CategoryForm,
    SingleCategoryRow,
    ContentHeader,
    InfoBox,
    NestedTest,
    singleRow: SingleCategoryRow,
    CategoryList,
  },
  created() {
    this.$store.dispatch("categories/loadCategories");
  },
  mounted() {
    this.categoryData = this.nestedCategories;
  },

  computed: {
    ...mapGetters("categories", ["getCategories"]),
    ...mapGetters("categories", ["singleCategory"]),
    ...mapGetters("categories", ["flatCategories"]),

    setCategory() {
      this.categoryData = this.singleCategory;
    },

    nestedCategories: {
      get() {
        return this.getCategories;
      },
      set(value) {
        this.$store.dispatch("categories/updateCategories", value);
      },
    },
  },
  methods: {
    editCategory(el) {
      this.categoryData = el;
    },
    handleChange() {
      console.log("changed");
    },
    inputChanged(value) {
      this.activeNames = value;
    },
    getComponentData() {
      return {
        on: {
          change: this.handleChange,
          input: this.inputChanged,
        },
        attrs: {
          wrap: true,
        },
        props: {
          value: this.activeNames,
        },
      };
    },
  },
};
</script>

<style lang="scss">
// .categoriesBlock {
//   ul:first-child {
//     margin-left: 0px;
//     padding-left: 0px;
//   }
// }
// .categoriesItems li:first-child {
//   &:before {
//     border: 0px;
//   }
// }
</style>

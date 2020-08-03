<template>
  <ul class="categoryList">
    <li
      class="p-3 mb-3 d-flex border justify-content-between border-white shadow rounded-lg cursor-move categoriesItem flex-wrap w-100"
    >
      <div class="d-flex align-items-center singleCat">
        <i class="fas fa-circle text-info"></i>
        <span class="ml-2 font-semibold font-sans tracking-wide">
          <strong>{{ name }}</strong>:
          <small class="text-gray">id: {{catId || 1}}</small>
          <small class="text-gray">Active posts: {{postsCount || 1}}</small>
        </span>
      </div>
      <div class="d-flex justify-content-between catActions">
        <a class="btn btn-primary btn-xs text-white" @click="editCategory(current)">
          <i class="fas fa-pencil-alt"></i>
        </a>
        <a class="btn btn-danger btn-xs text-white" @click="deleteCategory(current.id)">
          <i class="fas fa-trash"></i>
        </a>
      </div>
    </li>
    <CategoryList
      v-for="category in categories"
      :key="category.id"
      :categories="category.children"
      :name="category.name"
      :catId="category.id"
      :postsCount="category.postsCount"
      :current="category"
    ></CategoryList>
  </ul>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  name: "CategoryList",
  props: ["name", "categories", "catId", "postsCount", "current"],
  methods: {
    editCategory(category) {
      console.log("category :", category);
      this.$store.dispatch("categories/editCategory", category);
    },
    deleteCategory(catId) {
      this.$store.dispatch("categories/deleteCategory", catId).then(
        this.$notify({
          group: "foo-css",
          title: "Sukces!",
          text: "Category została usunieta",
          type: "danger",
        })
      );
    },
  },
};
</script>

<style lang="scss">
ul.categoryList {
  list-style-type: none;
  position: relative;
  &:before {
    content: "";
    display: block;
    width: 0;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    border-left: 1px solid;
  }
  .categoriesItem {
    position: relative;
    &:before {
      content: "";
      display: block;
      width: 40px;
      left: -40px;
      height: 0;
      border-top: 1px solid;
      margin-top: -1px;
      position: absolute;
    }
  }
}
.catActions {
  width: 50px;
}
</style>
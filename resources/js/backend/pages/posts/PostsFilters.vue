<template>
  <div class="row p-4 postsTopBar">
    <div class="actions">
      <a class="btn btn-success btn-sm text-white" href="panel#/post/add">
        <i class="fas fa-plus"></i> Dodaj post
      </a>
    </div>
    <div class="d-flex flex-wrap filters">
      <div class="form-group search">
        <label>Szukaj:</label>
        <input @keyup="searchByWord" type="text" class="form-control" v-model="filters.search" />
      </div>
      <div class="form-group">
        <label>Category:</label>
        <select class="custom-select" @change="changeCategory">
          <option :value="null">All</option>
          <option
            v-for="(category, index) in postsCategories"
            :key="index"
            :value="category"
          >{{getCategoryName(category)}}</option>
          <option value="0">none</option>
        </select>
      </div>
      <div class="form-group">
        <label>Status:</label>
        <select class="custom-select" @change="changeStatus">
          <option value="all">All</option>
          <option value="published">Opublikowane</option>
          <option value="unpublished">Nieopublikowane</option>
        </select>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapState, mapActions } from "vuex";
export default {
  name: "PostsFilters",
  data() {
    return {
      filters: {
        status: "all",
        category: "",
        search: "",
      },
    };
  },
  computed: {
    ...mapGetters("posts", ["activePostsCategories"]),
    ...mapGetters("categories", ["getUniqeCats"]),
    postsCategories() {
      return this.activePostsCategories;
    },
  },
  methods: {
    changeStatus(e) {
      this.filters.status = e.target.value;
      this.$store.dispatch("posts/statusFilter", this.filters.status);
    },

    changeCategory(e) {
      this.filters.category = e.target.value;
      this.$store.dispatch("posts/categoryFilter", this.filters.category);
    },
    searchByWord(e) {
      this.$store.dispatch("posts/searchByWord", this.filters.search);
    },
    getCategoryName(catId) {
      let category = this.getUniqeCats.filter((cat) => cat.id == catId);
      if (category.length) {
        return category[0]["name"];
      }
      return "none";
    },
  },
};
</script>

<style lang="scss" scoped>
.postsTopBar {
  width: 100%;
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: space-between;
  .actions {
    flex: 1;
  }

  .filters {
    flex: 2;
    .form-group {
      margin: 0 5px;
    }
    .search {
      flex: 2;
    }
  }
}
</style>

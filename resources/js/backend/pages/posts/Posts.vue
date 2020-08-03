<template>
  <div class="container-fluid">
    <ContentHeader title="Posty"></ContentHeader>
    <div class="row" v-if="postsCount">
      <InfoBox
        :size="`4`"
        :number="categoriesCount"
        bg="success"
        title="Active catagories"
        icon="fa-list"
      ></InfoBox>
      <InfoBox :size="`4`" :number="postsCount" bg="success" title="Articles" icon="fa-book-open"></InfoBox>
      <InfoBox
        :size="`4`"
        :number="deletedPostsCount"
        bg="danger"
        title="Articles removed"
        icon="fa-trash"
      ></InfoBox>

      <PostsFilters :perPage="perPage"></PostsFilters>
    </div>
    <div class="row"></div>
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Blog</h3>
      </div>
      <tr class="card-body p-0">
        <table class="table table-striped posts">
          <thead>
            <tr>
              <th style="width: 1%">#</th>
              <th style="width: 10%">Img</th>
              <th style="width: 30%">Tytuł</th>
              <th style="width: 15%">Data</th>
              <th style="width: 20%">Category</th>
              <th style="width: 5%" class="text-center">Status</th>
              <th style="width: 20%"></th>
            </tr>
          </thead>

          <paginate name="posts" :list="posts" :per="perPage" tag="tbody" v-if="posts.length">
            <SinglePostRow
              v-for="(post, index) in paginated('posts')"
              :key="index"
              :postData="post"
            ></SinglePostRow>
          </paginate>
          <div class="noData" v-else>none danych :(</div>
        </table>
        <!-- /.card-body -->
      </tr>
    </div>

    <paginate-links for="posts" :hide-single-page="true" :async="true"></paginate-links>
  </div>
</template>

<script>
import ContentHeader from "../../layout/partials/ContentHeader";
import InfoBox from "../../components/InfoBox";
import SinglePostRow from "./SinglePostRow";
import PostsFilters from "./PostsFilters";
import { mapGetters, mapState } from "vuex";
export default {
  components: {
    InfoBox,
    ContentHeader,
    SinglePostRow,
    PostsFilters,
  },
  mounted() {
    //TODO check if posts exists
    this.$store.dispatch("posts/loadPosts");
    this.$store.dispatch("categories/loadCategories");
    console.log();
  },
  data() {
    return {
      //filter when page load
      // filters: { status: "all", category: 0 },
      paginate: ["posts"],
      perPage: 8,
    };
  },

  computed: {
    ...mapGetters("posts", [
      "postsCount",
      "deletedPostsCount",
      "categoriesCount",
      "activePostsCategories",
      "filteredPosts",
    ]),
    posts() {
      console.log("filteredPots", this.filteredPosts);
      return this.filteredPosts;
    },
    categories() {
      return this.activePostsCategories;
    },
  },
};
</script>

<style lang="scss">
ul.paginate-links.posts {
  margin: 0 auto;
  width: 30%;
  display: flex;
  list-style: none;
  justify-content: flex-start;
  align-items: center;
  height: 20px;

  li.number {
    margin: 20px 5px;
    cursor: pointer;
    background: #ddd;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    &.active {
      background: #444;
      color: #fff;
    }
    a {
      width: 30px;
      height: 30px;
      text-align: center;
      line-height: 30px;
    }
  }
}
.noData {
  width: 200px;
  font-size: 20px;
  padding: 20px;
}
.table td {
  vertical-align: middle;
  border-top: 1px solid #dee2e6;
}
</style>

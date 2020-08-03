<template>
  <div class="card">
    <div class="card-header border-0">
      <h3 class="card-title">Recent posts</h3>
    </div>
    <div class="card-body table-responsive p-0">
      <table class="table table-striped table-valign-middle">
        <thead>
          <tr>
            <th>Title</th>
            <th>Data</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(post, index) in getLatestPosts" :key="index">
            <td>
              <img
                src="https://picsum.photos/32"
                alt="Product 1"
                class="img-circle img-size-32 mr-2"
              />
              {{ post.title.trim(0) }}
            </td>
            <td>{{ post.created_at }}</td>
            <td>
              <i
                :class="`fas fa-circle ${
                                    post.published
                                        ? 'text-success'
                                        : 'text-danger'
                                } mr-3`"
                alt="unpublsied"
              ></i>
            </td>
            <td>
              <a href="#" class="text-muted" @click="goToPost(post.id)">
                <i class="fas fa-search"></i>
              </a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  name: "LatestPost",
  mounted() {
    this.$store.dispatch("posts/loadPosts");
  },
  computed: {
    ...mapGetters("posts", ["filteredPosts"]),
    getLatestPosts() {
      return this.filteredPosts.slice(0, 5);
    },
  },
  methods: {
    goToPost(postId) {
      this.$router.push({ name: "post", params: { id: postId } });
    },
  },
};
</script>

<style lang="scss" scoped></style>

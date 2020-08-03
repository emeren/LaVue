<template>
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Thumbnail</h3>

      <div class="card-tools">
        <button
          type="button"
          class="btn btn-tool"
          data-card-widget="collapse"
          data-toggle="tooltip"
          title="Collapse"
        >
          <i class="fas fa-calendar"></i>
        </button>
      </div>
    </div>
    <div class="card-body d-flex justify-content-center">
      <img alt="Avatar" class="thumbnail" src="https://picsum.photos/300" />
    </div>
    <!-- /.card-body -->
  </div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  props: {
    postData: {
      required: true,
    },
  },
  data() {
    return {
      setCategory: [],
    };
  },
  computed: {
    ...mapGetters("posts", ["usedCategories"]),
    categories() {
      return this.activePostsCategories;
    },
  },
  methods: {
    categoryChange(e) {
      // console.log(e.target.value);
    },
  },
};
</script>

<style lang="scss" scoped>
.thumbnail {
  border: 1px #ddd solid;
  padding: 5px;
  border-radius: 5px;
}
</style>

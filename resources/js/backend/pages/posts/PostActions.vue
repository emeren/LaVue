<template>
  <td class="project-actions text-right">
    <a class="btn btn-primary btn-sm" :href="`#/post/${postData.id}`">
      <i class="fas fa-pencil-alt"></i>
      Edit
    </a>
    <a class="btn btn-danger btn-sm text-white" @click="deletePost()">
      <i class="fas fa-trash"></i>
      Delete
    </a>
  </td>
</template>

<script>
export default {
  name: "PostActions",
  props: {
    postData: {
      required: true
    }
  },
  methods: {
    deletePost() {
      this.$store.dispatch("posts/deletePost", this.postData.id).then(
        this.$notify({
          group: "foo-css",
          title: "Komunikat",
          text: "Post został usunięty z bazy",
          type: "warn"
        })
      );
    }
  }
};
</script>

<style lang="scss" scoped></style>

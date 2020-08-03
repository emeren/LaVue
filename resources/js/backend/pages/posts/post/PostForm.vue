<template>
  <div>
    <div class="card postForm">
      <div class="card-header">
        <div>
          <h3 class="card-title">Główne treści</h3>
        </div>
        <!-- Small switch -->
        <div class="form-group">
          <span class="switch switch-sm">
            <label for="switch-sm" class="mr-2 mb-0">Status</label>
            <input
              type="checkbox"
              class="switch success ml-2"
              id="switch-sm"
              v-model="postData.published"
            />
            <label for="switch-sm"></label>
          </span>
        </div>
      </div>
      <div class="card-body">
        <div class="form-group" v-if="postData">
          <label for="inputName">Tytuł posta</label>
          <input type="text" id="inputName" class="form-control" v-model="postData.title" />
        </div>
        <div class="form-group" v-if="postData">
          <label for="inputName">Slug</label>
          <input type="text" id="inputName" class="form-control" />
        </div>
        <hr />
        <div class="form-group" v-if="postData">
          <label for="inputShortDescription">Zajawka</label>
          <textarea
            id="inputShortDescription"
            class="form-control"
            rows="3"
            v-model="postData.shortDescription"
          ></textarea>
        </div>
        <div class="form-group" v-if="postData">
          <label for="inputDescription">Główny tekst</label>
          <vue-editor :row="10" id="inputDescription" v-model="postData.description"></vue-editor>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { VueEditor } from "vue2-editor";
export default {
  components: {
    VueEditor
  },
  props: {
    postData: {
      required: true
    }
  },
  methods: {
    changeStatus() {
      this.postData.published = !this.postData.published;
    }
  }
};
</script>
<style lang="scss">
#inputDescription {
  height: 450px;
}
</style>
<style lang="scss" scoped>
hr {
  margin: 25px 0px;
}
.card-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  .form-group {
    margin: 0px 0px 0px auto;
  }
}
</style>

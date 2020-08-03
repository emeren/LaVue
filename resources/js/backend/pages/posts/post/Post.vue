<template>
  <div class="container-fluid">
    <ContentHeader :title="isEditing ? 'Edycja posta' : 'Dodaj post'"></ContentHeader>
    <div class="row">
      <InfoBox
        :size="`4`"
        :number="countTitleChar"
        bg="success"
        title="Długosc tytułu"
        icon="fa-list"
      ></InfoBox>
      <InfoBox
        :size="`4`"
        :number="countDescChar"
        bg="success"
        title="Długość opisu"
        icon="fa-book-open"
      ></InfoBox>
      <InfoBox :size="`4`" :number="5" bg="info" title="Słowa kluczowe" icon="fa-pen"></InfoBox>
    </div>
    <div class="row">
      <div class="col-md-12 topButtons">
        <div></div>
        <div>
          <input
            :value="submitBusttonText"
            class="btn btn-success float-left"
            @click.prevent="formSubmit()"
          />
          <a class="btn btn-info btn-secondar text-white ml-2" @click="$router.go(-1)">
            <i class="fa fa-arrow-alt-circle-left"></i>
          </a>
        </div>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-md-8">
        <PostForm :postData="postData"></PostForm>
        <PostGallery :postData="postData"></PostGallery>
      </div>
      <!-- /.card -->
      <!-- //SIDEBAR -->
      <div class="col-md-4">
        <PostMeta :postData="postData"></PostMeta>
        <PostInfo :postData="postData"></PostInfo>
        <PostThumbnail :postData="postData"></PostThumbnail>
      </div>
    </div>
    <div class="row justify-content-end">
      <a class="btn btn-danger btn-secondar text-white mr-2" @click="$router.go(-1)">Anuluj</a>
      <input
        type="submit"
        :value="submitBusttonText"
        class="btn btn-success float-right"
        @click.prevent="formSubmit()"
      />
    </div>
  </div>
</template>

<script>
import InfoBox from "../../../components/InfoBox";
import ContentHeader from "../../../layout/partials/ContentHeader";

import PostInfo from "./PostInfo";
import PostMeta from "./PostMeta";
import PostForm from "./PostForm";
import PostThumbnail from "./PostThumbnail";
import PostGallery from "./PostGallery";
import { mapGetters, mapState } from "vuex";
export default {
  components: {
    InfoBox,
    ContentHeader,
    PostForm,
    PostThumbnail,
    PostGallery,
    PostInfo,
    PostMeta
  },
  data() {
    return {
      isEditing: false,
      submitBusttonText: "",
      pageTitle: "",
      titleChar: 0,
      textChar: 0,
      postData: {
        title: "",
        description: "",
        thumbnail: null,
        gallery: null,
        publish_from: "",
        publish_to: "",
        published: 1,
        categories: []
      }
    };
  },
  // watch: {
  //   postData: function(newPost, oldPost) {
  //     console.log("newval");
  //     console.log(newPost);
  //     console.log("old");
  //     console.log(oldPost);
  //   }
  // },
  created() {
    if (this.$route.params.id > 0) {
      this.submitBusttonText = "Zaktualizuj";
      this.pageTitle = "Edycja artykulu";
      this.postData = this.singlePost(this.$route.params.id);
      this.isEditing = true;
    } else {
      this.pageTitle = "Tworzenie artykułu";
      this.submitBusttonText = "Dodaj artykuł";
      this.isEditing = false;
    }
  },
  computed: {
    ...mapGetters("posts", ["singlePost"]),
    countTitleChar() {
      let title = this.postData.title;
      this.titleChar = title.length;
      return this.titleChar;
    },
    countDescChar() {
      let text = this.postData.description;
      this.textChar = text.length;
      return this.textChar;
    }
  },
  methods: {
    formSubmit() {
      this.$route.params.id > 0 ? this.updatePost() : this.createPost();
    },
    updatePost() {
      this.$store.dispatch("posts/updatePost", this.postData).then(
        this.$notify({
          group: "foo-css",
          title: "Aktualizacja",
          text: "Post został zaktualizowany",
          type: "success"
        }),
        this.$router.push({ name: "posts" })
      );
    },
    createPost() {
      this.$store.dispatch("posts/createPost", this.postData).then(
        this.$notify({
          group: "foo-css",
          title: "Sukces!",
          text: "Post został dodany do bazy",
          type: "success"
        })
      );
      this.$router.push({ name: "posts" });
    }
  }
};
</script>

<style lang="scss" scoped>
.postForm {
  padding-left: 5px;
  padding-right: 5px;
}
.topButtons {
  display: flex;
  justify-content: space-between;
}
</style>

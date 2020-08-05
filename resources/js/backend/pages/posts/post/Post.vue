<template>
    <div class="container-fluid">
        <ContentHeader
            :title="isEditing ? 'Edit post' : 'Create post'"
        ></ContentHeader>
        <div class="row">
            <InfoBox
                :size="`4`"
                :number="countTitleChar"
                bg="success"
                title="Title length"
                icon="fa-list"
            ></InfoBox>
            <InfoBox
                :size="`4`"
                :number="countDescChar"
                bg="success"
                title="Description length"
                icon="fa-book-open"
            ></InfoBox>
            <InfoBox
                :size="`4`"
                :number="5"
                bg="info"
                title="Key words"
                icon="fa-pen"
            ></InfoBox>
        </div>
        <div class="row">
            <div class="col-md-12 topButtons">
                <div v-if="isEditing">
                    Created by:
                    <a href="#">{{ this.postData.author.email }}</a>
                </div>
                <div>
                    <input
                        :value="submitBusttonText"
                        class="btn btn-success float-left"
                        @click.prevent="formSubmit()"
                    />
                    <a
                        class="btn btn-info btn-secondar text-white ml-2"
                        @click="$router.go(-1)"
                    >
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
            <a
                class="btn btn-danger btn-secondar text-white mr-2"
                @click="$router.go(-1)"
                >Cancle</a
            >
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
import { mapGetters } from "vuex";

import InfoBox from "../../../components/InfoBox";
import ContentHeader from "../../../layout/partials/ContentHeader";

import PostInfo from "./PostInfo";
import PostMeta from "./PostMeta";
import PostForm from "./PostForm";
import PostThumbnail from "./PostThumbnail";
import PostGallery from "./PostGallery";

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
    created() {
        if (this.$route.params.id > 0) {
            this.submitBusttonText = "Update";
            this.pageTitle = "Edycja artykulu";
            this.postData = this.singlePost(this.$route.params.id);
            this.isEditing = true;
        } else {
            this.pageTitle = "Creating article";
            this.submitBusttonText = "Add Article";
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
                    title: "Update",
                    text: "Post updated",
                    type: "success"
                }),
                this.$router.push({ name: "posts" })
            );
        },
        createPost() {
            this.$store.dispatch("posts/createPost", this.postData).then(
                this.$notify({
                    group: "foo-css",
                    title: "Success!",
                    text: "Post added to database",
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
    align-items: center;
}
</style>

<template>
    <tr class="singlePost">
        <td>{{ postData.indigo }}</td>
        <!-- //THUMNAIL -->
        <td>
            <img
                alt="Avatar"
                class="thumbnail"
                src="https://picsum.photos/50"
            />
        </td>
        <!-- //TITLE -->
        <td>
            <a>{{ postData.title }}</a>
            <br />
        </td>
        <td>
            <a>
                <small>{{ postData.created_at }}</small>
            </a>
            <br />
        </td>
        <!-- //CATEGORY  -->
        <td v-if="postData.categories.length" class="catListBox">
            <span
                class="catListItem"
                v-for="(catId, index) in postData.categories"
                :key="index"
                >{{ getCategoryName(catId) }}</span
            >
        </td>
        <td v-else>none</td>
        <!-- STATUS-->
        <td class="project-state">
            <span
                v-if="postData.published"
                class="badge badge-success change-status-btn"
                @click="changeStatus"
            >
                <i class="fa fa-check"></i>
            </span>
            <span
                v-else
                class="badge badge-danger change-status-btn"
                @click="changeStatus"
            >
                <i class="fa fa-times"></i>
            </span>
        </td>
        <!-- ACTION -->
        <PostActions :postData="postData"></PostActions>
    </tr>
</template>

<script>
import PostActions from "./PostActions";
import { mapGetters } from "vuex";
export default {
    name: "SinglePostRow",
    components: {
        PostActions
    },
    props: {
        postData: {
            required: true
        }
    },
    data() {
        return {
            post: {}
        };
    },
    computed: {
        ...mapGetters("posts", ["activePostsCategories"]),
        ...mapGetters("categories", ["getUniqeCats"])
    },
    methods: {
        changeStatus() {
            this.post = this.postData;
            this.post.published = !this.post.published;

            this.$store.dispatch("posts/updatePost", this.post).then(res => {
                this.$notify({
                    group: "foo-css",
                    title: "Updated",
                    text: "Status updated",
                    type: "success"
                });
            });
        },
        getCategoryName(catId) {
            let category = this.getUniqeCats.filter(cat => cat.id == catId);
            if (category.length) {
                return category[0]["name"];
            }
            return "none";
        }
    }
};
</script>

<style lang="scss" scoped>
.change-status-btn {
    cursor: pointer;
}
.catListBox {
    // display: flex;
    // flex-wrap: nowrap;
    .catListItem {
        background: lightblue;
        padding: 2px 6px;
        margin: 2px;
        border-radius: 5px;
    }
}
.thumbnail {
    border-radius: 100%;
}
</style>

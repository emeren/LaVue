<template>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Categories</h3>

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
        <div class="card-body">
            <div class="form-group">
                <div>
                    <div
                        class="chiller_cb"
                        v-for="(category, index) in categories"
                        :key="index"
                    >
                        <input
                            v-if="postData.categories.length"
                            :id="'cat' + category.id"
                            type="checkbox"
                            :value="category.id"
                            v-model="postData.categories"
                            @change="categoryChange"
                        />

                        <input
                            v-else
                            :id="'cat' + category.id"
                            type="checkbox"
                            :value="category.id"
                            v-model="postData.categories"
                            @change="categoryChange"
                        />
                        <label :for="'cat' + category.id">
                            {{ category.name }}
                        </label>
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
    props: {
        postData: {
            required: true
        }
    },
    data() {
        return {
            setCategory: []
        };
    },
    created() {
        console.log("postData", this.postData);
    },
    computed: {
        ...mapGetters("posts", ["activePostsCategories"]),
        ...mapGetters("categories", ["getUniqeCats"]),
        categories() {
            return this.getUniqeCats;
        },
        activeCategories() {
            return this.$store.getters["posts/activePostsCategories"];
        }
    },
    methods: {
        categoryChange(e) {
            // console.log(e.target.value);
        },
        isChecked(catId) {
            let usedCats = this.activePostsCategories.map(uC => uC.id);
            return usedCats.some(item => item == catId);
        }
    }
};
</script>

<style lang="scss" scoped></style>

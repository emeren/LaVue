<template>
    <div>
        <div class="card postForm">
            <div class="card-header">
                <div>
                    <h3 class="card-title">Galeria</h3>
                </div>
                <!-- Small switch -->
                <div class="form-group">
                    <span class="switch switch-sm">
                        <label for="switch-gallery" class="mr-2 mb-0"
                            >Włącz galeria dla artykułu</label
                        >
                        <input
                            type="checkbox"
                            class="switch success ml-2"
                            id="switch-gallery"
                            v-model="isActive"
                        />
                        <label for="switch-gallery"></label>
                    </span>
                </div>
            </div>
            <div class="card-body" v-if="isActive">
                Upload your images <i class="fas fa-plus"></i>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        postData: {
            required: true
        }
    },
    data() {
        return {
            isActive: false
        };
    },
    methods: {
        toogleGalleryForm() {
            this.isActive = !this.isActive;
        },
        changeStatus() {
            this.postData.published = !this.postData.published;
        }
    }
};
</script>

<style lang="scss" scoped>
.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    .form-group {
        margin: 0px 0px 0px auto;
    }
}
</style>

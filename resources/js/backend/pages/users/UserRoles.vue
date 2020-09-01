<template>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">roles</h3>

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
                        v-for="category in roles"
                        :key="category.id"
                    >
                        <input
                            v-if="userData.roles.length"
                            :id="'cat' + category.id"
                            type="checkbox"
                            :value="category.id"
                            v-model="userData.roles"
                        />

                        <input
                            v-else
                            :id="'cat' + category.id"
                            type="checkbox"
                            :value="category.id"
                            v-model="userData.roles"
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
        userData: {
            required: true
        }
    },
    data() {
        return {
            setCategory: []
        };
    },
    created() {
        console.log("userData", this.userData);
    },
    computed: {
        ...mapGetters("roles", ["getRoles"]),
        roles() {
            return this.getRoles;
        }
    }
};
</script>

<style lang="scss" scoped></style>

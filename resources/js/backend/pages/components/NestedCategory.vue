<template>
    <draggable
        v-bind="dragOptions"
        tag="div"
        class="item-container category"
        :list="list"
        :animation="200"
        :value="value"
        @input="emitter"
    >
        <div class="item-group" :key="el.id" v-for="el in realValue">
            <div class="item">{{ el.name }}</div>
            <nested-category class="item-sub" :list="el.children" />
        </div>
    </draggable>
</template>

<script>
import draggable from "vuedraggable";
export default {
    name: "nested-category",
    props: {
        value: {
            required: false,
            type: Array,
            default: null
        },
        list: {
            required: false,
            type: Array,
            default: null
        }
    },
    components: {
        draggable
    },
    data() {
        return {
            dragOptions: {
                animation: 1,
                group: "description",
                disabled: false,
                ghostClass: "ghost"
            }
        };
    },

    computed: {
        // this.value when input = v-model
        // this.list  when input != v-model
        realValue() {
            return this.value ? this.value : this.list;
        }
    },
    methods: {
        emitter(value) {
            this.$emit("input", value);
        }
    }
};
</script>

<style scoped>
.category {
    cursor: pointer;
}
.item-container {
    max-width: 20rem;
    margin: 0;
}
.item {
    padding: 1rem;
    border: solid black 1px;
    background-color: #fefefe;
}
.item-sub {
    margin: 0 0 0 1rem;
}
</style>

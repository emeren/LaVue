<template>
  <draggable
    v-bind="dragOptions"
    tag="ul"
    class="draggable-list"
    :list="list"
    ghost-class="moving-card"
    :animation="200"
    :value="value"
    @input="emitter(value)"
    @end="dragEnd"
  >
    <!-- @start="start"
    @end="end"
    @change="log"
    @add="add"-->
    <li
      class="p-3 mb-3 d-flex justify-content-between align-items-between border border-white shadow rounded-lg cursor-move categoriesBlok flex-wrap w-100"
      :key="el.id"
      v-for="el in realValue"
    >
      <div class="d-flex align-items-center singleCat">
        <i class="fas fa-arrows-alt"></i>
        <span class="ml-2 font-semibold font-sans tracking-wide">
          <strong>{{ el.name }}</strong>:
          <small class="text-gray">id: {{ el.id }}</small>
          <small class="text-gray">Aktywne posty: {{ el.posts }}</small>
        </span>
      </div>
      <div class="d-flex justify-content-between catActions">
        <a class="btn btn-primary btn-xs" @click="editCategory(el)">
          <i class="fas fa-pencil-alt"></i>
        </a>
        <a class="btn btn-danger btn-xs text-white" @click="deleteCategory(el.id)">
          <i class="fas fa-trash"></i>
        </a>
      </div>
      <nested-category class="item-sub" :list="el.children" />
    </li>
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
      showSubCatHelper: false,
      parentChild: []
    };
  },
  watch: {
    value: {
      immediate: true,
      deep: true,
      handler(newVal, oldVal) {
        console.log("newVal :", newVal);
        this.parentChild = newVal;
      }
    }
  },
  computed: {
    dragOptions() {
      return {
        animation: 0,
        group: "description",
        disabled: false,
        ghostClass: "ghost"
      };
    },
    realValue() {
      return this.value ? this.value : this.list;
    }
  },
  methods: {
    emitter(value) {
      console.log("value :", value);
      this.$emit("input", value);
    },
    editCategory(category) {
      this.$store.dispatch("categories/editCategory", category);
    },
    deleteCategory(catId) {
      this.$store.dispatch("categories/deleteCategory", catId).then(
        this.$notify({
          group: "foo-css",
          title: "Sukces!",
          text: "Kategoria została usunieta",
          type: "danger"
        })
      );
    },
    dragEnd(event) {
      console.log("this.realValue; :", this.realValue);
      console.log("this.czem", this.parentChild);
    },
    setParentChild(parentChild) {
      this.$store.dispatch("categories/setParentChild", parentChild);
    }

    // handleChange() {},
    // add: function(event) {},
    // start: function(event) {},
    // log: function(event, value) {},
    // drop: function(event) {}
  }
};
</script>

<style lang="scss" scoped>
.draggable-list {
  .categoriesBlok {
    cursor: pointer;
    // &:hover {
    //   // background: red;
    // }
  }
  width: 100%;
  list-style-type: none;
  .catImg {
    border-radius: 50%;
  }
  .catActions {
    width: 50px;
  }
  li {
    ul {
      li {
        margin-top: 20px;
        margin-bottom: 5px !important;
      }
    }
  }
}

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
.moving-card {
  opacity: 0.5;
  background: #f7fafc;
  border: 1px solid #4299e1;
}
</style>

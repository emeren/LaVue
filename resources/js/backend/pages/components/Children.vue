<template>
  <div class="col-12">
    <div class="row">
      <label for="children">Zgłoszono dzieci w wieku:</label>
    </div>
    <div class="row">
      <ul id="children" class="list-group list-group-horizontal">
        <li v-for="(child, index) in childrenSort" :key="index" class="list-group-item">
          {{ageLabel(child.age)}}
          <button
            type="button"
            class="close childRemove"
            aria-label="Close"
            title="Wykasuj zgłoszenie"
            @click="removeChild(index)"
          >
            <span aria-hidden="true">&times;</span>
          </button>
          <!-- <span class="color-red">x</span> -->
        </li>
      </ul>
    </div>
  </div>
</template>
<script>
export default {
  name: "children",
  props: {
    children: {
      type: Array,
      required: true
    }
  },
  computed: {
    childrenSort() {
      return this.children.sort((a, b) => (a.age > b.age ? 1 : -1));
    }
  },
  methods: {
    removeChild(index) {
      this.children.splice(index, 1);
    },
    ageLabel(age) {
      if (age == 1) {
        return `${age} rok`;
      } else if (age > 1 && age < 5) {
        return `${age} lata`;
      } else if (age > 4 && age < 20) {
        return `${age} lat`;
      } else {
        return age;
      }
    }
  }
};
</script>

<style scoped>
.childRemove {
  margin: -12px -15px 0 0;
  color: red;
}
</style>

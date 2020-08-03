<template>
  <div class="col-md-6">
    <div class="card postForm">
      <div class="card-header">
        <div>
          <h3
            class="card-title"
            v-text="catData.name ? 'Aktualizacja kategori' : 'Dodaj kategorie' "
          ></h3>
        </div>
        <!-- Small switch -->
        <div class="form-group">
          <span class="switch switch-sm">
            <label for="switch-sm" class="mr-2 mb-0">Status</label>
            <input
              type="checkbox"
              class="switch success ml-2"
              id="switch-sm"
              v-model="catData.published"
            />
            <label for="switch-sm"></label>
          </span>
        </div>
      </div>
      <div class="card-body">
        <form>
          <div class="form-group">
            <small v-if="catData.id">id: {{catData.id}}</small>
            <br />
            <label for="inputName">Nazwa kategorii</label>
            <input type="text" id="inputName" class="form-control" v-model="catData.name" required />
          </div>

          <div class="form-group">
            <label for="inputName">Kategoria nadrzędna</label>
            <select
              class="form-control"
              v-model="catData.name"
              name="parentCategory"
              v-if="flatCats"
              required
            >
              <option>brak</option>
              <option v-for="category in flatCats" :key="category.id">{{category.name}}</option>
            </select>
          </div>
          <div class="form-group" v-if="catData">
            <label for="inputShortDescription">Opis</label>
            <textarea
              id="inputShortDescription"
              class="form-control"
              rows="5"
              v-model="catData.description"
              required
            ></textarea>
          </div>
        </form>
      </div>
    </div>
    <div class="row justify-content-end" v-if="editing">
      <div class="col-md-4">
        <a class="btn btn-danger float-left text-white" @click="cancleEdit">Anuluj</a>
        <input
          type="submit"
          class="btn btn-success float-right"
          :value="catData.name ? 'Zapisz' : 'Dodaj' "
          @click.prevent="formSubmit()"
        />
      </div>``
    </div>
    <div class="row justify-content-end" v-else>
      <div class="col-md-4">
        <input
          type="submit"
          class="btn btn-success float-right"
          :value="catData.name ? 'Zapisz' : 'Dodaj' "
          @click.prevent="formSubmit()"
        />
      </div>
    </div>
  </div>
</template>

<script>
import { VueEditor } from "vue2-editor";
import { mapGetters } from "vuex";
export default {
  components: {
    VueEditor
  },
  props: {
    cats: {
      required: true
    }
  },
  data() {
    return {
      catData: {
        id: null,
        parent_id: null,
        name: "",
        description: "",
        published: 0
      }
    };
  },
  watch: {
    singleCategory: function(val) {
      this.catData = val;
    }
  },
  computed: {
    flatCats() {
      if (this.catData.id !== null) {
        // return this.flatCategories.filter(fC => fC.id != this.catData.id);
      }
      return this.flatCategories;
    },
    formTitale() {
      isEmpty(this.catData) ? "update" : "dodaj";
    },
    ...mapGetters("categories", ["singleCategory"]),
    ...mapGetters("categories", ["getCategories"]),
    ...mapGetters("categories", ["editing"]),
    ...mapGetters("categories", ["flatCategories"])
  },

  methods: {
    formSubmit() {
      this.catData.id != null ? this.updateCategory() : this.createCategory();
    },
    updateCategory() {
      this.$store.dispatch("categories/updateCategory", this.catData).then(
        this.$notify({
          group: "foo-css",
          title: "Aktualizacja",
          text: "Kategoria została zaktualizowana",
          type: "success"
        })
      );
      this.cancleEdit();
    },
    createCategory() {
      this.$store.dispatch("categories/createCategory", this.catData).then(
        this.$notify({
          group: "foo-css",
          title: "Sukces!",
          text: "Kategoria została dodana",
          type: "success"
        })
      );
      this.cancleEdit();
    },
    cancleEdit() {
      this.$store.dispatch("categories/editCategory");
    }
  },
  changeStatus() {
    this.catData.published = !this.catData.published;
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

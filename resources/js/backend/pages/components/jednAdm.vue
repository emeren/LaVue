<template>
  <div class="row">
    <div class="form-group col-12 col-md-6">
      <label for="woj">Województwo</label>
      <select
        id="woj"
        name="wojewodztwo"
        class="form-control"
        @change="wojSelected($event)"
        v-model="selWoj"
      >
        <option value disabled>-- wybierz --</option>
        <option v-for="(woj,i) in allWoj" :key="i" :value="woj.name">{{woj.name}}</option>
      </select>
    </div>
    <div class="form-group col-12 col-md-6">
      <label for="pow">Powiat</label>
      <select id="pow" name="powiat" class="form-control" v-model="selPow">
        <option value disabled>-- wybierz --</option>
        <option v-for="(pow,i) in powiaty" :key="i" :value="pow.name">{{pow.name}}</option>
      </select>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "jednAdm",
  props: {
    member: { type: Object, required: true }
  },
  data() {
    return {
      localMember: this.member,
      allWoj: Object,
      selWoj: "",
      selPow: "",
      powiaty: {}
    };
  },
  computed: {},
  async mounted() {
    this.allWoj = await this.getAllWoj();
    this.$nextTick(function() {
      this.selWoj = this.localMember.wojewodztwo;
    });
    this.$nextTick(function() {
      this.getPowiaty(this.selWoj);
    });
    this.$nextTick(function() {
      this.selPow = this.localMember.powiat;
    });
  },
  watch: {
    selWoj() {
      this.localMember.wojewodztwo = this.selWoj;
    },
    selPow() {
      this.localMember.powiat = this.selPow;
    }
  },
  methods: {
    getPowiaty(wojewodztwo) {
      this.allWoj.map(woj => {
        if (woj.name == wojewodztwo) {
          this.powiaty = woj.powiaty;
        }
      });
    },
    wojSelected(event) {
      let woj = event.target.value;
      this.selWoj = woj;
      this.getPowiaty(woj);
      this.selPow = "";
    },
    async getAllWoj() {
      try {
        const allWoj = await axios({
          method: "get",
          url: "/api/getAllWoj"
        });
        return allWoj.data.data;
      } catch (err) {
        console.error("axios_err: ", err);
      }
    }
  }
};
</script>

<style scoped>
</style>
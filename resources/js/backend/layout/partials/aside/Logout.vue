<template>
  <div class="logout py-2">
    <form method="POST">
      <input type="hidden" name="_token" :value="csrf" />
      <button
        type="submit"
        class="btn btn-block btn-danger w-100"
        @click.prevent="submitForm()"
      >Log out</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      csrf: "",
    };
  },
  mounted() {
    this.csrf = window.Laravel.csrfToken;
  },
  methods: {
    submitForm() {
      window.localStorage.clear();
      axios
        .post("/panel/logout")
        .then(function (response) {
          window.location.href = "/panel/login";
        })
        .catch((err) => {
          console.error("axios_err: ", err);
        });
    },
  },
};
</script>

<style lang="scss" scoped></style>

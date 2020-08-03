<template>
  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
      <img src="/backend/images/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image" />
    </div>
    <div class="info">
      <a href="#" class="d-block">{{user.name}}</a>
    </div>
  </div>
</template>

<script>
export default {
  props: ["user"]
};
</script>

<style lang="scss" scoped></style>

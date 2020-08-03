<template>
  <div class="container-fluid">
    <ContentHeader title="Users"></ContentHeader>
    <div class="row">
      <ContentColorBox title="Users counts" bg="yellow"></ContentColorBox>
      <ContentColorBox bg="purple"></ContentColorBox>
    </div>
  </div>
</template>

<script>
import ContentHeader from "../layout/partials/ContentHeader";
import ContentColorBox from "../components/ContentColorBox";
export default {
  components: {
    ContentColorBox,
    ContentHeader,
  },
};
</script>

<style lang="scss" scoped></style>

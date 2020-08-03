<template>
  <div class="container-fluid">
    <ContentHeader title="Desktop"></ContentHeader>
    <div class="row">
      <InfoBox bg="success" size="6"></InfoBox>
      <InfoBox bg="primary" title="Posts count" :number="postsCount" size="6"></InfoBox>
    </div>
    <div class="row mt-5">
      <div class="col-md-6 ml-auto">
        <LatestPost></LatestPost>
      </div>
    </div>
  </div>
</template>

<script>
import ContentHeader from "../layout/partials/ContentHeader";
import ContentColorBox from "../components/ContentColorBox";
import InfoBox from "../components/InfoBox";
import LatestPost from "../components/LatestPosts";

import { mapGetters } from "vuex";
export default {
  components: {
    ContentColorBox,
    ContentHeader,
    InfoBox,
    LatestPost,
  },
  computed: {
    ...mapGetters("posts", ["postsCount"]),
  },
};
</script>

<style lang="scss" scoped></style>

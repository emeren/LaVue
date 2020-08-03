<template>
  <div
    :class="`sidebar-mini ${
            asideCollapse ? 'sidebar-collapse' : ''
        } layout-fixed`"
  >
    <div class="wrapper">
      <Navbar></Navbar>
      <Aside :user="user"></Aside>
      <Content></Content>
      <Footer></Footer>

      <notifications
        group="foo-css"
        position="top right"
        :speed="500"
        :width="450"
        classes="rcps-notify"
      />/>
    </div>
  </div>
</template>

<script>
import Navbar from "./layout/Navbar";
import Aside from "./layout/Aside";
import Content from "./layout/Content";
import Footer from "./layout/Footer";
import { mapGetters } from "vuex";
export default {
  components: {
    Navbar,
    Aside,
    Content,
    Footer
  },
  props: {
    user: {
      type: Object,
      default: null
    }
  },
  computed: {
    ...mapGetters("dashboard", ["asideCollapse"])
  }
};
</script>

<style lang="scss">
.rcps-notify {
  padding: 10px;
  margin: 0 5px 5px;

  font-size: 14px;
  margin: 5px 5px 0 0;
  color: #ffffff;
  background: #44a4fc;
  border-left: 5px solid #187fe7;

  &.warn {
    background: #ffb648;
    border-left-color: #f48a06;
  }

  &.error {
    background: #e54d42;
    border-left-color: #b82e24;
  }

  &.success {
    background: #68cd86;
    border-left-color: #42a85f;
  }
}

.main-sidebar {
  transition: all 0.3s ease !important;
}
.main-sidebar * {
  transition: all 0.3s ease !important;
}
</style>

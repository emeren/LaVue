<template>
  <div class="content-wrapper">
    <section class="content">
      <transition :name="transitionName" mode="out-in">
        <router-view></router-view>
      </transition>
    </section>
  </div>
</template>

<script>
import ContentHeader from "./partials/ContentHeader";
import MainContent from "./partials/MainContent";
import ContentColorBox from "../components/ContentColorBox";

export default {
  data() {
    return {
      defaultTransition: "fade",
      transitionName: ""
    };
  },
  components: {
    ContentHeader,
    MainContent,
    ContentColorBox
  },
  created() {
    this.$router.beforeEach((to, from, next) => {
      let transitionName = to.meta.transitionName || from.meta.transitionName;

      if (transitionName === "slide") {
        const toDepth = to.path.split("/").length;
        const fromDepth = from.path.split("/").length;
        transitionName = toDepth < fromDepth ? "slide-right" : "slide-left";
      }

      this.transitionName = transitionName || this.defaultTransition;

      next();
    });
  }
};
</script>

<style lang="scss" scoped>
.fade-enter-active,
.fade-leave-active {
  transition-duration: 0.3s;
  transition-property: opacity;
  transition-timing-function: ease;
}

.fade-enter,
.fade-leave-active {
  opacity: 0;
}
.slide-left-enter-active,
.slide-left-leave-active,
.slide-right-enter-active,
.slide-right-leave-active {
  transition-duration: 0.35s;
  transition-property: height, opacity, transform;
  transition-timing-function: cubic-bezier(0.55, 0, 0.1, 1);
  overflow: hidden;
}

.slide-left-enter,
.slide-right-leave-active {
  opacity: 0;
  transform: translate(2em, 0);
}

.slide-left-leave-active,
.slide-right-enter {
  opacity: 0;
  transform: translate(-2em, 0);
}
</style>

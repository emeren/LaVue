<template>
  <li :class="`nav-item has-treeview ${treeView ? 'menu-open' : ''}`">
    <a href="#" :class="`nav-link ${treeView ? 'active' : ''}`" @click="toogleTreeView">
      <i :class="`nav-icon fas ${icon}`"></i>
      <p>
        {{ title }}
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <transition name="fade">
      <ul
        :id="name"
        :class="`nav nav-treeview2`"
        :style="
                    treeView ? 'height:' + navTreeHeight + 'px' : 'opacity:0'
                "
      >
        <li class="nav-item" v-for="(subItem, index) in subItems" :key="index">
          <router-link exact-active-class="active" :to="subItem.link" class="nav-link">
            <i :class="`far ${subItem.icon} nav-icon`"></i>
            <p>{{ subItem.title }}</p>
          </router-link>
        </li>
      </ul>
    </transition>
  </li>
</template>

<script>
export default {
  props: {
    title: {
      type: String,
      default: "empty title"
    },
    link: {
      type: String,
      default: "empty title"
    },
    name: {
      type: String,
      required: true
    },
    rightText: {
      type: String,
      default: ""
    },
    icon: {
      type: String
    },
    target: {
      type: String,
      default: "_self"
    },
    subItems: {
      type: Array
    }
  },
  mounted() {
    this.getHeight();
  },
  data() {
    return {
      treeView: 0,
      navTreeHeight: 0
    };
  },
  methods: {
    toogleTreeView() {
      this.treeView = !this.treeView;
      this.getHeight();
    },
    getHeight() {
      let blokName = this.name;
      let navTree = document.getElementById(blokName);
      let navItem = Array.prototype.slice.call(
        navTree.getElementsByTagName("li")
      );
      let navItemHeightSum = 0;
      navItem.forEach(item => {
        navItemHeightSum += item.offsetHeight;
      });
      this.navTreeHeight = navItemHeightSum + 10; // added padding
    }
  }
};
</script>

<style lang="scss" scoped>
.nav-treeview2 {
  > .nav-item {
    > a {
      p {
        padding-left: 5px;
      }
      i {
        padding-left: 10px;
      }
    }
    .active {
      background-color: rgba(255, 255, 255, 0.9);
      color: #343a40;
    }
  }
}
.nav-treeview2 {
  height: 0;
  display: block;
  flex-wrap: wrap;
}
</style>

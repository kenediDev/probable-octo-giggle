<template>
  <div>
    <navbar
      v-if="navbarActive"
      :logo="logo"
      v-on:clickRouter="clickRouter($event)"
    />
    <router-view
      v-on:clickRouter="clickRouter($event)"
      :logo="logo"
    ></router-view>
    <msg :message="message" />
    <progress_ :message="message" />
  </div>
</template>

<script lang="ts">
import Vue from "vue";
import { Component } from "vue-property-decorator";
import navbar from "./navbar.component.vue";
import msg from "./attribute/message.component.vue";
import progress_ from "./attribute/progress.component.vue";
import { mapGetters } from "vuex";

@Component({
  components: {
    navbar,
    msg,
    progress_,
  },
  computed: {
    ...mapGetters(["message"]),
  },
})
export default class BaseComponent extends Vue {
  logo: string = `http://${window.location.host}/images/Tanpa judul (5).png`;
  navbarActive: boolean = true;

  clickRouter(args: { url: string; params: string }) {
    if (args.url) {
      this.$router.push({
        name: args.url,
        params: {
          id: args.params,
        },
      });
    } else {
      this.$router.push({ name: args.url });
    }
  }

  circleLife() {
    if (
      this.$route.name === "dashboard" ||
      this.$route.name === "login" ||
      this.$route.name === "forgot" ||
      this.$route.name === "loading"
    ) {
      this.navbarActive = false;
    } else {
      this.navbarActive = true;
    }
  }

  beforeUpdate() {
    this.circleLife();
  }

  beforeMount() {
    this.circleLife();
  }
}
</script>


<style lang="scss" scoped>
@import url("https://use.fontawesome.com/releases/v5.15.3/css/all.css");
@import url("https://fonts.googleapis.com/css2?family=Roboto&family=Roboto+Slab&display=swap");
// font-family: 'Roboto', sans-serif;
// font-family: 'Roboto Slab', serif;
</style>

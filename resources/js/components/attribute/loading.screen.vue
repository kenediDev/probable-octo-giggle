<template>
  <div class="loading">
    <div class="cp-spinner cp-bubble"></div>
  </div>
</template>

<script lang="ts">
import Vue from "vue";
import { Component } from "vue-property-decorator";

@Component({})
export default class LoadingScreen extends Vue {
  beforeMount() {
    setTimeout(() => {
      this.$router.push({ name: this.$route.params.id });
    }, 600);
  }
}
</script>

<style lang="scss" scoped>
.loading {
  background-color: white;
  width: 100%;
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
}
</style>
<template>
  <div :class="message.loading ? 'loading-message' : 'loading-hidden'">
    <div class="cp-spinner cp-bubble"></div>
  </div>
</template>

<script lang="ts">
import Vue from "vue";
import { Component, Prop } from "vue-property-decorator";
import { Message } from "../../store/types/interface";

@Component({})
export default class ProgressComponent extends Vue {
  @Prop(Object) message: Message;
}
</script>

<style lang="scss" scoped>
@import "../assets/scss/progress.scss";
</style>
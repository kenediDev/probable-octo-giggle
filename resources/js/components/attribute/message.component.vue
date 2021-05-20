<template>
  <div
    :class="
      message.valid === 1
        ? 'message'
        : message.valid === 2
        ? 'message-error'
        : message.valid === 3
        ? 'message-close'
        : 'message-hidden'
    "
  >
    <div class="message-button">
      <button @click="clickMessage(message.message)">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <div class="message-content">
      {{ message.message }}
    </div>
  </div>
</template>


<script lang="ts">
import { Message } from "postcss";
import Vue from "vue";
import { Component, Prop } from "vue-property-decorator";

@Component({})
export default class MessageComponent extends Vue {
  @Prop(Object) message: Message;

  clickMessage(args: string) {
    this.$store.commit("message", { message: args, valid: 3 });
  }
}
</script>


<style lang="scss" scoped>
@import "../assets/scss/message.scss";
</style>
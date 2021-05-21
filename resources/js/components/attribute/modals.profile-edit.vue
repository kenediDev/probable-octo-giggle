<template>
  <div
    :class="
      modalsProfile === 1
        ? 'modalsProfile'
        : modalsProfile === 2
        ? 'modalsProfile-close'
        : 'modalsProfile-hidden'
    "
  >
    <form action="">
      <div class="close">
        <button type="button" @click="clickModalsProfile()">
          <i class="fas fa-times"> </i>
        </button>
      </div>
      <div class="field" id="field-input">
        <input
          type="text"
          name="title"
          id="title"
          class="title"
          placeholder="Nama Pertama"
          :value="first_name"
          @input="changeFirstName($event)"
        />
      </div>
      <div class="field" id="field-input">
        <input
          type="text"
          name="last_name"
          id="last_name"
          class="last_name"
          placeholder="Nama Belakang"
          :value="last_name"
          @input="changeLastName($event)"
        />
      </div>
      <div class="field" id="field-textarea">
        <textarea
          name="textarea"
          id="textarea"
          cols="30"
          rows="10"
          class="textarea"
          placeholder="Bio"
          :value="bio"
          @input="changeBio($event)"
        ></textarea>
      </div>
      <div class="field" id="field-button">
        <button>Simpan</button>
      </div>
    </form>
  </div>
</template>

<script lang="ts">
import Vue from "vue";
import { Component, Emit, Prop } from "vue-property-decorator";
@Component({})
export default class ModalsProfileEdit extends Vue {
  @Prop(String) first_name: string;
  @Prop(String) last_name: string;
  @Prop(String) bio: string;
  @Emit()
  changeFirstName(args: any) {
    this.$emit("changeFirstName", args);
  }

  @Emit()
  changetLastName(args: any) {
    this.$emit("changetLastName", args);
  }

  @Emit()
  changeBio(args: any) {
    this.$emit("changeBio", args);
  }

  @Emit()
  clearInput() {
    this.$emit("clearInput");
  }

  @Prop(Number) modalsProfile: number;
  @Emit()
  clickModalsProfile() {
    this.$emit("clickModalsProfile");
  }
}
</script>

<style lang="scss" scoped>
@import "../assets/scss/modals.profile.scss";
</style>
<template>
  <div
    :class="
      modalInformation === 1
        ? 'modals-information'
        : modalInformation === 2
        ? 'modals-information-close'
        : 'modals-information-hidden'
    "
  >
    <form @submit.prevent="submit">
      <button class="close" @click="openModalsInformation()">
        <i class="fas fa-times"></i>
      </button>
      <div class="field" id="field-input">
        <input
          type="text"
          name="title_information"
          id="title_information"
          class="title_information"
          placeholder="Title"
          :value="title"
          @input="changeName($event)"
        />
      </div>
      <div class="field" id="field-input">
        <input
          type="text"
          name="child_title_information"
          id="child_title_information"
          class="title_information"
          placeholder="Sub Title"
          :value="child_title"
          @input="changeTitle($event)"
        />
      </div>
      <div class="field" id="field-textarea">
        <textarea
          name="info_desc"
          id="info_desc"
          cols="30"
          rows="10"
          class="infor_des"
          placeholder="Description"
          :value="description"
          @input="changeDescription($event)"
        ></textarea>
      </div>
      <div class="field" id="field-button">
        <button>Simpan</button>
      </div>
    </form>
  </div>
</template>

<script lang="ts">
import { AxiosResponse } from "axios";
import Vue from "vue";
import { Component, Emit, Prop } from "vue-property-decorator";

@Component({})
export default class ModalsInformation extends Vue {
  @Prop(String) title: string;
  @Prop(String) child_title: string;
  @Prop(String) description: string;
  @Prop(Number) modalInformation: number;

  @Emit()
  changeName(args: any) {
    this.$emit("changeName", args);
  }

  @Emit()
  changeTitle(args: any) {
    this.$emit("changeTitle", args);
  }

  @Emit()
  changeDescription(args: any) {
    this.$emit("changeDescription", args);
  }

  @Emit()
  clearInput() {
    this.$emit("clearInput");
  }

  @Emit()
  openModalsInformation() {
    this.$emit("openModalsInformation");
  }

  submit() {
    const data = {
      title: this.title,
      child_title: this.child_title,
      description: this.description,
    };
    this.$store
      .dispatch("updateCoverInformation", data)
      .then((res: AxiosResponse<any>) => {
        this.$store.commit("message", { message: res.data.message, valid: 1 });
        this.$store.commit("updateCoverInformation", res.data.results);
        this.clearInput();
      })
      .catch((err) => {
        if (!err.response.data) {
          localStorage.clear();
          window.location.reload();
        }
        this.$store.commit("message", {
          message: err.response.data.message,
          valid: 2,
        });
      });
  }
}
</script>

<style lang="scss" scoped>
@import "../assets/scss/modals.information.scss";
</style>
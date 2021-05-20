<template>
  <div class="column-right">
    <form @submit.prevent="submit">
      <div class="field" id="field-input">
        <input
          type="text"
          name="name"
          id="name"
          class="name"
          placeholder="Title"
          :value="title"
          @input="changeTitle($event)"
        />
      </div>
      <div class="field" id="field-textarea">
        <textarea
          name="description"
          id="description"
          cols="30"
          rows="10"
          class="description"
          placeholder="Description"
          :value="description"
          @input="changeDescription($event)"
        ></textarea>
      </div>
      <div class="field" id="field-image">
        <span @click="clickModals()">{{ photo ? photo.name : "" }}</span>
      </div>
      <div class="field" id="field-button">
        <button>Buat</button>
        <div class="upload-btn-wrapper">
          <input
            type="file"
            name=""
            id=""
            ref="photo"
            @change="changePhoto()"
          />
          <button class="box-icon">
            <icon :src="photos" class="icon" />
          </button>
        </div>
      </div>
    </form>
    <div
      :class="
        modals === 1
          ? 'modals'
          : modals === 2
          ? 'modals-close'
          : 'modals-hidden'
      "
      :style="'background-image:url(' + photo_url + ')'"
      @click="clickModals()"
    ></div>
  </div>
</template>

<script lang="ts">
import { AxiosResponse } from "axios";
import Vue from "vue";
import { Component, Emit, Prop } from "vue-property-decorator";
import photos from "../../assets/photo.svg";

@Component({})
export default class ColumnRight extends Vue {
  photos = photos;
  modals: number = 0;

  @Prop(String) title: string;
  @Prop(String) description: string;
  @Prop() photo: any = null;
  @Prop(String) photo_url: string;

  @Emit()
  changeTitle(args) {
    this.$emit("changeTitle", args);
  }
  @Emit()
  changeDescription(args) {
    this.$emit("changeDescription", args);
  }
  @Emit()
  changePhoto() {
    const url = (this.$refs.photo as any).files[0];
    this.$emit("changePhoto", url);
  }
  @Emit()
  clearInput() {
    this.$emit("clearInput");
  }

  clickModals() {
    if (!this.modals) {
      this.modals = 1;
    } else if (this.modals === 1) {
      this.modals = 2;
    } else {
      this.modals = 1;
    }
  }

  submit() {
    this.service();
  }

  service() {
    const args = new FormData();
    args.append("title", this.title);
    args.append("description", this.description);
    args.append("photo", this.photo);
    this.$store.commit("message", { valid: 3 });
    this.$store
      .dispatch("createService", args)
      .then((res: AxiosResponse<any>) => {
        this.$store.commit("message", { message: res.data.message, valid: 1 });
      })
      .catch((err) => {
        this.$store.commit("message", {
          message: err.response.data.message,
          valid: 2,
        });
      });
  }
}
</script>


<style lang="scss" scoped>
@import "../../assets/scss/column-right.scss";
</style>
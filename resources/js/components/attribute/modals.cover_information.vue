<template>
  <div
    :class="
      modalsCoverInformation === 1
        ? 'modals-cover-information'
        : modalsCoverInformation === 2
        ? 'modals-cover-information-close'
        : 'modals-cover-information-hidden'
    "
  >
    <form @submit.prevent="submit">
      <div class="close">
        <button type="button" @click="clickModalsInformation()">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="field" id="field-input">
        <input
          type="text"
          name="name_button"
          id="name_button"
          class="name_button"
          placeholder="Nama Button"
          :value="name"
          @input="changeName($event)"
        />
      </div>
      <div class="field" id="field-textarea">
        <textarea
          name="desc_"
          id="desc_"
          cols="30"
          rows="10"
          class="desc_"
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
export default class ModalsCoverInformation extends Vue {
  @Prop(Number) modalsCoverInformation: number;
  @Prop(String) name: string;
  @Prop(Number) id: number;
  @Prop(String) description: string;

  @Emit()
  changeName(args: any) {
    this.$emit("changeName", args);
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
  clickModalsInformation() {
    this.$emit("openModalCoverInformation");
  }

  submit() {
    if (this.id) {
      this.$store
        .dispatch("updateListInformation", {
          id: this.id,
          description: this.description,
          name: this.name,
        })
        .then((res: AxiosResponse<any>) => {
          this.$store.commit("message", {
            message: res.data.message,
            valid: 1,
          });
          this.$store.commit("updateListInformation", res.data.results);
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
    } else {
      this.$store
        .dispatch("createListInformation", {
          name: this.name,
          description: this.description,
        })
        .then((res: AxiosResponse<any>) => {
          this.$store.commit("message", {
            message: res.data.message,
            valid: 1,
          });
          this.$store.commit("createListInformation", res.data.results);
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
}
</script>

<style lang="scss" scoped>
@import "../assets/scss/modals.scss";
</style>
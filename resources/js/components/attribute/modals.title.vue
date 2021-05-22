<template>
  <div
    :class="
      modalsTitle_ === 1
        ? 'modals-title'
        : modalsTitle_ === 2
        ? 'modals-title-close'
        : 'modals-title-hidden'
    "
  >
    <div class="modals-title-content">
      <form @submit.prevent="submit">
        <button class="close" @click="clickModalsTitle()" type="button">
          <i class="fas fa-times"></i>
        </button>
        <div class="field" id="field-title">
          Apakah anda ingin perbarui title
        </div>
        <div class="field" id="field-input">
          <input
            type="text"
            name="_title"
            id="title___"
            placeholder="Title"
            :value="nameTitle"
            @change="changeName($event)"
          />
        </div>
        <div class="field" id="field-button">
          <button>Simpan</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script lang="ts">
import { AxiosResponse } from "axios";
import Vue from "vue";
import { Component, Emit, Prop } from "vue-property-decorator";

@Component({})
export default class ModalsTitle extends Vue {
  @Prop(Number) modalsTitle_: number;
  @Prop(String) nameTitle: string;
  @Prop(String) type: string;

  @Emit()
  changeName(args: any) {
    this.$emit("changeName", args);
  }
  @Emit()
  clickModalsTitle() {
    this.$emit("clickModalsTitle");
  }

  submit() {
    this.$store
      .dispatch("updateServiceTitle", {
        title: this.nameTitle,
        type: this.type,
      })
      .then((res: AxiosResponse<any>) => {
        this.$store.commit("message", { message: res.data.message, valid: 1 });
        this.$store.commit("updateServiceTitle", res.data.results);
        this.clickModalsTitle();
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
@import "../assets/scss/modals.title.scss";
</style>
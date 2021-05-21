<template>
  <div class="grids">
    <div class="cols"></div>
    <div class="cols">
      <div class="rights">
        <div>
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
                <span v-if="photo" @click="clickModals()">
                  <span v-if="photo.match(/http/i)">
                    <span class="box-icon">
                      <icon :src="photo" class="icon" />
                    </span>
                  </span>
                  <span v-else>
                    {{ photo ? photo.name : "" }}
                  </span>
                </span>
              </div>
              <div class="field" id="field-button">
                <button>Buat</button>
                <button
                  type="button"
                  class="box-icon"
                  @click="clickModalsIcon()"
                >
                  <icon :src="photos" class="icon" />
                </button>
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
            <div
              :class="
                modalsIcon === 1
                  ? 'modals-icon'
                  : modalsIcon === 2
                  ? 'modals-icon-close'
                  : 'modals-hidden'
              "
            >
              <div class="group">
                <h6>Pilih Icon untuk service</h6>
                <button @click="clickModalsIcon()">
                  <i class="fas fa-times"></i>
                </button>
              </div>
              <div class="list-icon">
                <button
                  v-for="(items, index) in icons"
                  :key="index"
                  @click="changePhoto(items)"
                >
                  <icon :src="items" class="icon" />
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { AxiosResponse } from "axios";
import Vue from "vue";
import { Component, Emit, Prop } from "vue-property-decorator";
import { mapGetters } from "vuex";
import photos from "../../assets/photo.svg";

@Component({
  computed: {
    ...mapGetters(["icons"]),
  },
})
export default class ColumnRight extends Vue {
  photos = photos;
  modals: number = 0;
  modalsIcon: number = 0;

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
  changePhoto(args) {
    this.modalsIcon = 0;
    this.$emit("changePhoto", args);
  }

  @Emit()
  clearInput() {
    this.$emit("clearInput");
  }

  clickModalsIcon() {
    if (!this.modalsIcon) {
      this.modalsIcon = 1;
    } else if (this.modalsIcon === 1) {
      this.modalsIcon = 2;
    } else this.modalsIcon = 1;
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
        this.clearInput();
        this.$store.commit("message", { message: res.data.message, valid: 1 });
      })
      .catch((err) => {
        if (!Boolean(err.response.data)) {
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
@import "../../assets/scss/column-right.scss";
</style>
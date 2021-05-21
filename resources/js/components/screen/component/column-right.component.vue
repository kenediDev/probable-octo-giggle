<template>
  <div>
    <!-- Background -->
    <div
      v-if="me.accounts"
      class="background"
      :style="
        'background-image:url(' + me.accounts.background[count].background + ')'
      "
    >
      <div class="background-content">
        <button
          :class="count !== 0 ? 'arrow-left' : 'arrow-left-close'"
          @click="clickPrev()"
        >
          <i class="fas fa-arrow-left"></i>
        </button>
        <button
          :class="
            count === user.data.background_list.length - 1
              ? 'arrow-right'
              : 'arrow-right-close'
          "
          @click="clickNext()"
        >
          <i class="fas fa-arrow-right"></i>
        </button>
      </div>
      <div class="group-button">
        <button
          @click="
            openModalsNotification(
              'Apakah benar anda ingin menghapus photo ini?',
              me.accounts.background[count].id,
              'background'
            )
          "
        >
          <icon :src="trash" class="icon" />
        </button>
        <button>
          <icon :src="sync" class="icon" />
        </button>
        <div class="upload-btn-wrapper">
          <input
            type="file"
            name=""
            id=""
            ref="background"
            @change="changeCarousel()"
          />
          <button>
            <icon :src="camera" class="icon" />
          </button>
        </div>
      </div>
    </div>
    <div class="grids">
      <div class="cols">
        <!-- Profil Intro -->
        <profile
          :me="me"
          v-if="me.accounts"
          v-on:clickModalsProfile="clickModalsProfile($event)"
        />
      </div>
      <div class="cols">
        <div class="rights">
          <div>
            <!-- Form -->
            <div class="column-right">
              <form @submit.prevent="submit" id="form">
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
                  <button>{{ formUpdate ? "Perbarui" : "Buat" }}</button>
                  <button
                    v-if="formUpdate"
                    type="button"
                    @click="clearInput()"
                    class="box-icon"
                  >
                    <icon :src="times" class="icon" />
                  </button>
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
        <!-- Service -->
        <service
          :service="me.service"
          v-if="me"
          :me="me"
          v-on:updateService="updateService($event)"
        />
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { AxiosResponse } from "axios";
import Vue from "vue";
import { Component, Emit, Prop } from "vue-property-decorator";
import { mapGetters, mapState } from "vuex";
import photos from "../../assets/photo.svg";
import trash from "../../assets/garbage.svg";
import camera from "../../assets/camera.svg";
import sync from "../../assets/laptop.svg";
import profile from "./profile.component.vue";
import service from "./product.component.vue";
import { User } from "../../../store/types/interface";
import times from "../../assets/cancel.svg";

@Component({
  components: {
    profile,
    service,
  },
  data() {
    return {
      user: {
        data: {
          background_list: [],
        },
      },
      count: 0,
    };
  },
  computed: {
    ...mapGetters(["icons"]),
    ...mapState(["UserModules"]),
    getBackgroundList() {
      const _ = this.UserModules;
      return _;
    },
  },
  methods: {
    clickNext() {
      const length = this.$data.user.data.background_list.length - 1;
      if (this.$data.count !== length) {
        this.$data.count += 1;
      }
    },
    clickPrev() {
      if (this.$data.count !== 0) {
        this.$data.count -= 1;
      }
    },
  },
  mounted() {
    const data = this.getBackgroundList;
    this.user = data;
  },
})
export default class ColumnRight extends Vue {
  times = times;
  @Prop(Object) me: User;
  $store: any;
  // Icon
  trash = trash;
  camera = camera;
  sync = sync;
  //

  photos = photos;
  modals: number = 0;
  modalsIcon: number = 0;

  // Service Form
  @Prop(String) title: string;
  @Prop(String) description: string;
  @Prop() photo: any;
  @Prop(String) photo_url: string;
  @Prop(Boolean) formUpdate: boolean;

  // Accounts Form
  @Prop(Number) id: number;
  @Prop(String) first_name: string;
  @Prop(String) last_name: string;
  @Prop(String) bio: string;
  @Prop() logos: any;
  @Prop() logos_url: any;
  @Prop() background: any;
  @Prop() background_url: any;
  // Another
  @Prop(String) type: string;

  @Emit()
  updateService(args: {
    id: number;
    title: string;
    description: string;
    photo: string;
  }) {
    this.$emit("updateService", args);
  }

  @Emit()
  clickModalsProfile(args: {
    first_name: string;
    last_name: string;
    bio: string;
  }) {
    this.$emit("clickModalsProfile", args);
  }

  @Emit()
  openModalsNotification(args: string, pk: number, choice: string) {
    this.$emit("openModalsNotification", { message: args, pk, choice });
  }

  @Emit()
  changeFirstName(args: any) {
    this.$emit("changeFirstName", args);
  }

  @Emit()
  changeLastName(args: any) {
    this.$emit("changeLastName", args);
  }

  @Emit()
  changeBio(args: any) {
    this.$emit("changeBio", args);
  }

  @Emit()
  changeAvatar() {
    const photos = (this.$refs.avatar as any).files[0];
    this.$emit("changeAvatar", photos);
  }

  @Emit()
  changeBackground() {
    const args = (this.$refs.background as any).files[0];
    this.$emit("changeBackground", args);
  }

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

  changeCarousel() {
    const _ = (this.$refs.background as any).files[0];
    const data = new FormData();
    data.append("background", _);
    this.$store
      .dispatch("addBackground", data)
      .then((res: AxiosResponse<any>) => {
        this.$store.commit("message", { message: res.data.message, valid: 1 });
        this.$store.commit("updateBackground", res.data.results);
        this.$store.count = 0;
      })
      .catch((err) => {
        if (!err.response.data) {
          localStorage.clear();
          window.location.reload();
        }
      });
  }

  submit() {
    switch (this.type) {
      case "service":
        this.service();
        break;

      default:
        break;
    }
    this.service();
  }

  service() {
    const args = new FormData();
    args.append("title", this.title);
    args.append("description", this.description);
    args.append("photo", this.photo);
    this.$store.commit("message", { valid: 3 });
    if (this.formUpdate) {
      this.$store
        .dispatch("updateService", { id: this.id, data: args })
        .then((res: AxiosResponse<any>) => {
          this.$store.commit("message", {
            message: res.data.message,
            valid: 1,
          });
          this.$store.commit("updateService", res.data.results);
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
        .dispatch("createService", args)
        .then((res: AxiosResponse<any>) => {
          this.clearInput();
          this.$store.commit("message", {
            message: res.data.message,
            valid: 1,
          });
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
}
</script>


<style lang="scss" scoped>
@import "../../assets/scss/column-right.scss";
</style>
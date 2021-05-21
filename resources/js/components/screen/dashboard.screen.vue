<template>
  <div>
    <div class="grids">
      <div class="cols">
        <div class="brand-icons">
          <img :src="logo" alt="" class="brand" />
        </div>
        <div class="drawer-open">
          <div class="drawer-list">
            <h5>Dashboard</h5>
            <div class="drawer-sub-list">
              <a href="#" class="active">
                <div class="box-icon">
                  <icon :src="album" class="icon" />
                </div>
                <span>Album</span>
              </a>
              <a href="#" class="unactive">
                <div class="box-icon">
                  <icon :src="service" class="icon" />
                </div>
                <span>Service</span>
              </a>
              <a href="#" class="unactive">
                <div class="box-icon">
                  <icon :src="vision" class="icon" />
                </div>
                <span>Visi</span>
              </a>
              <a href="#" class="unactive">
                <div class="box-icon">
                  <icon :src="testimonials" class="icon" />
                </div>
                <span>Testimoni</span>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="cols">
        <div class="headers">
          <div class="input">
            <div class="box-icon">
              <icon :src="search" class="icon" />
            </div>
            <input
              type="text"
              name="search"
              id="search"
              class="search"
              placeholder="Cari"
            />
          </div>
          <div class="group">
            <button>
              <icon :src="bell" class="icon" />
            </button>
            <button>
              <icon :src="author" class="icon" />
            </button>
          </div>
        </div>
        <div class="sub-headers">
          <button @click="clickRouter('loading', 'home')">
            <span>Kembali</span>
          </button>
          <div class="metadata">
            <div class="box-icon">
              <icon :src="clock" class="icon" />
            </div>
            {{ new Date() | moment("LLLL") }}
          </div>
        </div>
        <columnright
          :id="id"
          :title="title"
          :description="description"
          :photo="photo"
          :photo_url="photo_url"
          v-on:clearInput="clearInput()"
          v-on:changeTitle="changeTitle($event)"
          v-on:changeDescription="changeDescription($event)"
          v-on:changePhoto="changePhoto($event)"
          :first_name="first_name"
          :last_name="last_name"
          :bio="bio"
          :logos="logos"
          :logos_url="logos_url"
          :background="background"
          :background_url="background_url"
          v-on:changeFirstName="changeFirstName($event)"
          v-on:changeLastName="changeLastName($event)"
          v-on:changeBio="changeBio($event)"
          v-on:changeAvatar="changeAvatar($event)"
          v-on:changeBackground="changeBackground($event)"
          v-on:openModalsNotification="openModalsNotification($event)"
          v-on:clickModalsProfile="clickModalsProfile($event)"
          :me="me"
          v-on:updateService="updateService($event)"
          :formUpdate="formUpdate"
          :type="type"
        />
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import Vue from "vue";
import { Component, Emit, Prop } from "vue-property-decorator";
import service from "../assets/maintenance.svg";
import vision from "../assets/name.svg";
import testimonials from "../assets/testimonials.svg";
import album from "../assets/album.svg";
import bell from "../assets/bell.svg";
import author from "../assets/profile.svg";
import search from "../assets/search.svg";
import clock from "../assets/digital-clock.svg";
import columnright from "./component/column-right.component.vue";
import { User } from "../../store/types/interface";

@Component({
  components: {
    columnright,
  },
})
export default class DashboardComponent extends Vue {
  @Prop(Object) me: User;
  @Prop(String) logo: string;
  service = service;
  vision = vision;
  testimonials = testimonials;
  album = album;
  bell = bell;
  author = author;
  search = search;
  clock = clock;

  // Service Form
  @Prop(Number) id: number;
  @Prop(String) title: string;
  @Prop(String) description: string;
  @Prop() photo: any;
  @Prop() photo_url: any;
  @Prop(Boolean) formUpdate: boolean;
  // Another
  @Prop(String) type: string;

  @Emit()
  changePhoto(args: any) {
    this.$emit("changePhoto", args);
  }

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
  clearInput() {
    this.$emit("clearInput");
  }

  // Accounts Form
  first_name: string = "";
  last_name: string = "";
  bio: string = "";
  logos: any = null; // This is avatar from accounts;
  logos_url: any = null;
  background: any = null;
  background_url: any = null;

  @Emit()
  clickModalsProfile(args: {
    first_name: string;
    last_name: string;
    bio: string;
  }) {
    this.$emit("clickModalsProfile", args);
  }

  @Emit()
  openModalsNotification(args: {
    message: string;
    pk: number;
    choice: string;
  }) {
    this.$emit("openModalsNotification", args);
  }

  @Emit()
  changeTitle(args: any) {
    this.$emit("changeTitle", args);
  }

  @Emit()
  changeDescription(args: any) {
    this.$emit("changeDescription", args);
  }

  changeFirstName(args: any) {
    this.first_name = args.target.value;
  }
  changeLastName(args: any) {
    this.last_name = args.target.value;
  }
  changeBio(args: any) {
    this.bio = args.target.value;
  }
  changeAvatar(args: any) {
    this.logos = args;
    this.logos_url = URL.createObjectURL(args);
  }
  changeBackground(args: any) {
    this.background = args;
    this.background_url = URL.createObjectURL(args);
  }

  @Emit()
  clickRouter(args: string, params: string = null) {
    this.$emit("clickRouter", { url: args, params });
  }

  beforeMount() {
    this.$store.dispatch("listIcon");
  }
}
</script>

<style lang="scss" scoped>
@import "../assets/scss/dashboard.scss";
</style>
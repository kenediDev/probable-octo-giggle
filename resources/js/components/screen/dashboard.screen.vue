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
          <button>
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
          :title="title"
          :description="description"
          :photo="photo"
          :photo_url="photo_url"
          v-on:clearInput="clearInput()"
          v-on:changeTitle="changeTitle($event)"
          v-on:changeDescription="changeDescription($event)"
          v-on:changePhoto="changePhoto($event)"
        />
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import Vue from "vue";
import { Component, Prop } from "vue-property-decorator";
import service from "../assets/maintenance.svg";
import vision from "../assets/name.svg";
import testimonials from "../assets/testimonials.svg";
import album from "../assets/album.svg";
import bell from "../assets/bell.svg";
import author from "../assets/profile.svg";
import search from "../assets/search.svg";
import clock from "../assets/digital-clock.svg";
import columnright from "./component/column-right.component.vue";

@Component({
  components: {
    columnright,
  },
})
export default class DashboardComponent extends Vue {
  @Prop(String) logo: string;
  service = service;
  vision = vision;
  testimonials = testimonials;
  album = album;
  bell = bell;
  author = author;
  search = search;
  clock = clock;

  title: string = "";
  description: string = "";
  photo: any = null;
  photo_url: any = null;

  changePhoto(args: string) {
    this.photo = args;
    this.photo_url = URL.createObjectURL(args);
  }
  changeTitle(args: any) {
    this.title = args.target.value;
  }
  changeDescription(args: any) {
    this.description = args.target.value;
  }
  clearInput() {
    this.title = "";
    this.description = "";
    this.photo_url = "";
    this.photo = "";
  }
}
</script>

<style lang="scss" scoped>
@import "../assets/scss/dashboard.scss";
</style>
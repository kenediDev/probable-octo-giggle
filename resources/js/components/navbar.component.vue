<template>
  <div>
    <div class="navbar">
      <img :src="logo" alt="" />
      <div class="navbar-group">
        <a href="#" @click="clickRouter('home')">Beranda</a>
        <a href="#">Service</a>
        <a href="">Testimoni</a>
        <a href="">Tentang Kami</a>
        <a href="">Kontak</a>
        <button @click="clickRouter('loading', 'login')" class="login">
          <span>Masuk</span>
          <span class="icons">
            <i class="fas fa-arrow-right"></i>
          </span>
        </button>
        <button class="login-mobile" @click="clickDrawer()">
          <i class="fas fa-bars"></i>
        </button>
      </div>
    </div>
    <div
      :class="
        drawer === 1
          ? 'drawer'
          : drawer === 2
          ? 'drawer-close'
          : 'drawer-hidden'
      "
    >
      <div class="logo">
        <img :src="logo" alt="" />
      </div>
      <button class="arrow" @click="clickDrawer()">
        <icon :src="arrow" class="icon" />
        <span>Tutup</span>
      </button>
      <div class="drawer-list">
        <a href="" :class="active === 'home' ? 'active' : 'unactive'">
          <icon :src="home" class="icon" />
          <span>Beranda</span></a
        >
        <a href="" :class="active === 'service' ? 'active' : 'unactive'">
          <icon :src="service" class="icon" />
          <span>Service</span></a
        >
        <a href="" :class="active === 'testimoni' ? 'active' : 'unactive'">
          <icon :src="testimoni" class="icon" />
          <span>Testimoni</span></a
        >
        <a href="" :class="active === 'about' ? 'active' : 'unactive'">
          <icon :src="about" class="icon" />
          <span>Tentang Kami</span></a
        >
        <a href="" :class="active === 'contact' ? 'active' : 'unactive'">
          <icon :src="contact" class="icon" />
          <span>Kontak</span></a
        >
        <button @click="clickRouter('loading', 'login')">
          <icon :src="login" class="icon" />
          <span>Masuk</span>
        </button>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import Vue from "vue";
import { Component, Emit, Prop } from "vue-property-decorator";
import home from "./assets/house.svg";
import service from "./assets/maintenance.svg";
import testimoni from "./assets/testimonials.svg";
import about from "./assets/agenda.svg";
import contact from "./assets/name.svg";
import login from "./assets/key.svg";
import arrow from "./assets/left-arrow.svg";

@Component({})
export default class NavbarComponent extends Vue {
  active: string = "";
  @Prop(String) logo: string;

  drawer: number = 0;

  home = home;
  service = service;
  testimoni = testimoni;
  about = about;
  contact = contact;
  login = login;
  arrow = arrow;

  @Emit()
  clickRouter(args: string, params: string = null) {
    this.$emit("clickRouter", {
      url: args,
      params: params,
    });
  }

  clickDrawer() {
    if (!this.drawer) {
      this.drawer = 1;
    } else if (this.drawer === 1) {
      this.drawer = 2;
    } else {
      this.drawer = 1;
    }
  }

  beforeUpdate() {
    this.active = this.$route.name;
  }

  beforeMount() {
    this.active = this.$route.name;
  }
}
</script>


<style lang="scss" scoped>
@import "./assets/scss/navbar.scss";
</style>
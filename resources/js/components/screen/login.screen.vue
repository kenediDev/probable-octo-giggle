<template>
  <div>
    <div class="grids">
      <div class="cols">
        <img :src="logo" alt="" class="logo" />
        <h3>Selamat datang dibengkel mobil sangkut</h3>
        <img :src="image" alt="" class="image" />
      </div>
      <div class="cols">
        <div class="auth-button-back">
          <span>Kembali ke</span>
          <span @click="clickRouter('loading', 'home')">Beranda</span>
        </div>
        <div class="auth">
          <form @submit.prevent="submit">
            <h5 class="field-text">Masukkan Akun anda dibawah ini.</h5>
            <div class="field" id="field-input">
              <div class="field-icon">
                <i class="fas fa-user-circle"></i>
              </div>
              <input
                type="text"
                name="username"
                id="username"
                class="username"
                placeholder="Nama Pengguna"
                v-model="username"
              />
            </div>
            <div class="field" id="field-input">
              <div class="field-icon">
                <i class="fas fa-lock"></i>
              </div>
              <input
                type="password"
                name="password"
                id="password"
                class="password"
                placeholder="Kata sandi"
                v-model="password"
              />
            </div>
            <div class="field" id="field-checkbox">
              <div class="group">
                <input
                  type="checkbox"
                  name="checkbox"
                  id="checkbox"
                  class="checkbox"
                  v-model="rememmber"
                />
                <span>Ingatkan saya</span>
              </div>
              <a href="#" @click="clickRouter('loading', 'forgot')"
                >Lupa Kata Sandi</a
              >
            </div>
            <div class="field" id="field-button">
              <button>Masuk</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { AxiosResponse } from "axios";
import Vue from "vue";
import { Component, Emit, Prop } from "vue-property-decorator";

@Component({})
export default class LoginScreen extends Vue {
  @Prop(String) logo: string;
  image: string = `http://${window.location.host}/images/illustration_login.png`;

  @Emit()
  clickRouter(args: string, params: string = null) {
    this.$emit("clickRouter", {
      url: args,
      params: params,
    });
  }

  username: string = "";
  password: string = "";
  rememmber: boolean = false;

  submit() {
    const data = {
      email: this.username,
      password: this.password,
    };
    this.$store
      .dispatch("login", data)
      .then((res: AxiosResponse<any>) => {
        if (this.rememmber) {
          const args: any = JSON.stringify({
            username: data.email,
            password: data.password,
            active: this.rememmber,
          });
          localStorage.setItem("auth", args);
        } else {
          localStorage.clear();
        }

        localStorage.setItem("token", res.data.token);
        window.location.reload();
      })
      .catch((err) => {
        this.$store.commit("message", {
          message: err.response.data.message,
          valid: 2,
        });
      });
  }

  mounted() {
    if (localStorage.getItem("auth")) {
      const args = JSON.parse(localStorage.getItem("auth"));
      this.username = args.username;
      this.password = args.password;
      this.rememmber = Boolean(args.active);
    }
  }
}
</script>


<style lang="scss" scoped>
@import "../assets/scss/login.scss";
</style>
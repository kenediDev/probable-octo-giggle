<template>
  <div class="auth">
    <form @submit.prevent="submit">
      <div class="field" id="field-text">
        <h2 class="field-title">Lupa Kata Sandi?</h2>
        <div class="field-sub-title">
          Silakan masukkan akun Anda dan kami akan mengirimkan tautan melalui
          email untuk mengatur ulang kata sandi Anda.
        </div>
      </div>
      <div class="field" id="field-input">
        <span class="field-icon">
          <i class="fas fa-search"></i>
        </span>
        <input
          type="text"
          name="search"
          id="search"
          class="search"
          placeholder="Cari Akun Anda"
          v-model="token"
        />
      </div>
      <div class="field" id="field-button">
        <button>Reset Kata Sandi</button>
        <a href="#" @click="clickRouter('loading', 'login')">Kembali</a>
      </div>
    </form>
  </div>
</template>

<script lang="ts">
import { AxiosResponse } from "axios";
import Vue from "vue";
import { Component, Emit } from "vue-property-decorator";

@Component({})
export default class ForgotScreen extends Vue {
  @Emit()
  clickRouter(args: string, params: string) {
    this.$emit("clickRouter", { url: args, params: params });
  }

  token: string = "";
  submit() {
    const args = {
      token: this.token,
    };
    this.$store.commit("message", { loading: true });
    this.$store
      .dispatch("reset", args)
      .then((res: AxiosResponse<any>) => {
        this.$store.commit("message", { loading: false });
        this.token = "";
        this.$store.commit("message", { message: res.data.message, valid: 1 });
      })
      .catch((err) => {
        this.$store.commit("message", { loading: false });
        this.$store.commit("message", {
          message: err.response.data.message,
          valid: 2,
        });
      });
  }
}
</script>


<style lang="scss" scoped>
@import "../assets/scss/forgot.scss";
</style>
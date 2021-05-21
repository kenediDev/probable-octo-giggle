<template>
  <div class="profile">
    <div class="profile-author">
      <div class="image">
        <img :src="me.accounts.logo" alt="" />
        <div class="upload">
          <div class="upload-btn-wrapper">
            <input
              type="file"
              name=""
              id=""
              ref="avatar"
              @change="changeAvatar()"
            />
            <button>
              <icon :src="camera" class="icon" />
            </button>
          </div>
        </div>
      </div>
      <div class="profile-author-group">
        <div class="group">
          <a href="">{{ me.accounts.first_name }}</a>
          <a href="">{{ me.accounts.last_name }}</a>
        </div>
        <button
          @click="
            clickModalsProfile(
              me.accounts.first_name,
              me.accounts.last_name,
              me.accounts.description
            )
          "
        >
          <icon :src="tools" class="icon" />
        </button>
      </div>
      <div class="content">
        <div class="title">Biodata</div>
        <div class="bio">
          {{ me.accounts.description }}
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import Vue from "vue";
import { Component, Emit, Prop } from "vue-property-decorator";
import { User } from "../../../store/types/interface";
import tools from "../../assets/tools.svg";
import camera from "../../assets/camera.svg";
import { AxiosResponse } from "axios";

@Component({})
export default class ProfileComponent extends Vue {
  @Emit()
  clickModalsProfile(first_name: string, last_name: string, bio: string) {
    this.$emit("clickModalsProfile", { first_name, last_name, bio });
  }

  @Prop(Object) me: User;
  tools = tools;
  camera = camera;

  changeAvatar() {
    const _ = (this.$refs.avatar as any).files[0];
    const data = new FormData();
    data.append("avatar", _);
    this.$store
      .dispatch("updateProfile", data)
      .then((res: AxiosResponse<any>) => {
        this.$store.commit("message", { message: res.data.message, valid: 1 });
        this.$store.commit("updateProfile", res.data.results);
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
@import "../../assets/scss/profile.scss";
</style>
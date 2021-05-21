<template>
  <div
    :class="
      modalsNotification === 1
        ? 'modals-notifications-'
        : modalsNotification === 2
        ? 'modals-notifications-close'
        : 'modals-notifications-hidden'
    "
  >
    <div class="modals-notification">
      <div class="modals-notification-headers">
        <button @click="clickModalsNotification()">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="modals-notification-content">
        <p>{{ modalsNotificationMessage }}</p>
      </div>
      <div class="modals-notification-button">
        <button @click="clickDestroy()">Hapus</button>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { AxiosResponse } from "axios";
import Vue from "vue";
import { Component, Emit, Prop } from "vue-property-decorator";

@Component({})
export default class ModalsScreen extends Vue {
  @Prop(Number) pk: number;
  @Prop(Number) modalsNotification: number;
  @Prop(String) modalsNotificationMessage: string;
  @Prop(String) choice: string;

  @Emit()
  clickModalsNotification() {
    this.$emit("clickModalsNotification");
  }

  clickDestroy() {
    switch (this.choice) {
      case "background":
        this.background();
        break;

      default:
        break;
    }
  }
  background() {
    this.$store
      .dispatch("destroyBackground", this.pk)
      .then((res: AxiosResponse<any>) => {
        this.$store.commit("message", { message: res.data.message, valid: 1 });
        this.$store.commit("destroyBackground", this.pk);
        this.clickModalsNotification();
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
@import "../assets/scss/modals-notification.scss";
</style>
<template>
  <div>
    <navbar
      v-if="navbarActive"
      :logo="logo"
      :token="token"
      v-on:clickRouter="clickRouter($event)"
    />
    <router-view
      v-on:clickRouter="clickRouter($event)"
      :logo="logo"
      v-on:openModalsNotification="openModalsNotification($event)"
      v-on:clickModalsProfile="clickModalUpdateProfile($event)"
      :me="me"
      :id="id"
      :title="title"
      :description="description"
      :photo="photo"
      :photo_url="photo_url"
      v-on:updateService="updateService($event)"
      v-on:changeTitle="changeTitle($event)"
      v-on:changeDescription="changeDescription($event)"
      v-on:changePhoto="changePhoto($event)"
      :formUpdate="formUpdate"
      :type="type"
      v-on:clearInput="clearInput()"
    ></router-view>
    <msg :message="message" />
    <progress_ :message="message" />
    <modalsNotification
      :modalsNotification="modalsNotification"
      :modalsNotificationMessage="modalsNotificationMessage"
      :pk="pk"
      :choice="choice"
      v-on:clickModalsNotification="clickModalsNotification()"
    />
    <modalsProfile
      :first_name="first_name"
      :last_name="last_name"
      :bio="bio"
      :modalsProfile="modalsProfile"
      v-on:clickModalsProfile="clickModalsProfile()"
      v-on:clearInput="clearInput()"
      v-on:changeFirstName="changeFirstName($event)"
      v-on:changeLastName="changeLastName($event)"
      v-on:changeBio="changeBio($event)"
    />
  </div>
</template>

<script lang="ts">
import Vue from "vue";
import { Component } from "vue-property-decorator";
import navbar from "./navbar.component.vue";
import msg from "./attribute/message.component.vue";
import progress_ from "./attribute/progress.component.vue";
import { mapGetters } from "vuex";
import modalsNotification from "./attribute/modals.screen.vue";
import modalsProfile from "./attribute/modals.profile-edit.vue";

@Component({
  components: {
    navbar,
    msg,
    progress_,
    modalsNotification,
    modalsProfile,
  },
  computed: {
    ...mapGetters(["message", "me"]),
  },
})
export default class BaseComponent extends Vue {
  logo: string = `http://${window.location.host}/images/Tanpa judul (5).png`;
  navbarActive: boolean = true;
  token: string = "";
  // Service Form
  id: number = 0;
  title: string = "";
  description: string = "";
  photo: any = null;
  photo_url: any = null;
  // Modals Notification
  choice: string = "";
  modalsNotification: number = 0;
  modalsNotificationMessage: string = "";
  pk: number = 0;
  // Modals Profile
  modalsProfile: number = 0;
  first_name: string = "";
  last_name: string = "";
  bio: string = "";
  formUpdate: boolean = false;

  // Another
  type: string = "service";

  changeTitle(args: any) {
    this.title = args.target.value;
  }
  changeDescription(args: any) {
    this.description = args.target.value;
  }

  updateService(args: {
    id: number;
    title: string;
    description: string;
    photo: string;
  }) {
    this.id = args.id;
    this.title = args.title;
    this.description = args.description;
    this.photo = args.photo;
    const myEl = document.getElementById("form") as HTMLElement;
    this.formUpdate = true;
    this.type = "service";
    this.$smoothScroll({
      scrollTo: myEl,
      hash: "#form",
    });
  }

  changePhoto(args: any) {
    if (args.match(/http/i)) {
      this.photo = args;
      this.photo_url = args;
    } else {
      const photo = (args as any).files[0];
      this.photo = photo;
      this.photo_url = URL.createObjectURL(photo);
    }
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

  clearInput() {
    this.first_name = "";
    this.last_name = "";
    this.bio = "";
    this.title = "";
    this.description = "";
    this.photo_url = "";
    this.photo = "";
    this.formUpdate = false;
  }

  clickModalUpdateProfile(args: {
    first_name: string;
    last_name: string;
    bio: string;
  }) {
    this.first_name = args.first_name;
    this.last_name = args.last_name;
    this.bio = args.bio;
    this.modalsProfile = 1;
  }

  clickModalsProfile() {
    if (!this.modalsProfile) {
      this.modalsProfile = 1;
    } else if (this.modalsProfile === 1) {
      this.modalsProfile = 2;
    } else {
      this.modalsProfile = 1;
    }
  }

  clickModalsNotification() {
    if (!this.modalsNotification) {
      this.modalsNotification = 1;
    } else if (this.modalsNotification === 1) {
      this.modalsNotification = 2;
    } else {
      this.modalsNotification = 1;
    }
  }

  openModalsNotification(args: {
    message: string;
    pk: number;
    choice: string;
  }) {
    this.modalsNotificationMessage = args.message;
    this.modalsNotification = 1;
    this.pk = args.pk;
    this.choice = args.choice;
  }

  clickRouter(args: { url: string; params: string }) {
    if (args.url) {
      this.$router.push({
        name: args.url,
        params: {
          id: args.params,
        },
      });
    } else {
      this.$router.push({ name: args.url });
    }
  }

  circleLife() {
    if (
      this.$route.name === "dashboard" ||
      this.$route.name === "login" ||
      this.$route.name === "forgot" ||
      this.$route.name === "loading"
    ) {
      this.navbarActive = false;
    } else {
      this.navbarActive = true;
    }
    if (localStorage.getItem("token")) {
      this.token = localStorage.getItem("token");
    } else {
      this.token = "";
    }
  }

  beforeUpdate() {
    this.circleLife();
  }

  beforeMount() {
    this.circleLife();
    this.$store.dispatch("listProduct");
    this.$store.dispatch("loadMe");
  }
}
</script>


<style lang="scss" scoped>
@import url("https://use.fontawesome.com/releases/v5.15.3/css/all.css");
@import url("https://fonts.googleapis.com/css2?family=Roboto&family=Roboto+Slab&display=swap");
@import url("https://fonts.googleapis.com/css2?family=Public+Sans:wght@700&display=swap");
// font-family: 'Roboto', sans-serif;
// font-family: 'Roboto Slab', serif;
// font-family: 'Public Sans', sans-serif;
</style>

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
      :nameTitle="name"
      v-on:retrieveTitle="retrieveTitle($event)"
      v-on:changeName="changeName($event)"
      :choiceScreen="choiceScreen"
      v-on:clickChoiceScreen="clickChoiceScreen($event)"
      v-on:clickModalInformation="clickModalInformation($event)"
      v-on:clickModalCoverInformation="clickModalCoverInformation($event)"
      v-on:openModalCoverInformation="openModalCoverInformation()"
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
    <modalsTitle
      :modalsTitle_="modalsTitle_"
      v-on:clickModalsTitle="clickModalsTitle()"
      :nameTitle="name"
      :type="type"
      v-on:changeName="changeName($event)"
    />
    <modalsInformation
      :modalInformation="modalInformation"
      v-on:openModalsInformation="openModalsInformation($event)"
      :title="name"
      :child_title="title"
      :description="description"
      v-on:changeTitle="changeTitle($event)"
      v-on:changeName="changeName($event)"
      v-on:changeDescription="changeDescription($event)"
      v-on:clearInput="clearInput()"
    />
    <modalsCoverInformation
      :modalsCoverInformation="modalsCoverInformation"
      v-on:openModalCoverInformation="openModalCoverInformation()"
      :name="name"
      :id="id"
      :description="description"
      v-on:changeName="changeName($event)"
      v-on:changeDescription="changeDescription($event)"
      v-on:clearInput="clearInput()"
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
import modalsTitle from "./attribute/modals.title.vue";
import modalsInformation from "./attribute/modals.information.vue";
import modalsCoverInformation from "./attribute/modals.cover_information.vue";

@Component({
  components: {
    navbar,
    msg,
    progress_,
    modalsNotification,
    modalsProfile,
    modalsTitle,
    modalsInformation,
    modalsCoverInformation,
  },
  computed: {
    ...mapGetters(["message", "me"]),
  },
})
export default class BaseComponent extends Vue {
  logo: string = `http://${window.location.host}/images/Tanpa judul (5).png`;
  navbarActive: boolean = true;
  token: string = "";
  // Name Title
  name: string = "";
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
  modalsTitle_: number = 0;
  first_name: string = "";
  last_name: string = "";
  bio: string = "";
  formUpdate: boolean = false;

  // Another
  type: string = "service";

  // Choice Screen
  choiceScreen: string = "information";
  modalInformation: number = 0;
  modalsCoverInformation: number = 0;

  clickModalCoverInformation(args: {
    id: number;
    name: string;
    description: string;
  }) {
    this.id = args.id;
    this.name = args.name;
    this.description = args.description;
    this.modalsCoverInformation = 1;
  }

  openModalCoverInformation() {
    if (!this.modalsCoverInformation) {
      this.modalsCoverInformation = 1;
    } else if (this.modalsCoverInformation === 1) {
      this.modalsCoverInformation = 2;
    } else {
      this.modalsCoverInformation = 1;
    }
  }

  clickModalInformation(args: {
    title: string;
    child_title: string;
    description: string;
  }) {
    this.modalsCoverInformation = 1;
    this.name = args.title;
    this.title = args.child_title;
    this.description = args.description;
  }

  openModalsInformation() {
    if (!this.modalInformation) {
      this.modalInformation = 1;
    } else if (this.modalInformation === 1) {
      this.modalInformation = 2;
    } else {
      this.modalInformation = 1;
    }
  }

  clickChoiceScreen(args: string) {
    this.choiceScreen = args;
  }

  clickModalsTitle() {
    if (!this.modalsTitle_) {
      this.modalsTitle_ = 1;
    } else if (this.modalsTitle_ === 1) {
      this.modalsTitle_ = 2;
    } else {
      this.modalsTitle_ = 1;
    }
  }

  changeName(args) {
    this.name = args.target.value;
  }

  retrieveTitle(args: { title: string; type: string }) {
    this.name = args.title;
    this.type = args.type;
    this.modalsTitle_ = 1;
  }

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
    this.title = "";
    this.name = "";
    this.formUpdate = false;
    this.modalInformation = 0;
    this.modalsCoverInformation = 0;
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

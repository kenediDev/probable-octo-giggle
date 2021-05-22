<template>
  <div class="product">
    <div class="list-product" v-if="active === 'poster' || active === ''">
      <img
        v-for="(items, index) in listProduct"
        :key="index"
        :src="items"
        alt=""
      />
    </div>
    <h1
      v-if="active === 'service' || active === ''"
      :id="active === 'service' ? 'active-h1' : ''"
    >
      <span v-if="me.accounts">{{ me.accounts.title_service }}</span>
      <div
        @click="retrieveTitle(me.accounts.title_service, 'service')"
        v-if="active === 'service'"
        class="box"
      >
        <icon :src="edit" class="icon" />
      </div>
    </h1>
    <div
      class="list-choice"
      v-if="active === 'service' || active === ''"
      :id="active === 'service' ? 'active-list' : ''"
    >
      <div v-for="(items, index) in me.service" :key="index">
        <div class="choice-card" :id="active === 'service' ? 'active' : ''">
          <div class="choice-sub-card">
            <div class="icons">
              <icon :src="items.photo" class="icon" />
            </div>
            <div class="choice-card-title">
              {{ items.title }}
            </div>
            <div class="choice-card-description">{{ items.description }}</div>
            <div class="group" v-if="active === 'service'">
              <button
                @click="
                  updateService(
                    items.id,
                    items.title,
                    items.description,
                    items.photo
                  )
                "
              >
                <icon :src="edit" class="icon" />
                <span>Edit</span>
              </button>
              <button @click="clickDestroy(items.id)">
                <icon :src="trash" class="icon" />
                <span>Hapus</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-if="active === 'service'" class="another-form">
      <button class="box-icon" @click="clickAnimation()">
        <icon :src="activeSwitch ? switchOn : switchOff" class="icon" />
      </button>
      <div class="info">
        <icon :src="info" class="icon" />
        <div class="information">
          Silahkan klik on untuk mengaktifkan animasi, klik icon post untuk
          menambahkan informasi service.
        </div>
      </div>
      <button class="box-icon" id="box-icon">
        <icon :src="post" class="icon" id="icon" />
      </button>
    </div>
    <div class="another-choice">
      <div v-for="(items, index) in anotherChoices" :key="index">
        <div
          class="another-choice-card"
          :id="active === 'service' ? 'another-choice-card-animation' : ''"
        >
          <div class="another-choice-sub-card">
            <div class="icons">
              <icon :src="items.url" class="icon" />
            </div>
            <div class="another-choice-card-title">
              {{ items.name }}
            </div>
            <div class="another-choice-card-description">
              {{ items.description }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { AxiosResponse } from "axios";
import Vue from "vue";
import { Component, Emit, Prop } from "vue-property-decorator";
import { mapGetters } from "vuex";
import { User } from "../../../store/types/interface";
import edit from "../../assets/edit.svg";
import trash from "../../assets/garbage.svg";
import switchOn from "../../assets/switch-on.svg";
import switchOff from "../../assets/switch-off.svg";
import info from "../../assets/cursor.svg";
import post from "../../assets/post.svg";

@Component({
  computed: {
    ...mapGetters(["listProduct", "choices", "anotherChoices"]),
  },
})
export default class ProductComponent extends Vue {
  switchOn = switchOn;
  switchOff = switchOff;
  info = info;
  activeSwitch: boolean = true;
  post = post;

  clickAnimation() {
    this.activeSwitch = !this.activeSwitch;
  }

  @Prop(String) nameTitle: string;
  @Emit()
  changeName(args: any) {
    this.$emit("changeName", args);
  }

  @Emit()
  retrieveTitle(title: string, type: string) {
    this.$emit("retrieveTitle", { title: title, type: type });
  }

  @Emit()
  updateService(id: number, title: string, description: string, photo: string) {
    this.$emit("updateService", {
      id: id,
      title: title,
      description: description,
      photo: photo,
    });
  }

  @Prop(Object) me: User;
  active: string = "";
  edit = edit;
  trash = trash;

  clickDestroy(args: number) {
    this.$store
      .dispatch("destroyService", args)
      .then((res: AxiosResponse<any>) => {
        this.$store.commit("message", { message: res.data.message, valid: 1 });
        this.$store.commit("destroyService", args);
      })
      .catch((err) => {
        if (err.response.data) {
          localStorage.clear();
          window.location.reload();
        }
        this.$store.commit("message", {
          message: err.response.data.message,
          valid: 2,
        });
      });
  }

  beforeMount() {
    if (this.$route.name === "dashboard") {
      this.active = "service";
    }
  }
  beforeUpdate() {
    if (this.$route.name === "dashboard") {
      this.active = "service";
    }
  }
}
</script>


<style lang="scss" scoped>
@import "../../assets/scss/product.scss";
</style>
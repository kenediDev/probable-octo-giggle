<template>
  <div class="product">
    <div class="list-product" v-if="active === 'poster' || active === null">
      <img
        v-for="(items, index) in listProduct"
        :key="index"
        :src="items"
        alt=""
      />
    </div>
    <h1
      v-if="active === 'service' || active === null"
      :id="active === 'service' ? 'active-h1' : ''"
    >
      Alasan ditempat kami
      <div v-if="active === 'service'" class="box">
        <icon :src="edit" class="icon" />
      </div>
    </h1>
    <div class="list-choice" v-if="active === 'service' || active === null">
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
            <div class="group">
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
    <div class="another-choice">
      <div v-for="(items, index) in anotherChoices" :key="index">
        <div class="another-choice-card">
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

@Component({
  computed: {
    ...mapGetters(["listProduct", "choices", "anotherChoices"]),
  },
})
export default class ProductComponent extends Vue {
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
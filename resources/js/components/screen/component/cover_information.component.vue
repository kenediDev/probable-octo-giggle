<template>
  <div>
    <div class="cover_information">
      <div class="grids" :id="active === 'information' ? 'grids-unactive' : ''">
        <div
          class="cols"
          :id="active === 'information' ? 'active-cols' : ''"
          :style="
            'background-image:url(' +
            'https://www.mynrma.com.au/-/media/car-servicing/nrma-car-service-app.jpg?h=360&w=640&hash=f5e334365f5a22383956a0f9d914081a' +
            ')'
          "
        >
          <div v-if="active === 'information'" class="groups">
            <button>
              <icon :src="upload" class="icon" />
            </button>
          </div>
        </div>
        <div class="cols">
          <div class="title">
            {{ me.accounts.cover_information.title }}
            <button
              @click="
                clickModalInformation(
                  me.accounts.cover_information.title,
                  me.accounts.cover_information.child_title,
                  me.accounts.cover_information.description
                )
              "
            >
              <icon :src="edit" class="icon" />
            </button>
          </div>
          <div class="child-title">
            {{ me.accounts.cover_information.child_title }}
          </div>
          <p>
            {{ me.accounts.cover_information.description }}
          </p>
          <div class="group">
            <button>Misi kita</button>
            <button>Visi Kita</button>
          </div>
          <div class="content">
            <div class="text">
              Far far away, behind the word mountains, far from the countries
              Vokalia and Consonantia, there live the blind texts. Separated
              they live in Bookmarksgrove right at the coast of the Semantics, a
              large language ocean.
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import Vue from "vue";
import { Component, Emit, Prop } from "vue-property-decorator";
import upload from "../../assets/image.svg";
import edit from "../../assets/edit.svg";
import { User } from "../../../store/types/interface";

@Component({})
export default class CoverInformation extends Vue {
  @Prop(Object) me: User;

  active: string = "";
  upload = upload;
  edit = edit;

  @Emit()
  clickModalInformation(
    title: string,
    child_title: string,
    description: string
  ) {
    this.$emit("clickModalInformation", {
      title: title,
      child_title: child_title,
      description: description,
    });
  }

  beforeMount() {
    if (this.$route.name === "dashboard") {
      this.active = "information";
    }
  }

  beforeUpdate() {
    if (this.$route.name === "dashboard") {
      this.active = "information";
    } else {
      this.active = "information";
    }
  }
}
</script>

<style lang="scss" scoped>
@import "../../assets/scss/cover_information.scss";
</style>
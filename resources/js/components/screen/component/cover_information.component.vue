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
          <div v-if="active === 'information'" class="section">
            <button @click="openModalCoverInformation()">
              <icon :src="edit" class="icon" />
            </button>
          </div>
          <div
            class="group"
            :id="active === 'information' ? 'active-group' : ''"
          >
            <button
              v-for="(items, index) in me.accounts.cover_information
                .list_cover_information"
              :key="index"
              @click="clickChoiceInformation(index)"
            >
              {{ items.name }}
            </button>
          </div>
          <div
            v-if="me.accounts.cover_information.list_cover_information[choice]"
            class="content"
          >
            <div class="text">
              {{
                me.accounts.cover_information.list_cover_information[choice]
                  .description
              }}
            </div>
            <div class="group" v-if="active === 'information'">
              <button
                @click="
                  clickModalCoverInformation(
                    me.accounts.cover_information.list_cover_information[choice]
                      .id,
                    me.accounts.cover_information.list_cover_information[choice]
                      .name,
                    me.accounts.cover_information.list_cover_information[choice]
                      .description
                  )
                "
              >
                <icon :src="edit" class="icon" />
                <span>Edit</span>
              </button>
              <button
                @click="
                  clickDestroy(
                    me.accounts.cover_information.list_cover_information[choice]
                      .id
                  )
                "
              >
                <icon :src="trash" class="icon" />
                <span> Hapus </span>
              </button>
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
import trash from "../../assets/garbage.svg";
import { AxiosResponse } from "axios";

@Component({})
export default class CoverInformation extends Vue {
  choice: number = 0;

  @Prop(Object) me: User;

  @Emit()
  clickModalCoverInformation(id: number, name: string, description: string) {
    this.$emit("clickModalCoverInformation", {
      id: id,
      name: name,
      description: description,
    });
  }

  @Emit()
  openModalCoverInformation() {
    this.$emit("openModalCoverInformation");
  }

  active: string = "";
  upload = upload;
  edit = edit;
  trash = trash;

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

  clickChoiceInformation(args: number) {
    this.choice = args;
    console.log(args);
  }

  clickDestroy(args: number) {
    this.$store
      .dispatch("destroyListInformation", args)
      .then((res: AxiosResponse<any>) => {
        this.$store.commit("message", { message: res.data.message, valid: 1 });
        this.$store.commit("destroyListInformation", args);
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
<template>
  <div class="product">
    <div class="list-product">
      <img
        v-for="(items, index) in listProduct"
        :key="index"
        :src="items"
        alt=""
      />
    </div>
    <h1>Alasan ditempat kami</h1>
    <div class="list-choice">
      <div v-for="(items, index) in choices" :key="index">
        <div class="choice-card">
          <div class="choice-sub-card">
            <div class="icons">
              <icon :src="items.url" class="icon" />
            </div>
            <div class="choice-card-title">
              {{ items.name }}
            </div>
            <div class="choice-card-description">{{ items.description }}</div>
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
import Vue from "vue";
import { Component } from "vue-property-decorator";
import { mapGetters } from "vuex";

@Component({
  computed: {
    ...mapGetters(["listProduct", "choices", "anotherChoices"]),
  },
})
export default class ProductComponent extends Vue {}
</script>


<style lang="scss" scoped>
@import "../../assets/scss/product.scss";
</style>
<template>
  <div>
    <div class="cover_information">
      <div class="grids">
        <div
          class="cols"
          :style="
            'background-image:url(' +
            'https://www.mynrma.com.au/-/media/car-servicing/nrma-car-service-app.jpg?h=360&w=640&hash=f5e334365f5a22383956a0f9d914081a' +
            ')'
          "
        ></div>
        <div class="cols">
          <div class="title">WELCOME TO AUTOREPAIR</div>
          <div class="child-title">
            We help more than 45 years serving customer car
          </div>
          <p>
            Far far away, behind the word mountains, far from the countries
            Vokalia and Consonantia, there live the blind texts. Separated they
            live in Bookmarksgrove right at the coast of the Semantics, a large
            language ocean. A small river named Duden flows by their place and
            supplies it with the necessary regelialia. It is a paradisematic
            country, in which roasted parts of sentences fly into your mouth.
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
import { Component } from "vue-property-decorator";

@Component({})
export default class CoverInformation extends Vue {}
</script>

<style lang="scss" scoped>
@import "../../assets/scss/cover_information.scss";
</style>
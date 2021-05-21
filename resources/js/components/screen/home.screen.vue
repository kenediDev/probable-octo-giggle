<template>
  <div class="home">
    <div
      class="home-background"
      :style="'background-image:url(' + background + ')'"
    >
      <div class="homes-background">
        <div class="homes-content">
          <h1>Bengkel Mobil Sangkut</h1>
          <h1 class="homes-text">Kota Lubuklinggau</h1>
          <p>
            Bengkel Mobil sangkut kini sudah menjadi bengkel mobil terbaik
            dikota lubuklinggau, untuk melayani anda ahli dalam memeliharaan
            untuk ban, layanan memeliharaan rem, baterai, shock, absorber,
            suspensi mobil, sistem pendingin udara, dan penggantian oli, dan
            kami menawarkan penuh dari mekanik terlatih dan proffesional yang
            merupakan spesialis di bidang masing - masing, mekanik kami siap
            memberikan anda saran, memberikan layanan terbaik dan dibengkel
            sangkut siap untuk melayan perbaikan kendaraan anda diluar lokasi
            kota lubuklinggau, dan kami akan mengirimkan mekanik yang handal
            untuk memperbaiki kendaraan anda.
          </p>
          <div class="group">
            <button>Telepon</button>
            <button>Buka Rute</button>
          </div>
        </div>
      </div>
    </div>
    <div class="home-content">
      <product :me="me" v-if="me" v-on:updateService="updateService($event)" />
    </div>
  </div>
</template>

<script lang="ts">
import Vue from "vue";
import { Component, Emit, Prop } from "vue-property-decorator";
import { User } from "../../store/types/interface";
import product from "./component/product.component.vue";

@Component({
  components: {
    product,
  },
})
export default class HomeScreen extends Vue {
  background: string =
    "http://static1.squarespace.com/static/5b7eea0f70e802f73c399c2f/t/5ba53265b208fc5e9513b656/1537553006321/car+maintenance.jpg?format=1500w";

  @Prop(Object) me: User;

  @Emit()
  updateService(args: {
    id: number;
    title: string;
    description: string;
    photo: string;
  }) {
    this.$emit("updateService", args);
  }
}
</script>


<style lang="scss" scoped>
@import "../assets/scss/home.scss";
</style>
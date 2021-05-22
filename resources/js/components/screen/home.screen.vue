<template>
  <div class="home">
    <div
      v-if="me.accounts"
      class="home-background"
      :style="
        'background-image:url(' + me.accounts.background[count].background + ')'
      "
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
      <product
        :me="me"
        v-if="me"
        v-on:updateService="updateService($event)"
        v-on:updateTitle="updateTitle($event)"
      />
    </div>
  </div>
</template>

<script lang="ts">
import Vue from "vue";
import { Component, Emit, Prop, Watch } from "vue-property-decorator";
import { mapState } from "vuex";
import { User, UserBackgroundList } from "../../store/types/interface";
import product from "./component/product.component.vue";

@Component({
  data() {
    return {
      user: {
        data: {
          background_list: [],
        },
      },
      count: 0,
    };
  },
  components: {
    product,
  },
  computed: {
    ...mapState(["UserModules"]),
    getBackgroundList() {
      const _ = this.UserModules;
      return _;
    },
  },
  mounted() {
    const _ = this.getBackgroundList;
    this.user = _;
  },
})
export default class HomeScreen extends Vue {
  count: number;
  user: UserBackgroundList;
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

  @Watch("count", { immediate: true })
  watchCount() {
    const length = this.user.data.background_list.length - 1;
    if (length >= 0) {
      setTimeout(() => {
        if (this.count !== 0) {
          this.count -= 1;
        } else if (this.count !== length) {
          this.count += 1;
        }
      }, 1000);
    }
  }
}
</script>


<style lang="scss" scoped>
@import "../assets/scss/home.scss";
</style>
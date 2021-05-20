import Vue from "vue";
import Vuex from "vuex";
import UserModules from "./modules/user.modules";

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        UserModules
    }
});

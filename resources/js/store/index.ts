import Vue from "vue";
import Vuex from "vuex";
import UserModules from "./modules/user.modules";
import DefaultModules from "./modules/default.modules";
import ServiceModules from "./modules/service.modules";

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        UserModules,
        DefaultModules,
        ServiceModules
    }
});

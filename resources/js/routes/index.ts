import Vue, { VueConstructor } from "vue";
import VueRouter from "vue-router";
import LoginScreen from "../components/screen/login.screen.vue";
import ForgotScreen from "../components/screen/forgot.screen.vue";
import HomeScreen from "../components/screen/home.screen.vue";
import LoadingScreen from "../components/attribute/loading.screen.vue";

Vue.use(VueRouter);

type RouteName = "home" | "login" | "forgot" | "loading";
type RoutePath =
    | "/"
    | "/access-login"
    | "/access-forgot-password"
    | "/loading/:id";
interface Routes {
    name: RouteName;
    path: RoutePath;
    component: VueConstructor<Vue>;
}

const routes: Routes[] = [
    {
        name: "home",
        path: "/",
        component: HomeScreen
    },
    {
        name: "login",
        path: "/access-login",
        component: LoginScreen
    },
    {
        name: "forgot",
        path: "/access-forgot-password",
        component: ForgotScreen
    },
    {
        name: "loading",
        path: "/loading/:id",
        component: LoadingScreen
    }
];

const router = new VueRouter({ routes });

const authenticate = ["login"];
const unauthenticate = ["dashboard"];

router.beforeEach((to, from, next) => {
    if (localStorage.getItem("token")) {
        if (authenticate.includes(to.name)) {
            next({ name: "home" });
        } else next();
    } else {
        if (unauthenticate.includes(to.name)) {
            next({ name: "login" });
        } else next();
    }
});

export default router;

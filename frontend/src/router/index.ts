import Vue from "vue";
import VueRouter, { RouteConfig } from "vue-router";
import HomePage from "../views/HomePage.vue";
import UploadPage from "../views/UploadPage.vue";
import FilePage from "../views/FilePage.vue";
import LoginPage from "../views/LoginPage.vue";
import RegisterPage from "../views/RegisterPage.vue";

Vue.use(VueRouter);

const routes: Array<RouteConfig> = [
  {
    path: "/",
    name: "Home",
    component: HomePage,
  },
  {
    path: "/upload",
    name: "Upload a new file",
    component: UploadPage,
  },
  {
    path: "/:id(\\d+)",
    name: "View a file",
    component: FilePage,
  },
  {
    path: "/login",
    name: "Login",
    component: LoginPage,
  },
  {
    path: "/register",
    name: "Register",
    component: RegisterPage,
  },
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes,
});

export default router;

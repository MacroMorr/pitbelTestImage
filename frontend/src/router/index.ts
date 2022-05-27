import Vue from "vue";
import VueRouter, { RouteConfig } from "vue-router";
import HomePage from "../views/HomePage.vue";
import UploadPage from "../views/UploadPage.vue";
import FilePage from "../views/FilePage.vue";

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
    path: "/:id",
    name: "View a file",
    component: FilePage,
  },
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes,
});

export default router;

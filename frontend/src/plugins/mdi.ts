import Vue from "vue";
import mdiVue from "mdi-vue/v2";
import * as mdijs from "@mdi/js";
import "material-design-icons-iconfont/dist/material-design-icons.css";
import "@mdi/font/css/materialdesignicons.css";

Vue.use(mdiVue, {
  icons: mdijs,
});

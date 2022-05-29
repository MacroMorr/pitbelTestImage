import Vue from "vue";
import Vuex, { StoreOptions } from "vuex";
import auth from "./auth";

Vue.use(Vuex);

const store: StoreOptions<any> = {
  modules: {
    auth,
  } as any,
};
export default new Vuex.Store<any>(store);

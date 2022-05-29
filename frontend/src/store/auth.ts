import AuthApi from "@/api/AuthApi";
import { TLoginParams } from "@/types";
import axios from "axios";
import { getCookie, setCookie } from "@/utils/cookie";

export default {
  state: () => ({
    userId: null,
    isAuth: false,
    token: null,
  }),
  mutations: {
    setIsAuth(state: any, isAuth: boolean): void {
      state.isAuth = isAuth;
    },
    setToken(state: any, token: string) {
      state.token = token;
    },
  },
  actions: {
    checkAuth(store: any) {
      const token = getCookie("token");
      if (token) {
        store.commit("setToken", token);
        store.commit("setIsAuth", true);
      }
    },

    register(store: any, params: TLoginParams): Promise<any> {
      return AuthApi.register(params)
        .then(({ access_token }) => {
          document.cookie = `token=${access_token}`;
          setCookie("token", access_token);
          axios.defaults.headers.common["Authorization"] = `Bearer ${access_token}`;
          store.commit("setToken", access_token);
          store.commit("setIsAuth", true);
        })
        .catch(({response: {data: message}}) => {
          return new Promise((resolve, reject) => {
            return reject(message);
          });
        });
    },

    login(store: any, params: TLoginParams) {
      return AuthApi.login(params)
        .then(({ access_token }) => {
          document.cookie = `token=${access_token}`;
          setCookie("token", access_token);
          axios.defaults.headers.common["Authorization"] = `Bearer ${access_token}`;
          store.commit("setToken", access_token);
          store.commit("setIsAuth", true);
        })
        .catch((err) => {
          return new Promise((resolve, reject) => {
            reject(err);
          });
        });
    },

    logout(store: any) {
      AuthApi.logout()
        .then(() => {
          setCookie("token", "");
          axios.defaults.headers.common["Authorization"] = "";
          store.state.userId = null;
          store.state.isAuth = false;
          store.state.token = null;
        })
        .catch((error) => {
          alert(error.message);
        });
    },
  },
  getters: {},
};

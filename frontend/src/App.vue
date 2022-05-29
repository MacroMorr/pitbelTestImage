<template>
  <v-app id="app" data-app>
    <nav>
      <router-link to="/">Home</router-link>
      <span v-if="isAuth"> | </span>
      <router-link v-if="isAuth" to="/upload">Upload</router-link>
      <span> | </span>
      <a class="logout" v-if="isAuth" v-on:click="logout">Logout</a>
      <router-link v-else to="/login">Login</router-link>
      <span v-if="!isAuth"> | </span>
      <router-link v-if="!isAuth" to="/register">Register</router-link>
    </nav>
    <router-view />
  </v-app>
</template>

<script lang="ts">
import Vue from "vue";
import Component from "vue-class-component";

@Component
export default class App extends Vue {
  get isAuth() {
    return this.$store.state.auth.isAuth;
  }

  mounted() {
    this.$store.dispatch("checkAuth");
  }

  logout() {
    this.$store.dispatch("logout");
  }
}
</script>
<style lang="scss">
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

nav {
  padding: 30px;

  a {
    font-weight: bold;
    color: #2c3e50;
    text-decoration: underline;

    &.router-link-exact-active {
      color: #42b983;
    }
  }
}
</style>

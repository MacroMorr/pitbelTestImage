<template>
  <section>
    <h1>Login page</h1>
    <VAlert class="alert" v-if="message" outlined text type="error">{{ message }}</VAlert>
    <VTextField class="input" v-model="username" placeholder="Login" />
    <VTextField class="input" type="password" v-model="password" placeholder="Password" />
    <VBtn v-on:click="submit">Login</VBtn>
  </section>
</template>

<script lang="ts">
import Vue from "vue";
import Component from "vue-class-component";
import router from "@/router";

@Component
export default class LoginPage extends Vue {
  username = "";
  password = "";

  message = "";

  submit() {
    this.$store
      .dispatch("login", {
        username: this.username,
        password: this.password,
      })
      .then(() => {
        router.push("/");
      })
      .catch(({ response: { status, statusText } }) => {
        if (status === 401) {
          this.message = statusText;
        }
      });
  }
}
</script>

<style scoped lang="scss">
.alert {
  width: 50%;
  margin: 0 auto;
}

.input {
  width: 50%;
  margin: auto;
}
</style>

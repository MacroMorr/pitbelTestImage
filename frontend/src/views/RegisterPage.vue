<template>
  <section>
    <h1>Register Page</h1>
    <VAlert v-for="(message, idx) in messages" :key="idx" class="alert" outlined text type="error">
      {{ message }}
    </VAlert>
    <VTextField class="input" v-model="username" placeholder="Login" />
    <VTextField class="input" type="password" v-model="password" placeholder="Password" />
    <VBtn v-on:click="submit">Register</VBtn>
  </section>
</template>

<script lang="ts">
import Component from "vue-class-component";
import Vue from "vue";
import router from "@/router";

@Component
export default class RegisterPage extends Vue {
  username = "";
  password = "";
  messages = [];

  submit() {
    this.$store
      .dispatch("register", {
        username: this.username,
        password: this.password,
      })
      .then((response) => {
        debugger;
        router.push("/");
      })
      .catch(({ messages }) => {
        this.messages = messages;
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

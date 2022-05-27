<template>
  <section>
    <h1>Upload new files</h1>
    <v-alert class="alert" v-if="message" outlined text :type="messType">{{ message }}</v-alert>
    <v-file-input
      v-model="files"
      placeholder="Upload new files"
      chips
      counter
      multiple
      show-size
      truncate-length="11"
      accept="image/png, image/jpeg, image/bmp"
    />
    <v-btn v-on:click="submit">Upload image(s) to server</v-btn>
  </section>
</template>

<script lang="ts">
import Vue from "vue";
import Component from "vue-class-component";
import ImageApi from "@/api/ImageApi";

@Component({
  name: "UploadPage",
})
export default class UploadPage extends Vue {
  message: string | null = null;
  files: File[] = [];
  messType: "success" | "error" | null = null;

  submit() {
    ImageApi.upload(this.files)
      .then(() => {
        this.message = "Image(s) uploaded successfully";
        this.messType = "success";
      })
      .catch(({ data: { message } }: any) => {
        this.message = message;
        this.messType = "error";
      });
  }
}
</script>

<style lang="scss">
.alert {
  width: 50%;
  margin: 0 auto;
}
</style>

<template>
  <VBtn @click="addLike">
    <VIcon v-if="isLiked">mdi-thumb-up</VIcon>
    <VIcon v-else>mdi-thumb-up-outline</VIcon>
    &nbsp;{{ count }}
  </VBtn>
</template>

<script>
import LikeApi from "@/api/LikeApi";

export default {
  name: "Like",

  props: {
    imageId: {
      type: Number,
      required: true,
    },
    count: {
      type: Number,
      default: 0,
    },
    isLiked: {
      type: Boolean,
      default: false,
    },
  },

  methods: {
    addLike() {
      if (this.isLiked) {
        LikeApi.removeLike(this.imageId).then(() => {
          this.$emit("change", this.imageId, this.count - 1, "remove");
        });
      } else {
        LikeApi.addLike(this.imageId).then(() => {
          this.$emit("change", this.imageId, this.count + 1, "add");
        });
      }
    },
  },
};
</script>

<style scoped>

</style>
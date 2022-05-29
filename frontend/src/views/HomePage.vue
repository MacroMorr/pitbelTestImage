<template>
  <div class="home">
    <h1>Home page</h1>
    <VContainer>
      <VRow>
        <VCol>
          <div class="images">
            <VImg
              v-for="image in images"
              :key="image.name"
              :src="`http://localhost:8000/img/${image.name}`"
              class="image"
            />
          </div>

          <v-pagination v-if="images.length" v-model="page" :length="length" />
        </VCol>
      </VRow>
    </VContainer>
  </div>
</template>

<script lang="ts">
import { Component, Vue, Watch } from "vue-property-decorator";
import ImageApi from "@/api/ImageApi";
import { TListItem } from "@/types";

const COUNT_IMAGES_ON_PAGE = 9;

@Component
export default class HomePage extends Vue {
  page = 1;
  length = 0;
  images: TListItem[] = [];

  mounted() {
    this.getImageList();
  }

  @Watch("page")
  changePage(page: number) {
    this.getImageList(page);
  }

  getImageList(page: number | null = null) {
    const params = {
      count: COUNT_IMAGES_ON_PAGE,
      page: page || 1,
    };
    ImageApi.getList(params).then(({ images, length }) => {
      this.images = images;
      this.length = Math.ceil(length / COUNT_IMAGES_ON_PAGE);
    });
  }
}
</script>

<style lang="scss" scoped>
.images {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  margin: auto;

  .image {
    max-width: 200px;
    height: 100px;
    margin: 10px;
    border-radius: 10px;
  }
}

.divided {
  margin-top: 30px;
  margin-bottom: 30px;
}
</style>

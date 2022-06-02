<template>
  <div class="home">
    <h1>Home page</h1>
    <VContainer>
      <VRow>
        <VCol>
          <div class="images">
            <div v-for="image in images" :key="image.name">
              <VImg :src="`http://localhost:8000/img/${image.name}`" class="image"/>
              <div class="actions">
                <Like
                    :count="image.likes.count"
                    :imageId="image.id"
                    :isLiked="image.likes.isLiked"
                    @change="setLikeToImage"
                />
              </div>
            </div>
          </div>

          <v-pagination v-if="images.length" v-model="page" :length="length" />
        </VCol>
      </VRow>
    </VContainer>
  </div>
</template>

<script lang="ts">
import {Component, Vue, Watch} from "vue-property-decorator";
import ImageApi from "@/api/ImageApi";
import {TActionLike, TListItem} from "@/types";
import Like from "@/components/Like.vue";

const COUNT_IMAGES_ON_PAGE = 9;

@Component({
  components: {
    Like,
  },
})
export default class HomePage extends Vue {
  page = 1;
  length = 0;
  images: TListItem[] = [];

  mounted() {
    this.getImageList();
  }

  setLikeToImage(imageId: number, newCount: number, action: TActionLike) {
    this.images = this.images.map((image) => {
      if (image.id === imageId) {
        image.likes.count = newCount;
        image.likes.isLiked = action === "add";
      }
      return image;
    });
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

import API from "@/api/API";

class LikeApi extends API {
  async addLike(imageId: number): Promise<any> {
    return await this.post("/api/image/like", {
      imageId,
      action: "add",
    });
  }

  async removeLike(imageId: number): Promise<any> {
    return await this.post("/api/image/like", {
      imageId,
      action: "remove",
    });
  }
}

export default new LikeApi();

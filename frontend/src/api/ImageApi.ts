import API from "@/api/API";
import {TList, TListItem, TListParams} from "@/types";

class ImageApi extends API {
  async getList(params: TListParams): Promise<TList<TListItem>> {
    return await this.get("/api/image/list", params);
  }

  async upload(files: File[]): Promise<number[]> {
    const formData = new FormData();

    files.map((file) => {
      formData.append("images[]", file);
    });
    return await this.uploadFiles(`/api/image/upload`, formData);
  }

  async file(id: number): Promise<number> {
    return await this.post(`/api/image/${id}`);
  }
}

export default new ImageApi();

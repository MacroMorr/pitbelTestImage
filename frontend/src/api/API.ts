import axios, { AxiosResponse } from "axios";

const timezone = new Date().getTimezoneOffset() / 60;
const config = {
  headers: { "Content-Type": "application/json", Timezone: timezone },
  timeout: 30000,
};

class API {
  get(url: string, params?: unknown): Promise<any> {
    return new Promise((resolve, reject) => {
      axios
        .get(url, { ...config, params })
        .then((response: AxiosResponse) => resolve(response.data))
        .catch((error: any) => reject(error));
    });
  }

  post(url: string, params?: unknown): Promise<any> {
    return new Promise((resolve, reject) => {
      axios
        .post(url, { ...config, params })
        .then((response: AxiosResponse) => resolve(response.data))
        .catch((error: any) => reject(error));
    });
  }

  uploadFiles(url: string, params?: unknown): Promise<any> {
    return new Promise((resolve, reject) => {
      config.headers = { ...config.headers, "Content-Type": "multipart/form-data" };
      axios
        .post(url, params, config)
        .then((response: AxiosResponse) => resolve(response.data))
        .catch((error: any) => reject(error.response));
    });
  }

  put(url: string, params?: unknown): Promise<any> {
    return new Promise((resolve, reject) => {
      axios
        .put(url, { ...config, params })
        .then((response: AxiosResponse) => resolve(response.data))
        .catch((error: any) => reject(error));
    });
  }

  delete(url: string, params?: unknown): Promise<any> {
    return new Promise((resolve, reject) => {
      axios
        .delete(url, { ...config, params })
        .then((response: AxiosResponse) => resolve(response.data))
        .catch((error: any) => reject(error));
    });
  }
}

export default API;

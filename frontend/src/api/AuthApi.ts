import API from "@/api/API";
import { TLoginResponse, TLoginParams } from "@/types";

class AuthApi extends API {
  login(params: TLoginParams): Promise<TLoginResponse> {
    return this.post("/api/login", params);
  }

  logout(): Promise<void> {
    return this.post("/api/logout");
  }
}

export default new AuthApi();

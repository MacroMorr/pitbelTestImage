import API from "@/api/API";
import { TLoginResponse, TLoginParams } from "@/types";

class AuthApi extends API {
  register(params: TLoginParams): Promise<TLoginResponse> {
    return this.post("/api/register", params);
  }

  login(params: TLoginParams): Promise<TLoginResponse> {
    return this.post("/api/login", params);
  }

  logout(): Promise<void> {
    return this.post("/api/logout");
  }
}

export default new AuthApi();

export type TListItem = {
  id: number;
  name: string;
};

export type TListParams = {
  count?: number;
  page?: number;
};

export type TList<T> = {
  images: T[];
  length: number;
};

export type TLoginParams = {
  username: string;
  password: string;
};

export type TLoginResponse = {
  access_token: string;
  token_type: string;
  expires_in: number;
};

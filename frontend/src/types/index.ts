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

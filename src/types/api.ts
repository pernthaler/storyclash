export type ApiNote = ApiComment & {
  replies: ApiComment[];
};

export type ApiComment = {
  id: number;
  text: string;
  author: ApiAuthor;
};

type ApiAuthor = {
  id: number;
  username: string;
  avatar: string;
};

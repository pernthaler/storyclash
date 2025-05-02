export type ApiNote = ApiComment & {
    replies: ApiComment[];
};

export type ApiComment = {
    id: number;
    text: string;
    author: ApiUser;
};

export type ApiUser = {
    id: number;
    username: string;
    avatar: string;
};

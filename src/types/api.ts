export type ApiNote = ApiComment & {
    updatedAt: string;
    replies: ApiComment[];
};

export type ApiComment = {
    id: number;
    text: string;
    createdAt: string;
    author: ApiUser;
};

export type ApiUser = {
    id: number;
    username: string;
    avatar: string;
};

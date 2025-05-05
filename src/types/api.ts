export type NoteApi = CommentApi & {
    updatedAt: string;
    replies: CommentApi[];
};

export type CommentApi = {
    id: number;
    text: string;
    createdAt: string;
    author: UserApi;
};

export type UserApi = {
    id: number;
    firstName: string;
    lastName: string;
    avatar: string;
};

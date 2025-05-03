import type { ApiNote } from "../types/api";
import { ofetch } from "ofetch";

export default {
    async createNote(text: string) {
        return await ofetch<ApiNote>("/api/notes", {
            method: "POST",
            body: { text },
        });
    },

    async deleteNote(note: ApiNote) {
        await ofetch(`/api/notes/${note.id}`, {
            method: "DELETE",
        });
    },
};

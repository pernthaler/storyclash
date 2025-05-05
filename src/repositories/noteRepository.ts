import type { NoteApi } from "../types/api";
import { ofetch } from "ofetch";

export default {
    async createNote(text: string) {
        return await ofetch<NoteApi>("/api/notes", {
            method: "POST",
            body: { text },
        });
    },

    async patchNote(note: NoteApi, text: string) {
        return await ofetch(`/api/notes/${note.id}`, {
            method: "PATCH",
            body: { text },
        });
    },

    async deleteNote(note: NoteApi) {
        await ofetch(`/api/notes/${note.id}`, {
            method: "DELETE",
        });
    },

    async replyNote(note: NoteApi, text: string) {
        return await ofetch<NoteApi>(`/api/notes/${note.id}/reply`, {
            method: "POST",
            body: { text },
        });
    },
};

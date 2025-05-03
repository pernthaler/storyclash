<script setup lang="ts">
import Background from "./components/Background.vue";
import Button from "./components/Button.vue";
import Modal from "./components/Modal.vue";
import Note from "./components/Note.vue";
import type { ApiNote } from "./types/api";
import { syncRef, useFetch } from "@vueuse/core";
import { ofetch } from "ofetch";
import { ref } from "vue";

const { data, isFinished } = useFetch("/api/notes").json<ApiNote[]>();
const notes = ref(data.value);
syncRef(data, notes);

const text = ref<string>();

async function onCreate() {
    const note = await ofetch<ApiNote>("/api/notes", {
        method: "POST",
        body: {
            text: text.value,
        },
    });
    notes.value?.push(note);
    text.value = undefined;
}
</script>

<template>
    <header class="flex justify-center">
        <div class="flex-1">
            <h1 class="text-4xl font-bold">Storyclash Notes</h1>
            <p class="text-subtext">
                Manage and track your Creators in projects and analyze them.
            </p>
        </div>

        <div class="flex items-center">
            <Modal title="Create a new Note" @submit="onCreate">
                <template #trigger>
                    <Button size="large" type="primary">
                        Create a new Note
                    </Button>
                </template>

                <textarea v-model="text" required />
            </Modal>
        </div>
    </header>

    <div class="border-border rounded-lg border bg-white shadow-xs">
        <template v-if="isFinished">
            <Note
                v-if="notes?.length"
                v-for="note in notes"
                :key="note.id"
                v-bind="note"
            />
            <p v-else class="p-6">No notes were found.</p>
        </template>
        <p v-else class="p-6">Loading...</p>
    </div>

    <Background />
</template>

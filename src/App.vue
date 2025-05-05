<script setup lang="ts">
import Background from "./components/Background.vue";
import Button from "./components/Button.vue";
import Modal from "./components/Modal.vue";
import Note from "./components/Note.vue";
import TextArea from "./components/TextArea.vue";
import noteRepository from "./repositories/noteRepository";
import type { ApiNote } from "./types/api";
import { syncRefs, useFetch } from "@vueuse/core";
import { computed, ref } from "vue";

const { data, isFinished } = useFetch("/api/notes").json<ApiNote[]>();
const notes = ref(data.value);
syncRefs(data, notes);

const sortedNotes = computed(() =>
    notes.value?.toSorted(
        (a, b) =>
            new Date(b.updatedAt).getTime() - new Date(a.updatedAt).getTime(),
    ),
);

const text = ref<string>();

async function onCreate() {
    if (!text.value) return;
    const note = await noteRepository.createNote(text.value);
    notes.value?.push(note);
}

async function onDelete(note: ApiNote) {
    await noteRepository.deleteNote(note);
    const index = notes.value?.indexOf(note);
    if (index !== undefined) {
        notes.value?.splice(index, 1);
    }
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
            <Modal
                title="Create a new Note"
                action="Create Note"
                @submit="onCreate">
                <template #trigger>
                    <Button
                        size="large"
                        type="primary"
                        @click="text = undefined">
                        Create a new Note
                    </Button>
                </template>

                <TextArea v-model="text" placeholder="Please enter your Note" />
            </Modal>
        </div>
    </header>

    <div
        v-auto-animate
        class="border-border rounded-lg border bg-white shadow-xs">
        <template v-if="isFinished">
            <Note
                v-if="notes?.length"
                v-for="note in sortedNotes"
                :key="note.id"
                v-bind="note"
                @delete="onDelete(note)" />
            <p v-else class="p-6">No Notes were found</p>
        </template>
        <p v-else class="p-6">Loading...</p>
    </div>

    <Background />
</template>

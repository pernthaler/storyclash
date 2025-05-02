<script setup lang="ts">
import Button from "./components/Button.vue";
import Note from "./components/Note.vue";
import Triangle from "./components/Triangle.vue";
import type { ApiNote } from "./types/api";
import { useFetch } from "@vueuse/core";

const { data, isFinished } = useFetch("/api/notes").json<ApiNote[]>();

function onCreate() {
    console.log("asd");
}
</script>

<template>
    <Triangle />
    <header class="flex justify-center">
        <div class="flex-1">
            <h1 class="text-4xl font-bold">Storyclash Notes</h1>
            <p class="text-subtext">
                Manage and track your Creators in projects and analyze them.
            </p>
        </div>
        <div class="flex items-center">
            <Button size="large" type="primary" @click="onCreate">
                Create a New Note
            </Button>
        </div>
    </header>
    <div class="border-border rounded-lg border bg-white shadow-xs">
        <template v-if="isFinished">
            <Note
                v-if="data?.length"
                v-for="note in data"
                :key="note.id"
                v-bind="note"
            />
            <p v-else class="p-6">No notes were found.</p>
        </template>
        <p v-else class="p-6">Loading...</p>
    </div>
</template>

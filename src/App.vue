<script setup lang="ts">
import Note from "./components/Note.vue";
import Button from "./components/Button.vue";
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
  <div class="bg-white rounded-lg border-border border shadow-xs">
    <Note v-if="isFinished" v-for="note in data" :key="note.id" v-bind="note" />
    <p v-else class="p-6">Loading...</p>
  </div>
</template>

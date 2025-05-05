<script setup lang="ts">
import type { CommentApi } from "../types/api";
import { useDateFormat } from "@vueuse/core";

const props = defineProps<CommentApi>();

const date = useDateFormat(props.createdAt, "DD.MM.YYYY, HH:mm");
</script>

<template>
    <img
        class="border-border bg-border col-start-2 m-auto size-8 rounded-full border"
        :src="author.avatar"
        alt="Avatar"
        loading="lazy" />

    <div class="flex gap-4">
        <div>
            <p class="text-sm font-medium">{{ author.username }}</p>
            <p class="text-placeholder text-xs">{{ date }}</p>
        </div>

        <slot />
    </div>

    <div class="bg-border col-start-2 mx-auto w-px" />

    <div class="py-2 text-sm break-all whitespace-pre">{{ text }}</div>
</template>

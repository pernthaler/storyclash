<script setup lang="ts">
import type { ApiComment } from "../types/api";

defineProps<ApiComment>();
</script>

<template>
    <img
        class="border-border bg-border col-start-2 m-auto size-8 rounded-full border"
        :src="author.avatar"
        loading="lazy"
    />

    <div class="flex">
        <div>
            <p class="text-sm font-medium">{{ author.username }}</p>
            <p class="text-placeholder text-xs">31.10.2021, 17:14</p>
        </div>

        <slot />
    </div>

    <div class="bg-border col-start-2 mx-auto w-px" />

    <div class="py-2 text-sm break-all">{{ text }}</div>
</template>

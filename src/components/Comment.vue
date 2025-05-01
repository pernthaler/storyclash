<script setup lang="ts">
import type { ApiComment } from "../types/api";

const props = defineProps<ApiComment>();
</script>

<template>
  <img
    class="size-8 border-border bg-border border rounded-full m-auto col-start-2"
    :src="props.author.avatar"
    loading="lazy"
  />

  <div class="flex">
    <div>
      <p class="text-sm font-medium">{{ props.author.username }}</p>
      <p class="text-placeholder text-xs">31.10.2021, 17:14</p>
    </div>

    <slot />
  </div>

  <div class="w-px bg-border mx-auto col-start-2" />

  <div class="py-2 text-sm break-all">{{ text }}</div>
</template>

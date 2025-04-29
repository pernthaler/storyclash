<script setup lang="ts">
import Comment from "./Comment.vue";
import Button from "./Button.vue";
import IconAccount from "~icons/lets-icons/comment";

defineProps<{
  text: string;
}>();
</script>

<template>
  <div class="note p-6">
    <IconAccount class="text-icon m-auto" />
    <Comment :text>
      <div class="controls hidden my-auto">
        <Button type="outline">Edit</Button>
        <Button type="outline">Delete</Button>
      </div>
    </Comment>
    <Comment :text />
    <div class="col-start-2 col-span-2">
      <Button type="solid">Reply</Button>
    </div>
  </div>
</template>

<style lang="scss" scoped>
.note {
  display: grid;
  grid-template-columns: auto auto 1fr;
  grid-auto-rows: auto;
  gap: 8px;

  &:not(&:last-of-type) {
    border-bottom: 1px solid var(--color-border);
  }

  &:hover .controls {
    display: block;
  }
}
</style>

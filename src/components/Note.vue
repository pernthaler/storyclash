<script setup lang="ts">
import Comment from "./Comment.vue";
import Button from "./Button.vue";
import IconAccount from "~icons/lets-icons/comment";
import type { ApiNote } from "../types/api";
import { ref } from "vue";

const props = defineProps<ApiNote>();

const expanded = ref(false);
</script>

<template>
  <div class="note p-6">
    <IconAccount class="text-icon m-auto" />
    <Comment v-bind="props">
      <div class="controls hidden my-auto">
        <Button type="outline">Edit</Button>
        <Button type="outline">Delete</Button>
      </div>
    </Comment>
    <div v-if="replies.length >= 2 && !expanded" class="col-start-2 col-span-2">
      <Button size="medium" type="outline" @click="expanded = true">
        Show {{ replies.length }} more replies
      </Button>
    </div>
    <div v-auto-animate class="contents">
      <template v-for="(reply, index) in props.replies">
        <Comment
          v-if="expanded || index === replies.length - 1"
          :key="reply.id"
          v-bind="reply"
        />
      </template>
    </div>
    <div class="col-start-2 col-span-2">
      <Button size="medium" type="solid">Reply</Button>
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

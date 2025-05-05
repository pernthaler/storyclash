<script setup lang="ts">
import type { ApiNote } from "../types/api";
import Button from "./Button.vue";
import Comment from "./Comment.vue";
import Modal from "./Modal.vue";
import { ref } from "vue";
import IconComment from "~icons/lets-icons/comment";

defineProps<ApiNote>();

const emit = defineEmits(["edit", "delete"]);

const expanded = ref(false);
</script>

<template>
    <div class="note p-6">
        <IconComment class="text-icon m-auto" />

        <Comment :id :text :created-at="updatedAt" :author>
            <div class="controls my-auto hidden gap-1.5">
                <Button type="outline" @click="emit('edit')">Edit</Button>
                <Modal
                    title="Are you sure you want to delete?"
                    action="Delete Note"
                    @submit="emit('delete')"
                    danger>
                    <template #trigger>
                        <Button type="outline">Delete</Button>
                    </template>

                    <p class="text-sm">
                        By deleting this note all replies will be deleted too.
                        <br />
                        This cannot be undone!
                    </p>
                </Modal>
            </div>
        </Comment>

        <div v-if="replies.length >= 2 && !expanded" class="contents">
            <div class="col-span-2 col-start-2">
                <Button type="outline" @click="expanded = true">
                    Show {{ replies.length - 1 }} more replies
                </Button>
            </div>

            <div class="bg-border col-start-2 mx-auto h-4 w-px" />
        </div>

        <template v-for="(reply, index) in replies">
            <Comment
                v-if="expanded || index === replies.length - 1"
                :key="reply.id"
                v-bind="reply" />
        </template>

        <div class="col-span-2 col-start-2">
            <Button type="solid">Reply</Button>
        </div>
    </div>
</template>

<style lang="scss" scoped>
.note {
    display: grid;
    grid-template-columns: auto auto 1fr;
    grid-auto-rows: auto;
    gap: 0.5rem;

    &:not(&:first-of-type) {
        border-top: 1px solid var(--color-border);
    }

    &:hover .controls {
        display: flex;
    }
}
</style>

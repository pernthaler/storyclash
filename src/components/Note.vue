<script setup lang="ts">
import noteRepository from "../repositories/noteRepository";
import type { NoteApi } from "../types/api";
import Button from "./Button.vue";
import Comment from "./Comment.vue";
import Modal from "./Modal.vue";
import TextArea from "./TextArea.vue";
import { ref } from "vue";
import IconComment from "~icons/lets-icons/comment";

const props = defineProps<NoteApi>();
const note = ref({ ...props });
const text = ref(note.value.text);
const reply = ref<string>();

const emit = defineEmits(["delete"]);

const expanded = ref(false);

async function onEdit() {
    note.value = await noteRepository.patchNote(note.value, text.value);
}

async function onReply() {
    if (!reply.value) return;

    note.value.replies.push(
        await noteRepository.replyNote(note.value, reply.value),
    );
}
</script>

<template>
    <div class="note p-6">
        <IconComment class="text-icon m-auto" />

        <Comment
            :id="note.id"
            :text="note.text"
            :created-at="note.updatedAt"
            :author="note.author">
            <div class="controls my-auto hidden gap-1.5">
                <Modal title="Edit Note" action="Save Note" @submit="onEdit">
                    <template #trigger>
                        <Button type="outline">Edit</Button>
                    </template>

                    <TextArea
                        v-model="text"
                        placeholder="Please enter your Note" />
                </Modal>

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

        <div v-if="note.replies.length > 2 && !expanded" class="contents">
            <div class="col-span-2 col-start-2">
                <Button type="outline" @click="expanded = true">
                    Show {{ note.replies.length - 1 }} more replies
                </Button>
            </div>

            <div class="bg-border col-start-2 mx-auto h-4 w-px" />
        </div>

        <template v-for="(reply, index) in note.replies">
            <Comment
                v-if="
                    expanded ||
                    index === note.replies.length - 1 ||
                    (note.replies.length <= 2 &&
                        index === note.replies.length - 2)
                "
                :key="reply.id"
                v-bind="reply" />
        </template>

        <div class="col-span-2 col-start-2">
            <Modal
                title="Create a new Reply"
                action="Create Reply"
                @submit="onReply">
                <template #trigger>
                    <Button type="solid" @click="reply = undefined">
                        Reply
                    </Button>
                </template>

                <TextArea
                    v-model="reply"
                    placeholder="Please enter your Reply" />
            </Modal>
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

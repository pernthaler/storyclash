<script setup lang="ts">
import Button from "./Button.vue";
import {
    DialogClose,
    DialogContent,
    DialogOverlay,
    DialogPortal,
    DialogRoot,
    DialogTitle,
    DialogTrigger,
} from "reka-ui";
import { ref } from "vue";
import IconCloseRound from "~icons/lets-icons/close-round";

defineProps<{
    title: string;
    action: string;
    danger?: boolean;
}>();

const emit = defineEmits(["submit"]);

const open = ref(false);

function onSubmit() {
    emit("submit");
    open.value = false;
}
</script>

<template>
    <DialogRoot v-model:open="open">
        <DialogTrigger as-child>
            <slot name="trigger" />
        </DialogTrigger>
        <DialogPortal>
            <DialogOverlay class="fixed inset-0 bg-black/50" />
            <DialogContent
                class="fixed top-[50%] left-[50%] translate-x-[-50%] translate-y-[-50%] rounded-lg bg-white p-6"
                :aria-describedby="undefined">
                <form
                    class="flex w-96 flex-col gap-6"
                    @submit.prevent="onSubmit">
                    <header class="flex">
                        <DialogTitle class="flex-1 text-xl font-medium">
                            {{ title }}
                        </DialogTitle>
                        <DialogClose
                            class="text-icon cursor-pointer"
                            aria-label="Close">
                            <IconCloseRound />
                        </DialogClose>
                    </header>
                    <slot />
                    <div>
                        <Button
                            size="large"
                            class="text-primary"
                            @click="open = false">
                            Cancel
                        </Button>
                        <Button
                            class="float-right"
                            size="large"
                            :type="!danger ? 'primary' : 'danger'"
                            submit>
                            {{ action }}
                        </Button>
                    </div>
                </form>
            </DialogContent>
        </DialogPortal>
    </DialogRoot>
</template>

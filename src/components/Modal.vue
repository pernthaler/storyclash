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
        <DialogTrigger>
            <slot name="trigger" />
        </DialogTrigger>
        <DialogPortal>
            <DialogOverlay class="" />
            <DialogContent
                class="data-[state=open]:animate-contentShow fixed top-[50%] left-[50%] z-[100] max-h-[85vh] w-[90vw] max-w-[450px] translate-x-[-50%] translate-y-[-50%] rounded-[6px] bg-white p-[25px] shadow-[hsl(206_22%_7%_/_35%)_0px_10px_38px_-10px,_hsl(206_22%_7%_/_20%)_0px_10px_20px_-15px] focus:outline-none"
            >
                <form @submit.prevent="onSubmit">
                    <header class="flex">
                        <DialogTitle class="flex-1 text-xl font-medium">
                            {{ title }}
                        </DialogTitle>
                        <DialogClose
                            class="text-icon cursor-pointer"
                            aria-label="Close"
                        >
                            <IconCloseRound />
                        </DialogClose>
                    </header>
                    <slot />
                    <Button
                        size="large"
                        class="text-primary"
                        @click="open = false"
                    >
                        Cancel
                    </Button>
                    <Button size="large" type="primary" submit>Submit</Button>
                </form>
            </DialogContent>
        </DialogPortal>
    </DialogRoot>
</template>

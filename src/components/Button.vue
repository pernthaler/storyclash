<script setup lang="ts">
const { size = "small" } = defineProps<{
    size?: "small" | "large";
    type?: "primary" | "danger" | "solid" | "outline";
    submit?: boolean;
}>();

const emit = defineEmits(["click"]);
</script>

<template>
    <button
        class="cursor-pointer"
        :type="submit ? 'submit' : 'button'"
        @click="emit('click')"
        :data-size="size"
        :data-type="type">
        <slot />
    </button>
</template>

<style lang="scss" scoped>
button {
    border-radius: 3.125rem;

    &[data-size="small"] {
        font-size: 0.75rem;
        padding: 3px 1rem;
    }

    &[data-size="large"] {
        padding: 0.5rem 1.25rem;
    }

    &[data-type="primary"],
    &[data-type="danger"] {
        color: white;
    }

    &[data-type="primary"] {
        background-color: var(--color-primary);
    }

    &[data-type="danger"] {
        background-color: var(--color-danger);
    }

    &[data-type="solid"] {
        background-color: var(--color-surface);
    }

    &[data-type="outline"] {
        box-shadow: inset 0 0 0 1px var(--color-border);
    }
}
</style>

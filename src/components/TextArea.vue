<script setup lang="ts">
const model = defineModel<string>();

defineProps<{
    placeholder: string;
}>();
</script>

<template>
    <textarea
        v-autofocus
        v-model="model"
        class="placeholder:text-placeholder border-border bg-surface-dark rounded-sm border px-4 py-3 text-sm"
        :placeholder
        :maxlength="255"
        required />
</template>

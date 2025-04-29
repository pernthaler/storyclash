<script setup lang="ts">
const { size = "small" } = defineProps<{
  size?: "small" | "large";
  type?: "primary" | "danger" | "solid" | "outline";
}>();

const emit = defineEmits(["click"]);
</script>

<template>
  <button
    class="cursor-pointer"
    @click="emit('click')"
    :data-size="size"
    :data-type="type"
  >
    <slot />
  </button>
</template>

<style scoped>
button {
  border-radius: 50px;
}

button[data-size="large"] {
  padding: 10px 20px;
}

button[data-size="small"] {
  padding: 6px 16px;
  font-size: 12px;
}

button[data-type="primary"] {
  color: white;
  background-color: var(--color-primary);
}

button[data-type="danger"] {
  background-color: var(--color-danger);
}

button[data-type="solid"] {
  background-color: var(--color-surface);
}

button[data-type="outline"] {
  border: 1px solid var(--color-border);
}
</style>

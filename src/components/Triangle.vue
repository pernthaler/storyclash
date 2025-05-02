<script setup lang="ts">
import Triangle from "../assets/triangle.svg?url";
</script>

<template>
    <img class="absolute inset-0 -z-10" :src="Triangle" alt="Triangle" />
</template>

<style scoped>
img {
    width: 50%;
}
</style>

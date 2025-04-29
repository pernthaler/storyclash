<script setup lang="ts">
import Triangle from "../assets/triangle.svg?url";
</script>

<template>
  <img class="absolute -z-10 inset-0" :src="Triangle" alt="Triangle" />
</template>

<style scoped>
img {
  width: 50%;
}
</style>

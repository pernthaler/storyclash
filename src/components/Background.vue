<script setup lang="ts">
import Triangle1 from "../assets/triangle1.svg?url";
import Triangle2 from "../assets/triangle2.svg?url";
</script>

<template>
    <img class="absolute top-0 left-0" :src="Triangle1" alt="Triangle 1" />
    <img class="fixed right-0 bottom-0" :src="Triangle2" alt="Triangle 2" />
</template>

<style lang="scss" scoped>
img {
    width: 50%;
    z-index: -1;
}
</style>

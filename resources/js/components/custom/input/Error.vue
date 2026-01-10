<script setup lang="ts">
    defineProps<{content: string}>()
</script>

<template>
    <span class="text-[0.675rem] text-red-600">{{ content }}</span>
</template>
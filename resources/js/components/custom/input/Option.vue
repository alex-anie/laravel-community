<script setup lang="ts">
    defineProps<{content: string}>()
</script>
<template>
    <em class="text-red-600">{{ content }}</em>
</template>
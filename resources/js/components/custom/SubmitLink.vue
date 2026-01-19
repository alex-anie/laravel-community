<script setup lang="ts">
    defineProps<{
        content: string
    }>()
</script>
<template>
    <a target="_blank" class="group mt-2 py-1 w-full flex justify-center bg-red-600 hover:bg-amber-500">
        <span class="text-white font-mono group-hover:text-black transition-colors duration-300 ease-in-out">{{ content }}</span>
    </a>
</template>
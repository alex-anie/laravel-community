<script setup lang="ts">
    defineProps<{
        content: string
    }>()
</script>

<template>
    <section class="mt-8 relative w-fit">
        <div class="size-2 bg-red-600 absolute top-0 left-1"></div>
        <h1 class="font-cal-sans text-xl md:text-2xl">{{ content }}</h1>
        <div class="size-2 bg-red-600 absolute bottom-0 right-1"></div>
    </section>
</template>
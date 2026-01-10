<script setup lang="ts">
    defineProps<{content: string}>()
</script>
<template>
    <label class="text-neutral-400 text-[0.675rem]">{{ content }} 
        <slot></slot>
    </label>
</template>
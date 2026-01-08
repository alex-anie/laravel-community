<script setup lang="ts">
    defineProps<{
        tooltip: string
    }>();
</script>
<template>
    <div class="group relative inline-block">
        <slot></slot>
        <span class="absolute bottom-full mb-1 hidden group-hover:block bg-red-600 px-[0.2rem] py-[0.1rem] text-[0.55rem] text-white">
       {{ tooltip }}
    </span>
    </div>
    
</template>
<script setup lang="ts">
    import { Link } from '@inertiajs/vue3';

    defineProps<{
        href: string,
        active: boolean
    }>();

</script>
<template>
    <Link 
        :href="href" 
        :class="[active ? 'text-red-600': 'text-neutral-950', 'font-mono hover:underline transition-color duration-75 ease-in']"
        >
        <slot></slot>
    </Link>
</template>       
<script setup lang="ts">
    defineProps<{
        modelValue?: string | null
    }>();

    const emit = defineEmits<{
        (e: 'update:modelValue', value: string | null) : void
    }>();

    const onChange = (e: Event)=> {
        const target = e.target as HTMLSelectElement
        emit('update:modelValue', target.value || null)
    }
</script>
<template>
    <select
        :value="modelValue"
        @change="onChange"
        v-bind="$attrs"
        class="w-full border border-neutral-300 bg-white
            px-3 py-2 text-sm text-neutral-800 font-mono
            focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-red-600
            hover:border-red-400 transition">
            <slot></slot>
    </select>
</template>
<script setup lang="ts">
    const props = defineProps<{
        modelValue : string | number
    }>();

    const emit = defineEmits<{
        (e: 'update:modelValue', value: string | number) : void
    }>();
    
</script>

<template>
    <input 
        :value="props.modelValue" 
        @input="emit('update:modelValue', ($event.target as HTMLInputElement).value)" 
        class="w-full border border-gray-400 p-2 placeholder:font-mono placeholder:text-neutral-500 font-mono text-red-600 focus-within:border-red-600 focus-within:border focus-within:outline-0 transition-colors duration-500 ease-in"
    />
</template>
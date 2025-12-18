<script setup lang="ts">
import { computed, type Component } from 'vue'
import { Link } from '@inertiajs/vue3'


interface Props {
  label: string
  icon?: Component
  href: string | (() => string)
  canShow?: boolean
}

const props = withDefaults(defineProps<Props>(), {
  canShow: true,
})


const resolvedHref = computed(() =>
  typeof props.href === 'function' ? props.href() : props.href
)
</script>

<template>
  <Link
    v-if="canShow"
    :href="resolvedHref"
    class="group relative inline-flex items-center justify-center gap-2 overflow-hidden rounded-full
           bg-neutral-950 px-6 py-2 text-white transition-colors duration-300"
  >
    <!-- animated background -->
    <span
      class="absolute inset-0 z-0 w-0 bg-white transition-all duration-300 ease-out group-hover:w-full"
    />

    <!-- text -->
    <span
      class="relative z-10 transition-colors duration-300 group-hover:text-neutral-950"
    >
      {{ label }}
    </span>

    <!-- icon (optional) -->
    <component
      v-if="icon"
      :is="icon"
      class="relative z-10 h-4 w-4 transition-all duration-300
            group-hover:translate-x-1 group-hover:text-neutral-950"
    />
  </Link>
</template>

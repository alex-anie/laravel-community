<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue';
import { Link } from '@inertiajs/vue3';
import { Search, Briefcase } from 'lucide-vue-next';

const phrases = [
    'Pounce on your next opportunity',
    'Search. Hunt. Apply.',
    'Latest Tech Jobs'
];

const currentText = ref('');
const showCursor = ref(true);
let phraseIndex = 0;
let charIndex = 0;
let isDeleting = false;
let typewriterTimeout: ReturnType<typeof setTimeout>;

const typeWriter = () => {
    const currentPhrase = phrases[phraseIndex];
    
    if (isDeleting) {
        // Deleting characters
        currentText.value = currentPhrase.substring(0, charIndex - 1);
        charIndex--;
        
        if (charIndex === 0) {
            isDeleting = false;
            phraseIndex = (phraseIndex + 1) % phrases.length;
            typewriterTimeout = setTimeout(typeWriter, 500); // Pause before typing next phrase
            return;
        }
        
        typewriterTimeout = setTimeout(typeWriter, 50); // Faster deletion
    } else {
        // Typing characters
        currentText.value = currentPhrase.substring(0, charIndex + 1);
        charIndex++;
        
        if (charIndex === currentPhrase.length) {
            isDeleting = true;
            typewriterTimeout = setTimeout(typeWriter, 2000); // Pause at end of phrase
            return;
        }
        
        typewriterTimeout = setTimeout(typeWriter, 100); // Typing speed
    }
};

onMounted(() => {
    typeWriter();
});

onUnmounted(() => {
    if (typewriterTimeout) {
        clearTimeout(typewriterTimeout);
    }
});
</script>

<template>
    <section class="bg-neutral-100 py-20 md:py-32">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <!-- Main Heading with Typewriter Effect -->
            <h1 class="text-4xl md:text-6xl font-bold font-cal-sans mb-6 min-h-[8rem] md:min-h-[12rem] flex items-center justify-center">
                <span class="text-neutral-900">
                    {{ currentText }}
                    <span 
                        class="inline-block w-1 h-12 md:h-16 bg-red-600 ml-2 animate-blink"
                        :class="{ 'opacity-0': !showCursor }"
                    ></span>
                </span>
            </h1>

            <!-- Subheading -->
            <p class="text-neutral-900 text-lg md:text-xl mb-8 max-w-2xl mx-auto">
                Connecting tech talent with opportunities. Browse thousands of tech jobs or post your opening for free.
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <Link 
                    href="/jobs" 
                    class="px-8 py-4 bg-red-600 text-white font-mono font-bold hover:bg-red-700 transition-colors duration-200 flex items-center justify-center gap-2"
                >
                    <Search class="size-5" />
                    Browse Jobs
                </Link>
                <Link 
                    href="/job/post-a-job" 
                    class="px-8 py-4 bg-white text-neutral-900 font-mono font-bold hover:bg-neutral-100 transition-colors duration-200 flex items-center justify-center gap-2"
                >
                    <Briefcase class="size-5" />
                    Post a Job
                </Link>
            </div>
        </div>

    </section>
</template>

<style scoped>
@keyframes blink {
    0%, 50% {
        opacity: 1;
    }
    51%, 100% {
        opacity: 0;
    }
}

.animate-blink {
    animation: blink 1s infinite;
}
</style>
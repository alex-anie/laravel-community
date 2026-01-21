<script setup lang="ts">
    import { ref } from 'vue';
    import { ChevronDownIcon } from 'lucide-vue-next';
import HeadingText from './HeadingText.vue';

    interface FAQ {
        question: string;
        answer: string;
    }

    const openIndex = ref<number | null>(null);

    const faqs: FAQ[] = [
        {
        question: 'What does JobPanther do?',
        answer: 'JobPanther is an online platform where you can find job listings for tech jobs. It lists out the latest tech jobs online for users to browse and apply to the ones they like.'
    },
    {
        question: 'Do I need to sign in to apply for jobs on JobPanther?',
        answer: 'No! All jobs are listed out and you are open to apply without creating an account.'
    },
    {
        question: 'How do I post jobs on JobPanther?',
        answer: 'You simply create an account and then you can post a job. The job will be available on the website for all users who browse the site to see and apply.'
    },
    {
        question: 'Do I need to pay to post a job?',
        answer: 'No! Posting jobs is completely free on JobPanther.'
    },
    {
        question: 'How do I use JobPanther?',
        answer: 'You can either use JobPanther to look for jobs by browsing the job listings and applying, or you can post a job for hire if you are an employer.'
    },
    {
        question: 'What else can I do with JobPanther?',
        answer: 'Well, you can also create an account as someone looking for a job and fill in your details. Job employers can browse through your profile to see if you are a great fit and then send you a message.'
    }
    ];

    const toggleAccordion = (index: number)=> {
        openIndex.value = openIndex.value === index ? null : index;
    }
</script>
<template>
    <section class="">
        <HeadingText content="Frequently Asked Question" />
        <p class=" text-neutral-500 mb-8">Everything you need to know about JobPanther</p>

        <div class="space-y-3">
            <div v-for="(faq, index) in faqs" :key="index" class="border border-neutral-300  overflow-hidden transition-all duration-200">
                <button 
                    @click="toggleAccordion(index)"
                    class="w-full px-6 py-4 flex items-center justify-between bg-white hover:bg-neutral-50 transition-colors duration-200"
                    :aria-expanded="openIndex === index"
                    :aria-controls="`faq-content-${index}`"
                    >
                    <span class="text-left font-semibold text-neutral-900 pr-4">{{ faq.question }}</span>
                    <ChevronDownIcon
                        :class="[
                            'size-5 text-red-600 transition-transform duration-300 flex-shrink-0', openIndex === index ? 'rotate-180' : ''
                        ]"
                    />
                </button>

                <Transition
                    enter-active-class="transition-all duration-300 ease-out"
                    enter-from-class="max-h-0 opacity-0"
                    enter-to-class="max-h-96 opacity-100"
                    leave-active-class="transition-all duration-300 ease-in"
                    leave-from-class="max-h-96 opacity-100"
                    leave-to-class="max-h-0 opacity-0"
                >
                    <div
                        v-show="openIndex === index"
                        :id="`faq-content-${index}`"
                        class="overflow-hidden"
                    >
                        <div class="px-6 py-4 bg-neutral-50 border-t border-neutral-200">
                            <p class="text-neutral-700 text-sm leading-relaxed">
                                {{ faq.answer }}
                            </p>
                        </div>
                    </div>
                </Transition>
            </div>
        </div>
    </section>
</template>
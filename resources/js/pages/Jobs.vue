<script setup lang="ts">
    import CarouselImg from '@/components/custom/CarouselImg.vue';
    import CenterContent from '@/components/custom/CenterContent.vue';
    import LanguageTag from '@/components/custom/LanguageTag.vue';
    import NavLayouts from '@/layouts/NavLayouts.vue';
    import { MyJobs } from '@/types';
    import { Link, router } from '@inertiajs/vue3';
    import { MapPin, Banknote, Calendar } from 'lucide-vue-next';
    import { ref, watch } from 'vue';

    const props = defineProps<{
        jobs: {
            data: Array<MyJobs>
            links: Array<{url: string | null; label: string; active: boolean}>
            filters?:{
                search?:string
            }
        },

        selectedJob: MyJobs | null
    }>();


    const search = ref(props.jobs.filters?.search || '');

    watch(search, (value)=>{
        router.get('', {search: value}, 
            {
                preserveState: true,
                replace: true,
            }
        )
    })

    function timeAgo(date: string){
        const now = new Date();
        const past = new Date(date);
        const diffInSeconds = Math.floor((now.getTime() - past.getTime()) / 1000);

        if(diffInSeconds < 60){
            return 'now';
        }

        const units: [Intl.RelativeTimeFormatUnit, number][] = [
            ['year', 60 * 60 * 24 * 365],
            ['month', 60 * 60 * 24 * 30],
            ['week', 60 * 60 * 24 * 7],
            ['day', 60 * 60 * 24],
            ['hour', 60 * 60],
            ['minute', 60],
        ];

        const rtf = new Intl.RelativeTimeFormat('en', {numeric: 'auto'});

        for(const [unit, seconds] of units){
            const value = Math.floor(diffInSeconds / seconds);
            if(value >= 1){
                return rtf.format(-value, unit);
            }
        }

        return 'now';
    }
</script>
<template>
    <NavLayouts>
        <CenterContent>
            <!-- Hero -->
            <section class=" flex flex-col items-center">
                <div>
                    <h1 class="text-4xl font-mono font-bold mt-8">The Best Laravel Job Listing</h1>
                </div>
                <div>
                    <p class="font-mono text-center mt-8">find top Laravel jobs from job listing. Weather you’re a
                        Senior, Junior, Entry Level Developer, Looking for remote, full-time,
                        part-time, contract or onsite. Job listing provide jobs posts for Laravel
                        developer of all levels. New jobs are added every few hours and you can stay
                        updated via our newsletters and social media.</p>
                </div>
            </section>

            <!-- Carousel -->
            <section class="mt-12">
                <div class="w-full">
                    <CarouselImg />
                </div>
            </section>

            <!-- All Jobs -->
            <section class="mt-8">
                <h1 class="font-mono text-xl md:text-2xl">All Jobs</h1>
            </section>

            <article>
                <section class="border border-neutral-200 p-2">
                    <aside class="flex gap-y-4">
                        <div class="w-[30rem]">
                            <Link v-for="job in props.jobs.data" :key="job.id" preserve-state replace href="" class="block border border-red-600 p-2">
                            <div class="relative flex gap-x-2">
                                <div class="size-15">
                                    <img class="size-full object-cover object-center" 
                                        :src="`/storage/${job.company_logo}`" 
                                        :alt="`${job.company_name} logo`">
                                </div>
                                <div>
                                    <h2 class="font-mono text-red-600 text-[12px]">{{ job.company_name }}</h2>
                                    <h1 class="font-mono font-bold">{{ job.job_title }}</h1>
                                    <div class="flex gap-x-2">
                                        <div class="absolute top-0 right-4 flex">
                                            <p class="">
                                                <Banknote class="w-3 inline-block text-neutral-500" />
                                                <span class="text-[10px] font-mono text-neutral-900">{{ new Intl.NumberFormat("en-US", {style: "currency", currency: "USD",}).format(job.min_currency_value) }}  - {{ new Intl.NumberFormat("en-US", {style: "currency", currency: "USD",}).format(job.max_currency_value) }} </span>
                                            </p>
                                        </div>

                                        <p>
                                            <MapPin class="w-3 inline-block text-neutral-500" />
                                            <span class="text-[12px] font-mono text-neutral-500"> {{ job.location }} | Munish, German |</span>
                                        </p>
                                        <p>
                                            <Calendar class="w-3 mr-1 inline-block text-neutral-500" />
                                            <span :title="new Date(job.created_at).toDateString()" class="text-[12px] text-neutral-500 font-mono">{{ timeAgo(job.created_at) }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex gap-x-2 mt-2">
                                <LanguageTag v-for="tag in job.language_tags" :key="tag">{{ tag }}</LanguageTag>
                            </div>
                        </Link>
                        </div>

                        <div class="flex-1 border border-red-600">
                            <main v-if="selectedJob" :job="selectedJob">
                                <p>This is a dynamic content</p>
                            </main>
                            <div v-else class="">
                                select a job to view details
                            </div>
                        </div>
                    </aside>
                </section>
            </article>
        </CenterContent>

        <!-- Create Button -->
            <div class="fixed bottom-12 right-10">
                <Link href="/job/post-a-job" class="group relative py-2 px-3 border font-mono bg-red-600 hover:bg-amber-600 transition-colors duration-300 ease-in-out">
                    <span class="font-mono text-white group-hover:text-black">Post a job</span>

                    <div class="absolute right-2 bottom-7">
                        <span class="relative flex size-3">
                            <span
                                class="absolute inline-flex h-full w-full animate-ping rounded-full bg-red-400 opacity-75"></span>
                            <span class="relative inline-flex size-3 rounded-full bg-red-400"></span>
                        </span>
                    </div>
                </Link>
            </div>
    </NavLayouts>
</template>
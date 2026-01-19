<script setup lang="ts">
    import CarouselImg from '@/components/custom/CarouselImg.vue';
    import CenterContent from '@/components/custom/CenterContent.vue';
    import FAQ from '@/components/custom/FAQ.vue';
    import LanguageTag from '@/components/custom/LanguageTag.vue';
    import SubmitLink from '@/components/custom/SubmitLink.vue';
    import NavLayouts from '@/layouts/NavLayouts.vue';
    import { MyJobs } from '@/types';
    import { Link, router } from '@inertiajs/vue3';
    import { MapPin, Banknote, Calendar, ExternalLinkIcon, Database } from 'lucide-vue-next';
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

    // Time and days format
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
            <section class="flex flex-col items-center">
                <div>
                    <h1 class="text-4xl font-mono font-bold mt-8">Latest Tech Jobs</h1>
                </div>
                <div>
                    <p class="font-mono text-center mt-4">Connecting tech talent with opportunities. Find your next career move or discover the perfect candidate.</p>
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
                        <!-- Left Panel - Job List -->
                        <div class="w-[30rem] max-h-screen overflow-y-auto">
                            <Link v-for="job in props.jobs.data" 
                                :key="job.id" 
                                preserve-state
                                preserve-scroll
                                replace 
                                :href="`/?job=${job.id}`" 
                                :class="[
                                    'block border p-2 transition-colors', 
                                    selectedJob?.id === job.id 
                                        ? 'border-red-600 bg-red-50'
                                        : 'border-neutral-300 hover:border-red-400'

                                ]">
                            <div class="relative flex gap-x-2">
                                <div class="size-15">
                                    <img class="size-full object-cover object-center" 
                                        :src="`/storage/${job.company_logo}`" 
                                        :alt="`${job.company_name} logo`">
                                </div>
                                <div class="flex-1">
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

                        <!-- Right Panel - Job List -->
                        <div class="flex-1 border border-red-600 sticky top-4 h-fit max-h-screen overflow-y-auto">
                            <main v-if="selectedJob" :job="selectedJob" class="">
                                <header class="bg-neutral-900 p-2">
                                    <div class="flex">
                                        <div class="size-18 bg-white p-1">
                                            <img class="w-full object-cover object-center" :src="`/storage/${selectedJob.company_logo}`" :alt="`${selectedJob.company_name} logo`">
                                        </div> 
                                        <div class="pl-1">
                                            <p class="font-mono text-neutral-100 text-sm">{{ selectedJob.company_name }}</p>
                                            <p class="font-mono font-bold my-1 text-red-600">{{ selectedJob.job_title }}</p>
                                            <div class="flex gap-x-2">
                                                <p class="text-sm font-mono text-neutral-100"> <MapPin class="size-4 inline-block text-neutral-100" />Berlin, German |</p>
                                                <a :href="selectedJob.company_url" target="_blank" class="font-mono text-sm text-neutral-100 hover:underline hover:text-red-300">Visit Company website <ExternalLinkIcon class="size-3 inline-block" /></a>
                                            </div>
                                        </div>
                    
                                    </div>
                                        <SubmitLink :href="selectedJob.application_url" content="Apply to this Job" />
                                </header>
                                <article class="">
                                    <aside class="my-4 px-4 prose prose-neutral max-w-none prose-headings:font-mono prose-p:font-mono prose-p:leading-relaxed whitespace-normal" v-html="selectedJob.content" />
                                    <div>
                                        <SubmitLink :href="selectedJob.application_url" content="Apply to this Job" />
                                    </div>
                                </article>
                            </main>
                            <div v-else class="flex item-center justify-center h-64 text-neutral-500">
                                <div class="flex justify-center flex-col items-center">
                                    <Database class="text-center" />
                                    <p class="text-center"> select a job to view details</p>
                                </div>
                            </div>
                        </div>
                    </aside>
                </section>

                <!-- Pagination -->
                    <div class="my-4">
                        <Link
                            v-for="link in props.jobs.links"
                            :key="link.label"
                            :link="link.label"
                            :href="link.url ?? ''"
                            v-html="link.label"
                            class="px-3 py-1 border"
                            :class="{
                                'bg-red-600 text-white' : link.active,
                                'text-neutral-500 cursor-not-allowed' : !link.url
                            }"
                        />
                    </div>
            </article>

            <!-- FAQs -->
            <article>
                <FAQ />
            </article>
        </CenterContent>

        <!-- Create Button -->
            <div class="fixed bottom-30 right-10">
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
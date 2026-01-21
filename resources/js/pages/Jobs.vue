<script setup lang="ts">
    import CenterContent from '@/components/custom/CenterContent.vue';
    import HeadingText from '@/components/custom/HeadingText.vue';
    import LanguageTag from '@/components/custom/LanguageTag.vue';
    import SubmitLink from '@/components/custom/SubmitLink.vue';
    import NavLayouts from '@/layouts/NavLayouts.vue';
    import { MyJobs } from '@/types';
    import { Link, router } from '@inertiajs/vue3';
    import { MapPin, Banknote, Calendar, ExternalLinkIcon, Database, Globe2Icon, Briefcase } from 'lucide-vue-next';
    import { ref, watch } from 'vue';
    import MyJobController from '@/actions/App/Http/Controllers/MyJobController';

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
        <header class="bg-neutral-800 h-59 w-full mt-20">
            <div class="h-full flex flex-col justify-center w-[80%] mx-auto">
                <h1 class="text-red-600 font-cal-sans text-3xl">The Best</h1>
                <h1 class="text-red-600 font-cal-sans text-3xl">Job board for Tech Jobs</h1>
                <p class="mt-3 text-neutral-200">Connecting tech talent with opportunities. Browse thousands of tech jobs or post your opening for free.</p>
            </div>
        </header>
        <CenterContent>

            <div class="mt-20 mb-8">
                <HeadingText content="All Jobs" />
            </div>

            <article>
                <section class="mb-8">
                    <aside class="flex gap-x-4">
                        <!-- Left Panel - Job List -->
                        <div class="flex-1">
                            <Link v-for="job in props.jobs.data" 
                                :key="job.id" 
                                preserve-state
                                preserve-scroll
                                :href="MyJobController.show(job.id)" 
                                class=" block border p-2 transition-colors border-neutral-300 hover:border-red-400">
                            <div class="relative flex gap-x-2">
                                <div class="size-10 border border-neutral-200">
                                    <img class="size-full object-contain object-center" 
                                        :src="`/storage/${job.company_logo}`" 
                                        :alt="`${job.company_name} logo`">
                                </div>
                                <div class="flex-1">
                                    <h2 class=" text-red-600 text-[12px] capitalize">{{ job.company_name }}</h2>
                                    <h1 class=" font-bold">{{ job.job_title }}</h1>
                                    <div class="flex gap-x-2">
                                        <div class="absolute top-0 right-4 flex">
                                            <p class="">
                                                <Banknote class="w-3 inline-block text-neutral-500" />
                                                <span class="text-[10px] text-neutral-900">{{ new Intl.NumberFormat("en-US", {style: "currency", currency: "USD",}).format(job.min_currency_value) }}  - {{ new Intl.NumberFormat("en-US", {style: "currency", currency: "USD",}).format(job.max_currency_value) }} </span>
                                            </p>
                                        </div>

                                        <p>
                                            <MapPin class="w-3 inline-block text-neutral-500" />
                                            <span class="text-[12px] text-neutral-500"> {{ job.location }} </span>
                                        </p>

                                        <p>
                                            <Briefcase class="w-3 inline-block text-neutral-500" />
                                            <span class="text-[12px] text-neutral-500"> Contract </span>
                                        </p>

                                        <p>
                                            <Globe2Icon class="w-3 inline-block text-neutral-500" />
                                            <span class="text-[12px] text-neutral-500"> Munish, German |</span>
                                        </p>
                                        
                                        <p>
                                            <Calendar class="w-3 mr-1 inline-block text-neutral-500" />
                                            <span :title="new Date(job.created_at).toDateString()" class="text-[12px] text-neutral-500">{{ timeAgo(job.created_at) }}</span>
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
                        <div class="w-[20rem] border border-red-600 sticky top-15 h-fit max-h-screen overflow-y-auto">
                            <main v-if="selectedJob" :job="selectedJob" class="">
                                <header class="bg-neutral-900 p-2">
                                    <div class="flex">
                                        <div class="size-18 bg-white p-1">
                                            <img class="w-full object-cover object-center" :src="`/storage/${selectedJob.company_logo}`" :alt="`${selectedJob.company_name} logo`">
                                        </div> 
                                        <div class="pl-1">
                                            <p class="text-neutral-100 text-sm">{{ selectedJob.company_name }}</p>
                                            <p class="font-bold my-1 text-red-600">{{ selectedJob.job_title }}</p>
                                            <div class="flex gap-x-2">
                                                <p class="text-sm text-neutral-100"> <MapPin class="size-4 inline-block text-neutral-100" />Berlin, German |</p>
                                                <a :href="selectedJob.company_url" target="_blank" class="text-sm text-neutral-100 hover:underline hover:text-red-300">Visit Company website <ExternalLinkIcon class="size-3 inline-block" /></a>
                                            </div>
                                        </div>
                    
                                    </div>
                                        <SubmitLink :href="selectedJob.application_url" content="Apply to this Job" />
                                </header>
                                <article class="">
                                    <aside class="my-4 px-4 prose prose-neutral max-w-none  prose-p:leading-relaxed whitespace-normal" v-html="selectedJob.content" />
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
        </CenterContent>

        <!-- Create Button -->
            <div class="fixed bottom-30 right-10">
                <Link href="/job/post-a-job" class="group relative py-2 px-3 border bg-red-600 hover:bg-amber-600 transition-colors duration-300 ease-in-out">
                    <span class="text-white group-hover:text-black">Post a job</span>

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
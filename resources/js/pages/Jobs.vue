<script setup lang="ts">
    import CarouselImg from '@/components/custom/CarouselImg.vue';
    import CenterContent from '@/components/custom/CenterContent.vue';
    import LanguageTag from '@/components/custom/LanguageTag.vue';
    import NavLayouts from '@/layouts/NavLayouts.vue';
    import { Link } from '@inertiajs/vue3';
    import { MapPin, Banknote, Calendar } from 'lucide-vue-next';
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
                    <aside class="grid grid-cols-4">
                        <Link href="" class="border border-red-600 col-span-2 p-2">
                            <div class="relative flex gap-x-2">
                                <div class="size-15">
                                    <img class="size-full object-cover object-center" src="/deadpool-sword.jpg" alt="">
                                </div>
                                <div>
                                    <h2 class="font-mono text-red-600 text-[12px]">Jet Brains</h2>
                                    <h1 class="font-mono font-bold">PHP Laravel Developer (French or German speaker)</h1>
                                    <div class="flex gap-x-2">
                                        <div class="absolute top-0 right-4 flex">
                                            <p class="">
                                                <Banknote class="w-3 inline-block text-neutral-500" />
                                                <span class="text-[10px] text-neutral-900">$30,000 - $50,000 USD</span>
                                            </p>
                                        </div>

                                        <p>
                                            <MapPin class="w-3 inline-block text-neutral-500" />
                                            <span class="text-[12px] text-neutral-500"> Remote / Munish, German</span>
                                        </p>
                                        <p>
                                            <Calendar class="w-3 inline-block text-neutral-500" />
                                            <span class="text-[12px] text-neutral-500"> 2 days ago</span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex gap-x-2 mt-2">
                                <LanguageTag>Laravel</LanguageTag>
                                <LanguageTag>PHP</LanguageTag>
                                <LanguageTag>MySQL</LanguageTag>
                                <LanguageTag>Vuejs</LanguageTag>
                                <LanguageTag>Fullstack</LanguageTag>
                                <LanguageTag>backend</LanguageTag>
                            </div>
                        </Link>

                        <div class="col-span-2">
                            Content
                        </div>
                    </aside>
                </section>
            </article>
        </CenterContent>


        <!-- Create Button -->
            <div class="absolute bottom-12 right-10">
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
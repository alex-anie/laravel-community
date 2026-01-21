<script setup lang="ts">
import CenterContent from '@/components/custom/CenterContent.vue';
import HeadingText from '@/components/custom/HeadingText.vue';
import NavLayouts from '@/layouts/NavLayouts.vue';
import { Link } from '@inertiajs/vue3';
import { 
    Briefcase, 
    Building2, 
    Users, 
    MessageSquare, 
    Check, 
    Heart, 
    Zap, 
    Target 
} from 'lucide-vue-next';
</script>

<template>
    <NavLayouts>
        <CenterContent>
    <div class="min-h-screen bg-white">
        <!-- Hero Section -->
        <section class="bg-neutral-900 text-white py-20">
            <div class="max-w-4xl mx-auto px-6 text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-red-600 mb-6">
                    About JobPanther
                </h1>
                <p class="text-lg text-neutral-300 leading-relaxed">
                    Connecting tech talent with opportunities since 2026
                </p>
            </div>
        </section>

        <!-- Main Content -->
        <section class="max-w-4xl mx-auto px-6 py-16">
            <!-- Mission Statement -->
            <div class="mb-16">
                <HeadingText content="Our Mission" />
                
                <p class="text-neutral-700 text-sm leading-relaxed mb-4">
                    JobPanther is an online platform dedicated to bridging the gap between talented tech professionals and innovative companies. We believe that finding the right job or the perfect candidate shouldn't be complicated or expensive.
                </p>
                <p class="text-neutral-700 text-sm leading-relaxed">
                    Our mission is to make tech recruitment accessible, transparent, and efficient for everyone – whether you're a job seeker looking for your next opportunity or an employer searching for exceptional talent.
                </p>
            </div>

            <!-- What We Do -->
            <div class="mb-16">
                <HeadingText content="What We Do" />
            
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="border border-neutral-300  p-6 hover:border-red-400 transition-colors duration-200">
                        <div class="size-12 bg-red-600  flex items-center justify-center mb-4">
                            <Briefcase class="size-6 text-white" />
                        </div>
                        <h3 class="text-xl font-bold text-neutral-900 mb-3">
                            For Job Seekers
                        </h3>
                        <p class="text-neutral-700 text-sm leading-relaxed">
                            Browse the latest tech job listings from companies around the world. Apply directly to positions that match your skills and career goals – no account required.
                        </p>
                    </div>

                    <div class="border border-neutral-300  p-6 hover:border-red-400 transition-colors duration-200">
                        <div class="size-12 bg-red-600  flex items-center justify-center mb-4">
                            <Building2 class="size-6 text-white" />
                        </div>
                        <h3 class="text-xl font-bold text-neutral-900 mb-3">
                            For Employers
                        </h3>
                        <p class="text-neutral-700 text-sm leading-relaxed">
                            Post job openings completely free and reach thousands of qualified tech professionals. Browse candidate profiles and connect directly with potential hires.
                        </p>
                    </div>

                    <div class="border border-neutral-300  p-6 hover:border-red-400 transition-colors duration-200">
                        <div class="size-12 bg-red-600  flex items-center justify-center mb-4">
                            <Users class="size-6 text-white" />
                        </div>
                        <h3 class="text-xl font-bold text-neutral-900 mb-3">
                            Profile Creation
                        </h3>
                        <p class="text-neutral-700 text-sm leading-relaxed">
                            Create a detailed professional profile showcasing your skills, experience, and portfolio. Let employers discover you and reach out directly.
                        </p>
                    </div>

                    <div class="border border-neutral-300  p-6 hover:border-red-400 transition-colors duration-200">
                        <div class="size-12 bg-red-600  flex items-center justify-center mb-4">
                            <MessageSquare class="size-6 text-white" />
                        </div>
                        <h3 class="text-xl font-bold text-neutral-900 mb-3">
                            Direct Communication
                        </h3>
                        <p class="text-neutral-700 text-sm leading-relaxed">
                            Connect directly with employers or candidates through our messaging system. Skip the middleman and start conversations that matter.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Why Choose Us -->
            <div class="mb-16">
                <HeadingText content="Why Choose JobPanther" />
                <div class="space-y-4">
                    <div class="flex items-start gap-4 p-4 bg-neutral-50 ">
                        <div class="size-8 bg-red-600 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <Check class="size-5 text-white" />
                        </div>
                        <div>
                            <h3 class="font-bold text-neutral-900 mb-2">
                                100% Free to Use
                            </h3>
                            <p class="text-neutral-700 text-sm leading-relaxed">
                                No hidden fees, no subscription plans. Post jobs and apply to positions completely free.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 p-4 bg-neutral-50 ">
                        <div class="size-8 bg-red-600 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <Check class="size-5 text-white" />
                        </div>
                        <div>
                            <h3 class="font-bold text-neutral-900 mb-2">
                                No Account Required to Browse
                            </h3>
                            <p class="text-neutral-700 text-sm leading-relaxed">
                                Browse all job listings and apply without creating an account. We respect your time.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 p-4 bg-neutral-50 ">
                        <div class="size-8 bg-red-600 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <Check class="size-5 text-white" />
                        </div>
                        <div>
                            <h3 class="font-bold text-neutral-900 mb-2">
                                Tech-Focused Platform
                            </h3>
                            <p class="text-neutral-700 text-sm leading-relaxed">
                                Specialized in technology roles, ensuring relevant listings for developers, designers, and tech professionals.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 p-4 bg-neutral-50 ">
                        <div class="size-8 bg-red-600 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <Check class="size-5 text-white" />
                        </div>
                        <div>
                            <h3 class="font-bold text-neutral-900 mb-2">
                                Simple and Transparent
                            </h3>
                            <p class="text-neutral-700 text-sm leading-relaxed">
                                No complicated processes or unnecessary steps. Just straightforward job matching.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Values Section -->
            <div class="mb-16">
                <HeadingText content="Our Values" />
                <div class="grid md:grid-cols-3 gap-6">
                    <div class="text-center">
                        <div class="size-16 bg-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <Heart class="size-8 text-white" />
                        </div>
                        <h3 class="text-lg font-bold text-neutral-900 mb-2">
                            Accessibility
                        </h3>
                        <p class="text-neutral-700 text-sm">
                            Job opportunities should be accessible to everyone, without barriers.
                        </p>
                    </div>

                    <div class="text-center">
                        <div class="size-16 bg-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <Zap class="size-8 text-white" />
                        </div>
                        <h3 class="text-lg font-bold text-neutral-900 mb-2">
                            Efficiency
                        </h3>
                        <p class="text-neutral-700 text-sm">
                            We streamline the hiring process to save time for both employers and candidates.
                        </p>
                    </div>

                    <div class="text-center">
                        <div class="size-16 bg-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <Target class="size-8 text-white" />
                        </div>
                        <h3 class="text-lg font-bold text-neutral-900 mb-2">
                            Transparency
                        </h3>
                        <p class="text-neutral-700 text-sm">
                            Clear communication and honest interactions between all parties.
                        </p>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="bg-neutral-900  p-8 md:p-12 text-center">
                <h2 class="text-3xl font-bold text-red-600 mb-4">
                    Ready to Get Started?
                </h2>
                <p class="text-neutral-300 text-sm mb-8 max-w-2xl mx-auto">
                    Whether you're looking for your next opportunity or searching for the perfect candidate, JobPanther is here to help.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <Link 
                        href="/jobs" 
                        class="px-8 py-3 bg-red-600 text-white font-bold  hover:bg-red-700 transition-colors duration-200"
                    >
                        Browse Jobs
                    </Link>
                    <Link 
                        href="/job/post-a-job" 
                        class="px-8 py-3 bg-white text-neutral-900 font-bold  hover:bg-neutral-100 transition-colors duration-200"
                    >
                        Post a Job
                    </Link>
                </div>
            </div>
        </section>
    </div>
    </CenterContent>
    </NavLayouts>
</template>


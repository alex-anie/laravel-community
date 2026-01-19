<script setup lang="ts">
    import LinkedIn from '@/components/custom/svgs/LinkedIn.vue';
    import X from '@/components/custom/svgs/X.vue';
    import { Link } from '@inertiajs/vue3';
    import {  Mail } from 'lucide-vue-next';
</script>

<template>
    <footer class="bg-neutral-900 text-neutral-100 mt-8">
        <div class="max-w-7xl mx-auto px-6 py-12">
            <!-- Main Footer Content -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <!-- Brand Section -->
                <div class="md:col-span-2">
                    <h3 class="text-2xl font-bold font-mono text-red-600 mb-4">
                        JobMatch
                    </h3>
                    <p class="text-neutral-400 font-mono text-sm leading-relaxed mb-6">
                        Connecting tech talent with opportunities. 
                        Find your next career move or discover the perfect candidate.
                    </p>
                    
                    <!-- Social Media Links -->
                    <div class="flex items-center gap-4">
                        <a 
                            href="https://x.com/jobmatch" 
                            target="_blank"
                            rel="noopener noreferrer"
                            class="p-2 bg-neutral-800 rounded-lg hover:bg-red-600 transition-colors duration-200"
                            aria-label="Follow us on X (Twitter)"
                        >
                            <X class="size-5" />
                        </a>
                        <a 
                            href="https://linkedin.com/company/jobmatch" 
                            target="_blank"
                            rel="noopener noreferrer"
                            class="p-2 bg-neutral-800 rounded-lg hover:bg-red-600 transition-colors duration-200"
                            aria-label="Follow us on LinkedIn"
                        >
                            <LinkedIn class="size-5" />
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-semibold font-mono mb-4">
                        Quick Links
                    </h4>
                    <ul class="space-y-2">
                        <li>
                            <Link 
                                href="/terms" 
                                class="text-neutral-400 hover:text-red-600 transition-colors duration-200 font-mono text-sm"
                            >
                                Terms of Service
                            </Link>
                        </li>
                        <li>
                            <Link 
                                href="/privacy-policy" 
                                class="text-neutral-400 hover:text-red-600 transition-colors duration-200 font-mono text-sm"
                            >
                                Privacy Policy
                            </Link>
                        </li>
                        <li>
                            <Link 
                                href="/about-us" 
                                class="text-neutral-400 hover:text-red-600 transition-colors duration-200 font-mono text-sm"
                            >
                                About Us
                            </Link>
                        </li>
                    </ul>
                </div>

                <!-- Contact Section -->
                <div>
                    <h4 class="text-lg font-semibold font-mono mb-4">
                        Get In Touch
                    </h4>
                    <p class="text-neutral-400 font-mono text-sm mb-4">
                        Have questions? We'd love to hear from you.
                    </p>
                    <a 
                        href="mailto:hello@jobmatch.com" 
                        class="text-red-600 hover:text-red-500 transition-colors duration-200 font-mono text-sm flex items-center gap-2"
                    >
                        <Mail class="size-4" />
                        hello@jobmatch.com
                    </a>
                </div>
            </div>

            <!-- Divider -->
            <div class="border-t border-neutral-800 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <!-- Copyright and Legal Links -->
                    <div class="flex flex-col md:flex-row items-center gap-2 md:gap-1 text-neutral-500 font-mono text-sm">
                        <div class="flex items-center gap-2">
                            <Link 
                                href="/terms" 
                                class="hover:text-red-600 transition-colors duration-200"
                            >
                                Terms of Service
                            </Link>
                            <span class="hidden md:inline">•</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <Link 
                                href="/privacy-policy" 
                                class="hover:text-red-600 transition-colors duration-200"
                            >
                                Privacy Policy
                            </Link>
                            <span class="hidden md:inline">|</span>
                        </div>
                        <span>2026 © JobMatch. All rights reserved.</span>
                    </div>

                    <!-- Created By -->
                    <a 
                        href="https://x.com/alexanie_" 
                        target="_blank"
                        rel="noopener noreferrer"
                        class="flex items-center gap-2 text-neutral-500 hover:text-red-600 transition-colors duration-200 group"
                    >
                        <span class="font-mono text-sm">Created by</span>
                        <div class="flex items-center gap-2">
                            <div class="size-6 bg-red-600 rounded-full flex items-center justify-center group-hover:bg-red-500 transition-colors duration-200">
                                <!-- <Code class="size-4 text-white" /> -->
                                <img class="size-full object-center object-cover rounded-full" src="/images/local/alexanie.jpg" />
                            </div>
                            <span class="font-mono text-sm font-semibold">alexanie</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </footer>
</template>

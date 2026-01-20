<script setup lang="ts">
import { dashboard, login, register } from '@/routes';
import { Head, Link } from '@inertiajs/vue3';
import NavLink from './NavLink.vue';

withDefaults(
    defineProps<{
        canRegister?: boolean;
    }>(),
    {
        canRegister: true,
    },
);

</script>

<template>
    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <section class="bg-white/45 backdrop-blur-3xl border shadow-lg fixed w-full top-0 z-20">
    <nav
        class="w-[95%] mx-auto"
    >

        <header
            class="flex justify-between h-12 items-center"
        >
            
            <!-- Logo -->
            <div>
                <Link href="/">
                    <div class="w-35">
                        <img class="size-full" src="/images/logos/jobpantherlogo.svg" alt="jobpanther svg Logo">
                    </div>
                </Link>
            </div>

            <!-- Navlinks -->
            <div>
                <ul class="flex gap-x-6">
                    <li>
                        <NavLink href="/" :active="$page.url === '/'">Jobs</NavLink>
                    </li>
                    <li>
                        <NavLink href="/hire-talents" :active="$page.url === '/hire-talents'">Hire Talents</NavLink>
                    </li>
                    <li>
                        <NavLink href="/about-us" :active="$page.url === '/open-source'">About Us</NavLink>
                    </li>
                </ul>
            </div>

            <!-- Auth -->
            <div class="">

                <Link
                    v-if="$page.props.auth.user"
                    :href="dashboard()"
                    class=""
                >
                    Dashboard
                </Link>
                <template v-else>
                    <Link
                        :href="login()"
                        class=" bg-red-600 py-2 px-3 text-white hover:text-black hover:bg-yellow-600 transition-colors duration-300 ease-in-out"
                    >
                        Log in
                    </Link>

                    
                    <Link
                        v-if="canRegister"
                        :href="register()"
                        class=" bg-red-600 py-2 px-3 text-white hover:text-black hover:bg-yellow-600 transition-colors duration-300 ease-in-out"
                    >Register</Link>

                </template>
            </div>
        </header>
    </nav>
    </section>
</template>

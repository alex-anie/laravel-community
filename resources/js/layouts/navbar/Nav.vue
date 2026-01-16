<script setup lang="ts">
import { dashboard, login, register } from '@/routes';
import { Head, Link } from '@inertiajs/vue3';
import logo from '../../../../public/laravel_community_logo.svg'
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
    <section class="bg-white border shadow-lg">
    <nav
        class="w-[95%] mx-auto"
    >

        <header
            class="flex justify-between h-18 items-center"
        >
            
            <!-- Logo -->
            <div>
                <Link href="/">
                    <div class="w-80">
                        <img class="size-full" :src="logo" alt="Laravel Community Logo">
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
                        <NavLink href="/internship" :active="$page.url === '/internship'">Internship</NavLink>
                    </li>
                    <li>
                        <NavLink href="/open-source" :active="$page.url === '/open-source'">Open Source</NavLink>
                    </li>
                    <li>
                        <NavLink href="/freelancer" :active="$page.url === '/freelancer'">Freelancer</NavLink>
                    </li>
                </ul>
            </div>

            <!-- Auth -->
            <div class="">

                <Link
                    v-if="$page.props.auth.user"
                    :href="dashboard()"
                    class="font-mono"
                >
                    Dashboard
                </Link>
                <template v-else>
                    <Link
                        :href="login()"
                        class="font-mono bg-red-600 py-2 px-3 text-white hover:text-black hover:bg-yellow-600 transition-colors duration-300 ease-in-out"
                    >
                        Log in
                    </Link>

                    
                    <Link
                        v-if="canRegister"
                        :href="register()"
                        class="font-mono bg-red-600 py-2 px-3 text-white hover:text-black hover:bg-yellow-600 transition-colors duration-300 ease-in-out"
                    >Register</Link>

                </template>
            </div>
        </header>
    </nav>
    </section>
</template>

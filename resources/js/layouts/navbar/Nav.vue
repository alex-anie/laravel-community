<script setup lang="ts">
import { dashboard, login, register } from '@/routes';
import { Head, Link } from '@inertiajs/vue3';
import logo from '../../../../public/foodvendorplug_logo_with_name.svg'

withDefaults(
    defineProps<{
        canRegister: boolean;
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
    <nav
        class=""
    >
        <header
            class="flex justify-between"
        >
            <!-- Logo -->
            <div>
                <div class="">
                    <img class="size-full" :src="logo" alt="">
                </div>
            </div>

            <!-- NavLinks -->
            <div class="">

                <Link
                    v-if="$page.props.auth.user"
                    :href="dashboard()"
                    class=" "
                >
                    Dashboard
                </Link>
                <template v-else>
                    <Link
                        :href="login()"
                        class=""
                    >
                        Log in
                    </Link>
                    <Link
                        v-if="canRegister"
                        :href="register()"
                        class=""
                    >
                        Register
                    </Link>
                </template>
            </div>
        </header>
    </nav>
</template>

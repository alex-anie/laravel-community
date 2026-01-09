<script setup lang="ts">
import CenterContent from '@/components/custom/CenterContent.vue';
import MyEditor from '@/components/custom/MyEditor.vue';
import NavLayouts from '@/layouts/NavLayouts.vue';

import { useForm } from '@inertiajs/vue3';

const props = defineProps<>()

const form = useForm<{
    title: null,
    content: null
}>({
    title: null,
    content: null
});

function submitForm(){
    
}

</script>
<template>
    <NavLayouts>
        <CenterContent>
            <header>
                <h1 class="font-mono text-2xl font-bold">Post a Job</h1>
            </header>

            <article>
                <section>
                    <aside>
                        <form @submit.prevent="submitForm" class="space-y-8">
                            <input type="text" class="w-full border border-gray-400 p-2" v-model="form.title" />
                            
                            <MyEditor v-model="form.content" />
                        </form>
                    </aside>
                </section>
            </article>
        </CenterContent>
    </NavLayouts>
</template>

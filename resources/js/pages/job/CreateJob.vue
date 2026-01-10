<script setup lang="ts">
import CenterContent from '@/components/custom/CenterContent.vue';
import Error from '@/components/custom/input/Error.vue';
import InputTag from '@/components/custom/input/InputTag.vue';
import Label from '@/components/custom/input/Label.vue';
import Option from '@/components/custom/input/Option.vue';
import MyEditor from '@/components/custom/MyEditor.vue';
import NavLayouts from '@/layouts/NavLayouts.vue';

import { useForm } from '@inertiajs/vue3';

const form = useForm<{
    title: string,
    content: string
}>({
    title: '',
    content: "<h1>Heading here</h1><p>I'm running Tiptap with Vue.js. 🎉</p>"
});

function submitForm(){
    form.post('/', {
        preserveScroll: true,
        onSuccess: ()=> {
            alert('Form submission success!');
        }
    })
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
                            <div class="">
                                <Label for="jobTitle" content="Example: 'Senior Laravel Developer', 'Software Engineer'">
                                    <Option content="(required)" />
                                </Label>
                                <InputTag id="jobTitle" type="text" placeholder="Job Title" v-model="form.title"/>
                                <Error content="" />
                            </div>
                            
                            <MyEditor v-model="form.content" />

                            <div class="">
                                <Label class="sr-only" for="companyName" content="company name'"></Label>
                                <InputTag id="companyName" type="text" placeholder="Company Name" v-model="form.title"/>
                                <Error content="" />
                            </div>

                            <div>
                                <button type="submit" class="font-mono bg-red-600 py-2 px-3 text-white hover:text-black hover:bg-yellow-600 transition-colors duration-300 ease-in-out">Post A Job</button>
                            </div>
                        </form>
                    </aside>
                </section>
            </article>
        </CenterContent>
    </NavLayouts>
</template>

<script setup lang="ts">
import CenterContent from '@/components/custom/CenterContent.vue';
import Error from '@/components/custom/input/Error.vue';
import InputTag from '@/components/custom/input/InputTag.vue';
import Label from '@/components/custom/input/Label.vue';
import Option from '@/components/custom/input/Option.vue';
import MyEditor from '@/components/custom/MyEditor.vue';
import { useForm } from '@inertiajs/vue3';
import { ImageUp } from 'lucide-vue-next';
import NavLayouts from '@/layouts/NavLayouts.vue';
import { ref } from 'vue';
import SelectTag from '@/components/custom/input/SelectTag.vue';
import OptionTag from '@/components/custom/input/OptionTag.vue';


// props

// Variables
const open = ref(false);
const fileName = ref<string | null>(null);
const selected = ref<string[]>([]);

const minCurrencyValue = ref<number>(0);
const maxCurrencyValue = ref<number>(0);
const currencySymbol = ref<string | null>(null);

// FUNCTIONS 
/* return the file name of an upload image*/
const handleFileName = (e: Event): void =>{
    const target = e.target as HTMLInputElement
    fileName.value = target.files?.[0]?.name ?? null
}

// arrays
const tags = [
    'Laravel',
    'PHP',
    'MySQL',
    'REST APIs',
    'Vue.js',
    'Inertia.js',
    'Livewire',
    'React',
    'Tailwind CSS',
    'Git',
    'Docker',
    'Linux',
]

const toggleTag = (tag: string)=> {
    if(selected.value.includes(tag)){
        selected.value = selected.value.filter( t => t !== tag)
    } else if (selected.value.length < 5){
        selected.value.push(tag)
    }
}

const isDisabled = (tag: string)=> {
    return selected.value.length >= 5 && !selected.value.includes(tag)
}

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
                        <form @submit.prevent="submitForm" class="space-y-8" enctype="multipart/form-data">
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

                            <div class="">
                                <Label for="companyUrl" content="Please use https:// or http:// in the beginning of the URL, for example: https://yourcompany.com">
                                    <Option content="(required)" />
                                </Label>
                                <InputTag id="companyUrl" type="text" placeholder="Company Url" v-model="form.title"/>
                                <Error content="" />
                            </div>

                            <div class="">
                                <Label for="applicationUrl" content="Add application url, eg. https://yourcompany.com/careers">
                                    <Option content="(required)" />
                                </Label>
                                <InputTag id="applicationUrl" type="text" placeholder="Application Url" v-model="form.title"/>
                                <Error content="" />
                            </div>

                            <div>
                                <label  class="flex gap-x-3 justify-center w-full py-2 cursor-pointer border-2 border-red-600 border-dotted" for="companyLogo">
                                    <ImageUp class="text-red-600"/> <span class="font-mono">{{ fileName  ? fileName : 'Add a Company Logo' }}</span>
                                </label>
                                <input @change="handleFileName" type="file" id="companyLogo" name="company_logo" class="hidden" accept=".png,.jpg">
                            </div>

                            <div class="">
                                <Label for="location" content="We recommend Remote. If you restrict your job to a location, you will get 10x-20x less applicants">
                                    <Option content="(required)" />
                                </Label>
                                <InputTag id="location" type="text" placeholder="Job Location" v-model="form.title"/>
                                <Error content="" />
                            </div>

                            <div class="">
                                <Label content="Examples: $120,000 – $145,000 USD, €80,000 — €102,000">
                                    <Option content="(required)" />
                                </Label>

                                <div class="flex gap-x-3">
                                    <InputTag v-model.number="minCurrencyValue" type="number" name="min_salary" placeholder="10000" min="10000" max="500000" />
                                    <InputTag v-model.number="maxCurrencyValue" type="number" name="max_salary" placeholder="50000" min="10000" max="500000" />

                                    <SelectTag v-model="currencySymbol" name="currency" id="">
                                        <OptionTag value="" content="Select Country Currency" />
                                        <OptionTag value="$" content="United States Dollar (USD): $" />
                                        <OptionTag value="€" content="Euro (EUR): €" />
                                        <OptionTag value="£" content="British Pound Sterling (GBP): £" />
                                        <OptionTag value="¥" content="Japanese Yen (JPY): ¥" />
                                        <OptionTag value="¥" content="Chinese Yuan (CNY): ¥" />
                                        <OptionTag value="元" content="Chinese renminbi (RMB): 元" />
                                        <OptionTag value="₹" content="Indian Rupee (INR): ₹" />
                                        <OptionTag value="₽" content="Russian Ruble (RUB): ₽" />
                                        <OptionTag value="₩" content="Korean Won (KRW): ₩" />
                                        <OptionTag value="₱" content="Philippine Peso (PHP): ₱" />
                                        <OptionTag value="₺" content="Turkish Lira (TRY): ₺" />
                                        <OptionTag value="₦" content="Nigerian Naira (NGN): ₦" />
                                    </SelectTag>
                                </div>
                                <p class="font-mono text-sm">preview: {{ currencySymbol ?? '' }} {{ minCurrencyValue }} - {{ maxCurrencyValue }}</p>

                                <Error content="" />
                            </div>

                            <div class="w-full max-w-md space-y-2">
                                <label class="block text-sm font-mono" for="">Tech Stack (Select up to 5) {{ selected.length }} / 5 selected</label>
                                <!-- select box -->
                                <div class="border p-2 cursor-pointer flex flex-wrap gap-2" @click="open = !open">
                                    <span v-if="selected.length === 0" class="text-neutral-500 text-sm font-mono">
                                        Click to select tags
                                    </span>

                                    <span v-for="tag in selected" :key="tag" class="bg-red-100 text-red-700 px-2 py-1 text-sm">
                                        {{ tag }}
                                    </span>
                                </div>

                                <!-- Dropdown -->
                                <div v-if="open" class="border mt-1 p-2 max-h-48 overflow-y-auto">
                                    <label v-for="tag in tags" :key="tag" class="flex items-center gap-2 cursor-pointer py-1">
                                        <input 
                                            type="checkbox" 
                                            :value="tag" 
                                            :checked="selected.includes(tag)"
                                            :disabled="isDisabled(tag)"
                                            @change="toggleTag(tag)"
                                            
                                            >
                                        <span :class="isDisabled(tag) ? 'test-gray-400' : ''">{{ tag }}</span>
                                    </label>
                                </div>

                                <!-- Hidden input for Laravel -->
                                <input type="hidden" name="tags" :value="selected.join(',')">
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

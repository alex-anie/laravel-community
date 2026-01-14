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

// props


// Variables
const open = ref(false);
// const fileName = ref<string | null>(null);
const selected = ref<string[]>([]);

const minCurrencyValue = ref<number>(0);
const maxCurrencyValue = ref<number>(0);

const form = useForm<{
    job_title: string,
    content: string,
    company_url: string,
    company_name: string,
    application_url: string,
    company_logo: File | null,
    location: string,
    min_currency_value: number,
    max_currency_value: number,
    language_tags: string[]
}>({
    job_title: '',
    content: "<h2>Job Description</h2><p>Write your job description here...</p>",
    company_url: '',
    company_name: '',
    application_url: '',
    company_logo: null as File | null,
    location: '',
    min_currency_value: 0,
    max_currency_value: 0,
    language_tags: []
});


// FUNCTIONS 
/* return the file name of an upload image*/
const handleFile = (event: Event): void =>{
    const files = (event.target as HTMLInputElement).files;
    if(files && files[0]){
        form.company_logo = files[0]
    }
}

// arrays
const tags = [
    'Laravel',
    'PHP',
    'Symfony',
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
    'Node.js',
    'Express.js',
    'NestJS',
    'Python',
    'Django',
    'FastAPI',
    'Flask',
    'Java',
    'Spring Boot',
    'C#',
    'ASP.NET Core',
    'ASP.NET MVC',
    'Go',
    'Gin',
    'Fiber',
    'Ruby',
    'Ruby on Rails',
    'Rust',
    'Actix Web'
]

const toggleTag = (tag: string)=> {
    if(selected.value.includes(tag)){
        selected.value = selected.value.filter( t => t !== tag)
    } else if (selected.value.length < 5){
        selected.value.push(tag)
    }

    form.language_tags = [...selected.value]
}

const isDisabled = (tag: string)=> {
    return selected.value.length >= 5 && !selected.value.includes(tag)
}


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
                                <InputTag name="job_title" id="jobTitle" type="text" placeholder="Job Title" v-model="form.job_title"/>
                                <Error v-if="form.errors.job_title" :content="`${form.errors.job_title}`" />
                            </div>
                            
                            <MyEditor v-model="form.content" />
                            <Error v-if="form.errors.content" :content="`${form.errors.content}`" />

                            <div class="">
                                <Label class="sr-only" for="companyName" content="company name'"></Label>
                                <InputTag id="companyName" type="text" placeholder="Company Name" v-model="form.company_name"/>
                                <Error v-if="form.errors.company_name" :content="`${form.errors.company_name }`" />
                            </div>

                            <div class="">
                                <Label for="companyUrl" content="Please use https:// or http:// in the beginning of the URL, for example: https://yourcompany.com">
                                    <Option content="(required)" />
                                </Label>
                                <InputTag id="companyUrl" type="text" placeholder="Company Url" v-model="form.company_url"/>
                                <Error v-if="form.errors.company_url" :content="`${form.errors.company_url}`" />
                            </div>

                            <div class="">
                                <Label for="applicationUrl" content="Add application url, eg. https://yourcompany.com/careers">
                                    <Option content="(required)" />
                                </Label>
                                <InputTag id="applicationUrl" type="text" placeholder="Application Url" v-model="form.application_url"/>
                                <Error v-if="form.errors.application_url" :content="`${form.errors.application_url}`" />
                            </div>

                            <div>
                                <label class="flex gap-x-3 justify-center w-full py-2 cursor-pointer border-2 border-red-600 border-dotted" for="companyLogo">
                                    <ImageUp class="text-red-600"/> <span class="font-mono">{{ form.company_logo  ? form.company_logo.name : 'Add a Company Logo' }}</span>
                                </label>
                                <input @change="handleFile" type="file" id="companyLogo" name="company_logo" class="hidden" accept=".png,.jpg">
                                <Error v-if="form.errors.company_logo" :content="`${form.errors.company_logo}`" />
                            </div>

                            <div class="">
                                <Label for="location" content="We recommend Remote. If you restrict your job to a location, you will get 10x-20x less applicants">
                                    <Option content="(required)" />
                                </Label>
                                <InputTag id="location" type="text" placeholder="Job Location" v-model="form.location"/>
                                <Error v-if="form.errors.location" :content="`${form.errors.location}`" />
                            </div>

                            <div class="">
                                <Label content="Examples: $120,000 – $145,000 USD">
                                    <Option content="(required)" />
                                </Label>

                                <div class="w-full flex justify-between gap-x-3">
                                    <span class="w-full">
                                        <InputTag v-model.number="form.min_currency_value" type="number" name="min_salary" :placeholder="`$${new Intl.NumberFormat().format('10000')}`" min="10000" max="500000" />
                                        <Error v-if="form.errors.min_currency_value" :content="`${form.errors.min_currency_value}`" class="" />
                                    </span>
                                    <span class="w-full">
                                        <InputTag v-model.number="form.max_currency_value" type="number" name="max_salary" :placeholder="`$${new Intl.NumberFormat().format('50000')}`" min="10000" max="500000" />
                                        <Error v-if="form.errors.max_currency_value" :content="`${form.errors.max_currency_value}`" class=""/>
                                    </span>
                                </div>
                                <p class="font-mono text-sm text-neutral-400">preview: {{ new Intl.NumberFormat("en-US", {style: "currency", currency: "USD",}).format(minCurrencyValue) }} - {{  new Intl.NumberFormat("en-US", {style: "currency", currency: "USD",}).format(maxCurrencyValue)  }}</p>

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
                                <input type="hidden" name="language_tags" :value="selected.join(',')">
                                <Error v-if="form.errors.language_tags" :content="`${form.errors.language_tags}`" />
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

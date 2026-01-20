<script setup lang="ts">
    import CenterContent from '@/components/custom/CenterContent.vue';
    import Error from '@/components/custom/input/Error.vue';
    import InputTag from '@/components/custom/input/InputTag.vue';
    import Label from '@/components/custom/input/Label.vue';
    import Option from '@/components/custom/input/Option.vue';
    import MyEditor from '@/components/custom/MyEditor.vue';
    import { useForm, Link } from '@inertiajs/vue3';
    import { ImageUp, MoveLeft } from 'lucide-vue-next';
    import NavLayouts from '@/layouts/NavLayouts.vue';
    import { ref } from 'vue';
    import SelectTag from '@/components/custom/input/SelectTag.vue';
    import OptionTag from '@/components/custom/input/OptionTag.vue';
    import MyJobController from '@/actions/App/Http/Controllers/MyJobController';

// props


// Variables
const open = ref(false);
// const fileName = ref<string | null>(null);
const selected = ref<string[]>([]);

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
    form.submit(MyJobController.store(),{
        preserveScroll: true,
        preserveState: true,
        onSuccess: ()=> {
            alert('Form submission success!');
        }
    } )
}

</script>
<template>
    <NavLayouts>
        <CenterContent>
            <div class="my-2">
                <Link class="flex gap-x-1 text-neutral-600 hover:text-neutral-800" :href="MyJobController.index()"> <MoveLeft /> <span>Back to Jobs</span></Link>
            </div>

            <header>
                <h1 class="font-mono text-2xl font-bold">Post a Job</h1>
            </header>

            <article>
                <section>
                    <aside>
                        <form @submit.prevent="submitForm" @keydown.enter.prevent class="space-y-8" enctype="multipart/form-data">
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
                                <input @change="handleFile" type="file" id="companyLogo" name="company_logo" class="hidden" accept=".png,.jpg,.jpeg">
                                <Error v-if="form.errors.company_logo" :content="`${form.errors.company_logo}`" />
                            </div>

                            <div class="">
                                <Label for="location" content="We recommend Remote. If you restrict your job to a location, you will get 10x-20x less applicants">
                                    <Option content="(required)" />
                                </Label>
                                <SelectTag name="location" id="location" v-model="form.location">
                                    <OptionTag value="" content="Select Location" />
                                    <OptionTag value="Remote" content="Remote" />
                                    <OptionTag value="FullTime" content="Full Time" />
                                    <OptionTag value="PartTime" content="Part Time" />
                                    <OptionTag value="Contract" content="Contract" />
                                    <OptionTag value="Internship" content="Internship" />
                                    <OptionTag value="Freelance" content="Freelance" />
                                    <OptionTag value="OnSite" content="OnSite" />
                                    <OptionTag value="Hybrid" content="Hybrid" />
                                </SelectTag>
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
                                <p class="font-mono text-sm text-neutral-400">preview: {{ new Intl.NumberFormat("en-US", {style: "currency", currency: "USD",}).format(form.min_currency_value) }} - {{  new Intl.NumberFormat("en-US", {style: "currency", currency: "USD",}).format(form.max_currency_value)  }}</p>

                            </div>

                            <div class="w-full max-w-md space-y-2">
                                <label class="block text-sm" for="">Tech Stack (Select up to 5) {{ selected.length }} / 5 selected</label>
                                <!-- select box -->
                                <div class="border p-2 cursor-pointer flex flex-wrap gap-2" @click="open = !open">
                                    <span v-if="selected.length === 0" class="text-neutral-500 text-sm">
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
                                <button 
                                    type="submit"
                                    :disabled="form.processing"
                                    class="font-mono bg-red-600 py-2 px-3 text-white hover:text-black hover:bg-yellow-600 transition-colors duration-300 ease-in-out">
                                    <svg v-if="form.processing" aria-hidden="true" class="inline-block w-4 h-4 me-2 text-neutral-100 animate-spin fill-red-900" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/><path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/></svg>
                                    <span>{{ form.processing ? 'Creating Job...' : 'Post A Job' }}</span>
                                </button>

                            </div>
                        </form>
                    </aside>
                </section>
            </article>
        </CenterContent>
    </NavLayouts>
</template>

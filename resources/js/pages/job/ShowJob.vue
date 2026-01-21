<script setup lang="ts">
import CenterContent from '@/components/custom/CenterContent.vue';
import SubmitLink from '@/components/custom/SubmitLink.vue';
import NavLayouts from '@/layouts/NavLayouts.vue';
import { MyJobs } from '@/types';
import { BanknoteIcon, Briefcase, Calendar, Globe2Icon, MapPin } from 'lucide-vue-next';
      
      defineProps<{
         job: MyJobs
      }>();

</script>
<template>
   <NavLayouts>
      <CenterContent>
         <main class="mt-20">
         <header class="w-[80%] border-b border-b-neutral-500 pb-4">
            <a :href="job.company_url">
               <div class="flex items-center gap-x-4">
                     <div class="size-20 border border-neutral-500 p-1">
                        <img class="size-full object-contain object-center" :src="`/storage/${job.company_logo}`" :alt="`${job.company_name} Logo`">
                     </div>
                     <p class="font-bold text-xl">{{ job.company_name }} <span class="font-extralight text-sm italic text-red-600"> is hiring</span></p>
               </div>

            </a>
               <div>
                  <p class="font-cal-sans text-3xl mt-8">{{ job.job_title }}</p>
               </div>

               <div class="flex gap-2 my-4">
                  <p class="text-sm bg-neutral-300 py-1 px-2 w-fit"> <Briefcase class="size-4 inline-block text-neutral-500"/> Contract</p>
                  <p class="text-sm bg-neutral-300 py-1 px-2 w-fit"> <MapPin class="size-4 inline-block text-neutral-500" /> {{ job.location }}</p>
                  <p class="text-sm bg-neutral-300 py-1 px-2 w-fit"><Globe2Icon class="size-4 inline-block text-neutral-500" /> Munish, German</p>
                  <p> <Calendar class="size-4 inline-block text-neutral-500"  /> {{ job.created_at }}</p>
                  <p class="text-sm bg-neutral-300 py-1 px-2 w-fit"><BanknoteIcon class="size-4 inline-block text-neutral-500"/> {{ new Intl.NumberFormat("en-US", {style: "currency", currency: "USD",}).format(job.min_currency_value) }}  - {{ new Intl.NumberFormat("en-US", {style: "currency", currency: "USD",}).format(job.max_currency_value) }} USD </p>
               </div>

            <SubmitLink :href="job.application_url" content="Apply Now" />

           </header>
           <article class="mt-12">
               <p class="w-[80%] my-4 px-4 prose prose-neutral max-w-none  prose-p:leading-relaxed whitespace-normal" v-html="job.content"></p>
           </article>
         </main>
      </CenterContent>
   </NavLayouts>
   
</template>
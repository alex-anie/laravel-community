<script setup lang="ts">
import { MyJobs } from '@/types';
      
      defineProps<{
         selectedJob?: MyJobs | null
      }>();
</script>
<template>
   <main>
     This is dynamic content
   </main>
</template>
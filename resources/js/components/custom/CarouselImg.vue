<script setup lang="ts">
    import { Carousel, CarouselContent, CarouselItem } from '@/components/ui/carousel';
    import Autoplay from 'embla-carousel-autoplay'
    
    import atlassian from "../../../../public/images/carousel/atlassian.png"
    import cloudflare from "../../../../public/images/carousel/cloudflare.png"
    import docker from "../../../../public/images/carousel/docker.png"
    import hashiCorp from "../../../../public/images/carousel/hashiCorp.png"
    import jet_brains from "../../../../public/images/carousel/jet_brains.png"
    import laravel from "../../../../public/images/carousel/laravel.png"
    import azure from "../../../../public/images/carousel/microsoft_azure.png"
    import sentry from "../../../../public/images/carousel/sentry.png"
    import supabase from "../../../../public/images/carousel/supabase.png"
    import tailwind from "../../../../public/images/carousel/tailwind_css.png"

    const imagesCarousel = [
        {id: 1, name: "Atlassian", path: atlassian},
        {id: 2, name: "Cloudflare", path: cloudflare},
        {id: 3, name: "Docker", path: docker},
        {id: 4, name: "HashiCorp", path: hashiCorp},
        {id: 5, name: "JetBrains", path: jet_brains},
        {id: 7, name: "Laravel", path: laravel},
        {id: 8, name: "Microsoft Azure", path: azure},
        {id: 9, name: "Sentry", path: sentry},
        {id: 10, name: "Supabase", path: supabase},
        {id: 11, name: "TailwindCSS", path: tailwind}
    ];

    const plugin = Autoplay({
        delay: 2000,
        stopOnMouseEnter: true,
        stopOnInteraction: false,
        });

    
</script>
<template>
    <Carousel
        class="w-full"
        :plugins="[plugin]"
        @mouseenter="plugin.stop"
        @mouseleave="[plugin.reset(), plugin.play(), console.log('Running')];"
        :opts="{
        align: 'center',
        loop: true,
        }"
        >
        <CarouselContent class="-ml-1">
        <CarouselItem v-for="image in imagesCarousel" :key="image.id" class="pl-6 md:basis-1/2 lg:basis-1/5">
            <div class="w-32">
                <img class="size-full object-cover object-center" :src="image.path" :alt="`${image.name} Logo`" />
            </div>
        </CarouselItem>
        </CarouselContent>
    </Carousel>
</template>